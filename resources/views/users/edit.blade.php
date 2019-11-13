@extends('layouts.head')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">  
                    <div class="box-header with-border clearfix">
                        <div class="pull-left">
                            <h4 class="mt-5 mb-5">{{ !empty($user->name) ? $user->name : 'User' }}</h4>
                        </div>
                        <div class="btn-group btn-group-sm pull-right" role="group">
                            <a href="{{ route('users.user.index') }}" class="btn btn-success" title="Show All User">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Ver Usuarios
                            </a>
                            <a href="{{ route('users.user.create') }}" class="btn btn-success" title="Create New User">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Crear Usuario
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('users.user.update', $user->id) }}" id="edit_user_form" name="edit_user_form" accept-charset="UTF-8" class="form-horizontal">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        @include ('users.form', [ 'user' => $user ])
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Actualizar">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection