@extends('layouts.crud')

@section('content')
<div class="board">
    <form class="max-w-full" method="post" action="{{ route('add') }}">
        @csrf
        <div class="pt-5 pb-5 pr-5">
            Title
            <input required name="title" placeholder="Enter title" class="p-3 border-gray-900"></input>
        </div>
        <div class="pt-5 pb-5 pr-5">
            Description
            <textarea required name="desc"></textarea>
        </div>
        <input type="submit" value="Submit">
    </form>
</div>
@endsection