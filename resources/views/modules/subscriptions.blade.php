@extends('layouts.head')
@section('title', $title)

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $title }}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{ $title }}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-ok"></span>
                    {!! session('success') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-ok"></span>
                    {!! session('error') !!}
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
                    </div>
                    <div class="box-body">
                        @foreach($plans as $p)
                        <div class="col-xs-3">
                            <div class="box box-success box-solid">
                                <div class="box-header text-center">
                                    <h4 class="mt-5 mb-5">{{ $p["name"] }}</h4>
                                </div>
                                <div class="box-body text-center">
                                    <h3 class="text-bold">$ {{ number_format($p["amount"]) }}</h3>
                                    <h4>per {{ $p["interval"] }}</h4>                                    
                                    <p class="md-mt-30">{{ $p['statement_descriptor'] }}</p>
                                </div>
                                <div class="box-footer text-center">
                                    @if($p['id'] != Auth::user()->plan_id)
                                    <button class="btn btn-success to_subscribe" data-name="{{ $p['name'] }}" data-id="{{ $p['id'] }}">Subscribe</button>
                                    @else
                                    <button class="btn btn-default" disabled>It´s your plan</button>
                                    @endif
                                </div>
                            </div>             
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>           
        </div>
        <div class="row" id="subscription" hidden>
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-default">
                    <div class="box-header with-border clearfix">
                        <div class="pull-left">
                            <h4 class="mt-5 mb-5">Billing Information</h4>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12 back-gray md-px-0">
                            <form method="post" class="row md-p-4" id="paywithstripe" action="{{ url('withStripe') }}">
                                <div class="form-group col-md-12">
                                    <label>Plan to subscribe</label>
                                    <input type="text" class="form-control" id="plan_name" value="" readonly required>
                                </div> 
                                <div class="form-group col-md-12">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly required>
                                </div>                                        
                                <div class="form-group col-md-12">
                                    <label>Card Number</label>
                                    <input type="text" class="form-control" name="card_no" placeholder="0000 - 0000 - 0000 - 0000" value="{{ old('card_no') }}" autocomplete="off" required>
                                    {!! $errors->first('card_no', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Name on Card</label>
                                    <input type="text" class="form-control" name="name" placeholder="John More" value="{{ old('name') }}" autocomplete="off" required>
                                </div>
                                <div class="form-group col-xs-4 col-md-4">
                                    <label>Exp Date</label>
                                    <div class="row md-m-0 xs-m-0">
                                        <input type="text" class="form-control col-md-5 col-xs-5" name="ccExpiryMonth" placeholder="MM" size="2" value="{{ old('ccExpiryMonth') }}" autocomplete="off" required>
                                        <input type="text" class="form-control col-md-5 col-xs-5" name="ccExpiryYear" placeholder="YY" value="{{ old('ccExpiryYear') }}" size="2" autocomplete="off" required>
                                    </div>
                                    {!! $errors->first('ccExpiryMonth', '<p class="help-block">:message</p>') !!}
                                    {!! $errors->first('ccExpiryYear', '<p class="help-block">:message</p>') !!}
                                </div>
                                <div class="form-group col-xs-2">
                                    <label>CVV</label>
                                    <input type="text" class="form-control" name="cvvNumber" placeholder="123" size="3" autocomplete="off" required>
                                    {!! $errors->first('cvvNumber', '<p class="help-block">:message</p>') !!}
                                </div>                                       
                                <div class="form-group col-xs-12 text-center md-mb-0">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="" name="plan" id="plan_id">
                                    <input type="submit" id="btnComplete" class="btn btn-success md-mt-4" value="Complete the subscription">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </section>
</div>
<script>
    $(document).ready(function(){
        $('.to_subscribe').click(function(){
            $('#subscription').show();
            var name = $(this).data('name');
            console.log(name);
            var id = $(this).data('id');
            $('#plan_name').val(name);
            $('#plan_id').val(id);
        });
    });
</script>
@stop