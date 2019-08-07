<?php

namespace App\Http\Controllers;

class ServerSentEvents
{
    public const DOWNLOAD_START = 'download_start';
    public const DOWNLOAD_END = 'download_end';
    private const FILENAME = 'events.json';
    private static $arr = [];

    public function __construct()
    {
    }

    public static function getEvents()
    {
        /* Requires that a file named "count.json" already be in place.
If it's not, just create one and upload it. */
        $file = fopen(storage_path(self::FILENAME), "r+");
        $events = fgets($file);
        if (empty($events)) {
            $events = '';
        }
        self::$arr = json_decode($events) ? :[];
        fclose($file);
        return self::$arr;
    }

    public static function pushEvent($event, $contents)
    {
        self::getEvents();
        array_push(self::$arr, ['event' => $event, 'contents' => $contents]);
        $file = fopen(storage_path(self::FILENAME), "w+");
        fwrite($file, json_encode(self::$arr));
        fclose($file);
    }

    public static function resetEvents()
    {
        $file = fopen(storage_path(self::FILENAME), "w+");
        fwrite($file, '');
        self::$arr = [];
        fclose($file);
    }

    public static function popEvent()
    {
        self::getEvents();
        $event = array_shift(self::$arr);
        $file = fopen(storage_path(self::FILENAME), "w+");
        fwrite($file, json_encode(self::$arr));
        fclose($file);
        return $event;
    }
}