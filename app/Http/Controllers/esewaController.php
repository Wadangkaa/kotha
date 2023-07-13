<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Kotha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;

class esewaController extends Controller
{
    public function esewaPay()
    {
        $pid = uniqid();
        $amount = 30;
        $success_url = route('esewa.success');
        $failure_url = route('esewa.failure');
        // init client for development
        $config = new Config($success_url, $failure_url);

        $esewa = new Client($config);

        $esewa->process($pid, $amount, 0, 0, 0);
    }

    public function paymentSuccess(Request $request)
    {
        $payment_id = Payment::create([
            'product_id' => $request->oid,
            'amount' => $request->amt,
            'kotha_id' => session('new_kotha_id'),
            'esewa_ref_id' => $request->refId
        ]);

        if ($payment_id) {
            Session::remove('new_kotha_id');
            Session::put('success', 'Payment Success');
        }

        return redirect()->route('post.index');
    }

    public function paymentFailure()
    {
        $kotha = Kotha::find(Session::get('new_kotha_id'));
        if ($kotha->forcedelete()) {
            Session::remove('new_kotha_id');
            Session::put('error', 'Payment_failed');
        };
        return (new postController)->index();
    }
}
