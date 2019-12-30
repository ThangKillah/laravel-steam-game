<?php

namespace App\Traits;

use DOMDocument;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

trait Helper
{
    public function getDoomImageFromContent($content)
    {
        $dom = new DOMDocument();
        $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        return $dom;
    }

    public function deleteImageByContent($content, $arrSrcImg = [])
    {
        $dom = $this->getDoomImageFromContent($content);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (!in_array($src, $arrSrcImg)) {
                $split = explode('/', $src);
                $imageName = $split[count($split) - 1];
                Storage::disk('real')->delete(config('constant.image_comment_path') . $imageName);
            }
        }
    }

    public function contentImageEncodeBase64($content)
    {
        $arrSrcImg = [];
        $dom = $this->getDoomImageFromContent($content);
        $images = $dom->getElementsByTagName('img');
        // foreach <img> in the submited message
        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (strpos($src, config('constant.image_comment_path')) !== false) {
                $arrSrcImg[] = $src;
            }

            // if the img source is 'data-url'
            if (preg_match('/data:image/', $src)) {
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];

                // Generating a random filename
                $filename = time() . uniqid() . '.' . $mimetype;

                $path = public_path(config('constant.image_comment_path'));
                if (!file_exists($path)) {
                    mkdir($path, 666, true);
                }

                // @see http://image.intervention.io/api/
                Image::make($src)
                    // resize if required
                    /* ->resize(300, 200) */
                    ->encode($mimetype, 100)    // encode file to the specified mimetype
                    ->save($path . $filename);

                $new_src = config('services.homepage_url') . config('constant.image_comment_path') . $filename;
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } // <!--endforeach
        return [
            'doom' => $dom->saveHTML(),
            'arrSrcImg' => $arrSrcImg,
        ];
    }

    public function editContentGameSpot($content)
    {
        $dom = new DOMDocument();
        @$dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $tagA = $dom->getElementsByTagName('a');
        foreach ($tagA as $a) {
            $src = $a->getAttribute('href');
            $list[] = $src;
            if ($this->checkIsGameSlug($src)) {
                $a->removeAttribute('href');
                $a->setAttribute('href', route('game-detail', str_replace('/', '', $src)));
                continue;
            }

            if ($this->checkStringStarWithString('/articles/', $src)) {
                $a->removeAttribute('href');
                $a->setAttribute('href', str_replace("/articles/", "https://www.gamespot.com/articles/", $src));
                continue;
            }

            if ($this->checkStringStarWithString('/gallery/', $src)) {
                $a->removeAttribute('href');
                $a->setAttribute('href', str_replace("/gallery/", "https://www.gamespot.com/gallery/", $src));
                continue;
            }
        }
        //dd($list);
        return $dom->saveHTML();
    }

    public function checkStringContain($search, $stringToCheck)
    {
        if (strpos($stringToCheck, $search) !== false) {
            return true;
        }
        return false;
    }

    public function checkIsGameSlug($slug)
    {
        if (substr_count($slug, '/') == 2 && substr($slug, 0, 1) === '/' && substr($slug, -1) == '/') {
            return true;
        }
        return false;
    }

    public function checkStringStarWithString($search, $stringToCheck)
    {
        return substr($stringToCheck, 0, strlen($search)) == $search;
    }
}