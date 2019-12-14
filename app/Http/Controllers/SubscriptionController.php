<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;

use Environment;



class SubscriptionController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }

    public function createSubscription() {

        Environment::setPaymentsCustomUrl("https://api.payulatam.com/payments-api/4.0/service.cgi");
        Environment::setReportsCustomUrl("https://api.payulatam.com/reports-api/4.0/service.cgi");
        Environment::setSubscriptionsCustomUrl("https://api.payulatam.com/payments-api/rest/v4.9/");

        $parameters = array(
            // Ingresa aquí el número de cuotas a pagar.
            PayUParameters::INSTALLMENTS_NUMBER => "1",

            // -- Parámetros del cliente --
            // Ingresa aquí el nombre del cliente
            PayUParameters::CUSTOMER_NAME => "Pedro Perez",
            // Ingresa aquí el email del cliente
            PayUParameters::CUSTOMER_EMAIL => "pperezz@payulatam.com",

            // -- Parámetros de la tarjeta de crédito --
            // Ingresa aquí el nombre del pagador.
            PayUParameters::PAYER_NAME => "Sample User Name",
            // Ingresa aquí el número de la tarjeta de crédito
            PayUParameters::CREDIT_CARD_NUMBER => "4242424242424242",
            // Ingresa aquí la fecha de expiración de la tarjeta de crédito en formato AAAA/MM
            PayUParameters::CREDIT_CARD_EXPIRATION_DATE => "2014/12",
            // Ingresa aquí el nombre de la franquicia de la tarjeta de crédito
            PayUParameters::PAYMENT_METHOD => "VISA",
            // Ingresa aquí el documento de identificación asociado a la tarjeta
            PayUParameters::CREDIT_CARD_DOCUMENT => "1020304050",
            // (OPCIONAL) Ingresa aquí el documento de identificación del pagador
            PayUParameters::PAYER_DNI => "1020304050",
            // (OPCIONAL) Ingresa aquí la primera línea de la dirección del pagador
            PayUParameters::PAYER_STREET => "Address Name",
            // (OPCIONAL) Ingresa aquí la segunda línea de la dirección del pagador
            PayUParameters::PAYER_STREET_2 => "17 25",
            // (OPCIONAL) Ingresa aquí la tercera línea de la dirección del pagador
            PayUParameters::PAYER_STREET_3 => "Of 301",
            // (OPCIONAL) Ingresa aquí la ciudad de la dirección del pagador
            PayUParameters::PAYER_CITY => "City Name",
            // (OPCIONAL) Ingresa aquí el estado o departamento de la dirección del pagador
            PayUParameters::PAYER_STATE => "State Name",
            // (OPCIONAL) Ingresa aquí el código del país de la dirección del pagador
            PayUParameters::PAYER_COUNTRY => "CO",
            // (OPCIONAL) Ingresa aquí el código postal de la dirección del pagador
            PayUParameters::PAYER_POSTAL_CODE => "00000",
            // (OPCIONAL) Ingresa aquí el número telefónico del pagador
            PayUParameters::PAYER_PHONE => "300300300",

            // -- Parámetros del plan --
            // Ingresa aquí la descripción del plan
            PayUParameters::PLAN_DESCRIPTION => "Sample Plan 001",
            // Ingresa aquí el código de identificación para el plan
            PayUParameters::PLAN_CODE => "sample-plan-code-001",
            // Ingresa aquí el intervalo del plan
            PayUParameters::PLAN_INTERVAL => "MONTH",
            // Ingresa aquí la cantidad de intervalos
            PayUParameters::PLAN_INTERVAL_COUNT => "1",
            // Ingresa aquí la moneda para el plan
            PayUParameters::PLAN_CURRENCY => "USD",
            // Ingresa aquí el valor del plan
            PayUParameters::PLAN_VALUE => "1",
            //(OPCIONAL) Ingresa aquí el valor del impuesto
            PayUParameters::PLAN_TAX => "0",
            //(OPCIONAL) Ingresa aquí la base de devolución sobre el impuesto
            PayUParameters::PLAN_TAX_RETURN_BASE => "0",
            // Ingresa aquí la cuenta Id del plan
            PayUParameters::ACCOUNT_ID => "833989",
            // Ingresa aquí el intervalo de reintentos
            PayUParameters::PLAN_ATTEMPTS_DELAY => "1",
            // Ingresa aquí la cantidad de cobros que componen el plan
            PayUParameters::PLAN_MAX_PAYMENTS => "24",
            // Ingresa aquí la cantidad total de reintentos para cada pago rechazado de la suscripción
            PayUParameters::PLAN_MAX_PAYMENT_ATTEMPTS => "3",
            // Ingresa aquí la cantidad máxima de pagos pendientes que puede tener una suscripción antes de ser cancelada.
            PayUParameters::PLAN_MAX_PENDING_PAYMENTS => "1",
            // Ingresa aquí la cantidad de días de prueba de la suscripción.
            PayUParameters::TRIAL_DAYS => "0",
        );

        $response = PayUSubscriptions::createSubscription($parameters);

        return $response;

        if($response){
            $response->id;
            $response->plan->id;
            $response->customer->id;
        }
    }
}
