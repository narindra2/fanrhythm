@extends('layouts.user-no-nav')

@section('page_title', __('Bookmarks'))
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.3.0/dist/photoswipe.css">
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
                {{__('My bookmarks')}}
            </p>
           
            @php
                $currentFilter = request('filter'); // Obtient le filtre actuel à partir de l'URL
            @endphp
            
        </div>
        <div class="aff_profil_tab">
           
            <div >
                <a class="{{ $currentFilter == 'photos' ? 'active' : '' }}" href="{{url('/my/bookmarks/list?filter=all')}}">
                    <div>
                    {{__('All')}}
                    </div>
                </a>
            </div>

          
            <div>
                <a class="{{ $currentFilter == 'videosPres' ? 'active' : '' }}" href="{{url('/my/bookmarks/list?filter=mediaOnDemade')}}">
                    <div>
                    {{__('Videos')}}
                    </div>
                </a>
            </div>

        </div>
        <div class="justify-content-center align-items-center {{ Cookie::get('app_feed_prev_page') && PostsHelper::isComingFromPostPage(request()->session()->get('_previous')) ? 'mt-0' : 'mt-0' }}">
            @include('elements.message-alert',['classes'=>'p-2'])
            @if (in_array($activeFilter, ['mediaOnDemade', 'all']))
                <div class="feed-box mt-0 ">
                    @include('elements.feed.post-librairy', ['posts' => $posts])
                </div>
            @endif
        </div>
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