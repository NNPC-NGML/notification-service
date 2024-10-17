<?php

namespace App\Services;

use App\Models\Task;
use App\Services\UserService;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Validator;
use App\Jobs\CommunicationsService\EmailJob;
use App\Jobs\Notification\NotificationCreated;

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
        //send to communication service , which would send send the email

        NotificationCreated::dispatch($emailData)->onQueue("communication_queue");
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
            'type' => $request['entity_type'],
            'title' => $request['title'],
            'email' => $user->email,
            'route' => $request['route'],
        ];

        return $emailData;
    }
}
