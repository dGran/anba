<?php

declare(strict_types=1);

namespace App\Helpers;

use Symfony\Component\Serializer\Serializer as SymfonySerializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class Serializer
{
    private static ?SymfonySerializer $serializer = null;

    private static function getSerializer(): SymfonySerializer
    {
        if (self::$serializer === null) {
            $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];
            self::$serializer = new SymfonySerializer($normalizers, $encoders);
        }

        return self::$serializer;
    }

    public static function serialize($data, string $format = 'json'): string
    {
        return self::getSerializer()->serialize($data, $format);
    }

    public static function deserialize(string $data, string $type, string $format = 'json')
    {
        return self::getSerializer()->deserialize($data, $type, $format);
    }
}
