<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    function pay(Project $project) {

        $url = env('HYPERPAY_LINK')."/v1/checkouts";
        $data = "entityId=" . env('HYPERPAY_PUBLIC') .
                    "&amount=" . $project->price .
                    "&currency=USD" .
                    "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Authorization:Bearer ' . env('HYPERPAY_KEY')));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData = json_decode($responseData, true);
        $id = $responseData['id'];


        return view('payments.pay', compact('project', 'id'));
    }

    function status(Request $request, Project $project) {

        $resourcePath = $request->resourcePath;

        $url = env('HYPERPAY_LINK').$resourcePath;
        // return $url;
        $url .= "?entityId=".env("HYPERPAY_PUBLIC");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer '. env("HYPERPAY_KEY")));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $responseData = json_decode($responseData, true);

        $code = $responseData['result']['code'];

        if($code == '000.100.110') {
            $id = $responseData['id'];
            $free = $project->price - ($project->price * .2);
            $final = $project->price - $free;
            Payment::create([
                'job_id' => $project->id,
                'price' => $project->price,
                'freelancer_fees' => $free,
                'final' => $final,
                'transaction_id' => $id,
                'payment_method' => $responseData['paymentBrand']
            ]);

            return redirect()
            ->route('admin.projects.thanks')
            ->with('msg', 'Payment done successfully')
            ->with('type', 'success');
        }else {
            return redirect()
            ->route('admin.projects.thanks')
            ->with('msg', 'Payment Failed!')
            ->with('type', 'danger');
        }
    }

    function thanks() {
        return view('payments.thanks');
    }
}
