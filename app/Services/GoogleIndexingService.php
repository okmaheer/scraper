<?php

namespace App\Services;

use Google_Client;
use Google_Service_Indexing;

class GoogleIndexingService
{
    protected $client;
    protected $indexingService;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setAuthConfig(storage_path('app/google-service-account.json'));
        $this->client->addScope(Google_Service_Indexing::INDEXING);
        $this->indexingService = new Google_Service_Indexing($this->client);
    }

    public function submitUrl(string $url, string $type = 'URL_UPDATED')
    {
        $body = new \Google_Service_Indexing_UrlNotification();
        $body->setType($type);
        $body->setUrl($url);

        try {
            $response = $this->indexingService->urlNotifications->publish($body);
            return $response;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
