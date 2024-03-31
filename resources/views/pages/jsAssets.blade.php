{{-- Global JS Assets --}}
{!!
Minify::javascript(
array_merge([
'/libs/jquery/dist/jquery.min.js',
'/libs/popper.js/dist/umd/popper.min.js',
'/libs/bootstrap/dist/js/bootstrap.min.js',
'/js/plugins/toasts.js',
'/libs/cookieconsent/build/cookieconsent.min.js',
'/libs/xss/dist/xss.min.js',
'/js/app.js',

],
(isset($additionalJs) ? $additionalJs : [])
))->withFullUrl()
!!}

{{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
{{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
{{--[if lt IE 9]>
{!! Minify::javascript(array('//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js', '//oss.maxcdn.com/respond/1.4.2/respond.min.js')) !!}
<![endif]--}}

{{-- Page specific JS --}}
@yield('scripts')

<script type="module" src="{{asset('/libs/ionicons/dist/ionicons/ionicons.esm.js')}}"></script>
<script nomodule src="{{asset('/libs/ionicons/dist/ionicons/ionicons.js')}}"></script>

@if(getSetting('custom-code-ads.custom_js'))
{!! getSetting('custom-code-ads.custom_js') !!}
@endif
@include('elements.translations')

<script type="text/javascript">
    function decimalFormat(nStr) {
        var $decimalDot = '.';
        var $decimalComma = ',';
        var currency_symbol_left = '$ ';
        var currency_symbol_right = '';
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? $decimalDot + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + $decimalComma + '$2');
        }
        return currency_symbol_left + x1 + x2 + currency_symbol_right;
    }

    function earnAvg() {
        var feePercentage = 20; // Operating fee is 20%
        var subscriptionPercentage = 2; // Assume 2% of followers will subscribe
        var decimalPlaces = 2;

        var xofToEuroRate = 3 / 2000; // Conversion rate from XOF to Euro
        var monthlySubscriptionXOF = parseFloat($('#monthlySubscription').text());
        var monthlySubscriptionEuro = monthlySubscriptionXOF * xofToEuroRate;

        var totalFollowers = parseFloat($('#numberFollowers').text());

        var estimatedSubscribers = (totalFollowers * subscriptionPercentage / 100);
        var totalRevenueEuro = (estimatedSubscribers * monthlySubscriptionEuro);
        var operatingFeeEuro = (totalRevenueEuro * feePercentage / 100);
        var netEarningsEuro = totalRevenueEuro - operatingFeeEuro;

        var euroToXofRate = 2000 / 3; // Conversion rate from Euro to XOF.
        var netEarningsXOF = netEarningsEuro * euroToXofRate; // Convert the earnings to XOF

        return decimalFormat(netEarningsXOF.toFixed(decimalPlaces));
    }

    function updateValues() {
        $('#estimatedEarn').html(earnAvg());
    }

    $("#rangeNumberFollowers").on('input', function () {
        $('#numberFollowers').html($(this).val());
        updateValues();
    });

    $("#rangeMonthlySubscription").on('input', function () {
        $('#monthlySubscription').html($(this).val());
        updateValues();
    });

    updateValues(); // Call this function to initialize the estimated earnings when the page loads.

</script>



<script type="text/javascript">
    $(document).ready(function () {
        $('#home_tab li a').click(function (e) {
            e.preventDefault(); // Prevent the default action of the link

            // Remove the active class from the currently active link and image
            $('#home_tab li a.active, .home_info_content.active').removeClass('active');

            // Add the active class to the clicked link
            $(this).addClass('active');

            // Get the index of the clicked link
            var index = $('#home_tab li a').index(this);

            // Add the active class to the corresponding image
            $('.home_info_content').eq(index).addClass('active');
        });
    });

</script>

<div id="vp"
    style="position: fixed; bottom: 0.5rem; right: 0.5rem; z-index: 999; display: inline-block; background: #555; color: #ffffff; padding: 0 0.5rem 0.125rem; border-radius: 0.25rem;">
</div>

<script>
    var vp = document.body.querySelector('#vp');
    var viewportWidth = window.innerWidth + 'px';
    vp.innerHTML = viewportWidth;
    window.addEventListener('resize', function () {
        viewportWidth = window.innerWidth + 'px';
        vp.innerHTML = viewportWidth;
    });

</script>
    
<script>
    
</script>


<script>
    var vp = document.body.querySelector('#vp');
    var viewportWidth = window.innerWidth + 'px';
    vp.innerHTML = viewportWidth;
    window.addEventListener('resize', function () {
        viewportWidth = window.innerWidth + 'px';
        vp.innerHTML = viewportWidth;
    });

</script>

<script>
     document.addEventListener('DOMContentLoaded', function () {
        let menuHome = document.querySelector('#open_menu_home');

        if (menuHome) {
            menuHome.addEventListener('click', function () {
                document.body.classList.toggle('menu_ouvert');
            });
        }

    });

</script>


<script>
    function autoGrow(element) {
        if (element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight) + "px";
        }
    }

    // On appelle la fonction autoGrow lorsque la page est chargée
    window.onload = function () {
        autoGrow(document.getElementById("dropzone-uploader"));
    }

</script>

<script>
    // Attendre que la page ait fini de charger
    document.addEventListener('DOMContentLoaded', (event) => {
        // Sélectionner tous les boutons radio
        var radios = document.querySelectorAll('input[name="payment-radio-option"]');

        // Pour chaque bouton radio, ajouter un écouteur d'événement "change"
        radios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                // Enlever la classe 'active' de tous les divs
                var divs = document.querySelectorAll('.custom-control');
                divs.forEach(function (div) {
                    div.classList.remove('active');
                });

                // Ajouter la classe 'active' au div parent du bouton radio sélectionné
                this.parentNode.classList.add('active');
            });
        });
    });

