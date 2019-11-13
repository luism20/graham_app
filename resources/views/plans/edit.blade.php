@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">  
                    <div class="box-header with-border clearfix">
                        <div class="pull-left">
                            <h4 class="mt-5 mb-5">{{ !empty($plan->name) ? $plan->name : 'Plan' }}</h4>
                        </div>
                        <div class="btn-group btn-group-sm pull-right" role="group">
                            <a href="{{ route('plans.plan.index') }}" class="btn btn-success" title="Mostrar todos Plan">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Ver Plan
                            </a>
                            <a href="{{ route('plans.plan.create') }}" class="btn btn-success" title="Crear un nuevo Plan">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Crear Plan
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
                        <form method="POST" action="{{ route('plans.plan.update', $plan->id) }}" id="edit_plan_form" name="edit_plan_form" accept-charset="UTF-8" class="form-horizontal">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        @include ('plans.form', [ 'plan' => $plan ])
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