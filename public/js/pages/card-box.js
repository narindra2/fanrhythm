'use strict';


$(function () {
  const stripe = Stripe(stripeConfig.stripePublicID);
  var elements = stripe.elements();
  var style = {
    base: {
      color: '#55ac4e',
      lineHeight: '24px',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '17px',
      '::placeholder': {
        color: '#aab7c4'
      }
    },
    invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
    }
  };
  var card = elements.create('card', { style: style });
  card.mount('#card-element');
  card.addEventListener('change', function (event) {
    var displayError = $('#card-errors');
    if (event.error) {
      displayError.html(event.error.message);
    } else {
      displayError.html("");
    }
  });
  $(".card-save").on("click", function () {
    cardForm.removeError()
    if (!cardForm.validateFieldRequired()) {
      return;  
    }
    cardForm.Submitform(stripe, card)
  })

  $(".activeThisCard").on("click", function () {
    let cartId = $(this).data("card_id")
    if (cartId) {
      $.ajax({
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: app.baseUrl + '/my/settings/active/card-billing',
        cache: false,
        data: { "card_id": cartId },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            return location.reload();
          } else {
            return location.reload();
          }
        },

      });
    }
  })
});

var cardForm = {
  initCardInput: () => {


  },
    validateFieldRequired : () => {
      $("#billing-error").addClass("d-none")
      let validated = true;
      $(".required").each((i, element) => {
          if (!$(element).val()) {
            // $(element).addClass("is-invalid")
              $("#billing-error").removeClass("d-none")
               validated = false;
               return;
          }
      })
      if (!validated) {
        return false;
      }
      return true;
  },
  loading: (show = false) => {
    if (show) {
      $("#card-save").attr("disabled", true)
      $("#loading-saving-card").removeClass("d-none")
    } else {
      $("#card-save").attr("disabled", false)
      $("#loading-saving-card").addClass("d-none")
    }
  },
  removeError: () => {
    $("#billing-error").addClass("d-none")
    $("#saveError").addClass("d-nome")
    $("#saveError").html("")
  },
  Submitform: (stripe, card) => {
    cardForm.loading(true);
    var stripeToken = null
    stripe.createToken(card).then(function (result) {
      if (result.error) {
        var errorElement = $('#card-errors');
        errorElement.html(result.error.message);
        cardForm.loading(false);
        return;
      } else {
        stripeToken = result.token
        const data = {
          // "_token" : $('meta[name="csrf-token"]').attr('content'),
          "stripeToken": stripeToken,
          "name_card": $("input[name='card_name']").val(),
          "active_card": $('input[name="active_card"]:checked').val(),
        };
        $.ajax({
          type: "POST",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: app.baseUrl + '/my/settings/add/card-billing',
          cache: false,
          data: data,
          dataType: "json",
          success: function (response) {
            if (response.success) {
              return location.reload();
            } else {
              cardForm.loading(false);
              $("#saveError").text(trans('Erreur') + " : " + response.message)
              $("#saveError").removeClass("d-none")
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            cardForm.loading(false);
            $("#saveError").text(trans('Error') + " :" + textStatus)
            $("#saveError").removeClass("d-none")
          }
        });
      }
    });

  },

}