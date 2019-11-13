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
                            <h4 class="mt-5 mb-5">Plans</h4>
                        </div>
                        <div class="btn-group btn-group-sm pull-right" role="group">
                            <a href="{{ route('plans.plan.create') }}" class="btn btn-success" title="Crear un nuevo Plan">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new
                            </a>
                        </div>
                    </div>
                    @if(count($plans) == 0)
                        <div class="panel-body text-center">
                            <h4>No Plans Available!</h4>
                        </div>
                    @else
                    <div class="box-body panel-body-with-table">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th>Name</th>                                        
                                        <th>Amount</th>
                                        <th>Interval</th>
                                        <th>Description</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->name }}</td>                                        
                                        <td>{{ $plan->amount }}</td>
                                        <td>{{ $plan->interval }}</td>
                                        <td>{{ $plan->description }}</td>
                                        <td>
                                            <form id="plan-{{ $plan->id }}" method="POST" action="{!! route('plans.plan.destroy', $plan->id) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}
                                                <div class="btn-group btn-group-xs pull-right" role="group">
                                                    <a href="{{ route('plans.plan.edit', $plan->id ) }}" class="btn btn-primary" title="Editar Plan">
                                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                                    </a>
                                                    <button type="submit" class="btn btn-danger" title="Borrar Plan" onclick="confirmacion(event, 'plan', '#plan-{{ $plan->id }}')">
                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
                                                    </button>
                                                </div>
                                            </form>
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