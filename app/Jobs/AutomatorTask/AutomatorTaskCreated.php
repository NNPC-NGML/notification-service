<?php

namespace App\Jobs\AutomatorTask;

use App\Services\NotificationTaskService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AutomatorTaskCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $data;


    public function __construct(array $data)
    {
        $this->data = $data;
    }


    public function handle(): void
    {
        $service = new NotificationTaskService();
        $service->create($this->data);
    }

    public function getData(): array
    {
        return $this->data;
    }
}
