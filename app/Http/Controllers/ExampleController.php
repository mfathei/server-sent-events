<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

// use Illuminate\Container\Container;

class ExampleController extends Controller
{
    protected $events;
    private $callback;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        global $callback;
        // $this->eventsArr = $eventsArr;
        $this->callback = function () {

            echo "event: message\n"; // for onmessage listener
            echo "event: ping\n";
            $curDate = date(DATE_ISO8601);
            echo 'data: {"time": "' . $curDate . '"}';
            echo "\n\n";

            while (($event = ServerSentEvents::popEvent()) != null) {
                $m = json_encode($event->contents);
                echo "event: $event->event\n";
                echo "data: $m";
                echo "\n\n";
            }
            // echo "event: message\n";
            // $curDate = date(DATE_ISO8601);
            // echo 'data: {"message-time": "' . $curDate . '"}';
            // echo "\n\n";
            // while(true){
            //     if ($index != $this->eventsCounter){
            //         ServerSentEvents::sendEvent($this->event, $this->eventBody);
            //         $index = $this->eventsCounter;
            //     }

            //     sleep(1);
            // }
        };
    }

    public function eventStream()
    {
        $response = new \Symfony\Component\HttpFoundation\StreamedResponse();
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('Connection', 'keep-alive');
        $response->headers->set('X-Accel-Buffering', 'no');//Nginx: unbuffered responses suitable for Comet and HTTP streaming applications
        $response->setCallback($this->callback);
        return $response;
    }

    public function getEvents()
    {
        var_dump(ServerSentEvents::getEvents());
        die;
    }

    public function register(Request $request)
    {
        $name = $request->name;
        // ServerSentEvents::$arr[] = 'register';
        // array_shift($e);
        ServerSentEvents::pushEvent('register', ['message' => 'User '. $name .' registered!']);
//        var_dump(ServerSentEvents::getEvents());
        return new JsonResponse(['status' => 'success'], 201);
    }
    //
}
