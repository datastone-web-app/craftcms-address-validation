<?php

return [
    'postcode-eu/postcode/<postcode>/<houseNumber:\d+>/<houseNumberAddition:\w+>' => 'address-validation/postcode-eu/postcode',
    'postcode-eu/postcode/<postcode>/<houseNumber:\d+>' => 'address-validation/postcode-eu/postcode',
    'postcode-eu/postcode/<postcode>' => 'address-validation/postcode-eu/postcode',
    'postcode-eu/autocomplete/<context>/<term>' => 'address-validation/postcode-eu/autocomplete',
    'postcode-eu/address/<address>' => 'address-validation/postcode-eu/address',
];