
<h6 id="cards-list" style="margin-left: 32px;">
    {{ __('Liste des cartes') }}
</h6>
<div class=" ">
    <div class="row">
        <div class="col-4">
            <div>

            </div>
        </div>
        <div class="col-5">
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
<div class="list-cards" >
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
                            <span>{{ __('Numero de la carte') }} :   {{  "XXXXXXXXXXXX" .$card->cardStripe["last4"]   }}</span>
                        </div>

                    </div>   
                <div>
                    <span>{{ __("Date d'expiration") }} : {{ $card->cardStripe["exp_month"]  }}/ {{ $card->cardStripe["exp_year"]  }} </span> <br>
                    <span>  {{ $card->cardStripe["brand"]  }}  </span>
                </div>
            </div>
            <a href="javascript:void(0)" class="{{ !$card->status ? 'activeThisCard ' : 'btn btn-success' }}" data-card_id ="{{ $card->id }}" 
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
                                    <div  class="tab-pane  mb-2 fade show active aff_show_form_ui">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div>
                                                    <label for="namecard">
                                                        {{ __('Nom de la carte') }}
                                                    </label>
                                                    <input type="text" name="card_name" autocomplete="off" placeholder="Ex: My card"
                                                        onchange="cardForm.validateFieldRequired();" required
                                                        class=" uifield required ">
                                                </div>
                                            </div>
                                             
                                        </div>
                                    </div>
                                    <div  id="card-element" class="form-control  form-control-lg" style='border-radius: 6px'>
                                        <!-- a Stripe Element will be inserted here. -->
                                    </div>
                                    <span  id="card-errors" class="payment-errors  mt-2 mb-2" style="color: red; font-size: 13px; "></span>

                                    <div class="col-12 mt-3" style="margin-left: -10px;">
                                        <label for="active_card" id="active_card">
                                            <input type="checkbox" id="active_card" name="active_card" value="active">
                                            <span>
                                                {{ __("Activée pour les dépôts de crédit. Vous pouvez effectuer des dépôts sur cette carte à partir de maintenant.") }}
                                            </span>
                                        </label>
                                    </div>
                                    

                                    <div id="billing-error" class="billing-agreement-error error text-danger d-none"> {{ __('Please complete all billing details') }}</div>
                                    <div id="saveError" class="billing-agreement-error error text-danger d-none"> </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer mt-3" style="justify-content: end;">
                            <button type="submit" id="card-save" class="btn btn-primary card-save">{{ __('Save') }}
                                <div id="loading-saving-card" class="spinner-border spinner-border-sm ml-2 d-none" role="status">
                                    <span class="sr-only">{{ __('Loading...') }}</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .rajout_infos {
            font-size: 10px;
        }
        
        .list-cards{
                width: 80% ; 
                padding:6px 2px 10px 136px;
            }
        @media screen and (max-width: 768px) {
            .list-cards{
                width: auto; 
                padding:0px;
            }
        }
        
    </style>
