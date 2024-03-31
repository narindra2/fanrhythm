@extends('layouts.user-no-nav')
@section('page_title', __('Your feed'))

{{-- Page specific CSS --}}
@section('styles')
{!!
Minify::stylesheet([
'/libs/swiper/swiper-bundle.min.css',
'/libs/photoswipe/dist/photoswipe.css',
'/css/pages/checkout.css',
'/libs/photoswipe/dist/default-skin/default-skin.css',
'/css/pages/feed.css',
'/css/posts/post.css',
'/css/pages/search.css',
])->withFullUrl()
!!}
@stop

{{-- Page specific JS --}}
@section('scripts')
{!!
Minify::javascript([
'/js/PostsPaginator.js',
'/js/CommentsPaginator.js',
'/js/Post.js',
'/js/SuggestionsSlider.js',
'/js/pages/lists.js',
'/js/pages/feed.js',
'/js/pages/checkout.js',
'/libs/swiper/swiper-bundle.min.js',
'/js/plugins/media/photoswipe.js',
'/libs/photoswipe/dist/photoswipe-ui-default.min.js',
'/libs/@joeattardi/emoji-button/dist/index.js',
'/js/plugins/media/mediaswipe.js',
'/js/plugins/media/mediaswipe-loader.js',
])->withFullUrl()
!!}
@stop

@section('content')


<div id="aff_content">
    <!-- Gauche -->
    <div class="aff_gauche">

        <p class="aff_title_feed">
        {{__('Fil')}}
        </p>

            <div id="aff_search_mobile">
                @include('elements.search-box')
            </div>

            @if(!getSetting('feed.hide_suggestions_slider'))
            <div id="aff_suggestion_mobile">
                @include('elements.feed.suggestions-box',['profiles'=>$suggestions, 'isMobile'=> true])
            </div>
            @endif

            {{-- @include('elements.user-stories-box')--}}

            <div class="">
                @include('elements.message-alert',['classes'=>'mb-4'])
                @include('elements.feed.posts-load-more')
                <div class="feed-box posts-wrapper">
                    @include('elements.feed.posts-wrapper',['posts'=>$posts])
                </div>
                @include('elements.feed.posts-loading-spinner')



                {{-- @foreach ($postsForUser231 as $post)

                <div class="aff_post_block post-box" data-postid="325">
                    <div class="aff_header_post">
                        <a href="https://web.fanrhythm.com/{{ $post->username }}">

                            <img src="storage/{{$post->avatar}}">
                            <div class="aff_info_name">
                                <div>
                                    <span>
                                        Communication Fanrhythm 
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        <span>@</span>{{ $post->username }}
                                    </span>
                                </div>
                            </div>
                        </a>

                        <div>


                            <a class="aff_post_date" href="https://web.fanrhythm.com/posts/{{ $post->id }}/{{ $post->username }}"> {{ $post->created_at}}
                            </a>

                            <div class="dropdown dropleft">
                                
                            </div>
                        </div>

                    </div>


                    <div class="aff_post_text">
                        {!! nl2br(e($post->text)) !!}
                    </div>


                    <div class="post-media">
                        <div class="aff_empty_post_wrap">
                        @if ($post->attachment_id)
                            @php
                                $extension = strtolower(pathinfo($post->attachment_filename, PATHINFO_EXTENSION));
                            @endphp

                            @if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif']))
                                <img src="{{ asset('storage/' . $post->attachment_filename) }}" alt="Image du post" class="img-fluid">
                            @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'wmv']))
                               
                            @endif
                        @endif

                        </div>
                    </div>
                    <div class="post-footer aff_footer_post">
                        <div>
                            <div>

                                <div>
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

                                <div class="send-a-tip disabled">

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
                            </div>


                            <div>
                                <a href="https://web.fanrhythm.com/posts/{{ $post->id }}/{{ $post->username }}">
                                    <span>0</span>
                                    j'aime
                                </a>


                                <a href="https://web.fanrhythm.com/posts/{{ $post->id }}/{{ $post->username }}">
                                    <span>
                                        0
                                    </span>
                                    commentaire
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                   
                    
                @endforeach --}}
                            
            </div>



    </div>
    <!-- Droite -->
    <div class="aff_droite">
         <!-- <div class="mb-4">
                @include('elements.search-box')
            </div> -->

            @if(!getSetting('feed.hide_suggestions_slider'))
            @include('elements.feed.suggestions-box',['profiles'=>$suggestions, 'isMobile'=> false])
            @endif
            @if(getSetting('custom-code-ads.sidebar_ad_spot'))
            <div class="mt-4">
                {!! getSetting('custom-code-ads.sidebar_ad_spot') !!}
            </div>
            @endif
    </div>

    @include('elements.checkout.checkout-box')

</div>



@include('elements.standard-dialog',[
'dialogName' => 'comment-delete-dialog',
'title' => __('Delete comment'),
'content' => __('Are you sure you want to delete this comment?'),
'actionLabel' => __('Delete'),
'actionFunction' => 'Post.deleteComment();',
])

@stop
