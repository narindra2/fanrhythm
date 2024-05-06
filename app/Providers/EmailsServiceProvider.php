<?php

namespace App\Providers;

use App\Mail\GenericEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class EmailsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public static function sendGenericEmail($options = [])
    {
        try {
            Mail::to($options['email'])->send(new GenericEmail(
                [
                    'subject' => $options['subject'],
                    'mailTitle' => $options['title'],
                    'mailContent' => $options['content'],
                    'mailQuote' => (isset($options['quote']) ? $options['quote'] : null),
                    'replyTo' => (isset($options['replyTo']) ? $options['replyTo'] : null),
                    'button' => [
                        'color' => 'primary',
                        'text' => $options['button']['text'],
                        'url' => $options['button']['url'],
                    ],
                ]
            ));
        } catch (\Throwable $th) {
            return true; // on s'enfouit de l'erreur de send mail, les utilisateurs mettent des emails bordel
        }
        return true;
    }
}
