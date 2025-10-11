<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Dibsy\DibsyService;

class PaymentController extends Controller
{
    public function pay(DibsyService $dibsy)
    {
        $description = 'Payment for order #12345';
        $method = 'naps'; // or 'creditcard', 'naps' ,'applepay','googlepay' based on your requirement
        $payment = $dibsy->createPayment(150.00, 'QAR', route('dibsy.callback'), $description, $method);

        // dd($payment);

        return view('payment.result', compact('payment'));

        // return redirect($payment['status'] ?? '/');
    }

    public function dibsyCallback(Request $request)
    {
        $status = $request->input('status');
        return view('payment.result', compact('status'));
    }
}
