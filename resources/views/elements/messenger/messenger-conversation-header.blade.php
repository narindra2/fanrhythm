<div class="conversation-header d-none">
    <div class="aff_top_header_message">
        <div>
            <div class="">
                <img class="conversation-header-avatar" src="{{asset('/img/no-avatar.png')}}" />
            </div>
            <a class="conversation-header-user text-truncate" href="#">

            </a>
        </div>
        <div>
            <div class="dropdown {{GenericHelper::getSiteDirection() == 'rtl' ? 'dropright' : 'dropleft'}}">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-more-vertical">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="12" cy="5" r="1"></circle>
                        <circle cx="12" cy="19" r="1"></circle>
                    </svg>
                </a>
                <div class="dropdown-menu">
                    <!-- Dropdown menu links -->
                    <a class="dropdown-item d-flex align-items-center tip-btn" data-toggle="modal"
                        data-target="#checkout-center" data-type="chat-tip"
                        data-first-name="{{Auth::user()->first_name}}" data-last-name="{{Auth::user()->last_name}}"
                        data-billing-address="{{Auth::user()->billing_address}}"
                        data-country="{{Auth::user()->country}}" data-city="{{Auth::user()->city}}"
                        data-state="{{Auth::user()->state}}" data-postcode="{{Auth::user()->postcode}}"
                        data-available-credit="{{Auth::user()->wallet->total}}">{{__('Send a tip')}}</a>
                    <a class="dropdown-item d-flex align-items-center conversation-profile-link" href="#"
                        target="_blank">{{__('Go to profile')}}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item unfollow-btn" href="javascript:void(0);">{{__('Unfollow')}}</a>
                    <a class="dropdown-item block-btn" href="javascript:void(0);">{{__('Block')}}</a>
                    <a class="dropdown-item report-btn" href="javascript:void(0);">{{__('Report')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
