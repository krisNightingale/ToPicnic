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
                <a href="{{ url('/') }}">
                    <i class="ti-bag"></i>
                    <p>My picnics</p>
                </a>
            </li>
            <li class="active">
                <a href="{{url('/user/bills')}}">
                    <i class="ti-ticket"></i>
                    <p>My bills</p>
                </a>
            </li>
            <li>
                <a href="{{url('/user/friends')}}">
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
                <a class="navbar-brand" href="#">My bills</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <div class="input-group" style="float: left; margin-top: 15px;">
                        <input type="text" placeholder="Search" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    </div>
                </ul>
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
                <div class="col-lg-12 col-sm-12" style="height: 50px;">
                    <a href="{{ url('/user/bills') }}"><button class="btn btn-success">All</button></a>
                    <a href="{{ url('/user/bills?status=paid') }}"><button class="btn btn-warning">Paid</button></a>
                    <a href="{{ url('/user/bills?status=nonpaid') }}"><button class="btn btn-danger">Non paid</button></a>
                </div>
            </div>

            <div class="row">
                @foreach($bills as $bill)
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div>
                                        <h5 style="font-size: 1.4em; margin-top: 17px;">{{ $bill->getItemName() }}</h5>
                                        <h5><i class="fa fa-money" aria-hidden="true"></i> {{ $bill->amount }}</h5>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-success">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="icon-big">
                                                @if($bill->is_paid)
                                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-square-o" aria-hidden="true"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="stats" style="float: right;">
                                        <i class="ti-user"></i> to <a href="{{url('/user/'.$bill->getResponsible()->id)}}">{{ $bill->getResponsible()->nickname}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection