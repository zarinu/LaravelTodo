<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function construct($text, $bid)
    {
        $this->text = $text;
        $this->board_id = $bid;
    }
    public static function deleteAll($tasks) {
        foreach($tasks as $task) {
            $task->delete();
        }
    }
    
}
