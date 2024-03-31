<div class="row checkout-dialog" id="mmchecktout_ve">
    <div class="col-lg-6 mx-auto">
        {{-- Paypal and stripe actual buttons --}}
        <div class="paymentOption paymentPP d-none">
            <form id="pp-buyItem" method="post" action="{{route('payment.initiatePayment')}}">
                @csrf
                <input type="hidden" name="amount" id="payment-deposit-amount" value="">
                <input type="hidden" name="transaction_type" id="payment-type" value="">
                <input type="hidden" name="post_id" id="post-id" value="">
                <input type="hidden" name="user_message_id" id="userMessage" value="">
                <input type="hidden" name="recipient_user_id" id="recipient" value="">
                <input type="hidden" name="provider" id="provider" value="">
                <input type="hidden" name="first_name" id="paymentFirstName" value="">
                <input type="hidden" name="last_name" id="paymentLastName" value="">
                <input type="hidden" name="billing_address" id="paymentBillingAddress" value="">
                <input type="hidden" name="city" id="paymentCity" value="">
                <input type="hidden" name="state" id="paymentState" value="">
                <input type="hidden" name="phone" id="paymentPhone" value="">
                <input type="hidden" name="postcode" id="paymentPostcode" value="">
                <input type="hidden" name="country" id="paymentCountry" value="">
                <input type="hidden" name="taxes" id="paymentTaxes" value="">
                <input type="hidden" name="stream" id="stream" value="">
                <button class="payment-button" type="submit"></button>
            </form>
        </div>

        <div class="paymentOption ml-2 paymentStripe d-none">
            <button id="stripe-checkout-button">{{__('Checkout')}}</button>
        </div> 
        <div class="checkout-popup modal fade" id="checkout-center" tabindex="-1" role="dialog"
            aria-labelledby="checkout" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="payment-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{__('Close')}}">

                            <svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    opacity="0.352515811" stroke-linecap="round" stroke-linejoin="round">
                                    <g id="8---Fil-d'actualité---Pourboire"
                                        transform="translate(-1101.000000, -248.000000)" stroke="#000000">
                                        <g id="Group-3" transform="translate(534.000000, 222.000000)">
                                            <g id="x-(4)" transform="translate(568.000000, 27.000000)">
                                                <line x1="12" y1="0" x2="0" y2="12" id="Path"></line>
                                                <line x1="0" y1="0" x2="12" y2="12" id="Path"></line>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="payment-body">

                            <div class="aff_envoyer_a">
                                {{__("Envoyer à")}}
                            </div>
                            <div class="aff_checkout_user_modal">
                                <img src="" class="rounded-circle user-avatar">
                                <div class="name"> </div>
                            </div>
                            @php
                                $min  = getSetting('payments.min_tip_value');
                                // $max  = getSetting('payments.max_tip_value');
                                $currency_symbol  = config('app.site.currency_symbol') ??  getSetting('payments.currency_symbol');
                                $ex = $min * 2;
                            @endphp
                            <div class="aff_envoi_relative">
                                <div class="aff_envoyer_a">
                                    {{-- {{__("Saisissez le montant")}} {{ "(min : $min$currency_symbol - max : $max$currency_symbol)" }} --}}
                                    {{__("Montant")}} 
                                </div>
                               
                                <div class="aff_envoyer_montant">
                                    {{-- <input class="uifield-amount"
                                        placeholder='{{__("Ex : $ex$currency_symbol ")}}'
                                        aria-label="Username" aria-describedby="amount-label" id="checkout-amount"
                                        type="number" min="{{ $min }}" step="1" max="{{ $max  }}"> --}}
                                    <input class="uifield-amount "
                                        placeholder='{{__("Ex : $ex$currency_symbol ")}}'
                                        aria-label="Username" aria-describedby="amount-label" id="checkout-amount"
                                        type="number" >
                                </div>
                                {{-- <label for="#" style="font-size: 12px; font-style: italic;">
                                   <u>Note</u> : {{__('Le Montant est déjà déduit des frais de transaction.')}}
                                </label> --}}
                            </div>

                            <div class="invalid-feedback">{{__('Please enter a valid amount.')}}</div>
                        </div>

                        {{-- <form id="billing-agreement-form">
                            <div class="tab-content">
                                 credit card info
                                <div id="individual" class="tab-pane fade show active aff_show_form_ui">

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div>
                                                <label for="firstName">
                                                    {{__("Nom")}}
                                                </label>
                                                <input type="text" name="firstName"
                                                    onchange="checkout.validateFirstNameField();" required
                                                    class=" uifield-first_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div>
                                                <label for="lastName">
                                                    {{__("Prénom")}}
                                                </label>
                                                <input type="text" name="lastName"
                                                    onblur="checkout.validateLastNameField()" required
                                                    class=" uifield-last_name">
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-sm-6">
                                            <div>
                                                <label for="billingPostcode">
                                                    {{__("Code postal")}}
                                                </label>
                                                <input type="text" name="billingPostcode"
                                                    onblur="checkout.validatePostcodeField()" required
                                                    class=" uifield-postcode">
                                            </div>
                                        </div>



                                        <div class="col-md-6 col-sm-6">
                                            <div>
                                                <label for="billingCity">
                                                    Ville
                                                </label>
                                                <input type="text" name="billingCity"
                                                    onblur="checkout.validateCityField()" required
                                                    class=" uifield-city">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div>
                                                <label for="billingState">
                                                    {{__("Etat / Département")}}
                                                </label>
                                                <input type="text" name="billingState"
                                                    onblur="checkout.validateStateField()" required
                                                    class=" uifield-state">
                                            </div>
                                        </div>

                                       

                                        <div class="col-md-6 col-sm-6">
                                            <div>
                                                <label for="countrySelect">
                                                    {{__("Pays")}}
                                                </label>
                                                <select class="country-select  input-sm uifield-country"
                                                    id="countrySelect" required
                                                    onchange="checkout.validateCountryField()"></select>
                                            </div>
                                        </div>
                                         <div class="col-md-6 col-sm-6">
                                            <div>
                                                <label for="paymentPhone">
                                                   {{__("Telephone")}}
                                                </label>
                                                <input type="text" name="phoneNumber"
                                                    onblur="checkout.validatePhoneField()" required
                                                    class=" uifield-phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div>
                                                <label for="cardNumber">
                                                    {{__("Adresse")}}
                                                </label>
                                                <textarea type="text" name="billingAddress"
                                                    onblur="checkout.validateBillingAddressField()"

                                                    class=" w-100 uifield-billing_address" required></textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="billing-agreement-error error text-danger d-none">
                                    {{__('Please complete all billing details')}}</div>
                            </div>
                        </form> --}}

                        {{-- <div class="aff_recap_paiement">
                            <div class="subtotal row">
                                <span class="col-sm left">Sous total</span>
                                <span class="subtotal-amount col-sm right text-right">
                                    <b>$0.00</b>
                                </span>
                            </div>
                            <div class="taxes row">
                                <span class="col-sm left">TVA</span>
                                <span class="country-taxes col-sm right text-right">
                                    <b>$0.00</b>
                                </span>
                            </div>
                            <div class="taxes-details"></div>
                            <div class="total row">
                                <span class="col-sm left">Total</span>
                                <span class="total-amount col-sm right text-right">
                                    <b>$0.00</b>
                                </span>
                            </div>
                        </div> --}}

                        <div class="aff_mode_de_paiement">
                            <div>
                             {{__("Séléctionnez votre mode de paiement ci-dessous")}}
                            </div>
                            
                            <div class="find_check">
                                {{-- <div class="radio-group aff_liste_module" style="width: 50%">
                                    <div class="radio mx-auto digital-virgo-payment-provider checkout-payment-provider d-flex align-items-center justify-content-center"
                                    data-value="digital-virgo">
                                        <div>
                                        <img src="{{asset('/img/mp.svg')}}" alt="">
                                            <div>
                                                Powered by <img src="https://www.digitalvirgo.com/wp-content/uploads/2020/01/logo-digital-virgo-width-no-baseline.png"  alt="" loading="lazy">
                                            </div>
                                        </div>
                                    </div>

                                    <p class="rajout_infos">
                                        <span class="text-danger">*</span> Côte d'Ivoire, Sénégal, Mali, Niger, Bénin, Togo
                                    </p>
                                </div>

                                <div class="radio-group aff_liste_module" style="width: 50%">
                                    <div class="radio mx-auto paydunya-payment-provider  checkout-payment-provider d-flex align-items-center w-full justify-content-center"
                                    data-value="paydunya">
                                    <div>
                                    <img src="{{asset('/img/mc.svg')}}" alt="">
                                    <div>
                                      Powered by <img  src="https://paydunya.com/images/logo_blue.png" alt="" loading="lazy">
                                    </div>
                                    </div>
                                    </div>
                                    <p class="rajout_infos">
                                        <span class="text-danger">*</span> Cartes 3D Secure uniquement <span class="text-white"> Secure uniquement </span>
                                    
                                    </p>
                                </div> --}}

                                <div style="width: 50%" class="radio-group aff_liste_module" {!! (!Auth::check() || Auth::user()->wallet->total <= 0) ? 'data-toggle="tooltip" data-placement="right"' : '' !!} title="{{__('You can use the wallet deposit page to add credit.')}}">
                                    <div class="radio mx-auto credit-payment-provider checkout-payment-provider d-flex align-items-center justify-content-center selected" data-value="credit">
                                        <img class="img-if-light" src="{{asset('/img/fan-wallet.png')}}" alt="">
                                        <img class="img-if-dark" src="{{asset('/img/fan-wallet-white.png')}}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payment-error error text-danger text-bold d-none mb-1">
                            {{__('Please select your payment method')}}</div>

                        <label for="is_offer" id="label_accept_ui">
                            <input type="checkbox" aria-label="Checkbox for following text input" name="is_offer"
                                id="is_offer">
                            <span>
                                {{__("En effectuant votre paiement, vous reconnaissez avoir pris connaissance et accepté les conditions générales de vente. Nous vous encourageons à lire attentivement les termes et conditions avant de procéder au paiement.")}}
                            </span>
                        </label>

                        {{-- <div class="important_text">
                             Important :  {{__('Sectext')}} 
                        </div> --}}

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary checkout-continue-btn">{{ __("Payer maintenant") }}
                            <div class="spinner-border spinner-border-sm ml-2 d-none" role="status">
                                <span class="sr-only">{{__('Loading...')}}</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
  .rajout_infos {
    font-size: 10px;
}
</style>