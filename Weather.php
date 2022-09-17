<?php

class Weather
{
    private $key;
    private $aqi = "yes";
    private $alerts = "yes";

    function __construct($key)
    {
        $this->key = $key;
    }

    function now($q)
    {
        $url = "http://api.weatherapi.com/v1/current.json?key=" . $this->key . "&aqi=" . $this->aqi . "&q=" . $q;
        $data = json_decode(file_get_contents($url), true);
        return $data;
    }

    function today($q)
    {
        $url = "http://api.weatherapi.com/v1/forecast.json?key=" . $this->key . "&q=" . $q . "&days=1&aqi=" . $this->aqi . "&alerts=".$this->alerts;
        $data = json_decode(file_get_contents($url), true);
        return $data;
    }

    function tomorrow($q){
        $url = "http://api.weatherapi.com/v1/forecast.json?key=" . $this->key . "&q=" . $q . "&days=2&aqi=" . $this->aqi . "&alerts=".$this->alerts;
        $data = json_decode(file_get_contents($url), true);
        $data['forecast']['forecastday'][0] = $data['forecast']['forecastday'][1];
        unset($data['forecast']['forecastday'][1]);
        return $data;
    }

    function week($q){
        $url = "http://api.weatherapi.com/v1/forecast.json?key=" . $this->key . "&q=" . $q . "&days=7&aqi=" . $this->aqi . "&alerts=".$this->alerts;
        $data = json_decode(file_get_contents($url), true);
        return $data;
    }
}