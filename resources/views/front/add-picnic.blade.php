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
                <a class="navbar-brand" href="#">New picnic</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="ti-user"></i>
                            <p>My Profile</p>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Log out</a></li>
                            <li><a href="#"><i class="ti-settings"></i> Settings</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>


    <div class="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-md-6">
                    <div class="card" style="height: 430px;">
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
                                        <input type="text" value="" placeholder="Name" class="form-control" style="background-color: #ecf5ef;"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <p style="padding: 7px;">Select date:</p>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input type="text" placeholder="Date" class="form-control" style="background-color: #ecf5ef;">
                                        <span class="input-group-addon" style="background-color: #ecf5ef;">
                                                <i class="fa fa-calendar" style="font-size: 25px;"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <p style="padding: 7px;">Select time:</p>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input type="text" placeholder="Time" class="form-control" style="background-color: #ecf5ef;">
                                        <span class="input-group-addon" style="background-color: #ecf5ef;">
                                                <i class="fa fa-clock-o" style="font-size: 25px;"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <p style="padding: 7px;">Description:</p>
                                </div>
                                <div class="col-xs-8">
                                    <textarea class="form-control" style="background-color: #ecf5ef;" placeholder="Here can be your nice text" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card" style="height: 430px; padding-left: 10px;">
                        <div class="header">
                            <h4 class="title">Add friends:  <i class="fa fa-user-plus"></i></h4>
                        </div>
                        <div class="content">
                            <br/>
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <select multiple class="form-control" style="height: 320px; font-size: 18px; background-color: #ecf5ef;">
                                            <option>Olya</option>
                                            <option>Sasha</option>
                                            <option>User 3</option>
                                            <option>User 4</option>
                                            <option>User 5</option>
                                        </select>
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

                                <button class="btn btn-success btn-lg">Add</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection