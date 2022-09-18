<?php

namespace App\Repositories\Contracts;

interface CityRepository extends BaseRepository
{
    public function getWeatherDetails(array $data);
}
