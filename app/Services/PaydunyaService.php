<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;
use App\Model\Subscription;
use App\Model\Transaction;
use App\Model\UserMessage;
use App\Model\Wallet;


class PaydunyaService
{
    public function initializePayment(int $amount)
    {
        $transaction_id = Uuid::uuid4()->toString();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'PAYDUNYA-MASTER-KEY' => env('KEY_MASTER'),
            'PAYDUNYA-PRIVATE-KEY' => env('KEY_PRIVATE'),
            'PAYDUNYA-TOKEN' => env('TOKEN'),
        ])->post($this->getPaymentUrl() . "/create", [
            "invoice" => [
                "total_amount" => $amount,
            ],
            "store" => [
                "name" => "fanrhythm"
            ],
            "custom_data" => [
                "transaction_id" => $transaction_id
            ],
            "actions" => [
                "callback_url" => "https://web.fanrhythm.com/api/paydunya/status",
                "return_url" =>  "https://web.fanrhythm.com/api/paydunya/return"
            ]
        ]);

        return ([...$response->json(), "transaction_id" => $transaction_id]);
    }

    protected function getPaymentUrl()
    {
        return "https://app.paydunya.com/api/v1/checkout-invoice";
    }

    public function getPaymentStatus($token)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'PAYDUNYA-MASTER-KEY' => env('KEY_MASTER'),
            'PAYDUNYA-PRIVATE-KEY' => env('KEY_PRIVATE'),
            'PAYDUNYA-TOKEN' => env('TOKEN'),
        ])->get($this->getPaymentUrl() . "/confirm/$token");

        return $response->json();
    }
    public function updateTransactionStatus($status)
    {
        $transaction = Transaction::where("transaction_id", $status["custom_data"]["transaction_id"])->first();
        $transaction->status = isset($status) && $status["status"] == "completed" ? Transaction::APPROVED_STATUS : $transaction->status;
        $transaction->save();
        $userId = $transaction->sender_user_id;
        $receiverId = $transaction->recipient_user_id;
        $userWallet = Wallet::where("user_id", $userId)->first();
        $receiverWallet = Wallet::where("user_id", $receiverId)->first();
        switch ($transaction->type) {
            case Transaction::POST_UNLOCK:

                $receiverWallet->total += $transaction->amount;
            case Transaction::DEPOSIT_TYPE:
                $userWallet->total += $transaction->amount;
                break;
            case Transaction::MESSAGE_UNLOCK:

                $receiverWallet->total += $transaction->amount;
                $message = UserMessage::where("id", $transaction->user_message_id)->first();
                $message->price = null;
                $message->save();
                break;
            case Transaction::CHAT_TIP_TYPE || Transaction::TIP_TYPE:

                $receiverWallet->total += $transaction->amount;
                break;
            case Transaction::YEARLY_SUBSCRIPTION || Transaction::SUBSCRIPTION_RENEWAL || Transaction::ONE_MONTH_SUBSCRIPTION || Transaction::THREE_MONTHS_SUBSCRIPTION || Transaction::SIX_MONTHS_SUBSCRIPTION:
                $subscription = Subscription::where("id", $transaction->subscription_id)->first();
                $subscription->status = $transaction->status;

                $receiverWallet->total += $transaction->amount;
                $subscription->save();
                break;
        }
        $receiverWallet->save();
        $userWallet->save();
        return $transaction;
    }
}
