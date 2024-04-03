<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SPF6PHGLSS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-SPF6PHGLSS');
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16460625247"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-16460625247');
</script>

<!-- Google tag (gtag.js) event -->
<script>
  gtag('event', 'ads_conversion_verified_users_1', {
    // <event_parameters>
  });
</script>
<!-- Google tag (gtag.js) event - delayed navigation helper -->
<script>
  // Helper function to delay opening a URL until a gtag event is sent.
  // Call it in response to an action that should navigate to a URL.
  function gtagSendEvent(url) {
    var callback = function () {
      if (typeof url === 'string') {
        window.location = url;
      }
    };
    gtag('event', 'ads_conversion_verified_users_1', {
      'event_callback': callback,
      'event_timeout': 2000,
      // <event_parameters>
    });
    return false;
  }
</script>