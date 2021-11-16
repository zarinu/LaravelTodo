<?php

use Illuminate\Support\Facades\Auth; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Keep Note For You!</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <link href="{{asset('css/main2.css')}}" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/e359cce5b0.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/main2.js')}}"></script>
</head>

<body>
    <header id="header" class="container">
        <div id="leftH">
            <div class="faicon" id="accountoption" onclick="modalAccountOption();">
                <span title="account setting" class="far fa-user fa-lg" style="font-size: 25px; line-height: 40px;" </span>
            </div>
            <div class="faicon" id="theme">
                <span id="moon" title="changing theme" class="far fa-moon fa-lg" style="font-size: 22px; line-height: 42px;"></span>
                <span id="sun" title="changing theme">&#xf185</span>
            </div>
        </div>
        <div id="searchbox">
            <span class="osicon fas fa-times fa-lg" id="searchclose"></span>
            <input name="search" type="text" id="search" placeholder="Search Board subject or Task text">
            <span class="osicon fas fa-search fa-lg" id="searchok"></span>
        </div>
        <div id="rightH">
            <a id="logo" href="{{route('dashboard')}}">
                <img id="logoimg" src="{{asset('img/logo/logoLight.png')}}" alt="logo picture" title="logo picture">
            </a>
            <a href="{{ route('create-board') }}">
                <div class="faicon" id="addbord" onclick="addboard()">
                    <span title="add a board" class="fas fa-plus fa-lg" style="font-size: 20px; line-height: 43px;"></span>
                </div>
            </a>
        </div>

    </header>
    <hr class="hr">

    <!-- The Modal of account options -->
    <div id="accountModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content" id="madalAcouContent">
            <p style="pointer-events: none;">welcome <strong>{{ Auth::user()->name }}</strong></p>
            <hr class="hr">


            <p><span>&#xf044 </span><a href="{{ route('users.edit', Auth::user()->id) }}">Edit Account Info</a></p>

            <form id="deleteAcount" action="{{ route('users.destroy', Auth::user()->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <p id="deleteAccount" onclick="myFunction() ;{
                    document.getElementById('deleteAcount').submit(); }"><span>&#xf1f8 </span><a>Delete Account</a></p>
            </form>

            <p id="logOut" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><span>&#xf08b </span>
                <a href="{{ route('logout') }}">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </p>

        </div>

    </div>

    @yield('content')

</body>

</html>