<?php

namespace App\Jobs;

use App\Http\Controllers\ServerSentEvents;

class DownloadJob extends Job
{
    protected $wait;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $wait = 1)
    {
        $this->wait = $wait;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep($this->wait);
        ServerSentEvents::pushEvent(ServerSentEvents::DOWNLOAD_END, ['message' => 'Download completed!']);
    }
}
