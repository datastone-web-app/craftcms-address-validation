<?php declare(strict_types=1);

namespace datastone\addressValidation\services;

use datastone\addressValidation\AddressValidation;
use GuzzleHttp\Client;
use yii\base\Component;

class PostcodeEuService extends Component
{
     public function request(string $endpoint, string $apiUrl = null): string
     {
        $settings = AddressValidation::getInstance()->getSettings();

        $client = new Client();

        $apiUrl = $apiUrl ?? $settings->apiUrl;

        $request = $client->get(
            sprintf('%s/%s', rtrim($apiUrl, '/'), $endpoint),
            [
                'http_errors' => false,
                'headers' => [
                    'X-Autocomplete-Session' => $_SERVER['HTTP_X_AUTOCOMPLETE_SESSION'] ?? 'remove-after-testing',
                ],
                'auth' => [
                    $settings->apiKey,
                    $settings->apiSecret,
                ]
            ]
        );

        return $request->getBody()->getContents();
    }
}