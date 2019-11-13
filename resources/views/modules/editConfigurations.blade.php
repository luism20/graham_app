@extends('layouts.head')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">  
                    <div class="box-header with-border clearfix">
                        <div class="pull-left">
                            <h4 class="mt-5 mb-5">Configurations</h4>
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
                        <form method="POST" action="updateConfigurations" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}                        
                            <div class="form-group {{ $errors->has('instructions') ? 'has-error' : '' }}">
                                <div class="col-md-10">
                                    <label for="name" class="control-label">Image of instructions:</label>                 
                                    <input class="form-control" name="instructions" type="file" value="{{ old('instructions', optional($config)->instructions) }}" placeholder="Enter image...">
                                    {!! $errors->first('instructions', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('template') ? 'has-error' : '' }}">
                                <div class="col-md-10">
                                    <label for="template" class="control-label">File of template (Excel):</label>                 
                                    <input class="form-control" name="template" type="file" value="{{ old('template', optional($config)->template) }}" placeholder="Enter template...">
                                    {!! $errors->first('template', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 text-right">
                                    <input class="btn btn-success" type="submit" value="Update">
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