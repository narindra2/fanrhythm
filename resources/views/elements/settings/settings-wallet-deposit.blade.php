<p>
    {{__('Saisissez le montant de votre dépôt')}}
</p>

<div class="aff_edit_user aff_edit_user_checkout">
    <div class="row">
        <div class="col-12">
            <div>
                <label for="#">
                    {{__('Montant')}}
                </label>
                @php
                    $min = \App\Providers\PaymentsServiceProvider::getDepositMinimumAmount();
                    $max = \App\Providers\PaymentsServiceProvider::getDepositMaximumAmount();
                    $symb = getSetting('payments.currency_symbol');
                    @endphp
                <input placeholder='{{" Min $min $symb / Max $max $symb"}}'
                aria-label="{{__('Username')}}" aria-describedby="amount-label" value="{{ $min  }}" id="deposit-amount" type="number"
                min="{{ $min }}" step="5"
                max="{{ $max  }}">
               
            </div>
        </div>
    </div>
</div>
<div class="aff_edit_paiement_ui">
    <p>
    {{__('Mode de paiements')}}
    </p>
    <div class="payment-method virgo___">
        {{-- <div class="custom-control custom-radio mb-1">
            <input type="radio" id="customRadio9" name="payment-radio-option" class="custom-control-input"
                value="payment-digital-virgo">
                    <label   label class="custom-control-label stepTooltip" for="customRadio9" title="">
                    <img src="{{asset('/img/mp.svg')}}" alt="">

                                            <div>
                                                Powered by <img src="https://www.digitalvirgo.com/wp-content/uploads/2020/01/logo-digital-virgo-width-no-baseline.png"  alt="" loading="lazy">
                                            </div>
            </label>
        </div> --}}
        <div class="custom-control custom-radio mb-1">
            <input type="radio" id="customRadio9"  name="payment-radio-option" class="custom-control-input"
                value="payment-paypal">
                    <label   label class="custom-control-label stepTooltip" for="customRadio9" title="">
                            <img  src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAxcHgiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAxMDEgMzIiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaW5ZTWluIG1lZXQiIHhtbG5zPSJodHRwOiYjeDJGOyYjeDJGO3d3dy53My5vcmcmI3gyRjsyMDAwJiN4MkY7c3ZnIj48cGF0aCBmaWxsPSIjMDAzMDg3IiBkPSJNIDEyLjIzNyAyLjggTCA0LjQzNyAyLjggQyAzLjkzNyAyLjggMy40MzcgMy4yIDMuMzM3IDMuNyBMIDAuMjM3IDIzLjcgQyAwLjEzNyAyNC4xIDAuNDM3IDI0LjQgMC44MzcgMjQuNCBMIDQuNTM3IDI0LjQgQyA1LjAzNyAyNC40IDUuNTM3IDI0IDUuNjM3IDIzLjUgTCA2LjQzNyAxOC4xIEMgNi41MzcgMTcuNiA2LjkzNyAxNy4yIDcuNTM3IDE3LjIgTCAxMC4wMzcgMTcuMiBDIDE1LjEzNyAxNy4yIDE4LjEzNyAxNC43IDE4LjkzNyA5LjggQyAxOS4yMzcgNy43IDE4LjkzNyA2IDE3LjkzNyA0LjggQyAxNi44MzcgMy41IDE0LjgzNyAyLjggMTIuMjM3IDIuOCBaIE0gMTMuMTM3IDEwLjEgQyAxMi43MzcgMTIuOSAxMC41MzcgMTIuOSA4LjUzNyAxMi45IEwgNy4zMzcgMTIuOSBMIDguMTM3IDcuNyBDIDguMTM3IDcuNCA4LjQzNyA3LjIgOC43MzcgNy4yIEwgOS4yMzcgNy4yIEMgMTAuNjM3IDcuMiAxMS45MzcgNy4yIDEyLjYzNyA4IEMgMTMuMTM3IDguNCAxMy4zMzcgOS4xIDEzLjEzNyAxMC4xIFoiPjwvcGF0aD48cGF0aCBmaWxsPSIjMDAzMDg3IiBkPSJNIDM1LjQzNyAxMCBMIDMxLjczNyAxMCBDIDMxLjQzNyAxMCAzMS4xMzcgMTAuMiAzMS4xMzcgMTAuNSBMIDMwLjkzNyAxMS41IEwgMzAuNjM3IDExLjEgQyAyOS44MzcgOS45IDI4LjAzNyA5LjUgMjYuMjM3IDkuNSBDIDIyLjEzNyA5LjUgMTguNjM3IDEyLjYgMTcuOTM3IDE3IEMgMTcuNTM3IDE5LjIgMTguMDM3IDIxLjMgMTkuMzM3IDIyLjcgQyAyMC40MzcgMjQgMjIuMTM3IDI0LjYgMjQuMDM3IDI0LjYgQyAyNy4zMzcgMjQuNiAyOS4yMzcgMjIuNSAyOS4yMzcgMjIuNSBMIDI5LjAzNyAyMy41IEMgMjguOTM3IDIzLjkgMjkuMjM3IDI0LjMgMjkuNjM3IDI0LjMgTCAzMy4wMzcgMjQuMyBDIDMzLjUzNyAyNC4zIDM0LjAzNyAyMy45IDM0LjEzNyAyMy40IEwgMzYuMTM3IDEwLjYgQyAzNi4yMzcgMTAuNCAzNS44MzcgMTAgMzUuNDM3IDEwIFogTSAzMC4zMzcgMTcuMiBDIDI5LjkzNyAxOS4zIDI4LjMzNyAyMC44IDI2LjEzNyAyMC44IEMgMjUuMDM3IDIwLjggMjQuMjM3IDIwLjUgMjMuNjM3IDE5LjggQyAyMy4wMzcgMTkuMSAyMi44MzcgMTguMiAyMy4wMzcgMTcuMiBDIDIzLjMzNyAxNS4xIDI1LjEzNyAxMy42IDI3LjIzNyAxMy42IEMgMjguMzM3IDEzLjYgMjkuMTM3IDE0IDI5LjczNyAxNC42IEMgMzAuMjM3IDE1LjMgMzAuNDM3IDE2LjIgMzAuMzM3IDE3LjIgWiI+PC9wYXRoPjxwYXRoIGZpbGw9IiMwMDMwODciIGQ9Ik0gNTUuMzM3IDEwIEwgNTEuNjM3IDEwIEMgNTEuMjM3IDEwIDUwLjkzNyAxMC4yIDUwLjczNyAxMC41IEwgNDUuNTM3IDE4LjEgTCA0My4zMzcgMTAuOCBDIDQzLjIzNyAxMC4zIDQyLjczNyAxMCA0Mi4zMzcgMTAgTCAzOC42MzcgMTAgQyAzOC4yMzcgMTAgMzcuODM3IDEwLjQgMzguMDM3IDEwLjkgTCA0Mi4xMzcgMjMgTCAzOC4yMzcgMjguNCBDIDM3LjkzNyAyOC44IDM4LjIzNyAyOS40IDM4LjczNyAyOS40IEwgNDIuNDM3IDI5LjQgQyA0Mi44MzcgMjkuNCA0My4xMzcgMjkuMiA0My4zMzcgMjguOSBMIDU1LjgzNyAxMC45IEMgNTYuMTM3IDEwLjYgNTUuODM3IDEwIDU1LjMzNyAxMCBaIj48L3BhdGg+PHBhdGggZmlsbD0iIzAwOWNkZSIgZD0iTSA2Ny43MzcgMi44IEwgNTkuOTM3IDIuOCBDIDU5LjQzNyAyLjggNTguOTM3IDMuMiA1OC44MzcgMy43IEwgNTUuNzM3IDIzLjYgQyA1NS42MzcgMjQgNTUuOTM3IDI0LjMgNTYuMzM3IDI0LjMgTCA2MC4zMzcgMjQuMyBDIDYwLjczNyAyNC4zIDYxLjAzNyAyNCA2MS4wMzcgMjMuNyBMIDYxLjkzNyAxOCBDIDYyLjAzNyAxNy41IDYyLjQzNyAxNy4xIDYzLjAzNyAxNy4xIEwgNjUuNTM3IDE3LjEgQyA3MC42MzcgMTcuMSA3My42MzcgMTQuNiA3NC40MzcgOS43IEMgNzQuNzM3IDcuNiA3NC40MzcgNS45IDczLjQzNyA0LjcgQyA3Mi4yMzcgMy41IDcwLjMzNyAyLjggNjcuNzM3IDIuOCBaIE0gNjguNjM3IDEwLjEgQyA2OC4yMzcgMTIuOSA2Ni4wMzcgMTIuOSA2NC4wMzcgMTIuOSBMIDYyLjgzNyAxMi45IEwgNjMuNjM3IDcuNyBDIDYzLjYzNyA3LjQgNjMuOTM3IDcuMiA2NC4yMzcgNy4yIEwgNjQuNzM3IDcuMiBDIDY2LjEzNyA3LjIgNjcuNDM3IDcuMiA2OC4xMzcgOCBDIDY4LjYzNyA4LjQgNjguNzM3IDkuMSA2OC42MzcgMTAuMSBaIj48L3BhdGg+PHBhdGggZmlsbD0iIzAwOWNkZSIgZD0iTSA5MC45MzcgMTAgTCA4Ny4yMzcgMTAgQyA4Ni45MzcgMTAgODYuNjM3IDEwLjIgODYuNjM3IDEwLjUgTCA4Ni40MzcgMTEuNSBMIDg2LjEzNyAxMS4xIEMgODUuMzM3IDkuOSA4My41MzcgOS41IDgxLjczNyA5LjUgQyA3Ny42MzcgOS41IDc0LjEzNyAxMi42IDczLjQzNyAxNyBDIDczLjAzNyAxOS4yIDczLjUzNyAyMS4zIDc0LjgzNyAyMi43IEMgNzUuOTM3IDI0IDc3LjYzNyAyNC42IDc5LjUzNyAyNC42IEMgODIuODM3IDI0LjYgODQuNzM3IDIyLjUgODQuNzM3IDIyLjUgTCA4NC41MzcgMjMuNSBDIDg0LjQzNyAyMy45IDg0LjczNyAyNC4zIDg1LjEzNyAyNC4zIEwgODguNTM3IDI0LjMgQyA4OS4wMzcgMjQuMyA4OS41MzcgMjMuOSA4OS42MzcgMjMuNCBMIDkxLjYzNyAxMC42IEMgOTEuNjM3IDEwLjQgOTEuMzM3IDEwIDkwLjkzNyAxMCBaIE0gODUuNzM3IDE3LjIgQyA4NS4zMzcgMTkuMyA4My43MzcgMjAuOCA4MS41MzcgMjAuOCBDIDgwLjQzNyAyMC44IDc5LjYzNyAyMC41IDc5LjAzNyAxOS44IEMgNzguNDM3IDE5LjEgNzguMjM3IDE4LjIgNzguNDM3IDE3LjIgQyA3OC43MzcgMTUuMSA4MC41MzcgMTMuNiA4Mi42MzcgMTMuNiBDIDgzLjczNyAxMy42IDg0LjUzNyAxNCA4NS4xMzcgMTQuNiBDIDg1LjczNyAxNS4zIDg1LjkzNyAxNi4yIDg1LjczNyAxNy4yIFoiPjwvcGF0aD48cGF0aCBmaWxsPSIjMDA5Y2RlIiBkPSJNIDk1LjMzNyAzLjMgTCA5Mi4xMzcgMjMuNiBDIDkyLjAzNyAyNCA5Mi4zMzcgMjQuMyA5Mi43MzcgMjQuMyBMIDk1LjkzNyAyNC4zIEMgOTYuNDM3IDI0LjMgOTYuOTM3IDIzLjkgOTcuMDM3IDIzLjQgTCAxMDAuMjM3IDMuNSBDIDEwMC4zMzcgMy4xIDEwMC4wMzcgMi44IDk5LjYzNyAyLjggTCA5Ni4wMzcgMi44IEMgOTUuNjM3IDIuOCA5NS40MzcgMyA5NS4zMzcgMy4zIFoiPjwvcGF0aD48L3N2Zz4" alt="">

                                            <div style="    color: white;">
                                                Powered by Paypal 
                                            </div>
            </label>
        </div>
        {{-- <div class="custom-control custom-radio mb-1">
            <input type="radio" id="customRadio10" name="payment-radio-option" class="custom-control-input"
                value="payment-paydunya">
                    <label   label class="custom-control-label stepTooltip" for="customRadio10" title="">
                    <img src="{{asset('/img/mc.svg')}}" alt="" style="top: 0px;">

                                            <div>
                                                Powered by <img src="https://paydunya.com/images/logo_blue.png"  alt="" loading="lazy">
                                            </div>
            </label>
        </div> --}}
        
    </div>
