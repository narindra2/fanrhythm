@extends('layouts.user-no-nav')

@section('page_title', __(":username post",['username'=>$post->user->name]))

@section('styles')
{!!
Minify::stylesheet([
'/css/posts/post.css',
'/libs/swiper/swiper-bundle.min.css',
'/libs/photoswipe/dist/photoswipe.css',
'/css/pages/checkout.css',
'/libs/photoswipe/dist/default-skin/default-skin.css',
])->withFullUrl()
!!}
@stop

@section('scripts')
{!!
Minify::javascript([
'/libs/swiper/swiper-bundle.min.js',
'/js/PostsPaginator.js',
'/js/CommentsPaginator.js',
'/js/Post.js',
'/js/pages/lists.js',
'/js/pages/checkout.js',
'/js/plugins/media/photoswipe.js',
'/libs/@joeattardi/emoji-button/dist/index.js',
'/libs/photoswipe/dist/photoswipe-ui-default.min.js',
'/js/plugins/media/mediaswipe.js',
'/js/plugins/media/mediaswipe-loader.js',
'/js/posts/view.js',
])->withFullUrl()
!!}
@stop

@section('content')

<div id="aff_content">
    <div class="aff_gauche">

        <p class="aff_title_feed">
            <a href="{{route('profile',['username'=>$post->user->username])}}">
                <svg width="7px" height="12px" viewBox="0 0 7 12" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                        stroke-linejoin="round">
                        <g id="Abonnés" transform="translate(-541.000000, -54.000000)" stroke="#000000"
                            stroke-width="2">
                            <polyline id="Path"
                                transform="translate(544.500000, 60.000000) scale(-1, 1) translate(-544.500000, -60.000000) "
                                points="542 65 547 60 542 55"></polyline>
                        </g>
                    </g>
                </svg>
                {{__('Retour')}}
            </a>

        </p>

        <div class=" feed-box posts-wrapper">
@include('elements.message-alert',['classes'=>'pt-0 pb-4 px-2'])
        @include('elements.feed.post-box')
        </div>
        
    </div>
</div>

@include('elements.photoswipe-container')
@include('elements.feed.post-delete-dialog')
@include('elements.checkout.checkout-box')

@include('elements.standard-dialog',[
'dialogName' => 'comment-delete-dialog',
'title' => __('Delete comment'),
'content' => __('Are you sure you want to delete this comment?'),
'actionLabel' => __('Delete'),
'actionFunction' => 'Post.deleteComment();',
])

@stop
