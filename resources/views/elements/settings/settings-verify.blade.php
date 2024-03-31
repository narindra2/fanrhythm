@if(session('success'))
<div class="alert alert-success text-white font-weight-bold mt-2" role="alert">
{{__('Compte vérifié')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-warning text-white font-weight-bold mt-2" role="alert">
    {{session('error')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(Auth::user()->verification && (Auth::user()->verification->rejectionReason && Auth::user()->verification->status ===
'rejected' ) )
<div class="alert alert-warning text-white font-weight-bold mt-2" role="alert">
    {{__("Your previous verification attempt was rejected for the following reason:")}}
    "{{Auth::user()->verification->rejectionReason}}"
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


@if(Auth::user()->email_verified_at && (Auth::user()->verification && Auth::user()->verification->status == 'verified'))
<div id="hey_" class="pro_accn">
    <div>
        <div>
            {{__('Votre compte a été vérifié')}}
        </div>
        <div>
            {{__('Félicitations! Votre compte a été vérifié avec succès. Vous pouvez maintenant profiter de toutes les fonctionnalités de notre plateforme.')}}
        </div>

        <a href="https://web.fanrhythm.com/posts/create">
            {{__('Publier maintenant')}}
        </a>

    </div>
    <img src="{{asset('/img/hey.png')}}" />
</div>
<br>

<div class="info_pour_verif">
    <div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope"
                viewBox="0 0 16 16">
                <path
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
            </svg>
        </div>
        <div>
        {{__('Confirmation e-mail')}}
        </div>
    </div>
    <div>
        @if(Auth::user()->email_verified_at)
            <span class="text-primary">
                {{__('Terminé')}}
            </span>
        @else
            <span class="text-danger">
                {{__('Non-vérifié')}}
            </span>
        @endif
    </div>
</div>


<div class="info_pour_verif">
    <div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person-vcard" viewBox="0 0 16 16">
                <path
                    d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                <path
                    d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
            </svg>
        </div>
        <div>
        {{__('Passeport + selfie avec passeport')}}
        </div>
    </div>
    <div>
        <span class="text-primary">
        {{__('Terminé')}}
        </span>
    </div>
</div>
<p class="info_aler">
   <span>*</span> {{__('Nous tenons à vous informer que toutes les informations sensibles que nous avons recueillies lors du processus de vérification, telles que les détails du passeport, de la CIN ou autres, ont été supprimées de nos serveurs après la vérification.')}}
</p>
@else
@if(!Auth::user()->verification || (Auth::user()->verification && Auth::user()->verification->status !== 'verified' &&
Auth::user()->verification->status !== 'pending'))


<div id="hey_">
    <div>
    <div>
            {{__('Devenir créateur sur Afrifan')}}
        </div>
        <div>
            {{__('Vérification et documents d\'identification obligatoires pour publication. Seuls les comptes activés peuvent publier. Garantie de sécurité et d\'intégrité communautaire.')}}
        </div>

        <a href="#" id="commencer_la_verification">
            {{__('Vérifier')}}
        </a>
        <a href="#" onclick="location.reload();">
            {{__('Actualiser la page')}}
        </a>


    </div>
    <img src="{{asset('/img/hey.png')}}" />
</div>


<form class="verify-form" action="{{route('my.settings.verify.save')}}" method="POST">
    @csrf

    <div class="etape_verif" id="aff_verif_1">
        <a href="#" class="close_verif" id="close_verif_1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-x">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </a>
        <div>

        <div class="verif_header">
            <h3>
                {{__('Vérifiez votre identité')}}
            </h3>
            <p>
                {{__('La vérification de l\'identité se compose de quelques étapes simples et ne devrait pas prendre plus d\'une minute ou deux. Ne vous inquiétez pas, toutes vos données sont en sécurité.')}}
            </p>
        </div>
            <div class="verif_body">
                <p>
                {{__('Statut de votre compte :')}}
                </p>

                <div class="info_pour_verif">
                    <div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-envelope" viewBox="0 0 16 16">
                                <path
                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                            </svg>
                        </div>
                        <div>
                        {{__('Confirmation e-mail')}}
                        </div>
                    </div>
                    <div>
                        @if(Auth::user()->email_verified_at)
                        <span class="text-primary">
                        {{__('Terminé')}}
                        </span>
                        @else
                        <span class="text-danger">
                        {{__('Non-vérifié')}}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="info_pour_verif">


                    <div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-vcard" viewBox="0 0 16 16">
                                <path
                                    d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                                <path
                                    d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
                            </svg>
                        </div>
                        <div>
                        {{__('Passeport / CIN')}}
                        </div>
                    </div>
                    <div>
                        @if((Auth::user()->verification && Auth::user()->verification->status == 'verified'))
                        <span class="text-primary">
                        {{__('Terminé')}}
                        </span>
                        @else
                        @if(!Auth::user()->verification || (Auth::user()->verification &&
                        Auth::user()->verification->status
                        !==
                        'verified' && Auth::user()->verification->status !== 'pending'))

                        <span class="text-danger">
                        {{__('Non-vérifié')}}
                        </span>

                        @else

                        <span class="text-warning">
                        {{__('En cours')}}
                        </span>

                        @endif
                        @endif
                    </div>
                </div>


            </div>

            @if((!Auth::user()->verification || (Auth::user()->verification && Auth::user()->verification->status !==
            'verified' && Auth::user()->verification->status !== 'pending')) )

            <div class="verif_footer">
                <a href="#" id="goto_etape_verif_2">
                    {{__('Joindre des documents')}}
                </a>
            </div>
            @endif
        </div>


    </div>

    <div class="etape_verif" id="aff_verif_2">
        @if((!Auth::user()->verification || (Auth::user()->verification && Auth::user()->verification->status !==
        'verified' && Auth::user()->verification->status !== 'pending')) )

        <a href="#" class="close_verif" id="close_verif_2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-x">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </a>

<!--style="background:url('{{asset('/img/verif.webp')}}');"-->
        <div class="instruction">
        <div>
            <h3>{{__('Vérification de compte')}}</h3>
            <p>{{__('Suivez ces instructions pour vérifier votre compte :')}}</p>

            <div class="instruc">
                <h4>{{__('1- Document d\'identité')}}</h4>
                <p>{{__('Disposez de votre passeport ou carte d\'identité valide.')}}</p>
            </div>

            <div class="instruc">
                <h4>{{__('2 - Photo du document')}}</h4>
                <p>{{__('Prenez une photo claire de votre document d\'identité, en vous assurant que toutes les informations sont lisibles.')}}</p>
            </div>

            <div class="instruc">
                <h4>{{__('3 - Selfie avec le document')}}</h4>
                <p>{{__('Prenez un selfie en tenant votre document d\'identité à côté de votre visage, les deux doivent être clairement visibles.')}}</p>
            </div>

            <p>{{__('Après l\'envoi, la validation de votre compte de créateur est en cours. Le processus peut prendre jusqu\'à 48h (horaires ouvrés). Merci de votre patience.')}}</p>

            <p>{{__('L\'équipe Afrifan vous remercie pour votre coopération. En cas de besoin, n\'hésitez pas à nous contacter.')}}</p>
            
           
        </div>
        </div>
       <div>
        <div>
            <p>
            <img src="{{ asset('img/logo.webp') }}" alt="" style="width: 100px;  height: fit-content; object-fit: contain; margin: auto; display: block; margin-bottom: 20px;"> 
            </p>
                <div class="verif_body">
                    <div class="dropzone-previews dropzone w-100"></div>
                </div>
                <br>
                <input class="custom-control-input @error('terms') is-invalid @enderror" id="tosAgree" type="checkbox"
                    name="terms" value="1" placeholder="{{ __('Terms and Conditions') }}">
                <label class="custom-control-label" for="tosAgree">
                    <span>{{ __('Jaccepte') }}
                        <a
                            href="{{ url('/agreement') }}">{{ __("les conditions d'utilisation") }}</a>
                       , <a
                        <a
                            href="{{ url('/agreement#community-guidelines') }}">{{ __("community guidelines") }}</a>
                        {{ __('et') }} <a
                            href="/privacy/">{{ __('la politique de confidentialité.') }}</a></span>
                        <p>{{__("En devenant créateur, vous serez soumis aux règles qui s'appliquent à « l'utilisateur créatif » selon les termes et conditions de ce site Web.")}}</p>
                        <p>{{__("Veuillez noter que les conditions et accords de services de la plateforme Fanrhythm ainsi que les directives de la communauté Fanrhytm sont tous deux des accords juridiques contraignants entre vous et A.M. Hébergement Cloud Services Limited.")}}</p>
                </label>
                <br>
                <div class="verif_footer">
                    <button>
                    <h4>{{__('Envoyer')}}</h4>
                    </button>
                </div>
            </div>
       </div>
        @endif

    </div>
</form>

<div class="animation_rapide">
    <div class="loader_subm"></div>
</div>

@else

<p class="message_conf_">
{{__('La vérification de votre compte prendra jusqu\'à 72 heures. En attendant, commencez à poster sur votre compte afin que vos abonnés puissent accéder à vos contenus dès la vérification de votre compte.')}} 
<br>{{__('Afrifan vous remercie.')}}
</p>

@endif
@endif

@if(!Auth::user()->verification || 
   (Auth::user()->verification && Auth::user()->verification->status !== 'verified' && Auth::user()->verification->status === 'rejected'))
   <br>
    <p class="message_conf_">
    {{__('Votre demande n\'a pas été approuvée pour les raisons suivantes :')}}
    <br>
    <br>
    {{__('1 - Carte d\'identité :')}}
    <br>
    {{__('- Ne correspond pas aux photos du profil.')}}
    <br>
    {{__('- Illisible ou partiellement illisible.')}}
    <br><br>

    {{__('2 - Selfie :')}}
    <br>
    {{__('- Mauvaise qualité.')}}
    <br>
    {{__('- Visage caché ou coupé.')}}
    <br><br>

    {{__('3 - Compte :')}}
    <br>
    {{__('- Double compte détecté, ce qui est refusé sur notre plateforme.')}}
    <br><br>

    {{__('Veuillez prendre en compte ces observations, ajuster vos contenus en conséquence, et soumettre à nouveau votre demande.')}}
    <br><br>

    {{__('Afrifan vous remercie de votre compréhension et de votre effort pour maintenir la qualité de notre plateforme.')}}
    </p>

@endif


<style>

.message_conf_{
    background: #fafafa;
    padding: 20px;
    font-size: 14px;
    border: 1px dotted #ddd;
    border-radius: 9px;
}

.loader_subm {
    border: 6px solid #f3f3f3;
    border-radius: 50%;
    border-top: 6px solid #59b8f7;
    width: 40px;
    height: 40px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}



.animation_rapide{
    display: none;
    background: #000000cc;
    position: fixed;
    top: 0;
    z-index: 9999;
    width: 100%;
    left: 0;
    height: 100%;
    align-items: center;
    justify-content: center;
}

.boutton_a_ete_clique .animation_rapide{
    display: flex;
}

    .etape_verif {
        display: none;
    }

    .etapes_verifications #aff_verif_1,
    .etapes_fichiers #aff_verif_2 {
        background: var(--bg-card);
        display: flex;
        width: 100%;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .etape_verif>div {
        max-width: 480px;
    }

    .verif_header h3 {
        font-weight: 600;
        font-size: 18px;
        letter-spacing: -0.37px;
        text-align: center;
    }

    .verif_header p {
        font-size: 14px;
        color: var(--color-text-default);
        letter-spacing: -0.32px;
        margin-bottom: 0px;
        text-align: center;
        margin-bottom: 27px;
    }

    .verif_body>p {
        font-size: 14px;
        color: var(--color-text-default);
        letter-spacing: -0.32px;
    }

    .verif_footer {
        padding-top: 27px;
    }

    .verif_footer a,
    .verif_footer button {
        background-image: linear-gradient(92deg, #59B8F7 39%, #28A0F0 79%);
        border-radius: 24px;
        font-weight: 600;
        font-size: 14px;
        color: #FFFFFF;
        letter-spacing: -0.32px;
        text-align: center;
        border: 1px solid var(--bg-card);
        padding: 14px 20px;
        display: block;
        width: 100%;
    }

    .info_pour_verif {
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        border-radius: 8px;
        background-color: rgb(255, 255, 255);
        box-shadow: rgba(0, 0, 0, 0.08) 1px 1px 9px;
        background-color: var(--bg-card);
        padding: 20px;
        margin-bottom: 10px;
        justify-content: space-between;
    }

    .info_pour_verif>div:nth-child(1) {
        display: flex;
        align-items: center;
    }

    .info_pour_verif>div:nth-child(1)>div:nth-child(1) {
        background: #28a0f012;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        margin-right: 14px;
        border: 1px solid #28a0f00a;
        color: #28a0f0;
    }

    .info_pour_verif>div:nth-child(1) div:nth-child(2) {
        font-size: 14px;
        color: var(--color-text-default);
        letter-spacing: -0.32px;
        margin-bottom: 0px;
        text-align: center;
        font-weight: 600;
    }

    .info_pour_verif>div:nth-child(2) span {
        font-size: 10px;
        text-transform: uppercase;
        font-weight: 500;
    }

    .close_verif {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        border-radius: 100%;
        background: #ededed;
        justify-content: center;
        color: #00000094;
    }

    .close_verif:hover {
        color: #fff;
        background: #ea0606;
    }

    .verif_body .dropzone-previews.dropzone.w-100.dz-clickable {
        border: 2px dotted #00000057;
        border-radius: 10px;

    }



    .verif_body .dropzone-previews.dropzone.w-100.dz-started {
        position: relative;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        flex-wrap: wrap;
        margin-left: -4px;
        padding: 20px 20px 12px 12px !important;
        margin-right: -4px;
        margin-bottom: 0px;
        margin-top: 0px;
        position: relative;
        left: 2px;
    }

    .verif_body .dropzone-previews>div {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 20%;
        flex: 0 0 20%;
        max-width: 20%;
        width: 100%;
        height: auto;
        padding: 0px 4px;
        margin: 0px 0px 8px 0px !important;
        position: relative;
        display: flex;
    }

    .verif_body .dropzone .dz-preview .dz-image {
        border-radius: 10px;
        overflow: hidden;
        width: auto;
        height: auto;
        position: relative;
        display: block;
        z-index: 10;
    }

    .verif_body .dropzone .dz-preview {
        min-height: auto;
    }

    .verif_body .dropzone .dz-preview .dz-image img {
        display: block;
        max-width: 100%;
    }


    .verif_body .dropzone .dz-message {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
        border: 0px;
        margin: 0px;
        background: 0;
        border-radius: 6px;
        font-size: 14px;
        color: #8E8E8E;
        letter-spacing: -0.32px;
        text-align: center;
        padding: 50px;
        border: 1px solid var(--border-default);
        margin-top: 20px;
        
    }

    .verif_body .dropzone-previews>div.dz-message {
        display: none !important;
    }

    .verif_body .dropzone-previews>div>div.dz-image.shadow {
        display: block;
        box-shadow: none !important;
        border: 1px solid #edededee;
    }

    .verif_body .dropzone-previews>div>div {
        display: none;
    }

    .verif_body .dropzone .dz-preview .dz-remove {
        font-size: 14px;
        text-align: center;
        display: block;
        cursor: pointer;
        border: none;
        position: absolute;
        height: 100%;
        top: 0px;
        z-index: 199;
        right: 0px;
        width: calc(100% - 8px);
        left: 4px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="%23fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>');
        background-size: 16px;
        background-repeat: no-repeat;
        background-position: center;
        background-color: #f03232e3;
        font-size: 0px;
        opacity: 0;
        transition: .4s;
    }

    .verif_body .dropzone .dz-preview:hover .dz-remove {
        opacity: 1;
        transition: .4s;
    }

    .verif_body .dropzone .dz-preview:hover .dz-image img {
        -webkit-filter: none !important;
        filter: none !important;
        webkit-transform: none;
        -moz-transform: none;
        -ms-transform: none;
        -o-transform: none;
        transform: none;
    }

    .verif_body .dz-details,
    .verif_body .dz-progress,
    .verif_body .dz-success-mark,
    .verif_body .dz-error-mark,
    .verif_body .dz-error-message {
        display: none !important;
    }

    .dropzone-previews:not(.dz-started)>div.dz-message {
        display: block !important;
        border: 0px;
    }

</style>
@include('elements.uploaded-file-preview-template')
