@extends('layouts.generic')

@section('page_title', __($page->title))
@section('share_url', route('home'))
@section('share_title', getSetting('site.name') . ' - ' . getSetting('site.slogan'))
@section('share_description', getSetting('site.description'))
@section('share_type', 'article')
@section('share_img', GenericHelper::getOGMetaImage())

@section('content')
<div class="top_main">
    <div class="container"> 
        <div class="row">
            <div class="col-md-12">
                <h1>
                    {{$page->title}}
                </h1>
                @if(in_array($page->slug,['help','privacy','terms-and-conditions']))
                <p>
                    Denière mise à jour {{$page->updated_at->format('d-m-Y')}}
                </p>
                @endif

            </div>
        </div>
    </div>
</div>

<div class="top_content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content_ui">
                     {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.content_ui p:first-child {
    color: #000;
    font-weight: 600;
}

.content_ui p {
    font-family: Poppins-Regular;
    font-size: 14px;
    color: var(--base-color);
    letter-spacing: -0.32px;
    line-height: 24px;
}

    .top_content{
        padding: 80px 0px;
    }
    .top_main {
        background: #28a0f0;
        padding: 80px 0px;
        color: #fff;
    }

    .top_main h1 {
        font-weight: 600;
        font-size: 36px;
        color: #fff;
        letter-spacing: -1.34px;
        line-height: 36px;
        width: 100%;
    }

    .top_main p {
        font-size: 14px;
        color: #fff;
        letter-spacing: -0.45px;
        line-height: 29px;
        margin-bottom: 0px;
    }

    div#nav_home {
        top: 0px;
        background: #fff;
        border-bottom: 1px solid var(--border-default);
        position: fixed !important;
        z-index: 1024;
        height: 80px;
    }

    .navbar-brand>svg {
        position: absolute;
        margin-top: 3px;
    }

    body {
        padding-top: 80px;
    }

</style>
@stop
