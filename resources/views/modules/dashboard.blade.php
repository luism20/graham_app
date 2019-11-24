@extends('layouts.head')
@section('title', $title)

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @if(Session::has('success_message'))
            <div class="col-lg-12">
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-ok"></span>
                    {!! session('success_message') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
            
            <div class="col-lg-3 col-xs-6">               
            </div>
            
            <div class="col-lg-3 col-xs-6">
            </div>
            
            <div class="col-lg-3 col-xs-6">
            </div>
           
            <div class="col-lg-3 col-xs-6">               
            </div>
         
        </div>     
    </section>
   
</div>

@stop