'use strict';


$(function () {
        // $('#card_number').formatCardNumber();
        // $('#expired_date .cc-expires').formatCardExpiry();
        // $('#cvv .cc-cvc').formatCardCVC();
	// Document ready
    cardForm.initCardInput()
	$(".card-save").on("click",function(){
        if (!cardForm.validateFieldRequired()) {
          return;  
        }
        cardForm.removeError()
        cardForm.Submitform()
    } )
	$(".required").on("change",function(){
        cardForm.removeError()
    } )
    cardForm.fillCountrySelectOptions();
    $(".activeThisCard").on("click",function(){
            let cartId = $(this).data("card_id")
            if (cartId) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: app.baseUrl + '/my/settings/active/card-billing',
                    cache: false,
                    data: {"card_id" : cartId},
                    dataType:"json",
                    success: function(response){
                        if (response.success) {
                            return location.reload();
                        }else{
                            return location.reload();
                        }
                    },
                   
                  });
            }
    } )

});


var cardBox = {
    // cardName,
    // cardNumber,
    // cardExp,
    // cardCvv,
    // billingName,
    // billingLastName,
    // billingPostal,
    // billingCity,
    // billingEtat,
    // billingCountry,
    // billingPhone,
    // billingAdress,
}

var  cardForm = {
    fillCountrySelectOptions: function () {
		$.ajax({
			type: 'GET',
			url: app.baseUrl + '/countries',
			success: function (result) {
				if (result !== null &&typeof result.countries !== 'undefined' && result.countries.length > 0 ) {
					$('.country-select').find('option').remove().end().append(
							'<option value="">' + trans('Select a country') + '</option>'
						);
					$.each(result.countries, function (i, item) {
						$('.country-select').append(
							$('<option>', {
								value: item.id,
								text: item.name,
							})
						);
					});
				}
			},
		});
	},
    validateFieldRequired : (element) => {
        $("#billing-error").addClass("d-none")
        $(".required").each((i, element) => {
            if (!$(element).val()) {
                $("#billing-error").removeClass("d-none")
                return false;
            }
        })
        return true;
    },
    removeError : () => {
        $("#billing-error").addClass("d-none")
        $("#saveError").addClass("d-nome")
        $("#saveError").html("")
    },
    initCardInput : () => {
       
          var month = 0;
          $("#expired_date").on('keypress',function(event) {
            if (event.charCode >= 48 && event.charCode <= 57) {
              if ($(this).val().length === 1) {
                $(this).val($(this).val() + event.key + "/");
              } else if ($(this).val().length === 0) {
                if (event.key == 1 || event.key == 0) {
                  month = event.key;
                  return event.charCode;
                } else {
                  $(this).val(0 + event.key + "/");
                }
              } else if ($(this).val().length > 2 && $(this).val().length < 5) {
                return event.charCode;
              }
            }
            return false;
          }).on('keyup',function(event) {
            if (event.keyCode == 8 && $("#expired_date").val().length == 2) {
              $(this).val(month);
            }
          })
    },
    Submitform : () => {
        const data = {
            // "_token" : $('meta[name="csrf-token"]').attr('content'),
            "name_card" : $("input[name='card_name']").val(),
            "card_number" : $("input[name='card_number']").val(),
            "expired_date" : $("input[name='expired_date']").val(),
            "cvv" : $("input[name='cvv']").val(),
            "billing_name" : $("input[name='BillingName']").val(),
            "billing_last_name" : $("input[name='BillinglastName']").val(),
            // "billing_post_code" : $("input[name='billingPostcode']").val(),
            // "billing_city" : $("input[name='billingCity']").val(),
            // "country" : $("#countrySelect").val(),
            "billing_phone" : $("input[name='billingPhone']").val(),
            "billing_address" : $("#billingAddress").val(),
            "active_card" : $('input[name="active_card"]:checked').val(),
        };
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: app.baseUrl + '/my/settings/add/card-billing',
            cache: false,
            data: data,
            dataType:"json",
            success: function(response){
               
                if (response.success) {
                    return location.reload();
                }else{
                    $("#saveError").text(trans('Erreur') + " : "+ response.message)
                    $("#saveError").removeClass("d-none")
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#saveError").text(trans('Error') + " :" + textStatus)
                $("#saveError").removeClass("d-none")
            }
          });
      },

}