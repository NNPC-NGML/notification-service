<?php



namespace App\Http\Controllers;

use App\Models\NotificationTask;
use Illuminate\Http\Request;
use App\Services\NotificationTaskService;
use App\Http\Resources\TaskCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Tag(name="Tasks")
 */


class TaskController extends Controller
{
    protected $service;

    public function __construct(NotificationTaskService $taskService)
    {
        $this->service = $taskService;
    }

    /**
     * @OA\Get(
     *     path="/tasks/{id}",
     *     summary="Get tasks by user ID and status",
     *     
     *     @OA\Parameter(
     *         name="paginate",
     *         in="query",
     *         description="Pagination count",
     *         required=false,
     *         @OA\Schema(type="integer", default=20)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of tasks",
     *         @OA\JsonContent(ref="#/components/schemas/TaskCollection"),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error"
     *     )
     * )
     */

    // public function show(int $id, int $paginate = 20): JsonResource
    // {
    //     $tasks = $this->service->getTasksByUserIdAndStatus($id, NotificationTask::PENDING, $paginate);
    //     return new TaskCollection($tasks);
    // }


    public function show(Request $request): JsonResource
    {
        $id = auth()->id();
        $perPage = $request->query('per_page', 20);
        $tasks = $this->service->getTasksByUserIdAndStatus($id, NotificationTask::PENDING, $perPage);
        return new TaskCollection($tasks);
    }
}
