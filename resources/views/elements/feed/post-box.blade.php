@php
    $Moderation = "\App\Model\Moderation";
@endphp

<div class="aff_post_block post-box" data-postid="{{$post->id}}"

    @if ($post->moderationStatus == $Moderation::STATUS_PENDING )
        style ="opacity: 0.6;"
    @endif
    @if ($post->moderationStatus == $Moderation::STATUS_DECLINED )
        style ="opacity: 0.8;border: 1px red solid;"
    @endif
>

    <div class="aff_header_post">
        <a href="{{route('profile',['username'=>$post->user->username])}}">

            <img src="{{$post->user->avatar}}">
            <div class="aff_info_name">
                <div>
                    <span>
                        {{$post->user->name}}
                    </span>
                </div>
                <div>
                    <span>
                        <span>@</span>{{$post->user->username}}
                    </span>
                </div>
            </div>
        </a>

        <div>

            @if(Auth::check() && $post->user_id === Auth::user()->id && $post->status == 0)
            <span class="aff_pending">
                {{__('En attente')}}
            </span>
            @endif
            @if(Auth::check() && $post->user_id === Auth::user()->id && $post->price > 0)
            <span class="aff_ppv">
                {{ucfirst(__("PPV"))}}
            </span>
            @endif
 
            <a class="aff_post_date" 
                @if(!Auth::check()) 
                    onclick="goToRegister()"
                @else
                    onclick="PostsPaginator.goToPostPageKeepingNav({{$post->id}},{{$post->postPage}},'{{route('posts.get',['post_id'=>$post->id,'username'=>$post->user->username])}}')" 
                @endif 
                href="javascript:void(0)">{{$post->created_at->diffForHumans(null,false,true)}}
            </a>
            <div  @if(!Auth::check()) onclick="goToRegister()"   @endif class="dropdown {{GenericHelper::getSiteDirection() == 'rtl' ? 'dropright' : 'dropleft'}}">
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
                        onclick="Lists.showListManagementConfirmation('{{'unfollow'}}', {{$post->user->id}});">
                        {{__("Se désabonner")}}
                    </a>
                    <a class="dropdown-item" href="javascript:void(0);"
                        onclick="Lists.showListManagementConfirmation('{{'block'}}', {{$post->user->id}});">
                        {{__("Bloquer")}}
                    </a>
                    <a class="dropdown-item" href="javascript:void(0);"
                        onclick="Lists.showReportBox({{$post->user->id}},{{$post->id}});">
                        {{__("Signaler")}}
                    </a>
                    @if(Auth::check() && Auth::user()->id == $post->user->id)
                    <a class="dropdown-item"
                        href="{{route('posts.edit',['post_id'=>$post->id])}}">
                        {{__("Modifier")}}
                    </a>
                    @if(!getSetting('compliance.minimum_posts_deletion_limit') ||
                    (getSetting('compliance.minimum_posts_deletion_limit') > 0 && count($post->user->posts)
                    > getSetting('compliance.minimum_posts_deletion_limit')))
                    <a class="dropdown-item" href="javascript:void(0);"
                        onclick="Post.confirmPostRemoval({{$post->id}});">
                        {{__("Supprimer")}}
                    </a>
                    @endif
                    @endif
                    @endif
                </div>
            </div>
        </div>

    </div>
    @if($post->moderationStatus == $Moderation::STATUS_DECLINED)
        <div class="aff_post_text">
            <span  class="text-danger "  > * {{ __("Ce post ne respecte pas nos normes de modération et ne peut pas être publié") }}</span>
        </div>
    @endif
    @if($post->moderationStatus == $Moderation::STATUS_PENDING )
        <div class="aff_post_text">
            <span  class="text-danger "  > * {{ __("En attent de validation contenue média") }}</span>
        </div>
    @endif

    @if (isset($post->text))
    <div class="aff_post_text">
    {!! nl2br(e($post->text)) !!}
    </div>
    @endif


    @if(count($post->attachments))
    <div class="post-media">
        @if($post->isSubbed || (getSetting('profiles.allow_users_enabling_open_profiles') && $post->user->open_profile))
        @if((Auth::check() && Auth::user()->id !== $post->user_id && $post->price > 0 &&
        !PostsHelper::hasUserUnlockedPost($post->postPurchases)) || (!Auth::check() && $post->price > 0 ))
        @include('elements.feed.post-locked',['type'=>'post','post'=>$post])
        @else
        @if(count($post->attachments) > 1)
        <div class="swiper-container mySwiper pointer-cursor">
            <div class="swiper-wrapper">
                @foreach($post->attachments as $attachment)
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
        'attachment' => $post->attachments[0],
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
                @if($post->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') &&
                $post->user->open_profile))
                <div class="react-button {{PostsHelper::didUserReact($post->reactions) ? 'active' : ''}}"
                    data-toggle="tooltip" data-placement="top" title="{{__('Like')}}"
                    onclick="Post.reactTo('post',{{$post->id}})">

                    <svg width="21px" height="18px" viewBox="0 0 21 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="post" transform="translate(-16.000000, -785.000000)" stroke="#000000"
                                stroke-width="2">
                                <g id="coeur" transform="translate(17.000000, 786.000000)">
                                    <path
                                        d="M16.7073684,1.35578947 C15.8387165,0.486729657 14.6603268,-0.00153736522 13.4315789,-0.00153736522 C12.2028311,-0.00153736522 11.0244414,0.486729657 10.1557895,1.35578947 L9.26315789,2.24842105 L8.37052632,1.35578947 C6.56135774,-0.45337905 3.62811597,-0.453379028 1.81894742,1.35578952 C0.00977886632,3.16495807 0.00977884447,6.09819984 1.81894737,7.90736842 L2.71157895,8.8 L9.26315789,15.3515789 L15.8147368,8.8 L16.7073684,7.90736842 C17.5764282,7.03871646 18.0646953,5.86032676 18.0646953,4.63157895 C18.0646953,3.40283113 17.5764282,2.22444143 16.7073684,1.35578947 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>

                    <svg width="21px" height="18px" viewBox="0 0 21 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Group" transform="translate(-16.000000, -785.000000)" fill="#FA5454" stroke="#FA5454"
                                stroke-width="2">
                                <g id="coeur" transform="translate(17.000000, 786.000000)">
                                    <path
                                        d="M16.7073684,1.35578947 C15.8387165,0.486729657 14.6603268,-0.00153736522 13.4315789,-0.00153736522 C12.2028311,-0.00153736522 11.0244414,0.486729657 10.1557895,1.35578947 L9.26315789,2.24842105 L8.37052632,1.35578947 C6.56135774,-0.45337905 3.62811597,-0.453379028 1.81894742,1.35578952 C0.00977886632,3.16495807 0.00977884447,6.09819984 1.81894737,7.90736842 L2.71157895,8.8 L9.26315789,15.3515789 L15.8147368,8.8 L16.7073684,7.90736842 C17.5764282,7.03871646 18.0646953,5.86032676 18.0646953,4.63157895 C18.0646953,3.40283113 17.5764282,2.22444143 16.7073684,1.35578947 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                @else
                <div onclick="goToRegister()">
                    <svg width="21px" height="18px" viewBox="0 0 21 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="post" transform="translate(-16.000000, -785.000000)" stroke="#000000"
                                stroke-width="2">
                                <g id="coeur" transform="translate(17.000000, 786.000000)">
                                    <path
                                        d="M16.7073684,1.35578947 C15.8387165,0.486729657 14.6603268,-0.00153736522 13.4315789,-0.00153736522 C12.2028311,-0.00153736522 11.0244414,0.486729657 10.1557895,1.35578947 L9.26315789,2.24842105 L8.37052632,1.35578947 C6.56135774,-0.45337905 3.62811597,-0.453379028 1.81894742,1.35578952 C0.00977886632,3.16495807 0.00977884447,6.09819984 1.81894737,7.90736842 L2.71157895,8.8 L9.26315789,15.3515789 L15.8147368,8.8 L16.7073684,7.90736842 C17.5764282,7.03871646 18.0646953,5.86032676 18.0646953,4.63157895 C18.0646953,3.40283113 17.5764282,2.22444143 16.7073684,1.35578947 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                @endif

                @if(Auth::check() && $post->user->id != Auth::user()->id)
                @if($post->isSubbed || (getSetting('profiles.allow_users_enabling_open_profiles') &&
                $post->user->open_profile))
                <div class="send-a-tip to-tooltip poi {{(!GenericHelper::creatorCanEarnMoney($post->user)) ? 'disabled' : ''}}"
                    @if(!GenericHelper::creatorCanEarnMoney($post->user))
                    data-placement="top"
                    title="{{__('This creator cannot earn money yet')}}">
                    @else
                    data-toggle="modal"
                    data-target="#checkout-center"
                    data-post-id="{{$post->id}}"
                    data-type="tip"
                    data-first-name="{{Auth::user()->first_name}}"
                    data-last-name="{{Auth::user()->last_name}}"
                    data-billing-address="{{Auth::user()->billing_address}}"
                    data-country="{{Auth::user()->country}}"
                    data-city="{{Auth::user()->city}}"
                    data-state="{{Auth::user()->state}}"
                    data-postcode="{{Auth::user()->postcode}}"
                    data-available-credit="{{Auth::user()->wallet->total}}"
                    data-username="{{$post->user->username}}"
                    data-name="{{$post->user->name}}"
                    data-avatar="{{$post->user->avatar}}"
                    data-recipient-id="{{$post->user_id}}">
                    @endif
                    <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Group" transform="translate(-18.000000, -784.000000)" stroke="#000000"
                                stroke-width="2">
                                <g id="gift" transform="translate(19.000000, 785.000000)">
                                    <polyline id="Path" points="13.815 7.675 13.815 15.35 1.535 15.35 1.535 7.675">
                                    </polyline>
                                    <rect id="Rectangle" x="0" y="3.8375" width="15.35" height="3.8375"></rect>
                                    <line x1="7.675" y1="15.35" x2="7.675" y2="3.8375" id="Path"></line>
                                    <path
                                        d="M7.675,3.8375 L4.22125,3.8375 C3.16155364,3.8375 2.3025,2.97844636 2.3025,1.91875 C2.3025,0.859053636 3.16155364,0 4.22125,0 C6.9075,0 7.675,3.8375 7.675,3.8375 Z"
                                        id="Path"></path>
                                    <path
                                        d="M7.675,3.8375 L11.12875,3.8375 C12.1884464,3.8375 13.0475,2.97844636 13.0475,1.91875 C13.0475,0.859053636 12.1884464,0 11.12875,0 C8.4425,0 7.675,3.8375 7.675,3.8375 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                @else
                <div class="send-a-tip disabled" onclick="goToRegister()">

                    <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Group" transform="translate(-18.000000, -784.000000)" stroke="#000000"
                                stroke-width="2">
                                <g id="gift" transform="translate(19.000000, 785.000000)">
                                    <polyline id="Path" points="13.815 7.675 13.815 15.35 1.535 15.35 1.535 7.675">
                                    </polyline>
                                    <rect id="Rectangle" x="0" y="3.8375" width="15.35" height="3.8375"></rect>
                                    <line x1="7.675" y1="15.35" x2="7.675" y2="3.8375" id="Path"></line>
                                    <path
                                        d="M7.675,3.8375 L4.22125,3.8375 C3.16155364,3.8375 2.3025,2.97844636 2.3025,1.91875 C2.3025,0.859053636 3.16155364,0 4.22125,0 C6.9075,0 7.675,3.8375 7.675,3.8375 Z"
                                        id="Path"></path>
                                    <path
                                        d="M7.675,3.8375 L11.12875,3.8375 C12.1884464,3.8375 13.0475,2.97844636 13.0475,1.91875 C13.0475,0.859053636 12.1884464,0 11.12875,0 C8.4425,0 7.675,3.8375 7.675,3.8375 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
                @endif
                @endif
            </div>


            <div>
                <a href="#">
                    <span>{{count($post->reactions)}}</span>
                    {{trans_choice('likes', count($post->reactions))}}
                </a>

                @if($post->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') &&
                $post->user->open_profile))
                    <a
                        href="{{Route::currentRouteName() != 'posts.get' ? route('posts.get',['post_id'=>$post->id,'username'=>$post->user->username]) : '#comments'}}">
                        <span>
                            {{count($post->comments)}}
                        </span>
                        {{trans_choice('comments',  count($post->comments))}}
                    </a>
                @else
                    <a href="#" onclick="goToRegister()">
                        <span>
                            {{count($post->comments)}}
                        </span>
                        {{trans_choice('comments',  count($post->comments))}}
                        </span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    @if($post->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') &&
    $post->user->open_profile))
    <div class="post-comments d-none" {{Route::currentRouteName() == 'posts.get' ? 'id="comments"' : ''}}>
      
        <div class="post-comments-wrapper">
            <div class="comments-loading-box">
                @include('elements.preloading.messenger-contact-box',['limit'=>1])
            </div>
        </div>
        <div class="show-all-comments-label pl-3 d-none">
            @if(Route::currentRouteName() != 'posts.get')
            <a href="javascript:void(0)"
                onclick="PostsPaginator.goToPostPageKeepingNav({{$post->id}},{{$post->postPage}},'{{route('posts.get',['post_id'=>$post->id,'username'=>$post->user->username])}}')">{{__('Show more')}}</a>
            @else
            <a onClick="CommentsPaginator.loadResults({{$post->id}});"
                href="javascript:void(0);">{{__('Show more')}}</a>
            @endif
        </div>
       
        @if(Auth::check())
       
        @include('elements.feed.post-new-comment')
        @endif
    </div>
    @endif

</div>
