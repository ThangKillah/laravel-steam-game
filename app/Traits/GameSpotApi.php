<?php

namespace App\Traits;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

trait GameSpotApi
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function callAPIQuery($url, $query)
    {
        $response = $this->client->request(
            'GET',
            $url,
            [
                'query' => $query
            ]
        );

        $status = $response->getStatusCode();
        if ($status == config('services.gamespot.status_ok')) {
            $data = $response->getBody()->getContents();
            return json_decode($data, true);
        } else {
            Log::info('Something s wrong Code status :' . $status);
            return [];
        }
    }


    public function getBlog($page)
    {
        $limit = config('services.gamespot.limit');
        $offset = ($page - 1) * $limit;

        $queryInit = [
            'format' => 'json',
            'api_key' => config('services.gamespot.key'),
            'offset' => $offset,
            'filter' => 'categories:18' .
                ',publish_date:' . config('constant.date_gamespot_blog') . '|' . Carbon::now(),
            'association' => 'guid'
        ];

        return $this->callAPIQuery(config('services.gamespot.url_blog'), $queryInit);
    }

    public function getReview($page)
    {
        $limit = config('services.gamespot.limit');
        $offset = ($page - 1) * $limit;

        $queryInit = [
            'format' => 'json',
            'api_key' => config('services.gamespot.key'),
            'offset' => $offset,
            'filter' => 'publish_date:' . config('constant.datetime_api_init') . '|' . Carbon::now()
        ];

        return $this->callAPIQuery(config('services.gamespot.url_review'), $queryInit);
    }
}