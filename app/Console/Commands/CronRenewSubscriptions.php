<?php

namespace App\Console\Commands;

use App\Helpers\PaymentHelper;
use App\Model\Subscription;
use App\Model\Transaction;
use App\Providers\NotificationServiceProvider;
use App\Providers\PaymentsServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CronRenewSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:renew_subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process subscriptions renewal (update status, add/remove credit, etc)';

    public $paymentHelper;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PaymentHelper $paymentHelper)
    {
        $this->paymentHelper = $paymentHelper;
        parent::__construct();
    }

    /**
     * Process subscriptions renewal (update status, add/remove credit, etc).
     *
     * @return mixed
     */


     
     public function handle()
     {
         Log::channel('cronjobs')->info('[*]['.date('H:i:s')."] Starting processing subscriptions.\r\n");
     
         // Récupérer tous les abonnements actifs
         $activeSubscriptions = Subscription::with('subscriber', 'creator')
             ->where('status', '=', Subscription::ACTIVE_STATUS)
             ->get();
     
             foreach ($activeSubscriptions as $subscription) {
                // Vérifier si l'abonnement a expiré
                if (now()->gte($subscription->expires_at)) {
                    // Marquer l'abonnement comme expiré
                    $subscription->status = Subscription::EXPIRED_STATUS;
                    $subscription->save();
                    Log::channel('cronjobs')->info("[*][".date('H:i:s')."] Subscription {$subscription->id} marked as expired.");
                }
            }
            
         Log::channel('cronjobs')->info('[*]['.date('H:i:s')."] Finished processing subscriptions.\r\n");
         return 0;
     }
     
}