</script>

<script>
    document.querySelector('#commencer_la_verification')?.addEventListener('click', function () {
        document.body.classList.toggle('etapes_verifications');
    });

    document.querySelector('#close_verif_1')?.addEventListener('click', function () {
        document.body.classList.remove('etapes_verifications');
    });

    document.querySelector('#goto_etape_verif_2')?.addEventListener('click', function () {
        document.body.classList.remove('etapes_verifications');
        document.body.classList.add('etapes_fichiers');
    });

    document.querySelector('#close_verif_2')?.addEventListener('click', function () {
        document.body.classList.remove('etapes_verifications');
        document.body.classList.remove('etapes_fichiers');
    });

</script>

<script>
    $(document).ready(function () {
        // Événement soumission du formulaire
        $('.verify-form').on('submit', function (e) {
            e.preventDefault(); // Empêche le comportement par défaut de soumission du formulaire

            var form = $(this);
            var url = form.attr('action'); // Récupère l'URL de l'attribut 'action' du formulaire

            $('body').addClass('boutton_a_ete_clique'); // Ajoute la classe au body

            $.ajax({
                    type: 'POST',
                    url: url,
                    data: form.serialize() // Sérialise les données du formulaire pour l'envoi
                })
                .done(function (response) {
                    // Gérer la réponse du serveur ici
                    console.log(response);

                    // Rediriger vers une nouvelle page après 5 secondes
                    setTimeout(function () {
                        window.location.href =
                            "https://web.fanrhythm.com/my/settings/verify";
                    }, 5000);
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    // Gérer les erreurs ici
                    console.error(textStatus, errorThrown);

                    // Rediriger vers une nouvelle page après 5 secondes, même en cas d'erreur
                    setTimeout(function () {
                        window.location.href =
                            "https://web.fanrhythm.com/my/settings/verify";
                    }, 5000);
                });
        });
    });

</script>

<script>
    $(document).ready(function () {
        // Vérifie si le cookie est défini
        if (getCookie('cookieAccepted') === 'true') {
            $('.cookies_infos_edit').hide(); // cachez le bloc si le cookie est défini
        }

        $('#acceptCookies').on('click', function () {
            setCookie('cookieAccepted', 'true', 365); // définir le cookie pour un an
            $('.cookies_infos_edit').hide(); // cachez le bloc
        });
    });

    // Fonction pour définir un cookie
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // Fonction pour obtenir la valeur d'un cookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

</script>

<script>

    // Vos fonctions pour gérer les cookies restent les mêmes...

    $(document).ready(function() {
        // Lorsque l'élément est en focus
        $('textarea.messageBoxInput.dropzone').on('focus', function() {
            $('body').addClass('text_foc');
        });

        // Lorsque l'élément perd le focus
        $('textarea.messageBoxInput.dropzone').on('blur', function() {
            $('body').removeClass('text_foc');
        });
    });



</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === Node.ELEMENT_NODE) {
                        var textElements = node.querySelectorAll('.aff_post_text');
                        textElements.forEach(function(textElement) {
                            textElement.innerHTML = textElement.innerHTML.replace(
                                /(https?:\/\/[^\s<]+)/g,
                                '<a href="$1">$1</a>'
                            );
                        });
                    }
                });
            }
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Traiter les éléments existants dans le DOM
    var textElements = document.querySelectorAll('.aff_post_text');
    textElements.forEach(function(textElement) {
        textElement.innerHTML = textElement.innerHTML.replace(
            /(https?:\/\/[^\s<]+)/g,
            '<a href="$1">$1</a>'
        );
    });
});
</script>

