
<p>
    {{ __('Liste des cartes') }}
</p>
<div class=" ">
    <div class="row">
        <div class="col-4">
            <div>

            </div>
        </div>
        <div class="col-4">
            <div>
                <button class=" btn btn-primary  btn_aff " data-placement="top" data-toggle="modal" data-target="#add-cart"
                    data-toggle="modal"> + {{ __('Ajouter une carte') }}</button>
            </div>
        </div>
        <div class="col-4">
            <div>

            </div>
        </div>
    </div>
</div>
<div class="" style="width: 80% ; padding:6px 2px 10px 136px">
    <div class="aff_suggest_thumbs">
        @foreach ($billingsCard as $card)
        <div class="aff_search_user_list">
            <div class="aff_info_name">
                
                    <div>
                        @if ( $card->name_card )
                            <span>
                                {{ $card->name_card }}
                            </span>
                        @endif
                        <div>
                            <span>{{ __('Numero de la carte') }} :   {{  Str::mask($card->card_number, 'X', 0, 12)  }}</span>
                        </div>

                    </div>   
                <div>
                    <span>{{ __("Date d'expiration") }} : {{ $card->expired_date }} </span> <br>
                    <span>CVV :  {{ $card->cvv }}  </span>
                </div>
            </div>
            <a href="javascript:void(0)" class="{{ !$card->status ? 'activeThisCard' : '' }}" data-card_id ="{{ $card->id }}" 
                @if (!$card->status)
                    data-toggle="tooltip" data-placement="top" title="{{__('Activée cette carte')}}"
                @endif
                @if ($card->status)
                    data-toggle="tooltip" data-placement="top" title="{{__('Votre depot de  portefeuille se fait avec cette carte')}}"
                @endif
             >
                {{  $card->status ? __("Activé(e)") :   __("Desactivé(e)")  }}
            </a>
        </div>
        @endforeach
    </div>

</div>


<div class="row checkout-dialog" id="mmchecktout_ve">
    <div class="col-lg-6 mx-auto">
        <div class="paymentOption ml-2 paymentStripe d-none">
            <button id="stripe-checkout-button">{{ __('Checkout') }}</button>
        </div>
        <div class="checkout-popup modal fade" id="add-cart" tabindex="-1" role="dialog" aria-labelledby="checkout"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="payment-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">

                            <svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                    opacity="0.352515811" stroke-linecap="round" stroke-linejoin="round">
                                    <g id="8---Fil-d'actualité---Pourboire"
                                        transform="translate(-1101.000000, -248.000000)" stroke="#000000">
                                        <g id="Group-3" transform="translate(534.000000, 222.000000)">
                                            <g id="x-(4)" transform="translate(568.000000, 27.000000)">
                                                <line x1="12" y1="0" x2="0" y2="12"
                                                    id="Path"></line>
                                                <line x1="0" y1="0" x2="12" y2="12"
                                                    id="Path"></line>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="payment-body">
                            <form id="billing-agreement-form">
                                <div class="tab-content">
                                    <p style="padding : 14px 2px"> {{ __('Informations sur la carte de crédit') }}</p>
                                    <div id="" class="tab-pane fade show active aff_show_form_ui">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div>
                                                    <label for="namecard">
                                                        {{ __('Nom de la carte') }}
                                                    </label>
                                                    <input type="text" name="card_name" placeholder="..."
                                                        onchange="cardForm.validateFieldRequired();" required
                                                        class=" uifield required ">
                                                </div>
                                            </div>
                                            <hr style="display: block ;">
                                            <div class="col-md-12 col-sm-12">
                                                <div>
                                                    <label for="car_number">
                                                        {{ __('Numero de la carte') }}
                                                    </label>
                                                    <input type="text" name="card_number" id="card_number" placeholder="Ex : 4012000000020014" 
                                                        onchange="cardForm.validateFieldRequired();" required    maxlength="16"  
                                                        class=" uifield  required">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div>
                                                    <label for="expired_date">
                                                        {{ __("Date d'expiration") }}
                                                    </label>
                                                    <input type="text" name="expired_date" id="expired_date"  placeholder="MM/YY"
                                                        onchange="cardForm.validateFieldRequired();" required  
                                                        class=" uifield   required">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div>
                                                    <label for="cvv">
                                                        CVV
                                                    </label>
                                                    <input type="text" name="cvv"  placeholder="123" id="cvv"  maxlength="4"
                                                        onchange="cardForm.validateFieldRequired();" required 
                                                        class=" uifield  required">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div>
                                                    <label for="firstName">
                                                        {{ __('Nom') }}
                                                    </label>
                                                    <input type="text" name="BillingName"
                                                        onchange="cardForm.validateFieldRequired(this);" required
                                                        class=" uifield required">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div>
                                                    <label for="lastName">
                                                        {{ __('Prénom') }}
                                                    </label>
                                                    <input type="text" name="BillinglastName"
                                                    onchange="cardForm.validateFieldRequired(this)" required
                                                        class=" uifield required-last_name">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div>
                                                    <label for="phoneNumber">
                                                        {{ __('Telephone') }}
                                                    </label>
                                                    <input type="text" name="billingPhone"
                                                    onchange="cardForm.validateFieldRequired(this)" required
                                                        class=" uifield required-phone">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div>
                                                    <label for="billingAddress">
                                                        {{ __('Adresse complète') }}
                                                    </label>
                                                    <input type="text" name="billingAddress" id="billingAddress" onchange="cardForm.validateFieldRequired(this)"  class=" w-100 uifield required-billing_address" required />
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <label for="active_card" id="active_card">
                                                    <input type="checkbox" id="active_card" name="active_card" value="active">
                                                    <span>
                                                        {{ __("Activée pour les dépôts de crédit. Vous pouvez effectuer des dépôts sur cette carte à partir de maintenant.") }}
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="billing-error" class="billing-agreement-error error text-danger d-none"> {{ __('Please complete all billing details') }}</div>
                                    <div id="saveError" class="billing-agreement-error error text-danger d-none"> </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary card-save">{{ __('Save') }}
                                <div class="spinner-border spinner-border-sm ml-2 d-none" role="status">
                                    <span class="sr-only">{{ __('Loading...') }}</span>
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

