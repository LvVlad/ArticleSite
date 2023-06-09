<?php declare(strict_types=1);

namespace App;

use Carbon\Carbon;

class Cache
{
    public static function remember(string $key, string $data, int $ttl = 100): void
    {
        $cacheFileName = realpath(__DIR__. "/../cache/").'/'. $key;

        file_put_contents($cacheFileName, json_encode
        ([
            'ttl' => Carbon::now()->addSeconds($ttl),
            'data' => $data
        ])
        );
    }

    public static function has(string $key): bool
    {
        if(!file_exists(realpath(__DIR__.'/../cache/').'/' . $key))
        {
            return false;
        }
        $content = json_decode(file_get_contents(realpath(__DIR__.'/../cache/').'/' . $key));
        return (new Carbon($content->ttl)) > (Carbon::now());
    }

    public static function forget(string $key): void
    {
        unlink(realpath(__DIR__.'/../cache/').'/' . $key);
    }

    public static function get(string $key): ?string
    {
        if(!self::has($key))
        {
            return null;
        }

        $content = json_decode(file_get_contents(realpath(__DIR__.'/../cache/').'/' . $key));
        return $content->data;
    }
}