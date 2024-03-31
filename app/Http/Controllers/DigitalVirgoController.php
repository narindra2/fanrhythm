<?php

namespace App\Http\Controllers;

use App\Services\DigitalVirgoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class DigitalVirgoController extends Controller
{
    public function __construct(public DigitalVirgoService $digitalVirgoService)
    {
    }
    public function getReturnPayment(Request $request)
    {
        $transactionId = $request->input("transaction_id");
        $status = $this->digitalVirgoService->checkTransactionStatus($transactionId);
        $this->digitalVirgoService->updateTransactionStatus($transactionId, $status);
        Log::alert(json_encode($status));

        return Redirect::route("my.settings");
    }
    public function generatePayUrl(Request $request)
    {
        $response = $this->digitalVirgoService->generatePaymentUrl($request->input("amount"));
        return response()->json($response);
    }
    public function notifyPayment(Request $request)
    {
        $transactionId = $request->input("transaction_id");
        $status = $this->digitalVirgoService->checkTransactionStatus($transactionId);
        Log::alert(json_encode($status));
    }
}
