@extends('layouts.crud')
@section('content')


<h1>Boards</h1>
@foreach($boards as $board)
<a href="{{ route('show', ['id'=>$board->id]) }}">go to this</a>
@endforeach

<h1>Tasks</h1>
@foreach($tasks as $task)
<a href="{{ route('show', ['id'=>$task->board_id]) }}">go to this</a>
@endforeach


@endsection