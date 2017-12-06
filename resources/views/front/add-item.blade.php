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
            <li class="active">
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
                <a class="navbar-brand" href="#">
                    <h4 style="margin-top: 0px;"><i class="ti-bookmark"></i> New Year</h4>
                </a>
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
            <div class="row" style="padding: 10px;">
                <div class="col-md-4 col-sm-4" >
                    <p style="padding-top: 10px;"><i class="fa fa-clock-o" aria-hidden="true"></i> 12:00 Saturday</p>
                </div>
                <div class="col-md-8 col-sm-8" >
                    <p style="padding-top: 10px;"><i class="fa fa-users" aria-hidden="true"></i> 15 members</p>
                </div>
            </div>
            <div class="row">
                <div class="navbar-header" style="height: 50px;">
                    <div class="col-lg-12 col-sm-12" >
                        <h4 class="navbar-brand" style="margin-top: 0px;">New item</h4>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Create new item</h4>
                            <p class="category">Enter data</p>
                        </div>
                        <div class="content">
                            <br/>
                            <div class="row">
                                <div class="col-xs-2">
                                    <p style="padding: 7px;">Name:</p>
                                </div>
                                <div class="col-xs-9">
                                    <div class="form-group">
                                        <input type="text" value="" placeholder="Name" class="form-control" style="background-color: #ecf5ef;"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                    <p style="padding: 7px;">Price:</p>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-group">
                                        <input type="text" placeholder="Price" class="form-control" style="background-color: #ecf5ef;">
                                        <span class="input-group-addon" style="background-color: #ecf5ef;">
                                                <i class="fa fa-money" style="font-size: 25px;"></i>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <br/>
                                <div class="col-xs-6">
                                    <button class="btn btn-success">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection