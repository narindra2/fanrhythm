@php
$Moderation = "\App\Model\Moderation";
@endphp

<div class="aff_post_block post-box" data-postid="{{$demopost->id}}"  >

    <div class="aff_header_post">
        <a href="{{route('profile',['username'=>$demopost->user->username])}}">
            <img src="{{$demopost->user->avatar}}">
            <div class="aff_info_name">
                <div>
                    <span>
                        {{$demopost->user->name}}
                    </span>
                </div>
                <div>
                    <span>
                        <span>@</span>{{$demopost->user->username}}
                    </span>
                </div>
            </div>
        </a>
        {{-- <div>
            @if(Auth::check() && $demopost->user_id === Auth::user()->id && $demopost->status == 0)
            <span class="aff_pending">
                {{__('En attente')}}
            </span>
            @endif
            @if(Auth::check() && $demopost->user_id === Auth::user()->id && $demopost->price > 0)
            <span class="aff_ppv">
                {{ucfirst(__("PPV"))}}
            </span>
            @endif

            <a class="aff_post_date" @if(!Auth::check()) onclick="goToRegister()" @else
                onclick="PostsPaginator.goToPostPageKeepingNav({{$demopost->id}},{{$demopost->postPage}},'{{route('posts.get',['post_id'=>$demopost->id,'username'=>$demopost->user->username])}}')"
                @endif href="javascript:void(0)">{{$demopost->created_at->diffForHumans(null,false,true)}}
            </a>
            <div @if(!Auth::check()) onclick="goToRegister()" @endif
                class="dropdown {{GenericHelper::getSiteDirection() == 'rtl' ? 'dropright' : 'dropleft'}}">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <svg width="5px" height="18px" viewBox="0 0 5 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="post" transform="translate(-584.000000, -24.000000)" fill="#9E9E9E" stroke="#9E9E9E"
                                stroke-width="2.5">
                                <g id="date" transform="translate(443.000000, 24.000000)">
                                    <g id="more-horizontal"
                                        transform="translate(143.000000, 9.000000) rotate(90.000000) translate(-143.000000, -9.000000) translate(136.000000, 8.000000)">
                                        <circle id="Oval" cx="7" cy="0.875" r="1"></circle>
                                        <circle id="Oval" cx="13.125" cy="0.875" r="1"></circle>
                                        <circle id="Oval" cx="0.875" cy="0.875" r="1"></circle>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
                <div class="dropdown-menu">

                    @if(Auth::check())

                    <a class="dropdown-item" href="javascript:void(0);"
                        onclick="Lists.showListManagementConfirmation('{{'unfollow'}}', {{$demopost->user->id}});">
                        {{__("Se désabonner")}}
                    </a>
                    <a class="dropdown-item" href="javascript:void(0);"
                        onclick="Lists.showListManagementConfirmation('{{'block'}}', {{$demopost->user->id}});">
                        {{__("Bloquer")}}
                    </a>
                    <a class="dropdown-item" href="javascript:void(0);"
                        onclick="Lists.showReportBox({{$demopost->user->id}},{{$demopost->id}});">
                        {{__("Signaler")}}
                    </a>
                    @if(Auth::check() && Auth::user()->id == $demopost->user->id)
                    <a class="dropdown-item" href="{{route('posts.edit',['post_id'=>$demopost->id])}}">
                        {{__("Modifier")}}
                    </a>
                    @if(!getSetting('compliance.minimum_posts_deletion_limit') ||
                    (getSetting('compliance.minimum_posts_deletion_limit') > 0 && count($demopost->user->posts)
                    > getSetting('compliance.minimum_posts_deletion_limit')))
                    <a class="dropdown-item" href="javascript:void(0);"
                        onclick="Post.confirmPostRemoval({{$demopost->id}});">
                        {{__("Supprimer")}}
                    </a>
                    @endif
                    @endif
                    @endif
                </div>
            </div>
        </div> --}}

    </div>
    {{-- @if($demopost->moderationStatus == $Moderation::STATUS_DECLINED)
    <div class="aff_post_text">
        <span class="text-danger "> * {{ __("Ce post ne respecte pas nos normes de modération et ne peut pas être
            publié") }}</span>
    </div>
    @endif --}}
    {{-- @if($demopost->moderationStatus == $Moderation::STATUS_PENDING )
    <div class="aff_post_text">
        <span class="text-danger "> * {{ __("En attent de validation contenue média") }}</span>
    </div>
    @endif --}}

    {{-- @if (isset($demopost->text))
    <div class="aff_post_text">
        {!! nl2br(e($demopost->text)) !!}
    </div>
    @endif --}}


    @if(count($demopost->attachments))
    <div class="post-media">
        @if($demopost->isSubbed || (getSetting('profiles.allow_users_enabling_open_profiles') && $demopost->user->open_profile))
            @if(count($demopost->attachments) > 1)
                <div class="swiper-container mySwiper pointer-cursor">
                    <div class="swiper-wrapper">
                        @foreach($demopost->attachments as $attachment)
                        <div class="swiper-slide">
                            @include('elements.feed.post-box-media-wrapper',[
                            'attachment' => $attachment,
                            'isGallery' => true,
                            ])
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-button swiper-button-next p-pill-white">
                        @include('elements.icon',['icon'=>'chevron-forward-outline'])</div>
                    <div class="swiper-button swiper-button-prev p-pill-white">
                        @include('elements.icon',['icon'=>'chevron-back-outline'])</div>
                    <div class="swiper-pagination"></div>
                </div>
            @else
            @include('elements.feed.post-box-media-wrapper',[
            'attachment' => $demopost->attachments[0],
            'isGallery' => false,
            ])
        @endif
        @endif
        @else
        @include('elements.feed.post-locked',['type'=>'subscription',])
        @endif
    </div>
    @endif
    <div class="post-footer aff_footer_post">
        <div>
            <div>
                {{-- Likes --}}
                @if($demopost->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') &&  $demopost->user->open_profile))
                
                @else
                
                @endif

                @if(Auth::check() && $demopost->user->id != Auth::user()->id)
                
                @else
                {{-- <div class="send-a-tip disabled" data-toggle="tooltip" data-placement="top" title=""
                    data-original-title="{{ _('Abonnez-vous à moi') }}" --}}
                    
                @endif
                @endif
            </div>
        </div>
    </div>

   
</div>