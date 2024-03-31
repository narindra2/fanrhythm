<?php

namespace App\Services;

use App\Model\Subscription;
use App\Model\Transaction;
use App\Model\UserMessage;
use App\Model\Wallet;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;

class DigitalVirgoService
{

    protected $site_id;
    protected $apiKey;

    public function __construct()
    {
        $this->site_id =  env("DIGITAL_VIRGO_SITE_ID");
        $this->apiKey = env("DIGITAL_VIRGO_API");
    }

    public function generatePaymentUrl($amount)
    {
        $currency = "XOF";
        $notifyUrl = env("DIGITAL_VIRGO_NOTIFY_URL");
        $return_url = env("DIGITAL_VIRGO_RETURN_URL");
        $description = "description";
        $channels = "MOBILE_MONEY";
        $transaction_id = Uuid::uuid4()->toString();

        $response =  Http::post($this->getPaymentUrl(), [
            'site_id' => $this->site_id,
            'apikey' => $this->apiKey,
            'transaction_id' => $transaction_id,
            'channels' => $channels,
            'currency' => $currency,
            'notify_url' => $notifyUrl,
            'return_url' => $return_url,
            'description' => $description,
            'amount' => $amount
        ]);

        return ([...$response->json(), "transaction_id" => $transaction_id]);
    }
    protected function getPaymentUrl()
    {
        return "https://api.epaycs.com/v2/payment";
    }

    public function checkTransactionStatus(string $transactionId)
    {
        $response =  Http::post($this->getPaymentUrl() . "/check", [
            'site_id' => $this->site_id,
            'apikey' => $this->apiKey,
            'transaction_id' => $transactionId,
        ]);

        return $response->json();
    }
    public function updateTransactionStatus($transaction_id, $status)
    {
        $transaction = Transaction::where("transaction_id", $transaction_id)->first();
        $transaction->status = isset($status["data"]) && $status["data"]["status"] == "ACCEPTED" ? Transaction::APPROVED_STATUS : $transaction->status;
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
        return $transaction;
    }
}
