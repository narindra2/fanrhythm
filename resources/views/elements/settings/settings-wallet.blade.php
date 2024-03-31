{{-- Paypal and stripe actual buttons --}}

<div class="paymentOption paymentPP d-none">
    <form id="wallet-deposit" method="post" action="{{route('payment.initiatePayment')}}" >
        @csrf
        <input type="hidden" name="amount" id="wallet-deposit-amount" value="1">
        <input type="hidden" name="transaction_type" id="payment-type" value="">
        <input type="hidden" name="provider" id="provider" value="">
        <input type="hidden" name="manual_payment_files" id="manual-payment-files" value="">
        <input type="hidden" name="manual_payment_description" id="manual-payment-description" value="">

        <button class="payment-button" type="submit"></button>
    </form>
</div>

<div class="paymentOption ml-2 paymentStripe d-none">
    <button id="stripe-checkout-button">{{__('Checkout')}}</button>
</div>

{{-- Actual form --}}
<div>
    @include('elements/message-alert', ['classes' =>'mb-2'])

    <div class="aff_wallet_nav">
        <div>
            @foreach(\App\Providers\SettingsServiceProvider::allowWithdrawals(Auth::user()) ? ['deposit', 'withdraw'] : ['deposit'] as $tab)
                <a class="{{$activeTab == $tab ? 'active' : ''}}" href="{{route('my.settings',['type' => 'wallet', 'active' => $tab])}}">
                     {{__(ucfirst($tab))}}
                </a>
            @endforeach
        </div>
        {{-- <div>
            <div>
                {{__('Solde disponible')}}  
            </div>
            <div>
            {{number_format(Auth::user()->wallet->total, 2, '.', '')}} {{\App\Providers\SettingsServiceProvider::getWebsiteCurrencySymbol()}}
            </div>
        </div> --}}
    </div>

    <div class="aff_edit_info_form">
        <div class="aff_wallet_form">
            @if($activeTab != null && $activeTab === 'withdraw' && \App\Providers\SettingsServiceProvider::allowWithdrawals(Auth::user()))
                @include('elements/settings/settings-wallet-withdraw')
            @else
                @include('elements/settings/settings-wallet-deposit')
            @endif
        </div>
    </div>

</div>
