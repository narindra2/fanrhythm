@extends('layouts.user-no-nav')

@section('page_title', __('Discover'))
@section('share_url', route('home'))
@section('share_title', getSetting('site.name') . ' - ' . getSetting('site.slogan'))
@section('share_description', getSetting('site.description'))
@section('share_type', 'article')
@section('share_img', GenericHelper::getOGMetaImage())

@section('meta')
<meta name="robots" content="noindex">
@stop

@section('scripts')
    {!!
Minify::javascript([
'/js/PostsPaginator.js',
'/js/UsersPaginator.js',
'/js/StreamsPaginator.js',
'/js/CommentsPaginator.js',
'/js/Post.js',
'/js/SuggestionsSlider.js',
'/js/pages/lists.js',
'/js/pages/checkout.js',
'/libs/swiper/swiper-bundle.min.js',
'/js/plugins/media/photoswipe.js',
'/libs/photoswipe/dist/photoswipe-ui-default.min.js',
'/libs/@joeattardi/emoji-button/dist/index.js',
'/js/plugins/media/mediaswipe.js',
'/js/plugins/media/mediaswipe-loader.js',
'/js/pages/search.js',
])->withFullUrl()
!!}
</script>
@stop

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

@section('content')

<div id="aff_content">
    <div class="aff_gauche">
        <div id="header-fp" >
            <p class="aff_title_feed">
                {{__('Rechercher')}}
            </p>
    
            <div id="aff_search">
                @include('elements.search-box')
    
                @if($activeFilter == 'people')
                <span class="search-back-button" data-toggle="collapse" href="#colappsableFilters" role="button"
                    aria-expanded="false" aria-controls="colappsableFilters">
    
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-sliders">
                        <line x1="4" y1="21" x2="4" y2="14"></line>
                        <line x1="4" y1="10" x2="4" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12" y2="3"></line>
                        <line x1="20" y1="21" x2="20" y2="16"></line>
                        <line x1="20" y1="12" x2="20" y2="3"></line>
                        <line x1="1" y1="14" x2="7" y2="14"></line>
                        <line x1="9" y1="8" x2="15" y2="8"></line>
                        <line x1="17" y1="16" x2="23" y2="16"></line>
                    </svg>
                </span>
                @endif
            </div>
            @if($activeFilter == 'people'  )
            <div class="mobile-search-filter collapse {{$searchFilterExpanded ? 'show' : ''}}" id="colappsableFilters">
                @include('elements.search.search-filters')
            </div>
            @endif
    
            @php
            $currentFilter = request('filter'); // Obtient le filtre actuel à partir de l'URL
            @endphp
            {{-- Bug n'effache pas ce ligne --}}
            <div class="aff_profil_tab" style="display: none">
                <div>
                    <a class="{{ $currentFilter == 'live' ? 'active' : '' }}" href="/search?filter=live">
                        <div>
                            {{__('Live')}}
                        </div>
                    </a>
                </div>
    
                <div>
                    <a class="{{ $currentFilter == 'top' ? 'active' : '' }}" href="/search?filter=top">
                        <div>
                            {{__('Posts')}}
                        </div>
                    </a>
                </div>
    
                <div>
                    <a class="{{ $currentFilter == null ? 'active' : '' }}" href="/verified_user">
                        <div>
                            {{__('People')}}
                        </div>
                    </a>
                </div>
    
                <div >
                    <a class="{{ $currentFilter == 'photos' ? 'active' : '' }}" href="/search?filter=photos">
                        <div>
                            {{__('Photos')}}
                        </div>
                    </a>
                </div>
    
                <div>
                    <a class="{{ $currentFilter == 'videosPres' ? 'active' : '' }}" href="/search?filter=videosPres">
                        <div>
                            {{__('Videos')}}
                        </div>
                    </a>
                </div>
            </div>
            
        </div>
        {{-- fin Bug  --}}
        <div class="aff_profil_tab">
            <div>
                <a class="{{ $currentFilter == 'live' ? 'active' : '' }}" href="/search?filter=live">
                    <div>
                    {{__('Live')}}
                    </div>
                </a>
            </div>

            {{-- <div>
                <a class="{{ $currentFilter == 'top' ? 'active' : '' }}" href="/search?filter=top">
                    <div>
                    {{__('Posts')}}
                    </div>
                </a>
            </div> --}}
            <div>
                <a class="{{ $currentFilter == 'public' ? 'active' : '' }}" href="/search?filter=public">
                    <div>
                    {{__('Posts')}}
                    </div>
                </a>
            </div>

            <div>
                <a class="{{ $currentFilter == null ? 'active' : '' }}" href="/verified_user">
                    <div>
                    {{__('People')}}
                    </div>
                </a>
            </div>

            <div style="display: none">
                <a class="{{ $currentFilter == 'photos' ? 'active' : '' }}" href="/search?filter=photos">
                    <div>
                    {{__('Photos')}}
                    </div>
                </a>
            </div>

          
            <div>
                <a class="{{ $currentFilter == 'videosPres' ? 'active' : '' }}" href="/search?filter=videosPres">
                    <div>
                    {{__('Videos')}}
                    </div>
                </a>
            </div>

        </div>
        @include('elements.message-alert',['classes'=>'p-2'])

        @if(isset($posts))
            @include('elements.feed.posts-load-more')
            <div class="feed-box mt-0 pt-0 posts-wrapper">
                @include('elements.feed.posts-wrapper',['posts'=>$posts])
            </div>
            @include('elements.feed.posts-loading-spinner')
        @endif
        @if(isset($postsPublic))
            @include('elements.feed.posts-load-more')
                <div class="feed-box mt-0 pt-0 ">
                    <div class="row posts-wrapper ">
                        @foreach ($postsPublic as $post)
                            @include('elements.feed.posts-public',['post'=> $post])
                        @endforeach
                    </div>
                </div>
            @include('elements.feed.posts-loading-spinner')
        @endif

        @if(isset($users))
            <div class="aff_search_result_user users-box users-wrapper">
                @include('elements.search.users-wrapper',['posts'=>$users])
            </div>
            @include('elements.feed.posts-loading-spinner')
        @endif

        @if(isset($streams))
            <div class="streams-box streams-wrapper aff_search_result_user users-box users-wrappe">
                @include('elements.search.streams-wrapper',['streams'=>$streams])
            </div>
            @include('elements.feed.posts-loading-spinner')
        @endif

        @if(isset($demoposts))
            @include('elements.feed.posts-load-more')
            <div class="feed-box mt-0 pt-0 posts-wrapper">
                @include('elements.search.demoposts-wrapper',['demoposts'=>$demoposts])
            </div>
            @include('elements.feed.posts-loading-spinner')
        @endif
    </div>
    <div class="aff_droite">
        @if (Auth::check())
            @include('elements.feed.suggestions-box',['profiles'=>$suggestions,'isMobile' => false])
            @if(getSetting('custom-code-ads.sidebar_ad_spot'))
                <div class="mt-4">
                    {!! getSetting('custom-code-ads.sidebar_ad_spot') !!}
                </div>
            @endif
            @include('elements.checkout.checkout-box')
        @endif
    </div>
</div>
@include('template.searchmobile')
@stop