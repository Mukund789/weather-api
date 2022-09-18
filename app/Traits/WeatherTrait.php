<?php
namespace App\Traits;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use PhpParser\ErrorHandler\Throwing;
use Throwable;

trait WeatherTrait
{

    public function getCityData($city){

        try {
            $requestParams = [
                'appid'     => env('OPEN_WEATHER_API_KEY'),
                'q'         => $city,
                'limit'     => 1
            ];

            $cityDataApiUrl = env('CITY_DATA_API_URL');
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', url($cityDataApiUrl), [
                'query' => $requestParams
            ]);

            $responseData = json_decode((string) $response->getBody(), true);

            return $responseData;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    public function getCityWeatherData($lat, $lon){

        try {
            $requestParams = [
                'appid'     => env('OPEN_WEATHER_API_KEY'),
                'lat'         => $lat,
                'lon'         => $lon
            ];

            $openWeatherApiUrl = env('OPEN_WEATHER_API_URL');
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', url($openWeatherApiUrl), [
                'query' => $requestParams
            ]);

            $responseData = json_decode((string) $response->getBody(), true);

            return $responseData['list'] ?? [];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }
}
?>
