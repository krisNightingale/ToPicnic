@extends('front.layouts.main-layout')

@section('content')
<div class="sidebar" data-background-color="white" data-active-color="success">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ url('/') }}" class="simple-text">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i> ToPicnic
            </a>
        </div>

        <ul class="nav">
            <li>
                <a href="{{ url('/home')}}">
                    <i class="ti-bag"></i>
                    <p>My picnics</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/user/bills')}}">
                    <i class="ti-ticket"></i>
                    <p>My bills</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/user/friends')}}">
                    <i class="fa fa-users"></i>
                    <p>My friends</p>
                </a>
            </li>
            <li class="active">
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
                <a class="navbar-brand">New picnic</a>
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
                            <li><a href="#"><i class="ti-settings"></i> Settings</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>


    <div class="content">
        <div class="container-fluid">
            {!! Form::open(['url' => '/picnic', 'files' => true]) !!}

            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="height: 450px;">
                        <div class="header">
                            <h4 class="title">Create new picnic</h4>
                            <p class="category">Enter data</p>
                        </div>
                        <div class="content">
                            <br/>
                            <div class="row">
                                <div class="col-xs-3">
                                    <p style="padding: 7px;">Name:</p>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        {!! Form::text('name', null, ['class' => 'form-control',
                                        'required' => 'required',
                                        'placeholder' => 'Name',
                                        'style' => "background-color: #ecf5ef;"]) !!}
                                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <p style="padding: 7px;">Place:</p>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        {!! Form::text('place', null, ['class' => 'form-control',
                                        'placeholder' => 'Place',
                                        'style' => "background-color: #ecf5ef;"]) !!}
                                        {!! $errors->first('place', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <p style="padding: 7px;">Start time:</p>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        {!! Form::datetimeLocal( 'start_time', date('Y-m-d H:i:s'), ['class' => 'form-control',
                                        'required' => 'required',
                                        'style' => "background-color: #ecf5ef;"]) !!}
                                        {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
                                        <span class="input-group-addon" style="background-color: #ecf5ef;">
                                                <i class="fa fa-calendar" style="font-size: 25px;"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <p style="padding: 7px;">End time (optional):</p>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        {!! Form::datetimeLocal( 'end_time', null, ['class' => 'form-control',
                                        'style' => "background-color: #ecf5ef;"]) !!}
                                        {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
                                        <span class="input-group-addon" style="background-color: #ecf5ef;">
                                                <i class="fa fa-calendar-check-o" style="font-size: 25px;"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <p style="padding: 7px;">Description:</p>
                                </div>
                                <div class="col-xs-8">
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3,
                                    'placeholder' => 'Here can be your description',
                                    'style' => "background-color: #ecf5ef;"]) !!}
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card" style="height: 450px; padding-left: 10px;">
                        <div class="header">
                            <h4 class="title">Add friends:  <i class="fa fa-user-plus"></i></h4>
                        </div>
                        <div class="content">
                            <br/>
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        {!! Form::select('members[]', $membersNames, null, [
                                        'style' => "height: 320px; font-size: 18px; background-color: #ecf5ef;",
                                        'class' => 'form-control', 'multiple' => 'multiple'], $membersIds) !!}
                                        {!! $errors->first('members', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2" style="width: 13%;">
                    <div class="card" style="border-radius: 50px;">
                        <div class="content">
                            <div class="row text-center">
                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Add', ['class' => 'btn btn-success btn-lg']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection