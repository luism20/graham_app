<?php

namespace App\Http\Controllers;

use App\Card;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlansFormRequest;
use App\Plan;
use App\User;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Validator;
use Exception;

class PlansController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the plans.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $plans = Plan::all();
        return view('plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new plan.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('plans.create');
    }

    /**
     * Store a new plan in the storage.
     *
     * @param App\Http\Requests\PlansFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(PlansFormRequest $request)
    {
        $stripe = Stripe::make();
        $data = $request->getData();
        $data['id'] = \uniqid("plan-");
        $data['currency'] = 'USD';
        $stripe->plans()->create([
            'id' => $data['id'],
            'name' => $data['name'],
            'amount' => $data['amount'],
            'currency' => 'USD',
            'interval' => $data['interval'],
            'statement_descriptor' => $data['description'],
        ]);
        Plan::create($data);
        return redirect()->route('plans.plan.index')->with('success_message', 'Plan has been added successfully!');

    }

    /**
     * Display the specified plan.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        return view('plans.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified plan.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('plans.edit', compact('plan'));
    }

    /**
     * Update the specified plan in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\PlansFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, PlansFormRequest $request)
    {
        try {
            $data = $request->getData();
            $plan = Plan::findOrFail($id);
            $plan->update($data);
            return redirect()->route('plans.plan.index')
                ->with('success_message', 'Plan has been updated successfully!');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'An error has happened!']);
        }
    }

    /**
     * Remove the specified plan from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $plan = Plan::findOrFail($id);
            $plan->delete();
            return redirect()->route('plans.plan.index')
                ->with('success_message', 'Plan has been deleted successfully!');
        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'An error has happened!']);
        }
    }

    public function withStripe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required|digits:2|numeric|max:12',
            'ccExpiryYear' => 'required|digits:2|numeric|max:99|min:19',
            'cvvNumber' => 'required|digits:3',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('subscriptions')->withErrors($validator)->withInput();
        } else {
            $stripe = Stripe::make();
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->card_no,
                        'name' => $request->name,
                        'exp_month' => $request->ccExpiryMonth,
                        'exp_year' => $request->ccExpiryYear,
                        'cvc' => $request->cvvNumber,
                    ],
                ]);

                if (!isset($token['id'])) {
                    return redirect("subscriptions")->withInput();
                } else {
                    $card_stripe = $stripe->cards()->create(Auth::user()->stripe_id, $token['id']);
                    $card = new Card(['user_id' => Auth::id(), 'stripe_id' => $card_stripe["id"] ]);
                    $card->save();

                    $subscription = $stripe->subscriptions()->create(Auth::user()->stripe_id, [
                        'plan' => $request->plan,
                    ]);
                    
                    $user = User::find(Auth::id());
                    $user->subscription_id = $subscription['id'];
                    $user->plan_id = $request->plan;
                    $user->save();

                    return redirect('subscriptions')->with('success', 'Successful transaction, the credits have been added to your account.');
                }
                /**
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => $request->amount,
                    'description' => $request->description,
                ]);

                if ($charge['status'] == 'succeeded') {
                    return $this->confirmPurchase($request, $charge["id"]);
                } else {
                    return redirect("stripe")->with('error', 'Money not add in wallet!!');
                }
                */
            } catch (Exception $e) {
                return redirect("subscriptions")->with('error', $e->getMessage())->withInput();
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return redirect("subscriptions")->with('error', $e->getMessage())->withInput();
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return redirect("subscriptions")->with('error', $e->getMessage())->withInput();
            }
        }

    }

}
