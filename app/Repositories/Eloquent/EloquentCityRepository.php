<?php

namespace App\Repositories\Eloquent;

use App\Models\City;
use App\Repositories\Contracts\CityRepository;
use App\Traits\WeatherTrait;

class EloquentCityRepository implements CityRepository
{

    private $city;
    use WeatherTrait;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    public function save(array $data)
    {
        $cityData = [];
        $cityData['name'] = $data['name'];

        $cityDetails = $this->getCityData($data['name']);
        if(!count($cityDetails)){
            throw new \Exception('No Data found');
        }
        $cityData['latitude'] = $cityDetails[0]['lat'];
        $cityData['longitude'] = $cityDetails[0]['lon'];
        $cityData['country'] = $cityDetails[0]['country'];
        $cityData['state'] = $cityDetails[0]['state'];

        $city = $this->city->create($cityData);

        return $city;
    }

    public function getWeatherDetails(array $data)
    {
        $cityName = $data['name'] ?? '';

        $cityDetails = $this->city->when($cityName, function ($query, $cityName) {
            $query->where('name', $cityName);
        })->get();

        foreach ($cityDetails as $cityDetail) {
            $weatherDetails = $this->getCityWeatherData($cityDetail->lat, $cityDetail->lon);
            $cityDetail->weatherDetail = $weatherDetails;
        }
        return $cityDetails;
    }
}
