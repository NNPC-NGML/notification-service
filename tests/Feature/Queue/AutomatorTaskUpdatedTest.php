<?php

namespace Tests\Feature\Queue;

use Tests\TestCase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use App\Jobs\AutomatorTask\AutomatorTaskUpdated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AutomatorTaskUpdatedTest extends TestCase
{
    use RefreshDatabase;



    public function test_it_notification_receives_automator_task_updated_job_from_automator_services(): void
    {
        Queue::fake();

        $request = [
            'id' => 20,
            'processflow_history_id' => 1,
            'formbuilder_data_id' => 2,
            'entity_id' => 3,
            'entity_type' => 'customer',
            'user_id' => 4,
            'processflow_id' => 5,
            'processflow_step_id' => 6,
            'title' => 'Create DDQ',
            'route' => 'https://example.com/create-ddq',
            'start_time' => '2023-05-15',
            'end_time' => '2023-05-20',
            'task_status' => 0,
        ];
        AutomatorTaskUpdated::dispatch($request);

        Queue::assertPushed(AutomatorTaskUpdated::class, function ($job) use ($request) {
            return $job->getData() == $request;
        });
    }
}
