@extends('layouts.head')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border clearfix">
                        <span class="pull-left">
                            <h4 class="mt-5 mb-5">{{ isset($user->name) ? $user->name : 'User' }}</h4>
                        </span>
                        <div class="pull-right">
                            <form method="POST" action="{!! route('users.user.destroy', $user->id) !!}" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            {{ csrf_field() }}
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('users.user.index') }}" class="btn btn-success" title="Show All User">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('users.user.create') }}" class="btn btn-success" title="Create New User">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('users.user.edit', $user->id ) }}" class="btn btn-success" title="Edit User">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>
                                    <button type="submit" class="btn btn-danger" title="Delete User" onclick="return confirm(&quot;Click Ok to delete User.?&quot;)">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Name</dt>
            <dd>{{ $user->name }}</dd>
            <dt>Email</dt>
            <dd>{{ $user->email }}</dd>
            <dt>Password</dt>
            <dd>{{ $user->password }}</dd>
            <dt>Rol</dt>
            <dd>{{ $user->rol }}</dd>
            <dt>Remember Token</dt>
            <dd>{{ $user->remember_token }}</dd>
            <dt>Created At</dt>
            <dd>{{ $user->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $user->updated_at }}</dd>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection