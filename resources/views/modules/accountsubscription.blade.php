@extends('layouts.head')
@section('title', $title)

@section('content')
<script src="https://cdn.kushkipagos.com/kushki-checkout.js"></script>
<div class="content-wrapper">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">-->
     <section class="section">
            <div class="container" style="min-width: 450px">
                <div class="onboarding_wrapper">
                    <header class="onboarding_header ">
                    
                    <div class="onboarding_subtitle" style="padding: 20px;">
                    <p>
                        
                    Your free trial started on {{ (new DateTime($subscription->trialStartDate))->format('M d, Y') }}. At the end of this period ({{ (new DateTime($subscription->trialFinishDate))->format('M d, Y') }}) you will have to enter your payment information to continue using Graham Mind.
                    </p>
                    </div>
                    </header>

                </div>
            </div>
        </section>
         <section class="container content">
        <div class="row onboarding_wrapper" style="margin-left: 0px;margin-right: 0px;">
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
                    
                    <div class="box-body">
                        <div >
                        <form id="kushki-pay-form" action="confirm" method="post" style="min-height: 400px;">
                            <input type="hidden" name="cart_id" value="123">
                        </form>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
        
    </section>

</div>
<script type="text/javascript">
    var kushki = new KushkiCheckout({
        form: "kushki-pay-form",
        merchant_id: "20000000106778845000",
        amount: "99",
        currency: "USD",
        language: "en",
        return_url: "",
        payment_methods:["credit-card"], // Payments Methods enabled
        is_subscription: true, // Optional
        inTestEnvironment: true, 
        regional:false // Optional
    });
</script>
<script>
    $(document).ready(function(){
        $('iframe[name ="kushki-iframe"]').css("min-height","395px");        
    });
</script>
@stop