<?php declare(strict_types=1);

namespace datastone\addressValidation\controllers;

use craft\web\Controller;
use datastone\addressValidation\AddressValidation;
use GuzzleHttp\Client;
use yii\web\Response;

class PostcodeEuController extends Controller
{
    protected array|bool|int $allowAnonymous = true;

    // {{ actionInput('address-validation/postcode-eu/autocomplete') }} or {{site_url}}/actions/address-validation/postcode-eu/autocomplete
    public function actionAutocomplete(): Response
    {
        $this->requireSiteRequest();

        $settings = AddressValidation::getInstance()->getSettings();

        $client = new Client();

        $context = rawurlencode($this->request->getRequiredParam('context'));
        $term = rawurlencode($this->request->getRequiredParam('term'));

        $request = $client->get(
            sprintf('%s/autocomplete/%s/%s', rtrim($settings->apiUrl, '/'), $context, $term),
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
        
        return $this->asJson(json_decode($request->getBody()->getContents()));
    }

    public function actionAddress(): Response
    {
        $this->requireSiteRequest();

        $settings = AddressValidation::getInstance()->getSettings();

        $client = new Client();

        $address = $this->request->getRequiredParam('address');

        $request = $client->get(
            sprintf('%s/address/%s', rtrim($settings->apiUrl, '/'), ltrim($address, '/')),
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
        
        return $this->asJson(json_decode($request->getBody()->getContents()));
    }

    public function actionPostcode(): Response
    {
        $this->requireSiteRequest();

        $settings = AddressValidation::getInstance()->getSettings();

        $client = new Client();

        $apiUrl = str_replace('international', 'nl', $settings->apiUrl);
        $postCode = '5627BK';
        $houseNumber = '57';

        $request = $client->get(
            sprintf('%s/addresses/postcode/%s/%s', rtrim($apiUrl, '/'), $postCode, $houseNumber),
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
        
        return $this->asJson(json_decode($request->getBody()->getContents()));
    }
}