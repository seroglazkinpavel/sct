<?php

namespace App\Repositories;

use App\Priority;

class PriorityRepository
{
    /**
     * @return string
     */
    public function getAllJson(): string
    {
        return Priority::all()->keyBy('id')->toJson();
    }
}
