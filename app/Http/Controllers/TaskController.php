<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Board, Task};
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int   $bid
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $bid)
    {
        $board = Board::find($bid);
        if ($board->user_id != Auth::user()->id) {
            echo "access denied";
            return; // 403
        }
        $task = new Task;
        $task->construct($request->task, $bid);
        if ($task->save()) {
            return redirect('/boards/' . $bid);
        }

        return; // 422
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $bid
     * @param int   $tid
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $bid, $tid)
    {
        //
        $board = Board::find($bid);
        if ($board->user_id != Auth::user()->id) {
            echo "access denied";
            return; // 403
        }

        $task = Task::find($tid);
        if (empty($request->done)) {
            $task->done = false;
        } else if ($request->done == 'on') {
            $task->done = true;
        }

        if ($task->save()) {
            return redirect('/boards/' . $bid);
        }

        return; // 422 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $bid
     * @param int   $tid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bid, $tid)
    {
        # code...
        $board = Board::find($bid);
        if ($board->user_id != Auth::user()->id) {
            echo "access denied";
            return; // 403
        }
        $task = Task::find($tid);
        $task->text = $request->task;

        if ($task->save()) {
            return redirect('/boards/' . $bid);
        }

        return; // 422 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $bid
     * @param int   $tid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $bid, $tid)
    {
        //
        $board = Board::find($bid);
        if ($board->user_id != Auth::user()->id) {
            echo "access denied";
            return; // 403
        }
        $task = Task::find($tid);
        if ($task) {
            $task->delete();
            return redirect('/boards/' . $bid);
        }
        return; // 404
    }
}
