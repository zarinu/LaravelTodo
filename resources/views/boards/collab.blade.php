@extends('layouts.crud')

@section('content')
<div class="board">
    <form class="formAddBoard" method="POST" action="{{ route('collab' , ['id'=>$boardId]) }}">
        @csrf
        <div class="pt-5 pb-5 pr-5">
            <input name="collab_id" placeholder="Enter Your Friend ID" class="p-3 border-gray-900"></input>
        </div>
        <input type="submit" value="Enter">
    </form>
</div>
@endsection