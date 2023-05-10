<?php declare(strict_types=1);

namespace datastone\addressValidation;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class AddressValidationBundle extends AssetBundle
{
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = '@datastone/addressValidation/resources';

        // define the dependencies
        // $this->depends = [
        //     CpAsset::class,
        // ];

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            'script.js',
            'AutocompleteAddress.min.js'
        ];

        $this->css = [
            'styles.css',
            'autocomplete-address.css'
        ];

        parent::init();
    }
}