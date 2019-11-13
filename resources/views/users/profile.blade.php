@extends('layouts.head')
@section('title', $title)


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $title }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">{{ $title }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <!-- Profile Image -->
                <div class="box box-default" id="modificarPerfil1">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                        <p class="text-muted text-center">The last edition: {{Auth::user()->updated_at}}  </p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Email</b> <a class="pull-right">{{Auth::user()->email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Role</b> <a class="pull-right">@if(Auth::user()->rol == 0) Customer @else Admin @endif</a>
                            </li>                            
                            <li class="list-group-item">
                                <b>Company</b> <a class="pull-right">{{ Auth::user()->company }}</a>
                            </li>
                            <li class="list-group-item text-center">
                                <button class="btn btn-success" onclick="editProfile()">Edit Profile</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            @if(Auth::user()->allCards())
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header">
                        <h4 class="mt-5 mb-5">Cards</h4>
                    </div>
                    <div class="box-body box-success">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Name</b> <a class="pull-right">{{Auth::user()->email}}</a>
                            </li>
                            <li class="list-group-item">
                                <b></b> <a class="pull-right">@if(Auth::user()->rol == 0) Customer @else Admin @endif</a>
                            </li>                            
                            <li class="list-group-item">
                                <b></b> <a class="pull-right">{{ Auth::user()->company }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-success hidden" id="modificarPerfil2">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit profile</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="updateCostumer" method="post">
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="">Name</label>
                                <input type="text" class="form-control" value="{{Auth::user()->name}}" name="name" required="">
                            </div>
                            <div class="form-group col-md-6">
                                    <label for="">Company</label>
                                    <input type="text" class="form-control" value="{{Auth::user()->company }}" name="company" required="">
                                </div>
                            <div class="form-group col-md-6">
                                <label for="">Email</label>
                                <input type="email" class="form-control" value="{{Auth::user()->email}}" name="email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Password</label>
                                <input type="password" class="form-control" value="no se modifico!" name="password" required="">
                                <small>If you do not want to change your password do not modify this field</small>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ Auth::id() }}">
                            <input type="submit" class="btn btn-success" value="Save">
                            <input type="button" class="btn btn-danger" value="Cancel" onclick="editProfile()">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<script>
    function editProfile() {
        $('#modificarPerfil1').toggleClass('hidden');
        $('#modificarPerfil2').toggleClass('hidden');
    }
</script>
@stop

