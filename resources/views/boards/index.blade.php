@extends('layouts.crud')

@section('content')

<div class="conteinerContent">
    @foreach($boards as $key => $board)
    <div class="board">
        <div class="boardHeader">
            <p> {{$board->subject}} </p>
            <i id="btn{{$board->id}}" class="fas fa-ellipsis-v boardOptionBtn"></i>
        </div>
        <div class="boardText">
            @foreach($tasks[$key] as $task)
            <div class="rowBoardText">
                <input type="checkbox" class="checkbox" {{ $task->done == 1 ? 'checked' : '' }}>
                <p> {{$task->text}} </p>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>


<!-- The Modal of account options -->
@foreach($boards as $board)
<div id="modal{{$board->id}}" class="modal boardOptionModal">

    <!-- Modal content -->

    <div class="modal-content">
        <p>Added by {{$board->user_id == auth()->user()->id ? 'You' : $board->user->name}}</p>
        <p>created at : {{$board->getCreated_at()}} \^_^/ last update : {{$board->getUpdated_at()}}</p>
        <a href="{{ route('show', ['id'=>$board->id]) }}">go to this board</a>
    </div>


</div>
@endforeach
<script>
    var boardOptionBtn = document.getElementsByClassName("boardOptionBtn");
    var boardOptionModal = document.getElementsByClassName("boardOptionModal");


    for (let i = 0; i < boardOptionBtn.length; i++) {
        boardOptionBtn[i].onclick = function() {
            boardOptionModal[i].style.display = "block";
        }
    }

    window.onclick = function(event) {
        for (let i = 0; i < boardOptionModal.length; i++) {
            if (event.target == boardOptionModal[i]) {
                boardOptionModal[i].style.display = "none";
            }
        }
    }
</script>
@endsection