@if (isset($post->text))
    <div class="aff_post_text">
    {!! nl2br(e($post->text)) !!}
    </div>
@endif

@if($notLockedPost && $post->price > 0)
    <button style="margin: 10px" class="btn btn-primary btn-block to-tooltip {{(!GenericHelper::creatorCanEarnMoney($post->user)) ? 'disabled' : ''}}"
        @if(Auth::check())
            @if(!GenericHelper::creatorCanEarnMoney($post->user))
                data-placement="top"
                title="{{__('This creator cannot earn money yet')}}"
            @else
                data-toggle="modal"
                data-target="#checkout-center"
                data-type="post-unlock"
                data-recipient-id="{{$post->user->id}}"
                data-amount="{{$post->price}}"
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
                data-post-id="{{$post->id}}"
            @endif
        @else
            data-toggle="modal"
            data-target="#login-dialog"
        @endif
    >
    {{__('Dévérouiller ce contenu pour')}} {{config('app.site.currency_symbol') ?? config('app.site.currency_symbol')}}{{$post->price}}{{config('app.site.currency_symbol') ? '' : ' ' .config('app.site.currency_code')}}</button>
@else
<div class="post-footer aff_footer_post" >
    <div>
        <div>
            {{-- Likes --}}
            {{-- @if($post->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') &&  $post->user->open_profile)) --}}
            {{-- All user can like => always true --}}
            @if(Auth::check())
            <div class="react-button btn-reaction-{{$post->id}} {{PostsHelper::didUserReact($post->reactions) ? 'active' : ''}}"
                data-toggle="tooltip" data-placement="top" title="{{__('Like')}}"
                onclick="Post.reactTo('post',{{$post->id}},true)">

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
            @if ($post->isSubbed)
                    @php
                        $isPostBookmarked = PostsHelper::isPostBookmarked($post->bookmarks);
                    @endphp
                    <div class="bookmark-button {{ $isPostBookmarked  ? 'active' : ''}} bookmark-button-{{ $post->id }}"
                        id="bookmark-button-{{ $post->id }}"  data-toggle="tooltip" data-placement="top" data-original-title="{{  $isPostBookmarked ? __("Remove from my bookmarks") : __('Add to my bookmarks')}}"
                        onclick="Post.addTobookmark({{$post->id}})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                       </svg>
    
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                                <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2"/>
                            </svg>
    
                    </div>
                @endif
            @else
            {{-- <div class="disabled" data-toggle="tooltip" data-placement="top" title=""
                data-original-title="{{ _('Abonnez-vous à moi') }}" --}} 
                <div class="disabled" 
                {{-- data-toggle="modal" data-target="#subrcribe-dialog" --}}
                    @if (!Auth::check() )
                        data-toggle="modal"
                        {{-- onclick="goToRegister()" --}}
                        data-target="#login-dialog"
                    @endif
                >
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
        </div>
        <div>
            <a href="#" class="">
                <span class="post-reactions-label-count-{{$post->id}}">{{count($post->reactions)}}</span>
                <span class="post-reactions-label-{{$post->id}}">{{trans_choice('likes', count($post->reactions))}}</span>
            </a>
        </div>
    </div>
</div>
@endif