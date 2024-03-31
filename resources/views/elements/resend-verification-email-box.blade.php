<div class="aff_verif_notification">
    <div>
        <p>
            {{__('Bonjour')}}  {{Auth::user()->name}}
        </p>
        <p>
            {{__("Vous n'avez pas encore confirmer votre e-mail")}}.
        </p>
    </div>
    <div>
        <p>
            <a class="resend-verification-btn" href="javascript:void(0)"
                onClick="sendEmailConfirmation()">{{__("Renvoyer l'email")}}
            </a>
        </p>
    </div>
</div>
