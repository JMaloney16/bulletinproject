<?php

namespace App;

use Illuminate\Support\Facades\Http;

class Weather
{
    private $apiKey;
    private $location;

    public function __construct($apiKey, $location) {
        $this->apiKey = $apiKey;
        $this->location = $location;
    }

    public function getLocalWeather(){
        $request = 'http://api.openweathermap.org/data/2.5/weather?q='.$this->location.'&units=metric&appid='.$this->apiKey;
        $response = Http::get($request);
        return $response->json();
    }
}
