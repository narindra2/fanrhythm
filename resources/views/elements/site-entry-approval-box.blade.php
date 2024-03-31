<div class="modal fade" tabindex="-1" role="dialog" id="site-entry-approval-dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="d-flex justify-content-center align-items-center mt-5">
                {{-- <img class="brand-logo pb-4" src="{{asset( (Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme') == 'dark' ? getSetting('site.dark_logo') : getSetting('site.light_logo')) : (Cookie::get('app_theme') == 'dark' ? getSetting('site.dark_logo') : getSetting('site.light_logo'))) )}}"> --}}
                <img class="brand-logo pb-4" src="{{ "/img/logo.webp"}}">
            </div>

            <div class="d-flex justify-content-center align-items-center mt-4 mb-2 px-3 px-md-0">
                 <h4 class="text-uppercase text-bolder">{{__("Avertissement")}}</h4>
            </div>

            <div class="modal-body">
                <p>{{__("Ce site Internet est un réseau social exclusif de partage de contenus. Pour continuer, vous devez avoir 18 ans ou plus et respecter la loi de votre pays concernant la consommation de contenu en ligne et les directives en matière d'âge. En naviguant sur ce site, vous attestez répondre à ces critères et accepter nos conditions d'utilisation.")}}</p>
                <p>{{__("Nous utilisons des cookies pour améliorer votre expérience sur notre site. En poursuivant votre navigation, vous acceptez l'utilisation de cookies.")}}</p>
            </div>

            <div class="d-flex">
                <div class="col-6">
                    <button type="submit" class="btn  btn-primary btn-block" onClick="acceptSiteEntry();">
                        {{__('Accepter')}}
                    </button>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-link btn-block" onClick="redirect('{{getSetting('compliance.age_verification_cancel_url')}}')">
                        {{__('Sortir de ce site')}}
                    </button>
                </div>
            </div>
            <div class="modal-body pt-2 pb-2">
                <p class="text-muted">{{__("You can read more about our")}} <a href="{{ url('/agreement')}}">{{__("Termes et conditions")}}</a> {{__("over this page")}}.</p>
            </div>
        </div>
    </div>
</div>
