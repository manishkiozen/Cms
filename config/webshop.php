<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Number settings
    |--------------------------------------------------------------------------
    |
    | Configure the presentation of numbers. By default it is configured as
    | used on the European continent.
    |
    */
    'numbers' => [

        // The character inserted before decimals are displayed.
        'decimal_point' => ',',

        // The character used to separate groups of thousands.
        'thousands_separator' => '.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Currency settings
    |--------------------------------------------------------------------------
    |
    | Here you can set the currency settings your webshop will be using. By
    | default, everything is configured for euros.
    |
    */
    'currency' => [

        // Use ISO 4217 currency codes only (see http://en.wikipedia.org/wiki/ISO_4217).
        'code' => 'EUR',

        // Use the appropriate HTML entity or use text. Used for presentation purposes only.
        'symbol' => '&euro;',

        // Indicates if a non-breaking space is used after the currency symbol.
        'trailing_space' => true,

        // The number of decimals used in amounts.
        'precision' => 2,

    ],



];
