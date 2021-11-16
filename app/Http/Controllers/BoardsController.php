<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Board, Task, User};
use Illuminate\Support\Facades\Auth;

class boardsController extends Controller
{
    //
    public function index(Request $request)
    {
        # code...
        $boards = Board::getUserBoards();
        $tasks = Board::getTasksboards($boards);
        return view('boards.index')->with(['boards' => $boards, 'tasks' => $tasks]);
    }

    public function show(Request $request, $id)
    {
        # code...
        $board = Board::find($id);
        if (empty($board)) {
            echo "this board doesn't exsist";
            return; // 404
        }
        $tasks = Task::where('board_id', $id)->get();
        return view('boards.show')->with(['board' => $board, 'tasks' => $tasks]);
    }

    public function edit(Request $request, $id)
    {
        # code...
        $board = Board::find($id);
        if (empty($board)) {
            echo "this board doesn't exsist";
            return; // 404
        }
        if ($board->user_id != Auth::user()->id) {
            echo "access denied";
            return; // 403
        }
        return view('boards.edit', ['board' => $board]);
    }

    public function update(Request $request, $id)
    {
        # Validations before updating
        if ($request->subject == null) {
            return redirect('/boards/' . $id);
        }
        $board = Board::where('user_id', Auth::user()->id)->where('id', $id)->first();

        if ($board) {
            $board->subject = $request->subject;
            if ($board->save()) {
                return redirect('/boards/' . $id);
            }
            return; // 422
        }

        return; // 401
    }

    public function create(Request $request)
    {
        # code...
        return view('boards.add');
    }

    public function store(Request $request)
    {
        // codes
        if ($request->subject == null) {
            return redirect('/todo/');
        }
        $board = Board::create($request->subject, Auth::user()->id);
        if ($board->save()) {
            return redirect('/boards/' . $board->id);
        }

        return; // 422
    }

    public function search(Request $request)
    {
        // get tasks and boards that user can see thems
        $boards = Board::getUserBoards();
        $resaultB = $boards->where('subject', $request->search);

        $tasks = Board::getTasksboards($boards);
        $resaultT = $tasks[0]->where('text', $request->search);

        if ($resaultB->toArray() == null && $resaultT->toArray() == null) {
            echo "niste";
            return; // 404
        }
        return view('boards.search', ['boards' => $resaultB, 'tasks' => $resaultT]);
    }

    public function collabGet($id)
    {
        $board = Board::find($id);
        if (empty($board)) {
            echo "this board doesn't exist";
            return; // 404
        }
        if ($board->user_id != Auth::user()->id) {
            echo "access denied";
            return; // 403
        }
        return view('boards.collab', ['boardId' => $id]);
    }

    public function collab(Request $request, $id)
    {
        $collabId = $request->collab_id;
        $user = User::find($collabId);
        if (empty($user)) {
            echo "گشتیم نبود نگرد نیست";
            return;
        }

        $board = Board::find($id);

        $preValue = $board->collab_id;
        if (empty($preValue)) {
            $preValue = [];
        }
        $lala = array_search(intval($collabId), $preValue, TRUE);
        if ($lala !== False) {
            echo "qablan collab shode";
            return;
        }
        array_push($preValue,  intval($collabId));
        $board->collab_id = $preValue;

        if ($board->save()) {
            return redirect('/boards/' . $id);
        }
        return; // 422
    }

    public function delete(Request $request, $id)
    {
        # code...
        $board = Board::find($id);
        if (empty($board)) {
            echo "this board doesn't exsist";
            return; // 404
        }
        if ($board->user_id != Auth::user()->id) {
            echo "access denied";
            return; // 403
        }
        if ($board) {
            $board->deleteWithTasks();
            return redirect('/todo');
        }
        return; // 404
    }
}
