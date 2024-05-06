<div id="aff_mobile_nav">

<a href="{{Auth::check() ? route('feed') : route('home')}}"
            class="{{Route::currentRouteName() == 'feed' ? 'active' : ''}}">

           
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        </a>
        @if(Auth::check())
        {{-- <a href="{{route('my.notifications')}}"
            class="{{Route::currentRouteName() == 'my.notifications' ? 'active' : ''}}">
            

<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>

            <div
                        class="{{(isset($notificationsCountOverride) && $notificationsCountOverride->total > 0 ) || (NotificationsHelper::getUnreadNotifications()->total > 0) ? '' : 'd-none'}}">
                        {{!isset($notificationsCountOverride) ? NotificationsHelper::getUnreadNotifications()->total : $notificationsCountOverride->total}}
                    </div>

        </a> --}}
        <a href="{{route('search.get')}}"
            class="{{Route::currentRouteName() == 'search.get' ? 'active' : ''}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
              </svg>
        </a>
        @if(!getSetting('site.hide_create_post_menu'))
        @if(GenericHelper::isEmailEnforcedAndValidated())
        <a href="{{route('posts.create')}}"
            class="{{Route::currentRouteName() == 'posts.create' ? 'active' : ''}}">
           
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
        </a>
        @endif
        @endif
        <a href="{{route('my.messenger.get')}}"
            class="{{Route::currentRouteName() == 'my.messenger.get' ? 'active' : ''}}">
            
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
            <div
                        class=" {{(NotificationsHelper::getUnreadMessages() > 0) ? '' : 'd-none'}}">
                        {{NotificationsHelper::getUnreadMessages()}}
                    </div>

        </a>
        @endif
        <a href="javascript:void(0)"
            class="open-menu">
           
            @if(Auth::check())
                <img src="{{Auth::user()->avatar}}" class="rounded-circle user-avatar w-32">
                {!! Auth::user()->getUserStatusHtml() !!}
              @else
                @include('elements.icon',['icon'=>'person-circle','variant'=>'large'])
            @endif

        </a>

        
</div>
