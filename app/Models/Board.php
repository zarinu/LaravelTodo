<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Board extends Model
{
    use HasFactory;

    protected static function getTasksBoards($boards)
    {
        $allBoardTasks = [];

        foreach ($boards as $board) {
            $tasks = Task::where('board_id', $board->id)->get();
            array_push($allBoardTasks, $tasks);
        }
        return $allBoardTasks;
    }
}
