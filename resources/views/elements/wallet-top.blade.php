    <div class="d-flex">
        <div class="aff_gauche" style="padding: 0">
            <div class="wallet-desktop {{ in_array( url()->current(), [
                url('/my/lists') ,
                url('/feed'),
                url('/my/settings/wallet'),
                ])   ? 'wallet-desktop--with-button' : '' }}">
                @php
                    $currencySymbol = \App\Providers\SettingsServiceProvider::getWebsiteCurrencySymbol();
                    $minChargeWallet = \App\Providers\PaymentsServiceProvider::getDepositMinimumAmount();
                    $suggsChargeWallet = [ $minChargeWallet , 25 , 50 ,100  , 500]
                @endphp
                <div class="dropdown dropleft">
                    <div  style=" color: #28A0F0; "class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Solde disponible') }} : {{ number_format(Auth::user()->wallet->total, 2, '.', '') }}
                        {{ $currencySymbol }}
                    </div>
                    <div class="dropdown-menu" style="width: 300px !important;" aria-labelledby="dropdownMenuLink" style="width: 300px !important;" >
                        <ul  class="list-group list-group-flush ">
                            @foreach ($suggsChargeWallet as $amount)
                                <li onclick='location.href = "{{ url("/my/settings/wallet?chargeAmount=$amount")}}";' style="background-color: #fff0;  1px solid rgba(0,0,0,.125);" class="list-group-item d-flex justify-content-between align-items-center">{{$currencySymbol}}{{ $amount   }} wallet banlance  <span style="font-size: 15px;padding:6px 9px 2px 9px;" class="badge badge-primary">{{$currencySymbol}}{{ $amount  }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="aff_droite" style="padding: 0"></div>
    </div>
    <style>
        .wallet-desktop{
            display: flex;
            justify-content: end;
            margin-bottom: -110px;
            padding: 43px 0;
        }
        .wallet-desktop--with-button {
            padding-right: 95px;
        } 
        
        
    </style>
    @if(in_array( url()->current(), [
        url('/my/lists') ,
        url('/feed'),
        url('/my/settings/wallet'),
        ]))
        <style>
            .wallet-desktop--with-button {
                padding-right: 60px;
            }
            
            </style>
    @endif
    


