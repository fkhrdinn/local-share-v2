<?php

namespace App\Jobs;

use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use App\Mail\BroadcastMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendBroadcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$data)
    {
        $this->data = $data;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = Arr::get($this->data, 'date');
        if (empty($date)) {
            Mail::to($this->email)
            ->send(new BroadcastMessage($this->data));
        } else {
            Mail::to($this->email)
                ->later($date, new BroadcastMessage($this->data));
        }
    }
}
