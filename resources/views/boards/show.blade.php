@extends('layouts.crud')

@section('content')
<div class="board" id="one-board">
  <div class="boardHeader">
    <th><strong>{{ $board->subject }}</strong></th>
    <th><i id="boardOptionBtn" class="fas fa-ellipsis-v"></i></th>
  </div>


  <div class="boardContent">

    @foreach($tasks as $task)
    <div class="task">
      <form class="checkbox" id="checkTask{{$task->id}}" method="POST" action="{{ route('doneTask', ['bid' => $board->id, 'tid' => $task->id]) }}">
        @csrf
        @method('PATCH')
        <input type="checkbox" name="done" onclick="submitF('checkTask','{{$task->id}}')" {{$task->done == 1 ? 'checked' : ''}} />
      </form>

      <form id="renameTask{{$task->id}}" class="taskText" method="POST" action="{{ route('renameTask', ['bid' => $board->id, 'tid' => $task->id]) }}">
        @csrf
        @method('PUT')
        <input type="text" name="task" placeholder="{{$task->text}}">
        <p class="submitEditTask" onclick="submitF('renameTask','{{$task->id}}')">&#xf06e</p>
      </form>

      <form class="removeTask" id="deleteTask{{$task->id}}" method="POST" action="{{ route('deleteTask', ['bid' => $board->id, 'tid' => $task->id]) }}">
        @csrf
        @method('DELETE')
        <i class="fas fa-trash-alt" onclick="submitF('deleteTask','{{$task->id}}')"></i>
      </form>
    </div>
    @endforeach

    <div class="boardFooter">
      <div class="whoAdded">
        <p>Added by {{$board->user_id == auth()->user()->id ? 'You' : $board->user->name}}</p>
      </div>
      <div class="faicon" id="addTaskBtn">
        <span title="add a task" class="fas fa-plus fa-lg" style="font-size: 15px; line-height: 29px;"></span>
      </div>
    </div>

  </div>
</div>

<!-- The Modal of board options -->
<div id="boardOptionModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="{{ route('delete', ['id'=>$board->id]) }}">delete board</a><br>
    <a href="{{ route('edit-board', ['id'=>$board->id]) }}">rename subject board</a>
  </div>

</div>

<!-- The Modal of add a Task -->
<div id="addTaskModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" id="addTaskModalContent">

    <form method="POST" action="{{ route('addTask', ['bid'=>$board->id]) }}">
      @csrf
      <input name="task" type="text">
      <input type="submit">
    </form>
  </div>

</div>

<script>
  //////////////////////////////////add task modal //////////////////////////
  var addTaskModal = document.getElementById("addTaskModal");
  var addTaskBtn = document.getElementById("addTaskBtn");

  addTaskBtn.onclick = function() {
    addTaskModal.style.display = "block";
  }
  window.onclick = function(event) {
    if (event.target == addTaskModal) {
      addTaskModal.style.display = "none";
    }
  }
  //////////////////////////////////board option modal //////////////////////////
  var boardOptionModal = document.getElementById("boardOptionModal");
  var boardOptionBtn = document.getElementById("boardOptionBtn");

  boardOptionBtn.onclick = function() {
    boardOptionModal.style.display = "block";
  }
  window.onclick = function(event) {
    if (event.target == boardOptionModal) {
      boardOptionModal.style.display = "none";
    }
  }

  /////submit for edit name task///////////////
  function submitF(preFix, formId) {
    // alert(preFix + formId);
    document.getElementById(preFix + formId).submit();
  }


  /////////this ids fr checkbox tick ///////////////
  // function toChangeTick(id) {
  //   var status = 'todo';
  //   if ($("#done" + id).prop('checked') == true) {
  //     status = 'done';
  //   }

  //   $.ajax({
  //     type: "PUT",
  //     url: 'http://localhost:8000/boards/' + id,
  //     data: {
  //       _token: "S7rPENJLTmslyUguigApMguIcCqO3UgiqsMesBmc",
  //       status: status
  //     }, // serializes the form's elements.
  //     success: function(data) {

  //     }
  //   });

  // }
</script>
@endsection