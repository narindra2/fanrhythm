<p>
    {{__('Saisissez le montant à retirer')}}
</p>

<div class="aff_edit_user">
    <div class="row">
        <div class="col-md-12">
            <div>
                <label for="#">
                    {{__('Montant')}}
                </label>
                @php
                $min = \App\Providers\PaymentsServiceProvider::getWithdrawalMinimumAmount();
                $max = \App\Providers\PaymentsServiceProvider::getWithdrawalMaximumAmount();
                $symb = getSetting('payments.currency_symbol');
                @endphp
                <input placeholder='{{"Min $min $symb / $max $symb"}}'
                    aria-label="Username" aria-describedby="amount-label" id="withdrawal-amount" value="{{$min}}" type="number"
                    min="{{$min}}" step="5"
                    max="{{$max}}">
            </div>
        </div>
        <div class="col-md-12">
            <span class="invalid-feedback">{{__('Please enter a valid amount')}}</span>
        </div>
        <div class="col-md-6">
            <div>
                <label for="paymentMethod">{{__('Envoyer mes gains par')}}</label>
                <select id="payment-methods" name="payment-methods">
                    @foreach(\App\Providers\PaymentsServiceProvider::getWithdrawalsAllowedPaymentMethods() as
                    $paymentMethod)
                    <option value="{{$paymentMethod}}">{{$paymentMethod}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <label id="payment-identifier-label"
                    for="withdrawal-payment-identifier">{{__("Numéro de compte x")}}</label>
                <input type="text" id="withdrawal-payment-identifier" name="payment-identifier">
            </div>
        </div>

        <div class="col-md-12">
            <div class="for_textarea">
                <label for="withdrawal-message">{{__('Ajouter une note')}}</label>
                <textarea placeholder="{{__('Votre message')}}" id="withdrawal-message" rows="2"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <span class="invalid-feedback" role="alert">
                {{__('Please add your withdrawal notes: EG: Paypal or Bank account.')}}
            </span>
        </div>
        <div class="col-12">
            <span class="payment-error error text-danger d-none mt-3">{{__('Add all required info')}}</span>
        </div>

        <div class="col-12">
            <label for="accept_ui" id="label_accept_ui">
                <input type="checkbox" id="accept_ui">
                <span>
                {{__('pay_2')}}
                </span>
            </label>
        </div>
        <div class="col-12">
            <button class="withdrawal-continue-btn" type="submit">

                <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                        stroke-linejoin="round">
                        <g id="Reglages---retraits" transform="translate(-578.000000, -727.000000)" stroke="#FFFFFF">
                            <g id="input" transform="translate(555.000000, 711.000000)">
                                <g id="save" transform="translate(24.000000, 17.000000)">
                                    <path
                                        d="M12.4444444,14 L1.55555556,14 C0.696445945,14 0,13.3035541 0,12.4444444 L0,1.55555556 C0,0.696445945 0.696445945,0 1.55555556,0 L10.1111111,0 L14,3.88888889 L14,12.4444444 C14,13.3035541 13.3035541,14 12.4444444,14 Z"
                                        id="Path"></path>
                                    <polyline id="Path"
                                        points="10.8888889 14 10.8888889 7.77777778 3.11111111 7.77777778 3.11111111 14">
                                    </polyline>
                                    <polyline id="Path"
                                        points="3.11111111 0 3.11111111 3.88888889 9.33333333 3.88888889"></polyline>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
                {{__('Envoyer ma demande')}}</button>
        </div>
    </div>
</div>
