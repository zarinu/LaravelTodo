@extends('layouts.crud')

@section('content')
<div class="board" id="one-board">
  <div class="boardHeader">
    <th><strong>{{ $board->subject }}</strong></th>
    <th><i id="myBtn" class="fas fa-ellipsis-v"></i></th>
  </div>


  <div class="boardContent">
    @foreach($tasks as $task)
    <div class="task">
      <form class="checkbox">
        <input type="checkbox" name="" {{ $task->done == 1 ? 'checked' : '' }} />
      </form>

      <form class="taskText">
        <input type="text" name="" placeholder="{{$task->text}}" class="">
      </form>

      <form class="removeTask">
        <i class="fas fa-trash-alt"></i>
      </form>
    </div>
    @endforeach
    <div class="boardFooter">
      <div class="whoAdded">
        <p>Added by {{$board->user_id == auth()->user()->id ? 'You' : $board->user->name}}</p>
      </div>
      <div class="addTask faicon">
        <span title="add a text" class="fas fa-plus fa-lg" style="font-size: 15px; line-height: 29px;"></span>
      </div>
    </div>

  </div>
</div>

<!-- The Modal of account options -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="{{ route('delete', ['id'=>$board->id]) }}">delete board</a><br>
    <a href="{{ route('edit-board', ['id'=>$board->id]) }}">rename subject board</a>
  </div>

</div>


<script>
  // Get the modal
  var modali = document.getElementById("myModal");

  // Get the button that opens the modal
  var btni = document.getElementById("myBtn");

  // When the user clicks the button, open the modal 
  btni.onclick = function() {
    modali.style.display = "block";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modali) {
      modali.style.display = "none";
    }
  }
</script>
@endsection
<!-- 
<form method="post" action="{{ route('showp', ['id'=>$board->id]) }}">
          @csrf
          <!-- {{ csrf_field() }} -->
<!-- <input name="textt" type="text">
    <input type="submit">
    </form> -->