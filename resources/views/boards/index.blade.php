@extends('layouts.crud')
<!-- {{ route('create-form') }} -->
@section('content')

<div class="conteinerContent">
    @foreach($boards as $key => $board)
    <div class="board">
        <div class="boardHeader">
            <p> {{$board->subject}} </p>
            <i class="fas fa-ellipsis-v"></i>
        </div>
        <div class="boardText">
            @foreach($tasks[$key] as $task)
            <div class="rowBoardText">
                <input type="checkbox" name="radio" class="checkbox">
                <p> {{$task->text}} </p>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>
@endsection