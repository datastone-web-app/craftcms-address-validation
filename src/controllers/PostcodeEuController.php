<?php declare(strict_types=1);

namespace datastone\addressValidation\controllers;

use craft\web\Controller;
use datastone\addressValidation\AddressValidation;
use yii\web\Response;
use datastone\addressValidation\services\PostcodeEuService;

class PostcodeEuController extends Controller
{
    protected array|bool|int $allowAnonymous = true;

    public AddressValidation $plugin;
    public PostcodeEuService $postcodeEuClient;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->plugin = AddressValidation::getInstance();
        $this->postcodeEuClient = $this->plugin->postcodeEuClient;
    }

    // {{site_url}}/actions/address-validation/postcode-eu/autocomplete
    public function actionAutocomplete(): Response
    {
        $this->requireSiteRequest();

        $context = rawurlencode($this->request->getSegment(3));
        $term = rawurlencode($this->request->getSegment(4));
        $endpoint = sprintf('autocomplete/%s/%s', $context, $term);

        $response = $this->postcodeEuClient->request($endpoint);
        
        return $this->asJson(json_decode($response));
    }

    public function actionAddress(): Response
    {
        $this->requireSiteRequest();

        $address = $this->request->getSegment(3);
        $endpoint = sprintf('address/%s', ltrim($address, '/'));
         
        $response = $this->postcodeEuClient->request($endpoint);
        
        return $this->asJson(json_decode($response));
    }

    public function actionPostcode(): Response
    {
        $this->requireSiteRequest();

        $settings = $this->plugin->getSettings();

        $apiUrl = str_replace('international', 'nl', $settings->apiUrl);
        $postCode = $this->request->getSegment(3);
        $houseNumber = $this->request->getSegment(4);
        $addition = $this->request->getSegment(5);
        
        //implode('/', array_slice($this->request->getSegments(), 1))
        $endpoint = sprintf('addresses/postcode/%s/%s/%s', $postCode, $houseNumber, $addition);
    
        $response = $this->postcodeEuClient->request($endpoint, $apiUrl);
        
        return $this->asJson(json_decode($response));
    }
}