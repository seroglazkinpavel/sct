<?php

namespace App\Services;

use App\Priority;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    /**
     * @param Request $request
     * @param Task $task
     * @return Task|null
     */
    public function fillingData(Request $request, Task $task): ?Task
    {
        if (!$this->isValid($request)) {
            return null;
        }

        $task->title = $request->post('title');
        $task->priority_id = $request->post('priority_id');
        $task->status = $request->post('status');
        $task->tags = collect($request->post('tags'))->toJson();
        $task->user_id = Auth::id();
        $task->save();

        return $task;
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function isValid(Request $request)
    {
        $emptyTitle = empty($request->post('title'));
        $issetStatus = in_array($request->post('status'), Task::STATUSES);
        $notValidPriority = empty(Priority::find($request->post('priority_id')));

        if ($emptyTitle || !$issetStatus || $notValidPriority) {
            return false;
        }

        return true;
    }
}
