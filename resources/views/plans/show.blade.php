@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border clearfix">
                        <span class="pull-left">
                            <h4 class="mt-5 mb-5">{{ isset($plan->name) ? $plan->name : 'Plan' }}</h4>
                        </span>
                        <div class="pull-right">
                            <form method="POST" action="{!! route('plans.plan.destroy', $plan->id) !!}" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            {{ csrf_field() }}
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('plans.plan.index') }}" class="btn btn-success" title="Mostrar todos Plan">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('plans.plan.create') }}" class="btn btn-success" title="Crear un nuevo Plan">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('plans.plan.edit', $plan->id ) }}" class="btn btn-success" title="Editar Plan">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>
                                    <button type="submit" class="btn btn-danger" title="Borrar Plan" onclick="return confirm(&quot;Borrar Plan??&quot;)">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Name</dt>
            <dd>{{ $plan->name }}</dd>
            <dt>Stripe</dt>
            <dd>{{ optional($plan->stripe)->id }}</dd>
            <dt>Amount</dt>
            <dd>{{ $plan->amount }}</dd>
            <dt>Interval</dt>
            <dd>{{ $plan->interval }}</dd>
            <dt>Description</dt>
            <dd>{{ $plan->description }}</dd>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection