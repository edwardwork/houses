<?php

namespace App\Services\Dadata;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;
use JsonException;

class DadataService
{
    public function getFiasCodeForAddress(string $address): ?string
    {
        $client = new Client();

        try {
            $response = $client->post(config('dadata.api_url'), [
                RequestOptions::HEADERS => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Token ' . config('dadata.api_key'),
                ],
                RequestOptions::JSON => [
                    'query' => $address,
                ],
                RequestOptions::CONNECT_TIMEOUT => config('dadata.timeout_in_seconds'),
                RequestOptions::TIMEOUT => config('dadata.timeout_in_seconds'),
            ]);
        } catch (GuzzleException $e) {
            Log::channel('dadata')
                ->error(
                    'Error while fetching data from Dadata service',
                    [
                        'exception_message' => $e->getMessage()
                    ]
                );

            return null;
        }

        if ($response->getStatusCode() !== 200) {
            Log::channel('dadata')
                ->error('Response from Dadata service has status ' . $response->getStatusCode());
        }

        $data = null;

        try {
            $dataAsString = $response->getBody()->getContents();
            $data = json_decode($dataAsString, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            Log::channel('dadata')
                ->error('Error while json_decode from Dadata service: ' . $exception->getMessage());
        } catch (Exception $exception) {
            Log::channel('dadata')
                ->error('Undefined exception: ' . $exception->getMessage());
        }

        return $data['suggestions'][0]['data']['region_fias_id'] ?? null;
    }
}