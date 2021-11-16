<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class Board extends Model
{
    use HasFactory;

    protected $casts = [
        'collab_id' => 'array'
    ];

    public static function create($subject, $userId)
    {
        $board = new Board;
        $board->subject = $subject;
        $board->user_id = $userId;
        return $board;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getUserBoards()
    {
        $collabBoards = Board::whereJsonContains('collab_id', Auth::user()->id)->get();
        $boards = Board::where('user_id', Auth::user()->id)->get();
        $boards = $boards->merge($collabBoards);
        return $boards;
    }

    protected static function getTasksBoards($boards)
    {
        $allBoardTasks = [];

        foreach ($boards as $board) {
            $tasks = Task::where('board_id', $board->id)->get();
            array_push($allBoardTasks, $tasks);
        }
        return $allBoardTasks;
    }

    private static function convertTime($zaman)
    {
        $time = time() - strtotime($zaman); // to get the time since that moment
        $time = ($time < 1) ? 1 : $time;
        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            $resault = $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
            return $resault . ' ago';
        }
    }

    public function getCreated_at()
    {
        return Board::convertTime($this->created_at);
    }
    public function getUpdated_at()
    {
        return Board::convertTime($this->updated_at);
    }

    public function deleteWithTasks()
    {
        $tasks = Task::where('board_id', $this->id)->get();
        Task::deleteAll($tasks);
        $this->delete();
    }

    public static function deleteAll($boards)
    {
        foreach ($boards as $board) {
            $board->deleteWithTasks();
        }
    }
}
