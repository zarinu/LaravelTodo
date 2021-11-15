@extends('layouts.crud')

@section('content')

<div class="conteinerContent">
    @foreach($boards as $key => $board)
    <div class="board">
        <div class="boardHeader">
            <p> {{$board->subject}} </p>
            <i id="btn{{$board->id}}" class="fas fa-ellipsis-v boardsOptionBtn"></i>
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
<div id="modal{{$board->id}}" class="modal boardsOptionModal">

    <!-- Modal content -->

    <div class="modal-content">
        <p>Added by {{$board->user_id == auth()->user()->id ? 'You' : $board->user->name}}</p>
        <p>created at : {{$board->getCreated_at()}} \^_^/ last update : {{$board->getUpdated_at()}}</p>
        <a href="{{ route('show', ['id'=>$board->id]) }}">go to this board</a>
    </div>


</div>
@endforeach
<script>
    var boardsOptionBtn = document.getElementsByClassName("boardsOptionBtn");
    var boardsOptionModal = document.getElementsByClassName("boardsOptionModal");


    for (let i = 0; i < boardsOptionBtn.length; i++) {
        boardsOptionBtn[i].onclick = function() {
            boardsOptionModal[i].style.display = "block";
        }
    }

    window.onclick = function(event) {
        for (let i = 0; i < boardsOptionModal.length; i++) {
            if (event.target == boardsOptionModal[i]) {
                boardsOptionModal[i].style.display = "none";
            }
        }
    }
</script>
@endsection