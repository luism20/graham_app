@extends('layouts.head')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            API Keys
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Api Keys</li>
        </ol>
    </section>
    <section class="content">

@if(Session::has('success_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    {!! session('success_message') !!}

    <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
@endif

<div class="row">
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">AMAZON S3</h3>
            </div>
            <form role="form" action="{{ url('configurations/env') }}" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label>AWS_ACCESS_KEY_ID</label>
                        <input type="hidden" name="key1" value="AWS_ACCESS_KEY_ID">
                        <input type="text" name="value1" class="form-control" id="" placeholder="Enter key" value="{{ DotenvEditor::getValue('AWS_ACCESS_KEY_ID') }}">
                    </div>
                    <div class="form-group">
                        <label>AWS_SECRET_ACCESS_KEY</label>
                        <input type="hidden" name="key2" value="AWS_SECRET_ACCESS_KEY">
                        <input type="text" name="value2" class="form-control" id="" placeholder="Enter id of list" value="{{ DotenvEditor::getValue('AWS_SECRET_ACCESS_KEY') }}">
                    </div>
                    <div class="form-group">
                        <label>AWS_DEFAULT_REGION</label>
                        <input type="hidden" name="key1" value="AWS_DEFAULT_REGION">
                        <input type="text" name="value1" class="form-control" id="" placeholder="Enter key" value="{{ DotenvEditor::getValue('AWS_DEFAULT_REGION') }}">
                    </div>
                    <div class="form-group">
                        <label>AWS_BUCKET</label>
                        <input type="hidden" name="key2" value="AWS_BUCKET">
                        <input type="text" name="value2" class="form-control" id="" placeholder="Enter id of list" value="{{ DotenvEditor::getValue('AWS_BUCKET') }}">
                    </div>
                </div>
                <div class="box-footer text-right">
                    @csrf()
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </div>

    <div class="col-md-6">
            <!-- Form Element sizes -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">STRIPE</h3>
                </div>
                <form role="form" action="{{ url('configurations/env') }}" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label>STRIPE_KEY</label>
                            <input type="hidden" name="key1" value="STRIPE_KEY">
                            <input type="text" name="value1" class="form-control" id="" placeholder="Enter key" value="{{ DotenvEditor::getValue('STRIPE_KEY') }}">
                        </div>
                        <div class="form-group">
                            <label>STRIPE_API_KEY</label>
                            <input type="hidden" name="key2" value="STRIPE_API_KEY">
                            <input type="text" name="value2" class="form-control" id="" placeholder="Enter api key" value="{{ DotenvEditor::getValue('STRIPE_API_KEY') }}">
                        </div>
                        <div class="form-group">
                            <label>STRIPE_SECRET</label>
                            <input type="hidden" name="key3" value="STRIPE_SECRET">
                            <input type="text" name="value3" class="form-control" id="" placeholder="Enter secret key" value="{{ DotenvEditor::getValue('STRIPE_SECRET') }}">
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        @csrf()
                        <button type="submit" class="btn btn-success text-center">Save</button>
                    </div>
                </form>
            </div>
        </div>
    
</div>

</section>
</div>
@endsection