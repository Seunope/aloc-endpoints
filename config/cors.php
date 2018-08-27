<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */
   
    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['*'], //['Content-Type', 'X-Requested-With']
    'allowedMethods' => ['GET'],  // ex: ['GET', 'POST', 'PUT',  'DELETE']
    'exposedHeaders' => [],
    'maxAge' => 0,

];
