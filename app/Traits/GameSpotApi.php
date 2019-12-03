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

        $response = $this->client->request(
            'GET',
            config('services.gamespot.url_review'),
            [
                'query' => $queryInit
            ]
        );

        $status = $response->getStatusCode();
        if ($status == config('services.gamespot.status_ok')) {
            $data = $response->getBody()->getContents();
            return json_decode($data, true);
        } else {
            Log::info('Cant get review game, code status :' . $status);
            return [];
        }
    }
}