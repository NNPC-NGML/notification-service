<?php

namespace App\Services;

use App\Models\Task;
use App\Services\UserService;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Jobs\CommunicationsService\EmailJob;
use Skillz\Nnpcreusable\Models\NotificationTask;
use App\Jobs\NotificationTask\NotificationTaskCreated;

/**
 * TaskAutomator is a service class responsible for automating tasks and sending notifications.
 */
class NotificationTaskAutomator
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * Constructor for TaskAutomator.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Send a task notification.
     *
     * @param array $request
     * @return void
     */
    public function send(array $request): void
    {
       
        $emailData = $this->prepareEmailData($request);

        $notificationTasksQueue = config("nnpcreusable.NOTIFICATION_TASK_CREATED");
                if (is_array($notificationTasksQueue) && !empty($notificationTasksQueue)) {
                    foreach ($notificationTasksQueue as $queue) {
                        $queue = trim($queue);
                        if (!empty($queue)) {
                            Log::info("Dispatching NotificationTask event to queue: " . $queue);
                            NotificationTaskCreated::dispatch($emailData)->onQueue($queue);
                        }
                    }
                } else{
                    NotificationTaskCreated::dispatch($emailData)->onQueue("communication_queue");
                }
    }

    /**
     * Prepare email data for the task notification.
     *
     * @param array $request
     * @return array
     */
    private function prepareEmailData(array $request): array
    {
        $user = $this->userService->show($request['user_id']);
        $emailData = [
            'id'=>$request['id'],
            'user_id'=>$request['user_id'],
            'type' => $request['entity_type'],
            'subject' => $request['title'],
            'title' => $request['title'],
            'message' => $request['title'],
            'email' => $user->email,
            'route' => $request['route'],
        ];

        return $emailData;
    }
}