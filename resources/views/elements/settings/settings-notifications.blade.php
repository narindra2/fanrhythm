<div class="aff_edit_info_form">

    <p>
        {{__('Gérez ici comment et quand vous recevez des notifications de Afrifan, en activant ou désactivant les types de notifications selon vos préférences.')}}
    </p>    

    <form class="aff_notif_form">


        @if(getSetting('profiles.enable_new_post_notification_setting'))
        <div>
            <div>
            {{__('Une nouvelle publication est disponible')}}
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input notification-checkbox"
                    id="notification_email_new_post_created" name="notification_email_new_post_created"
                    {{isset(Auth::user()->settings['notification_email_new_post_created']) ? (Auth::user()->settings['notification_email_new_post_created'] == 'true' ? 'checked' : '') : false}}>
                <label class="custom-control-label" for="notification_email_new_post_created"></label>
            </div>
        </div>
        @endif

        <div>
        <div>
    {{__('Un nouvel abonnement a été souscrit')}}
</div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input notification-checkbox"
                    id="notification_email_new_sub" name="notification_email_new_sub"
                    {{isset(Auth::user()->settings['notification_email_new_sub']) ? (Auth::user()->settings['notification_email_new_sub'] == 'true' ? 'checked' : '') : false}}>
                <label class="custom-control-label" for="notification_email_new_sub"></label>
            </div>
        </div>

        <div>
        <div>
    {{__('Un pourboire a été reçu')}}
</div>

            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input notification-checkbox"
                    id="notification_email_new_tip" name="notification_email_new_tip"
                    {{isset(Auth::user()->settings['notification_email_new_tip']) ? (Auth::user()->settings['notification_email_new_tip'] == 'true' ? 'checked' : '') : false}}>
                <label class="custom-control-label" for="notification_email_new_tip"></label>
            </div>
        </div>

        <div>
        <div>
    {{__('Un nouveau message est arrivé')}}
</div>

            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input notification-checkbox"
                    id="notification_email_new_message" name="notification_email_new_message"
                    {{isset(Auth::user()->settings['notification_email_new_message']) ? (Auth::user()->settings['notification_email_new_message'] == 'true' ? 'checked' : '') : false}}>
                <label class="custom-control-label" for="notification_email_new_message"></label>
            </div>
        </div>

        <div>
        <div>
    {{__('Un nouveau commentaire a été laissé')}}
</div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input notification-checkbox"
                    id="notification_email_new_comment" name="notification_email_new_comment"
                    {{isset(Auth::user()->settings['notification_email_new_comment']) ? (Auth::user()->settings['notification_email_new_comment'] == 'true' ? 'checked' : '') : false}}>
                <label class="custom-control-label" for="notification_email_new_comment"></label>
            </div>
        </div>

        <div>
        <div>
    {{__('Abonnements arrivant à échéance')}}
</div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input notification-checkbox"
                    id="notification_email_expiring_subs" name="notification_email_expiring_subs"
                    {{isset(Auth::user()->settings['notification_email_expiring_subs']) ? (Auth::user()->settings['notification_email_expiring_subs'] == 'true' ? 'checked' : '') : false}}>
                <label class="custom-control-label" for="notification_email_expiring_subs"></label>
            </div>
        </div>
        <div>
        <div>
    {{__('Renouvellements à venir')}}
</div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input notification-checkbox"
                    id="notification_email_renewals" name="notification_email_renewals"
                    {{isset(Auth::user()->settings['notification_email_renewals']) ? (Auth::user()->settings['notification_email_renewals'] == 'true' ? 'checked' : '') : false}}>
                <label class="custom-control-label" for="notification_email_renewals"></label>
            </div>
        </div>
    </form>

</div>
