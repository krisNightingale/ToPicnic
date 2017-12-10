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
                    <a href="{{ url('/home') }}">
                        <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                        <p>Back</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/picnic/'.$picnic->id) }}">
                        <i class="ti-star"></i>
                        <p>Items</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/picnic/'.$picnic->id.'/items/add') }}">
                        <i class="ti-plus"></i>
                        <p>Add item</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/picnic/'.$picnic->id.'/members') }}">
                        <i class="fa fa-users"></i>
                        <p>Members</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/picnic/'.$picnic->id.'/members/add') }}">
                        <i class="fa fa-user-plus"></i>
                        <p>Add member</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/picnic/'.$picnic->id.'/bills') }}">
                        <i class="ti-ticket"></i>
                        <p>Bills</p>
                    </a>
                </li>
                <li class="active">
                    <a href="{{ url('/picnic/'.$picnic->id.'/edit')}}">
                        <i class="ti-pencil"></i>
                        <p>Edit picnic</p>
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
                    <a class="navbar-brand" href="#">
                        <h4 style="margin-top: 0px;"><i class="ti-bookmark"></i> {{$picnic->name}}</h4>
                    </a>
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
                                <li><a href="{{ route('logout') }}"
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
                <div class="row" style="padding: 10px;">
                    <div class="col-md-4 col-sm-4" >
                        <p style="padding-top: 10px;"><i class="fa fa-clock-o" aria-hidden="true"></i> {{date("D M j G:i", strtotime($picnic->start_time->toDateTimeString()))}}</p>
                    </div>
                    <div class="col-md-8 col-sm-8" >
                        <p style="padding-top: 10px;"><i class="fa fa-users" aria-hidden="true"></i> {{$picnic->membersCount()}} members</p>
                    </div>
                </div>
                <div class="row">
                    <div class="navbar-header" style="height: 50px;">
                        <div class="col-lg-12 col-sm-12" >
                            <h4 class="navbar-brand" style="margin-top: 0px;">Edit picnic info</h4>
                        </div>
                    </div>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                {!! Form::open(['url' => '/picnic/'.$picnic->id.'/edit', 'files' => true]) !!}

                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="height: 470px;">
                            <div class="header">
                                <h4 class="title">Edit</h4>
                            </div>
                            <div class="content">
                                <br/>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <p style="padding: 7px;">Name:</p>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="form-group">
                                            {!! Form::text('name', $picnic->name, ['class' => 'form-control',
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
                                            {!! Form::text('place', $picnic->place, ['class' => 'form-control',
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
                                            {!! Form::datetimeLocal( 'start_time',
                                             date("Y-m-d H:i:s", strtotime($picnic->start_time->toDateTimeString())), ['class' => 'form-control',
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
                                            {!! Form::datetimeLocal( 'end_time',
                                            $picnic->endtime !== null ? date("Y-m-d H:i:s", strtotime($picnic->end_time->toDateTimeString())) : null, ['class' => 'form-control',
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
                                        {!! Form::textarea('description', $picnic->description, ['class' => 'form-control', 'rows' => 3,
                                        'placeholder' => 'Here can be your description',
                                        'style' => "background-color: #ecf5ef;"]) !!}
                                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-2" style="width: 13%;">
                                        <div class="content">
                                            <div class="row text-center">
                                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-success']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
@endsection