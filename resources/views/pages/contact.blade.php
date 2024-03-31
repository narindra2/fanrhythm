@extends('layouts.generic')

@section('page_title', __('Contact us'))
@section('share_url', route('home'))
@section('share_title', getSetting('site.name') . ' - ' . getSetting('site.slogan'))
@section('share_description', getSetting('site.description'))
@section('share_type', 'article')
@section('share_img', GenericHelper::getOGMetaImage())

@if(getSetting('security.recaptcha_enabled'))
@section('meta')
{!! NoCaptcha::renderJs() !!}
@stop
@endif

@section('content')
<div id="affri_support" style="
    background-size: 40%;
    background-repeat: repeat;">
    <div class="container">
        <div class="row justify-content-end align-items-center">
            <div class="col-md-6">
                <img src="{{asset('/img/contact.webp')}}" class="img-fluid" />
            </div>
            <div class="col-md-6">
                <div>
                    <form class="well" role="form" method="post" action="{{route('contact.send')}}">
                        <div class="w-100">
                            <h3 class="h1s text-bold">{{__("Contact us")}}</h3>
                            <p class="mb-4">
                                {{__("Don't hesitate to contact us for any matter. We will get back to you asap.")}}</p>

                            @csrf
                            @if(session('success'))
                            <div class="alert alert-success text-white font-weight-bold mt-2" role="alert">
                                {{session('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="aff_edit_user _ip">
                                <div>
                                    <div>
                                        <div>
                                            <label for="">{{__("Email address")}}</label>
                                            <input type="email"
                                                class="title-form {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                value="{{ old('email') }}" name="email" placeholder=""
                                                autocomplete="email">
                                            @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$errors->first('email')}}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <div>
                                            <label for="#">
                                                {{__("Subject")}}
                                            </label>
                                            <input type="text"
                                                class="title-form {{ $errors->has('subject') ? 'is-invalid' : '' }}"
                                                value="{{ old('subject') }}" name="subject" placeholder="">
                                            @if($errors->has('subject'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$errors->first('subject')}}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <div style="height: 120px">
                                            <label for="">{{__("Message")}}</label>
                                            <textarea class="{{ $errors->has('message') ? 'is-invalid' : '' }}"
                                                name="message" placeholder="" rows="4">{{ old('message') }}</textarea>
                                            @if($errors->has('message'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$errors->first('message')}}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if(getSetting('security.recaptcha_enabled'))
                                    <div class=" captcha-field">
                                        {!! NoCaptcha::display(['data-theme' => (Cookie::get('app_theme') == null ?
                                        (getSetting('site.default_user_theme')) : Cookie::get('app_theme') )]) !!}
                                        {{--        {!! NoCaptcha::displaySubmit('register-form', 'submit now!', ['data-theme' => (Cookie::get('app_theme') == null ? (getSetting('site.default_user_theme')) : Cookie::get('app_theme') )]) !!}--}}
                                        @error('g-recaptcha-response')
                                        <span class="text-danger" role="alert">
                                            <strong>{{__("Please check the captcha field.")}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @endif

                                    <div>
                                        <button type="submit">{{__("Envoyer mon message")}}</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
