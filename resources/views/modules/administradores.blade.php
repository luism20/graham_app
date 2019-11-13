@extends('layouts.head')
@section('title', $title)

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuarios
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Usuarios</a></li>
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
        @if(Auth::user()->isSuper())
        <!-- botones -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <a href="nuevoAdmin">
                            <button type="button" class="btn btn-sm btn-info">Crear Usuario</button>
                        </a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        @endif

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Lista de todos los usuarios</h3>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="empresas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    @if(Auth::user()->isSuper())
                                    <th>Acciones</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $a)
                                <tr>                                                                       
                                    <td>{{$a->name}}</td>
                                    <td>{{$a->email}}</td>
                                    <td>{{$a->rol()}}</td>
                                    @if(Auth::user()->isSuper())
                                    <td>
                                        <a href="editarAdmin/{{$a->id}}">
                                            <button class="btn btn-success btn-xs" name="admin_{{$a->id}}" style="margin: 2px 0px 2px 0px">Editar</button>
                                        </a>
                                        <button class="btn btn-danger btn-xs" onclick="borrarAdmin({{$a->id}})">Borrar</button>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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


