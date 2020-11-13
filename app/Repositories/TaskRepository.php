<?php

namespace App\Repositories;

use App\Task;

class TaskRepository
{
    /**
     * @param $id
     * @return array
     */
    public function getAllTaskForUser($id): array
    {
        $tasks = Task::all()
            ->where('user_id', $id)
            ->jsonSerialize(JSON_UNESCAPED_UNICODE);
        return array_values($tasks);
    }
}
