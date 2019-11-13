@extends('layouts.head')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border clearfix">
                        <span class="pull-left">
                            <h4 class="mt-5 mb-5">Create a new Plan</h4>
                        </span>
                        <div class="btn-group btn-group-sm pull-right" role="group">
                            <a href="{{ route('plans.plan.index') }}" class="btn btn-success" title="Mostrar todos Plan">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Show Plans
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
                        <form method="POST" action="{{ route('plans.plan.store') }}" accept-charset="UTF-8" id="create_plan_form" name="create_plan_form" class="form-horizontal">
                        {{ csrf_field() }}
                        @include ('plans.form', [ 'plan' => null ])
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-success" type="submit" value="Add">
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


