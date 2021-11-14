@extends('layouts.crud')

@section('content')
<div class="board">
    <form class="formAddBoard" method="post" action="{{ route('add') }}">
        @csrf
        <div class="pt-5 pb-5 pr-5">
            Subject
            <input name="subject" placeholder="Enter Subject" class="p-3 border-gray-900"></input>
        </div>
        <input type="submit" value="Add Board">
    </form>
</div>
@endsection