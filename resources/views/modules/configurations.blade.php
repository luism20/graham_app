@extends('layouts.head')
@section('title', $title)

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Configurations
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Configurations</a></li>
        </ol>
    </section>

    @if (session('edicion'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{session('edicion')}}
    </div>
    @endif


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <span class="glyphicon glyphicon-ok"></span>
                        {!! session('success') !!}
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Your configurations</h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image gif (instructions)</th>
                                    <th>Template (Excel)</th>                                                                    
                                </tr>
                            </thead>
                            <tbody>                               
                                <tr>                                                                       
                                    <td><img src="{{ asset("img/" . $config->instructions) }}" class="img-thumbnail img-lg"></td>
                                    <td><a href="{{ asset("file/" . $config->template) }}">{{ $config->template }}</a></td>
                                </tr>                               
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer text-right">
                        <a href="configurations/edit" class="btn btn-success">Edit</a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop


