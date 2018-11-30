<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{
    protected $event;
    protected $eventBody;
    protected $eventsCounter = 0;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function eventStream() {
        $i = -999999;
        $response = new \Symfony\Component\HttpFoundation\StreamedResponse();
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');
        $response->headers->set('X-Accel-Buffering', 'no');//Nginx: unbuffered responses suitable for Comet and HTTP streaming applications
        $response->setCallback(function () use ($i) {

            echo "event: ping\n";
            $curDate = date(DATE_ISO8601);
            echo 'data: {"time": "' . $curDate . '"}';
            echo "\n\n";

            // while(true){
            //     if ($index != $this->eventsCounter){
            //         ServerSentEvents::sendEvent($this->event, $this->eventBody);
            //         $index = $this->eventsCounter;
            //     }

            //     sleep(1);
            // }
        });
        return $response;
    }

    //
}
