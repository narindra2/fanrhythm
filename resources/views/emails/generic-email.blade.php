@component('mail::layout')
{{-- Header --}}
@slot('header')
    @if($showEmailHeader)
    @component('mail::header', ['url' => config('app.url')])
        <!-- header here -->
        <img src="{{asset('/img/logo.webp')}}" class="mail-logo" width="250">
    @endcomponent
    @endif
@endslot

# {{$mailTitle}}
{{$mailContent}}
@if($mailQuote)
    <blockquote>
        {{$mailQuote}}
    </blockquote>
@endif
@if(count($button))
@component('mail::button', ['url' => $button['url'], 'color' => '#28a0f0'])
    <span style="color: white;">{{$button['text']}}</span>
@endcomponent
@endif

{{__('Thanks')}},<br>
{{ getSetting('emails.from_name') }}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{getSetting('site.name')}}. {{__('All rights reserved.')}}
    @endcomponent
@endslot
@endcomponent
