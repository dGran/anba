<?php

declare(strict_types=1);

namespace App\Http\Util;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientHelper
{
    private const IP_API_URI = 'http://ip-api.com/json';

    public static function getClientIP(Request $request): string
    {
        return $request->ip();
    }

    public static function getGeoLocation(string $ip): array
    {
        try {
            $response = Http::get(self::IP_API_URI.'/'.$ip);

            if ($response->successful() && $response->json('status') === 'success') {
                return [
                    'country' => $response->json('country'),
                    'region' => $response->json('regionName'),
                    'city' => $response->json('city'),
                    'latitude' => $response->json('lat'),
                    'longitude' => $response->json('lon'),
                    'timezone' => $response->json('timezone'),
                    'isp' => $response->json('isp'),
                ];
            }

            return ['error' => 'Unable to retrieve location'];
        } catch (\Throwable $exception) {
            return ['error' => $exception->getMessage()];
        }
    }
}
