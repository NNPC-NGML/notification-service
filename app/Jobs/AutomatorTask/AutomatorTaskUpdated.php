<?php

namespace App\Jobs\AutomatorTask;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\NotificationTaskService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Skillz\Nnpcreusable\Service\AutomatorTaskService;

class AutomatorTaskUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $data;
    private int $id;
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->id = $data["id"];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $service = new AutomatorTaskService();
        // $data = $this->data;
        // $service->update($data, $this->id);

        $service = new NotificationTaskService();
        $service->update($this->data, $this->id);
       
    }

    public function getData(): array
    {
        return $this->data;
    }
}
