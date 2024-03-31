    <div class="d-flex">
        <div class="aff_gauche" style="padding: 0">
            <div class="wallet-desktop {{ in_array( url()->current(), [
                url('/my/lists') ,
                url('/feed'),
                url('/my/settings/wallet'),
                ])   ? 'wallet-desktop--with-button' : '' }}">
                <div style=" color: #28A0F0;">
                    {{ __('Solde disponible') }} : {{ number_format(Auth::user()->wallet->total, 2, '.', '') }}
                    {{ \App\Providers\SettingsServiceProvider::getWebsiteCurrencySymbol() }}
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
    


