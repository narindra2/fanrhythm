</script>
<script type="module">
    import PhotoSwipeLightbox from '{{ asset("/libs/photoswipe5/photoswipe-lightbox.esm.js") }}'; // https://cdn.jsdelivr.net/npm/photoswipe@5.3.0/dist/photoswipe-lightbox.esm.js
    import PhotoSwipeDynamicCaption from '{{ asset("/libs/photoswipe5/photoswipe-dynamic-caption-plugin.esm.js") }}';
    import PhotoSwipeVideoPlugin from ' {{ asset("/libs/photoswipe5/photoswipe-video-plugin.esm.min.js") }}';

    const smallScreenPadding = {
      top: 0, bottom: 0, left: 0, right: 0
    };
    const largeScreenPadding = {
      top: 30, bottom: 30, left: 0, right: 0
    };
    const lightbox = new PhotoSwipeLightbox({
      gallerySelector: '#gallery',
      childSelector: '.pswp-gallery__item',
      tapAction: 'next',
      // optionaly adjust viewport
      paddingFn: (viewportSize) => {
        return viewportSize.x < 700 ? smallScreenPadding : largeScreenPadding
      },
      pswpModule: () => import('{{ asset("/libs/photoswipe5/photoswipe.esm.js") }}')
    });
    const captionPlugin = new PhotoSwipeDynamicCaption(lightbox, {
      mobileLayoutBreakpoint: 700,
      type: 'auto',
      mobileCaptionOverlapRatio: 1
    });
    const videoPlugin = new PhotoSwipeVideoPlugin(lightbox, {
      // options
    });

    lightbox.init();
</script>
<style>
  .pswp {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1040;
    touch-action: none;
    outline: 0;
    opacity: 0.003;
    contain: layout style size;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
  .pswp__dynamic-caption--aside {
  max-width: 300px;
  padding: 3px 0px 30px 0px;
  margin-top: 70px;
}
.pswp__dynamic-caption--below {
  max-width: 700px;
  padding: 15px 0 0;
}
.pswp__dynamic-caption--mobile {
  background: rgba(0, 0, 0, 0.5);
  padding: 10px 15px;
}
.pswp__custom-caption {
    background: rgba(75, 150, 75, 0.75);
    font-size: 16px;
    color: #fff;
    width: calc(100% - 32px);
    max-width: 400px;
    padding: 2px 8px;
    border-radius: 4px;
    position: absolute;
    left: 50%;
    bottom: 43%;
    transform: translateX(-50%);
    /* margin-top: -16px; */
}
  .image-item {
    width: 100%;
    height: 150px;
    object-fit: cover;
  }

  .pswp__img {
    object-fit: contain;
  }

  .pswp__dynamic-caption {
    color: #fff;
    position: absolute;
    width: 100%;
    left: 0;
    top: 0;
    transition: opacity 120ms linear !important;
    /* override default */
  }

  .pswp-caption-content {
    display: none;
  }

  .pswp__dynamic-caption a {
    color: #fff;
  }

  .pswp__dynamic-caption--faded {
    opacity: 0 !important;
  }

  /* .pswp__dynamic-caption--aside {
    width: auto;
    max-width: 300px;
    padding: 20px 15px 20px 20px;
    margin-top: 70px;
  } */

  .pswp__dynamic-caption--below {
    width: auto;
    max-width: 700px;
    padding: 15px 0 0;
  }

  .pswp__dynamic-caption--on-hor-edge {
    padding-left: 15px;
    padding-right: 15px;
  }

  .pswp__dynamic-caption--mobile {
    width: 100%;
    background: rgba(0, 0, 0, 0.5);
    padding: 10px 15px;

    right: 0;
    bottom: 0;

    /* override styles that were set via JS.
    as they interfere with size measurement */
    /* top: auto !important; */
    left: 0 !important;
    margin-top: 137%;
  }

  .pswp-gallery__item {
    margin: 0 4px 4px 0;
  }

  .pswp-gallery__item img {
    display: block;
  }

  .pswp-gallery {
    width: 100%;
    /* padding: 0 50px 50px; */
    position: relative;
    display: flex;
    /* flex-wrap: wrap; */
  }

  .pswp__dynamic-caption {
    color: #fff;
    width: 100%;
  }

  .pswp__dynamic-caption a {
    color: #fff;
    text-decoration: underline;
  }
 
</style>