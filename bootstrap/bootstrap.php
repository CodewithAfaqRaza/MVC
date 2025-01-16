<?php

use App\Providers\EventServiceProvider;
use App\Providers\RouteServiceProvider;

$providers = [
    EventServiceProvider::class,
    RouteServiceProvider::class
];
foreach($providers as $provider){
    $providerObj = $container->get($provider);
    $providerObj->register();
}