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
                <style>
                    .wallet-available{
                        display: block;
                        max-width: 400px;
                        border-radius: 6px;
                        padding:8px 12px 8px 12px;
                        overflow: hidden;
                        line-height: 1.4;
                        text-align: left;
                        background-color: rgba(0, 0, 0, 0.05);
                        border: 1px solid #8E8E8
                    }
                    
                </style>
                <div class="dropdown dropleft">
                    <div style="text-transform: none;font-weight: 500;font-size: 14px;padding:  9.5px;"  class="dropdown-toggle btn btn-primary    " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{-- <div> --}}
                            {{ __('Solde disponible') }} : {{ number_format(Auth::user()->wallet->total, 2, '.', '') }}
                            {{ $currencySymbol }}
                        {{-- </div> --}}
                     
                    </div>
                    
                    <div class="dropdown-menu" style="width: 300px !important;" aria-labelledby="dropdownMenuLink" style="width: 300px !important;" >
                        <ul  class="list-group list-group-flush ">
                            @foreach ($suggsChargeWallet as $amount)
                                <li onclick='location.href = "{{ url("/my/settings/wallet?chargeAmount=$amount")}}";' style="background-color: #fff0;  1px solid rgba(0,0,0,.125);" class="list-group-item d-flex justify-content-between align-items-center">{{$currencySymbol}}{{ $amount   }} wallet banlance  <span style="font-size: 15px;padding:6px 9px 4px 9px;" class="badge badge-primary">{{$currencySymbol}}{{ $amount  }}</span></li>
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
    


