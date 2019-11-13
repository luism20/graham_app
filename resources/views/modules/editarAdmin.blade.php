@extends('layouts.head')
@section('title', $title)

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar un administrador
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('inicio')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{url('administradores')}}">Administradores</a></li>
            <li class="active">Editar Admin</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">General</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="updateAdmin" method="post">

                        <div class="box-body">                           
                            <div class="form-group col-md-6">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" id="" placeholder="Nombre..." name="name" required="" value="{{$admin->name}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Correo</label>
                                <input type="tel" id="" class="form-control" placeholder="Correo Electrónico" name="email" value="{{$admin->email}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Rol</label>
                                <select class="form-control" name="rol">
                                    @foreach($roles as $r)
                                    @if($admin->rol == $r->id)
                                    <option value="{{$r->id}}" selected="">{{$r->rol}}</option>                                    
                                    @else
                                    <option value="{{$r->id}}">{{$r->rol}}</option>                                    
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Contraseña</label>
                                <input type="password" class="form-control" value="no se modifico!" name="password" required="">
                                <small>Si no desea cambiar su contraseña no modifique este campo</small>
                            </div> 
                        </div>

                        <div class="box-footer">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$admin->id}}">
                            <input type="submit" class="btn btn-success" value="Guardar cambios">
                            <a href="{{url('administradores')}}">
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