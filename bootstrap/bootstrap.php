<?php

use App\Providers\EventServiceProvider;

$providers = [
    EventServiceProvider::class
];
foreach($providers as $provider){
    $providerObj = $container->get($provider);
    $providerObj->register();
}