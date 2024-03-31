<?php

namespace App\Http\Controllers;

use App\Services\PaydunyaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class PaydunyaController extends Controller
{
    public function __construct(public PaydunyaService $paydunyaService)
    {
    }
    public function initialPayment(Request $request)
    {
        $response = $this->paydunyaService->initializePayment($request->input("amount"));
        return redirect($response['response_text']);
    }
    public function getPaymentNotification(Request $request)
    {
        $data = $request['token'];
        $response = $this->paydunyaService->getPaymentStatus($data);
        return response()->json($response);
    }
    public function getReturn(Request $request)
    {
        $data = $request['token'];
        $status = $this->paydunyaService->getPaymentStatus($data);
         $this->paydunyaService->updateTransactionStatus($status); 
        return Redirect::route("my.settings");
    }
}
