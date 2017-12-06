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
                    <a href="{{ url('/user/invites')}}">
                        <i class="ti-bell"></i>
                        <p>Invitations</p>
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
                    <a href="#">
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
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                {!! Form::open(['url' => '/user/me', 'files' => true]) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                {!! Form::text('name', $user->name, ['class' => 'form-control',
                                                   'required' => 'required',
                                                   'placeholder' => 'Name',
                                                   'style' => "background-color: #ecf5ef;"]) !!}
                                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nickname</label>
                                                {!! Form::text('nickname', $user->nickname, ['class' => 'form-control',
                                                   'required' => 'required',
                                                   'placeholder' => 'Nickname',
                                                   'style' => "background-color: #ecf5ef;"]) !!}
                                                {!! $errors->first('nickname', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email</label>
                                                {!! Form::text('email', $user->email, ['class' => 'form-control',
                                                   'required' => 'required',
                                                   'placeholder' => 'Email',
                                                   'style' => "background-color: #ecf5ef;"]) !!}
                                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update Profile',
                                         ['class' => 'btn btn-success btn-fill btn-wd']) !!}
                                    </div>
                                    <div class="clearfix"></div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection