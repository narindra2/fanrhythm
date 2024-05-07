<div class="aff_nav_mobile_top">
    <a href="/feed">
        <img src="{{asset('img/logo.webp')}}" style="height: 30px;width: auto; object-fit: contain;" alt="">
    </a>
    @if (Auth::check())
        <a href="{{route('my.notifications')}}"  class="{{Route::currentRouteName() == 'my.notifications' ? 'active' : ''}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
            <div class=" notification-bell {{(isset($notificationsCountOverride) && $notificationsCountOverride->total > 0 ) || (NotificationsHelper::getUnreadNotifications()->total > 0) ? '' : 'd-none'}}">
                {{!isset($notificationsCountOverride) ? NotificationsHelper::getUnreadNotifications()->total : $notificationsCountOverride->total}}
            </div>
        </a>
    @else
        <a href="/verified_user">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-search">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </a>
    @endif
</div>
<style>
    .notification-bell{
        flex-shrink: 0;
        justify-content: center;
        align-items: center;
        white-space: nowrap;
        text-align: center;
        vertical-align: baseline;
        border: 0.125rem solid var(--base-color);
        width: 1.3125rem;
        height: 1.3125rem;
        line-height: 1;
        font-size: .625rem;
        border-radius: 50%;
        background: #28A0F0;
        color: var(--base-color);
        font-weight: 700;
        right: 16px;
        margin-left: 10px;
        display: inline-flex;
        position: absolute;
        top: 7px;
    }
</style>

