<?php

namespace Tests\Feature\Queue;

use Tests\TestCase;
use App\Models\NotificationTask;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use App\Jobs\AutomatorTask\AutomatorTaskCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotificationTastSendEmailTest extends TestCase
{
    use RefreshDatabase;
    public function test_to_send_job_to_communications_service(): void
    {

        Queue::fake();
        $email = NotificationTask::factory(['user_id' => $this->user()->id])->create();
        AutomatorTaskCreated::dispatch($email->toArray());
        Queue::assertPushed(AutomatorTaskCreated::class, function ($job) use ($email) {
            return $job->getData() == $email->toArray();
        });
    }
}
