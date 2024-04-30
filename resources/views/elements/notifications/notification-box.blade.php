<div class="notification-box aff_user_notif {{ !$notification->read ? 'unread' : '' }}">
    <div style="
        display: flex;
        align-items: center;
    ">

        @if ($notification->fromUser)
            <a href="{{ route('profile', ['username' => $notification->fromUser->username]) }}"> 
                <img src="{{ $notification->fromUser->avatar }}" alt="{{ $notification->fromUser->username }}"> 
            </a>
            {!! $notification->fromUser->getUserStatusHtml("40px" ,"35px ") !!}
        @else
            <a href="{{ route('profile', ['username' => $notification->fromUser->username]) }}"> <img
                    src="{{ \App\Providers\GenericHelperServiceProvider::getStorageAvatarPath(null) }}" alt="Avatar">
            </a>
        @endif

        <div>
            @if ($notification->fromUser)
                <div class="aff_info_name">
                    <div>
                        <span>
                            <a href="{{ route('profile', ['username' => $notification->fromUser->username]) }}">{{ $notification->fromUser->name }}</a>
                            <span>
                                @switch($notification->type)
                                    @case(\App\Model\Notification::NEW_TIP)
                                        {{ $notification->transaction->sender->name }} {{ __('sent you a tip of') }}
                                        {{ \App\Providers\PaymentsServiceProvider::getTransactionAmountWithTaxesDeducted($notification->transaction) }}
                                        {{ $notification->transaction->currency }}.
                                    @break

                                    @case(\App\Model\Notification::NEW_REACTION)
                                        @if ($notification->post_id)
                                            @php
                                                $detailUrl = route('posts.get', ['username' => $notification->post->user->username,'post_id' => $notification->post->id,]);
                                            @endphp
                                            {{ __('aime votre ', ['name' => $notification->fromUser->name]) }} 
                                            <a href="{{ $detailUrl }}">{{ __('post') }}</a>
                                        @endif
                                        @if ($notification->post_comment_id)
                                            {{ __('aime votre commentaire', ['name' => $notification->postComment->author->name]) }}
                                        @endif
                                    @break

                                    @case(\App\Model\Notification::NEW_COMMENT)
                                        {{ __('a ajouté un commentaire sur votre', ['name' => $notification->fromUser->name]) }}
                                        @php
                                         $detailUrl = route('posts.get', ['username' => $notification->postComment->post->user->username, 'post_id' => $notification->postComment->post->id]);
                                        @endphp
                                        <a href="{{  $detailUrl }}">{{ __('post') }}</a>
                                    @break

                                    @case(\App\Model\Notification::NEW_SUBSCRIPTION)
                                        @php
                                           $detailUrl = url("/my/settings/subscriptions");
                                        @endphp
                                        {{ __("Un nouvel utilisateur vient de s'abonner") }}
                                    @break

                                    @case(\App\Model\Notification::WITHDRAWAL_ACTION)
                                        {{ __('retrait en cours', [
                                            'currencySymbol' => \App\Providers\SettingsServiceProvider::getWebsiteCurrencySymbol(),
                                            'amount' => $notification->withdrawal->amount,
                                            'status' => $notification->withdrawal->status,
                                        ]) }}
                                    @break

                                    @case(\App\Model\Notification::NEW_MESSAGE)
                                    @php
                                        $detailUrl = route('my.messenger.get');
                                    @endphp
                                        {{ __('vous a envoyé un message', ['message' => $notification->userMessage->message]) }}
                                    @break

                                    @case(\App\Model\Notification::EXPIRING_STREAM)
                                        {{ __('Your live streaming is about to end in 30 minutes. You can start another one  afterwards.') }}
                                    @break
                                @endswitch
                            </span>
                        </span>
                    </div>
                    <div>
                        <span>
                            {{ \Carbon\Carbon::parse($notification->created_at)->diffForhumans(Carbon\Carbon::now()) }}
                        </span>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if (isset($detailUrl) && $detailUrl)
        <a href="{{ $detailUrl }}">
            <svg width="7px" height="12px" viewBox="0 0 7 12" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                stroke-linejoin="round">
                <g id="Page-de-notification" transform="translate(-1116.000000, -204.000000)" stroke="#8E8E8E"
                    stroke-width="2">
                    <g id="Group" transform="translate(532.000000, 185.000000)">
                        <polyline id="Path" points="585 30 590 25 585 20"></polyline>
                    </g>
                </g>
            </g>
        </svg>
        </a>
    @endif
</div>
