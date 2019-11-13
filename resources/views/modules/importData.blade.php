@extends('layouts.head')
@section('title', $title)

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Import Data
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Import Data</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-5">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3>Instructions</h3>
                    </div>
                    <div class="box-body">
                        <img src="{{ asset("img/" . $instructions) }}" class="img-responsive">
                    </div>
                    <div class="box box-footer text-center">
                        <span>Do you need a guide file? <br> Download this <a href="{{ asset("file/" . $template) }}" target="_blank">Template</a></span>
                    </div>
                </div>                
            </div>
            <!-- ./col -->
            <div class="col-xs-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3>Upload Excel File</h3>
                    </div>
                    <form role="form" method="post" action="importData" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('file_input') ? 'has-error' : '' }}"">
                                <label for="file_input">File input</label>
                                <input type="file" id="file_input" name="file_input">                
                                <p class="help-block" id="status"></p>
                            </div>
                            <div id="progressBar" style="display:none">
                                <div class="clearfix">
                                    <span class="pull-left">Uploading</span>
                                    <small class="pull-right" id="bar">0%</small>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-green" id="percent"></div>
                                </div>
                            </div>
                        </div>      
                        <div class="box-footer">
                            @csrf
                            <input type="submit" class="btn btn-success" value="Submit" />
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </section>
</div>
<script>
    $(function() {
        var bar = $('#bar');
        var percent = $('#percent');
        var status = $('#status');

        $('form').ajaxForm({
            beforeSend: function() {
                status.empty();
                document.getElementById("progressBar").style.display = "block";
                var percentVal = '0%';
                bar.html(percentVal);
                percent.css("width", percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.html(percentVal);
                percent.css("width", percentVal);
            },
            complete: function(xhr) {
                var errors = JSON.parse(xhr.responseText);                
                status.html(errors.message);
                $('#file_input').val('');
            }
        });
    });
</script>
@stop