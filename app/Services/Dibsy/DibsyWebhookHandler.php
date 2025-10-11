<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Dibsy\DibsyService;

class PaymentController extends Controller
{
    public function pay(DibsyService $dibsy)
    {
        $payment = $dibsy->createPayment(150.00, 'QAR', route('dibsy.callback'));

        return redirect($payment['invoice']['url'] ?? '/');
    }

    public function dibsyCallback(Request $request)
    {
        $status = $request->input('status');
        return view('payment.result', compact('status'));
    }
}