</div>

<style>
   #aff_content > div > div > div:nth-child(3) > div.aff_edit_info_form > div > div.aff_edit_paiement_ui > div > div > label > img{
        height: 15px;
        width: auto!important;
        position: relative;
        top: 8px;
    }

    #aff_content > div > div > div:nth-child(3) > div.aff_edit_info_form > div > div.aff_edit_paiement_ui > div > div > label > div{
        font-size: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 3px;
    width: 100%;
    }

    #aff_content > div > div > div:nth-child(3) > div.aff_edit_info_form > div > div.aff_edit_paiement_ui > div > div > label > div img{
        height: 5px;
    width: auto!important;
    margin-left: 3px;
    }

    .aff_edit_paiement_ui>div>div {
    flex: 0 0 50%;
    max-width: 50%;
}

.aff_edit_paiement_ui>div>div>label {
    flex-wrap: wrap;
}
</style>

<div class="aff_edit_user">
    <div class="row">
        <div class="col-12">
            <label for="accept_ui" id="label_accept_ui">
                <input type="checkbox" id="accept_ui">
                <span>
                    {{__('En effectuant votre paiement, vous reconnaissez avoir lu et accepté')}}
                    <a href="{{ url('/agreement') }}">
                        {{__('Les Termes et conditions')}}
                    </a>,
                    <a href="{{ url('/agreement#community-guidelines') }}">
                        {{__('Guidelines')}}
                    </a>
                    {{ __('et') }}
                    <a href="{{ url('/privacy') }} ">
                        {{ __('la politique de confidentialité.') }}
                    </a>
                    {{__('Nous vous encourageons à lire attentivement les termes et conditions avant de procéder au paiement.')}}
                </span>
            </label>
        </div>
    </div>
    <div class="payment-error error text-danger d-none mt-3">{{__('Please select your payment method')}}</div>
    <button class="deposit-continue-btn" type="submit">

        <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                stroke-linejoin="round">
                <g id="Reglages---paiements" transform="translate(-578.000000, -539.000000)" stroke="#FFFFFF">
                    <g id="Group-2" transform="translate(534.000000, 178.000000)">
                        <g id="input" transform="translate(21.000000, 345.000000)">
                            <g id="save" transform="translate(24.000000, 17.000000)">
                                <path
                                    d="M12.4444444,14 L1.55555556,14 C0.696445945,14 0,13.3035541 0,12.4444444 L0,1.55555556 C0,0.696445945 0.696445945,0 1.55555556,0 L10.1111111,0 L14,3.88888889 L14,12.4444444 C14,13.3035541 13.3035541,14 12.4444444,14 Z"
                                    id="Path"></path>
                                <polyline id="Path"
                                    points="10.8888889 14 10.8888889 7.77777778 3.11111111 7.77777778 3.11111111 14">
                                </polyline>
                                <polyline id="Path" points="3.11111111 0 3.11111111 3.88888889 9.33333333 3.88888889">
                                </polyline>
                            </g>
                        </g>
                    </g>
                </g>
            </g>
        </svg>

        {{__('Payer maintenant')}}
    </button>
</div>
@include('elements.uploaded-file-preview-template')
{{-- @include('elements/settings/cart-box-add') --}}
