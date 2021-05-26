<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function price($user)
    {
        return $user->recycling()->where('verified', 'approved')->where('is_payment_received', '0')->count()/100;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_payments = auth()->user()->payments;
        return view('payment.index', compact('user_payments'));
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
    public function store($payment_type)
    {
        $user_recycling = auth()->user()->recycling()->where('verified', 'approved')->where('is_payment_received', '0')->get();
        abort_if(!count($user_recycling), 403, 'Hesabinizda yeterli bakiye bulunmamaktadir.');

        $payment = new Payment();
        $payment->price = $this->price(auth()->user());
        if ($payment_type == 'donate') {
            $payment->price_type = 'donate';
        } else {
            $payment->price_type = 'iban';
        }
        $payment->user_id = auth()->user()->id;
        $payment->save();

        foreach ($user_recycling as $key => $recycling) {
            $recycling->is_payment_received = 1;
            $recycling->save();
        }

        return redirect()->route('payment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Payment $payment, $operation)
    {
        if (!auth()->user()->can('payment confirm')) {
            abort(403);
        }

        if ($operation == 'successful') {
            $payment->is_success = 'successful';
        } else {
            $payment->is_success = 'unsuccessful';
        }
        $payment->save();

        return redirect()->route('payment.waiting');

    }

    public function waiting()
    {
        if (!auth()->user()->can('payment confirm')) {
            abort(403);
        }

        $user_payments = Payment::where('is_success', 'waiting')->get();
        return view('payment.index', compact('user_payments'));

    }

}
