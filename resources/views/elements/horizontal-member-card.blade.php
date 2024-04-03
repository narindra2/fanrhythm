
<div class="modal fade " tabindex="-1" role="dialog" id="subrcribe-dialog">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content p-2">
            <div class="modal-header" style="padding: 7px;">
                <h5 class="modal-title">
                    {{-- <span class="block-user-label">{{__('Login to subscribe')}}</span> --}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
                .mini-text {
                    font-size: 12px;
                    color: #9E9E9E;
                    letter-spacing: -0.28px;
                }
                a:hover {
                    color:#2e8dcd;
                }
            </style>
            {{-- <div class="modal-body" style="padding: 9px;"> --}}
            <div class="p-1 card-center " >
                <div class="">
                    <img class="card-img-top" src="{{ $user->cover }}" alt="{{$user->name}}">
                    <div class="card-body" style="padding: 0.25rem;">
                        <div class="col-12 col-md-auto" style="margin-top: -69px;">
                            <div class="d-flex justify-content-center">
                                <img src="{{$user->avatar}}" class="avatar rounded-circle shadow" alt="{{$user->name}}"/>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="card-title" style="margin-bottom: 0%;">
                                <a href="{{route('profile',['username'=>$user->username])}}">{{$user->name}}</a>
                                <span>
                                    @if ($user->email_verified_at && ($user->verification && $user->verification->status == 'verified'))
                                        <span data-toggle="tooltip" data-placement="top" title="{{ __('Verified user') }}">
                                            <svg style="fill: #59b8f7; height: 16px;" viewBox="0 0 22 22"
                                                aria-label="Compte certifié" role="img" data-testid="icon-verified">
                                                <g>
                                                    <path
                                                        d="M20.396 11c-.018-.646-.215-1.275-.57-1.816-.354-.54-.852-.972-1.438-1.246.223-.607.27-1.264.14-1.897-.131-.634-.437-1.218-.882-1.687-.47-.445-1.053-.75-1.687-.882-.633-.13-1.29-.083-1.897.14-.273-.587-.704-1.086-1.245-1.44S11.647 1.62 11 1.604c-.646.017-1.273.213-1.813.568s-.969.854-1.24 1.44c-.608-.223-1.267-.272-1.902-.14-.635.13-1.22.436-1.69.882-.445.47-.749 1.055-.878 1.688-.13.633-.08 1.29.144 1.896-.587.274-1.087.705-1.443 1.245-.356.54-.555 1.17-.574 1.817.02.647.218 1.276.574 1.817.356.54.856.972 1.443 1.245-.224.606-.274 1.263-.144 1.896.13.634.433 1.218.877 1.688.47.443 1.054.747 1.687.878.633.132 1.29.084 1.897-.136.274.586.705 1.084 1.246 1.439.54.354 1.17.551 1.816.569.647-.016 1.276-.213 1.817-.567s.972-.854 1.245-1.44c.604.239 1.266.296 1.903.164.636-.132 1.22-.447 1.68-.907.46-.46.776-1.044.908-1.681s.075-1.299-.165-1.903c.586-.274 1.084-.705 1.439-1.246.354-.54.551-1.17.569-1.816zM9.662 14.85l-3.429-3.428 1.293-1.302 2.072 2.072 4.4-4.794 1.347 1.246z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </span>
                                    @endif
                                </span>
                            </h5> 
                           
                            <a class='mini-text' href="{{route('profile',['username'=>$user->username])}}"> <span>@</span>{{ $user->username }}</a>
                           

                        </div>
                        
                        @if (1)
                            <p class="card-text">
                                <ul class="list-unstyled">
                                    <li class="" style="font-size: 14px;" >@include('elements.icon',['icon'=>'checkmark-sharp','centered'=>false, 'classes' => 'mr-2 text-muted', 'variant'=>'medium'])  {{__("Accès complet à ce contenu de créateur")}}</li>
                                    <li class="" style="font-size: 14px;">@include('elements.icon',['icon'=>'checkmark-sharp','centered'=>false, 'classes' => 'mr-2 text-muted', 'variant'=>'medium']) {{__('Annulez votre abonnement gratuit à tout moment')}}</li>
                                    <li class="" style="font-size: 14px;">@include('elements.icon',['icon'=>'checkmark-sharp','centered'=>false, 'classes' => 'mr-2 text-muted', 'variant'=>'medium'])  {{__('Discutez avec moi et demandez du contenu exclusif')}}</li>
                                    <li class="" style="font-size: 14px;">@include('elements.icon',['icon'=>'checkmark-sharp','centered'=>false, 'classes' => 'mr-2 text-muted', 'variant'=>'medium'])  {{__('Contenus exclusifs via le chat')}}</li>
                                    <li class="" style="font-size: 14px;">@include('elements.icon',['icon'=>'checkmark-sharp','centered'=>false, 'classes' => 'mr-2 text-muted', 'variant'=>'medium'])  {{__('Découvrez ma bibliothèque média à la demande')}}</li>
                                </ul>
                            </p>
                        @else 
                            <p class="card-text">
                                <ul class="list-unstyled">
                                    <li class="" style="font-size: 14px;" >@include('elements.icon',['icon'=>'checkmark-sharp','centered'=>false, 'classes' => 'mr-2 text-muted', 'variant'=>'medium'])  {{__("Accès complet à ce contenu de créateur gratuit")}}</li>
                                    <li class="" style="font-size: 14px;">@include('elements.icon',['icon'=>'checkmark-sharp','centered'=>false, 'classes' => 'mr-2 text-muted', 'variant'=>'medium']) {{__('Annulez votre abonnement gratuit à tout moment')}}</li>
                                    <li class="" style="font-size: 14px;">@include('elements.icon',['icon'=>'checkmark-sharp','centered'=>false, 'classes' => 'mr-2 text-muted', 'variant'=>'medium'])  {{__('Direct messages and access comments on public posts')}}</li>
                                </ul>
                            </p>
                        @endif
                        
                        <style>
                            .btn-follow{
                                background: transparent;
                                border: 1px solid #54B3F3;
                                border-radius: 24px;
                                font-weight: 600;
                                font-size: 12px;
                                color: #28A0F0;
                                letter-spacing: -0.28px;
                                text-align: center;
                                margin-left: 6px;
                                height: 36px;
                                padding: 0px 14px;
                                width: 100%;
                            }
                           
                        </style>
                        @if (Auth::check())
                            @if ( $user->paid_profile &&  (!getSetting('profiles.allow_users_enabling_open_profiles') || (getSetting('profiles.allow_users_enabling_open_profiles') && !$user->open_profile)))
                                <div class="liste_abonnements">
                                @include('elements.checkout.subscribe-button-30')
                                {{-- @if (
                                    $user->profile_access_price_6_months ||
                                        $user->profile_access_price_12_months ||
                                        $user->profile_access_price_3_months)
                                    <div class="makewhite">
                                        @if ($user->profile_access_price_3_months)
                                            @include('elements.checkout.subscribe-button-90')
                                        @endif

                                        @if ($user->profile_access_price_6_months)
                                            @include('elements.checkout.subscribe-button-182')
                                        @endif

                                        @if ($user->profile_access_price_12_months)
                                            @include('elements.checkout.subscribe-button-365')
                                        @endif

                                    </div>
                                @endif --}}
                                </div>
                            @else
                                <button class="btn-follow" onclick="Lists.manageFollowsAction('{{ $user->id }}')">
                                    {{ __('Suivre gratuitement') }}
                                </button>
                            @endif
                        @endif
                        
                  </div>
                {{-- <div class=" d-md-block">
                    <div class=" justify-content-center card-wrapper">
                        @include('elements.vertical-member-card',['profile' => $user])
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
