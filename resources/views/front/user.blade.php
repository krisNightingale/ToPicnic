@extends('front.layouts.main-layout')

@section('content')
    <div class="sidebar" data-background-color="white" data-active-color="success">

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ url('/') }}" class="simple-text">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i> ToPicnic
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{ url('/') }}">
                        <i class="ti-bag"></i>
                        <p>My picnics</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/user/bills') }}">
                        <i class="ti-ticket"></i>
                        <p>My bills</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/user/friends') }}">
                        <i class="fa fa-users"></i>
                        <p>My friends</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/picnic/add')}}">
                        <i class="ti-plus"></i>
                        <p>Add picnic</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/users')}}">
                        <i class="fa fa-user-plus"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/user/debtors')}}">
                        <i class="ti-wallet"></i>
                        <p>My debtors</p>
                    </a>
                </li>
                <li class="active-pro">
                    <a href="{{ url('/picnic/history')}}">
                        <i class="ti-archive"></i>
                        <p>Picnic history</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand"><i class="ti-user"></i> {{ $user->nickname}}</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-user"></i>
                                <p>{{ Auth::user()->nickname }}</p>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Log out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <li><a href="{{ url('/user/me') }}"><i class="ti-settings"></i> Settings</a></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-sm-8 col-xs-8">
                                        <h4 class="title">User info</h4>
                                    </div>
                                    <div class="col-sm-4 col-xs-4" style="height: 30px;">
                                        @if(Auth::user()->id !== $user->id)
                                            @if(Auth::user()->isFriend($user->id))
                                                <a href="{{ url('user/'.$user->id.'/nonfriend') }}">
                                                    <button class="btn btn-danger">Delete</button>
                                                </a>
                                            @else
                                                <a href="{{ url('user/'.$user->id.'/friend') }}">
                                                    <button class="btn btn-success">Add</button>
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Name</label>
                                        <p>{{ $user->name }}</p>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Nickname</label>
                                        <p>{{ $user->nickname }}</p>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Email</label>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                                <br/>
                                @if($user->id == Auth::user()->id)
                                <div class="text-center">
                                    <a href="{{ url('/user/edit') }}">
                                        <button class="btn btn-info btn-fill btn-wd">Edit Profile</button>
                                    </a>
                                </div>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection