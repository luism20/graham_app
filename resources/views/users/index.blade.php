@extends('layouts.head')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success_message'))
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-ok"></span>
                    {!! session('success_message') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="box box-default">
                    <div class="box-header with-border clearfix">
                        <div class="pull-left">
                            <h4 class="mt-5 mb-5">Users</h4>
                        </div>
                        <div class="btn-group btn-group-sm pull-right" role="group">
                            <a href="{{ route('users.user.create') }}" class="btn btn-success" title="Create New User">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new user
                            </a>
                        </div>
                    </div>
                    @if(count($users) == 0)
                    <div class="panel-body text-center">
                        <h4>No Users Available.</h4>
                    </div>
                    @else
                    <div class="box-body panel-body-with-table">
                        <div class="table-responsive">
                            <table id="users" class="table table-striped table-large">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Plan</th>
                                        <th>Role</th> 
                                        <th></th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)                                   
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td> 
                                        <td>{{ $user->company }}</td>
                                        <td>
                                            @if(optional($user->plan())->name != "")
                                                {{ optional($user->plan())->name }}
                                            @else
                                                TRIAL
                                            @endif

                                        </td>                                        
                                        <td>
                                            @if($user->isAdmin())
                                            Administrator
                                            @else
                                            Costumer
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->id != Auth::id())
                                            <form id="user-{{ $user->id }}" method="POST" action="{!! route('users.user.destroy', $user->id) !!}" accept-charset="UTF-8">
                                                <input name="_method" value="DELETE" type="hidden">
                                                {{ csrf_field() }}
                                                <div class="btn-group btn-group-xs pull-right" role="group">                                                  
                                                    <a href="{{ route('users.user.edit', $user->id ) }}" class="btn btn-primary" title="Edit User">
                                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                                    </a>
                                                    <button type="submit" class="btn btn-danger" title="Delete User" onclick="confirmation(event, 'this user', '#user-{{ $user->id }}' )">
                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
                                                    </button>
                                                </div>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>                                   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection