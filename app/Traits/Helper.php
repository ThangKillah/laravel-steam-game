<?php

namespace App\Traits;

use DOMDocument;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

trait Helper
{
    public function getDoomImageFromContent($content)
    {
        $message = $content;
        $dom = new DOMDocument();
        $dom->loadHtml(mb_convert_encoding($message, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        return $dom;
    }

    public function deleteImageByContent($content)
    {
        $dom = $this->getDoomImageFromContent($content);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            $split = explode('/', $src);
            $imageName = $split[count($split) - 1];
            Storage::disk('real')->delete(config('constant.image_comment_path') . $imageName);
        }
    }

    public function contentImageEncodeBase64($content)
    {
        $dom = $this->getDoomImageFromContent($content);
        $images = $dom->getElementsByTagName('img');
        // foreach <img> in the submited message
        foreach ($images as $img) {
            $src = $img->getAttribute('src');

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
        return $dom->saveHTML();
    }
}