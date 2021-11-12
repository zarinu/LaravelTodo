<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Support\Facades\Auth;

class BoardsController extends Controller
{
    //

    public function index(Request $request)
    {
        # code...

        $boards = Board::where('user_id', Auth::user()->id)->get();
        $tasks = Board::getTasksBoards($boards);
        return view('boards.index')->with(['boards' => $boards, 'tasks' => $tasks]);
    }

    public function byUserId(Request $request)
    {
        # code...
        
        $Boards = Board::where('user_id', Auth::user()->id)->get();
        return view('Boards.index')->with(['Boards' => $Boards]);
    }

    public function show(Request $request, $id)
    {
        # code...
        $Board = Board::find($id);
        return view('Boards.show')->with(['Board' => $Board]);
    }

    public function edit(Request $request, $id)
    {
        # code...
        $Board = Board::find($id);
        return view('Boards.edit', ['Board' => $Board]);
    }

    public function update(Request $request, $id)
    {
        # Validations before updating
        $Board = Board::where('user_id', Auth::user()->id)->where('id', $id)->first();

        if ($Board) {
            $Board->title = $request->title;
            $Board->desc = $request->desc;
            $Board->status = $request->status == 'on' ? 1 : 0;
            if ($Board->save()) {
                return view('Boards.show', ['Board' => $Board]);
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
        # Validations before updating
        $Board = new Board;
        $Board->title = $request->title;
        $Board->desc = $request->desc;
        $Board->user_id = Auth::user()->id;
        if ($Board->save()) {
            return view('Boards.show', ['Board' => $Board]);
        }

        return; // 422
    }

    public function delete(Request $request, $id)
    {
        # code...
        $Board = Board::where('user_id', Auth::user()->id)->where('id', $id)->first();
        if ($Board) {
            $Board->delete();
            return view('Boards.index');
        }
        return; // 404
    }
}

