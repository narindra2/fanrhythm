@extends('layouts.user-no-nav')
@section('page_title', __('New post'))

@section('styles')
    {!! Minify::stylesheet(['/css/posts/post.css', '/libs/dropzone/dist/dropzone.css'])->withFullUrl() !!}
@stop

@section('scripts')
    {!! Minify::javascript([
        '/js/Post.js',
        '/js/posts/create-helper.js',
        '/js/suggestions.js',
        Route::currentRouteName() == 'posts.create' ? '/js/posts/create.js' : '/js/posts/edit.js',
        '/libs/dropzone/dist/dropzone.js',
        '/js/FileUpload.js',
    ])->withFullUrl() !!}
@stop

@section('content')
    <div id="aff_content">
        <div class="aff_gauche">
            @include('elements.uploaded-file-preview-template')
            @include('elements.post-price-setup', ['postPrice' => isset($post) ? $post->price : 0])
            @if (!isset($post) || (isset($post) && $post->is_public)  )
                @include('elements.post-public-modal-info', ['countPostPublic' => isset($countPostPublic) ? $countPostPublic : 0 , "maxPostPublic" => $maxPostPublic])
            @endif
            @include('elements.attachments-uploading-dialog')
            <p class="aff_title_feed">
                {{ Route::currentRouteName() == 'posts.create' ? __('Créer une publication') : __('Modifier ma publication') }}
            </p>
            @if (!PostsHelper::getDefaultPostStatus(Auth::id()))
                <div class="pl-3 pr-3 pt-3">
                    @include('elements.pending-posts-warning-box')
                </div>
            @endif
            <div class="aff_create_post">

                <div id="aff_user">
                    @if (Auth::check())
                        <img src="{{ Auth::user()->avatar }}" class="rounded-circle user-avatar">
                    @else
                        @include('elements.icon', [
                            'icon' => 'person-circle',
                            'variant' => 'xlarge text-muted',
                        ])
                    @endif
                    @if (Auth::check())
                        <div>
                            <div>
                                {{ Auth::user()->name }}
                            </div>
                            <div>
                                @if (getSetting('profiles.enable_new_post_notification_setting'))
                                    <div class="aff_not">
                                        <span data-toggle="tooltip" data-placement="bottom"
                                            title="{{ __('If enabled, your followers will receive an email notification.') }}"
                                            class="post-notification-button {{ !GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? 'disabled' : '' }}"
                                            onclick="{{ !GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? '' : 'PostCreate.togglePostNotifications()' }}">

                                            <span class="d-none d-md-block">{{ __('Notifier les utilisateurs') }}</span>
                                            <span class="d-block d-md-none">{{ __('Notifiers') }}</span>
                                            <div class="post-notification-icon">
                                                @include('elements.icon', [
                                                    'icon' => 'notifications-off-outline',
                                                    'variant' => 'medium',
                                                    'centered' => true,
                                                    'classes' => 'mr-1',
                                                ])
                                            </div>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>


                @if (!GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks'))
                    <div class="alert alert-warning text-white font-weight-bold mt-2 mb-0" role="alert">
                        {{ __('Before being able to publish an item, you need to complete your') }} <a class="text-white"
                            href="{{ route('my.settings', ['type' => 'verify']) }}">{{ __('profile verification') }}</a>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                            <svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    opacity="0.352515811" stroke-linecap="round" stroke-linejoin="round">
                                    <g id="8---Fil-d'actualité---Pourboire" transform="translate(-1101.000000, -248.000000)"
                                        stroke="#000000">
                                        <g id="Group-3" transform="translate(534.000000, 222.000000)">
                                            <g id="x-(4)" transform="translate(568.000000, 27.000000)">
                                                <line x1="12" y1="0" x2="0" y2="12"
                                                    id="Path"></line>
                                                <line x1="0" y1="0" x2="12" y2="12"
                                                    id="Path"></line>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </div>
                @endif
                <div>
                    <div class="dropzone-previews dropzone w-100 p-0"></div>
                    <div class="progress" style="width:0%;height:3px;background-color:#2e8dcd" id="#progress-bar">
                        <div class="progress-bar progress-bar-primary" role="progressbar" data-dz-uploadprogress>
                            <span id="#progress-text" class="progress-text"></span>
                        </div>
                    </div>
                    <span class="text-danger d-none " style="font-size: 14px;"  id="attachementBreackModerationRulesMessage">{{ __('Le fichier que vous avez sélectionné ne respecte pas nos normes de modération et ne peut pas être téléchargé') }}</span>
                    <div id="aff_create_adds">
                        <div>
                            {{ __('Créer un post du type') }} ...
                        </div>

                        <div>

                            <span class=" file-upload-button {{ (isset($post) && $post->is_public) ? 'd-none' : '' }} {{ !GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? 'disabled' : '' }}">
                               
                                <svg width="18px" height="17px" viewBox="0 0 18 17" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Message---Discussion" transform="translate(-1293.000000, -884.000000)"
                                            stroke="#28A0F0" stroke-width="2">
                                            <g id="image" transform="translate(1294.000000, 885.000000)">
                                                <rect id="Rectangle" x="0" y="0" width="15.8333333" height="15"
                                                    rx="2">
                                                </rect>
                                                <ellipse id="Oval" cx="4.83796296" cy="4.58333333" rx="1.31944444"
                                                    ry="1.25"></ellipse>
                                                <polyline id="Path"
                                                    points="15.8333333 10 11.4351852 5.83333333 1.75925926 15"></polyline>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span class="">{{ __('Souscription') }}</span>
                            </span>
                            <span
                                class="post-price-button  {{ (isset($post) && $post->is_public) ? 'd-none' : '' }} {{ !GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? 'disabled' : '' }}"
                                onclick="{{ !GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks') ? '' : 'PostCreate.showSetPricePostDialog()' }}">
                                <svg width="18px" height="17px" viewBox="0 0 18 17" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Message---Discussion" transform="translate(-1339.000000, -899.000000)"
                                            stroke="#28A0F0" stroke-width="2">
                                            <g id="shopping-cart-(1)" transform="translate(1340.000000, 900.000000)">
                                                <circle id="Oval" cx="5.71428571" cy="14.2857143" r="1"></circle>
                                                <circle id="Oval" cx="13.5714286" cy="14.2857143" r="1"></circle>
                                                <path
                                                    d="M0,0 L2.85714286,0 L4.77142857,9.56428571 C4.90624069,10.2430225 5.50813138,10.7275445 6.2,10.7142857 L13.1428571,10.7142857 C13.8347258,10.7275445 14.4366165,10.2430225 14.5714286,9.56428571 L15.7142857,3.57142857 L3.57142857,3.57142857"
                                                    id="Path"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>

                                <span class="d-none d-md-block">{{ __('Ajouter prix') }}</span>
                                <span class="d-block d-md-none">{{ __('Prix') }}</span>
                                <span
                                    class="post-price-label ml-1">{{ (isset($post) && $post) > 0 ? '(' . config('app.site.currency_symbol') . "$post->price" . (config('app.site.currency_symbol') ? '' : config('app.site.currency_code')) . ')' : '' }}</span>
                            </span>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @if (isset($post->id) ||  ($countPostPublic < $maxPostPublic ) )
                            <span class=" post-public" data-toggle="modal" data-target="#post-set-public" >
                                [
                                <svg style="margin-right: 10px; margin-left: 10px;" xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-globe-americas"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484q-.121.12-.242.234c-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z" />
                                </svg>
                                <span class="me-2">{{ __('Public') }}</span>
                                &nbsp; &nbsp;]
                            </span>
                            @endif
                           
                           
                        </div>
                        

                    </div>
                    <div class="w-100 mt-5">
                        <textarea id="dropzone-uploader" name="input-text" class="w-100" spellcheck="false"
                            placeholder="{{ __('Créer une nouvelle publication sur Fanrhythm ... ') }}"
                            value="{{ isset($post) ? $post->text : '' }}" oninput="autoGrow(this)"></textarea>
                        <span class="invalid-feedback" role="alert">
                            <strong
                                class="post-invalid-feedback">{{ __('Your post must contain more than 10 characters.') }}</strong>
                        </span>

                    </div>


                    @if (!GenericHelper::isUserVerified() && getSetting('site.enforce_user_identity_checks'))
                        <button class="btn btn-primary disabled mb-0"
                            id="addPostbtn">{{ __('Publier maintenant') }}</button>
                    @else
                        <button class="btn  btn-primary post-create-button"
                            id="addPostbtn">{{ __('Publier maintenant') }}</button>
                    @endif

                </div>
            </div>
        </div>
    </div>

@stop
