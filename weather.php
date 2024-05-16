<?php

$city = readline("Enter a city: ");
$country = readline("Enter a country: ");
$apiKey = "7e21293de5f3fe1c2319ab0cf7d2c913";
$url = "http://api.openweathermap.org/data/2.5/weather?q=$city,$country&units=metric&appid=$apiKey";
$getContents = @file_get_contents($url);

if ($getContents === false) {
    die("Error");
}

$weatherData = json_decode($getContents);

$sunrise = $weatherData->sys->sunrise + $weatherData->timezone;
$sunriseTime = date("H:i", $sunrise);
$currentTime = date("H:i", time() + $weatherData->timezone);
$sunset = $weatherData->sys->sunset + $weatherData->timezone;
$sunsetTime = date("H:i", $sunset);

echo "Time is " . $currentTime . PHP_EOL;
echo "Current temperature in " . $weatherData->name . " is " . $weatherData->main->temp . "°C" . PHP_EOL;
echo "Temperature feels like " . $weatherData->main->feels_like . "°C" . PHP_EOL;
echo "Humidity is " . $weatherData->main->humidity . "%" . PHP_EOL;
echo "Sunrise will be at " . $sunriseTime . PHP_EOL;
echo "Sunset will be at " . $sunsetTime . PHP_EOL;
echo "Weather parameters: " . $weatherData->weather[0]->main . PHP_EOL;
echo "Weather condition is " . $weatherData->weather[0]->description . PHP_EOL;
echo "Cloudiness is " . $weatherData->clouds->all . "%" . PHP_EOL;
echo "Wind is " . $weatherData->wind->speed . " m/s" . PHP_EOL;