@extends('layouts.head')
@section('title', $title)

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cear nuevo usuario
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('inicio')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{url('administradores')}}">Usuarios</a></li>
            <li class="active">Nuevo Usuario</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                @if (session('error'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{session('error')}}
                </div>
                @endif



                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">General</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="crearAdmin" method="post">
                        <div class="box-body">                            
                            <div class="form-group col-md-6">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre..." name="name" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Correo Electrónico</label>
                                <input type="email" class="form-control" placeholder="correo del usuario" name="email">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Rol</label>                                
                                <select class="form-control" name="rol">
                                    @foreach($roles as $r)
                                    <option value="{{$r->id}}">{{$r->rol}}</option>
                                    @endforeach                                   
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Contraseña</label>
                                <input type="password" class="form-control" placeholder="Contraseña" name="password" required="">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Confirmar Contraseña</label>
                                <input type="password" class="form-control" placeholder="Confirmar Contraseña" name="password2" required="">
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-success" value="Crear usuario">
                            <a href="administradores">
                                <input type="button" class="btn btn-danger" value="Cancelar" >
                            </a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop

