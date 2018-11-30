<?php

namespace App;

class ServerSentEvents {

    public static function sendEvent($event, $contents) {
        header('Cache-Control: no-cache');
        header("Content-Type: text/event-stream\n\n");

        echo 'event: ' . $event.'\n';
        echo 'data:'. json_encode($contents) ;
        echo '\n\n';
    }

}