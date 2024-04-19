@if(count($demoposts))
    @php
        $lists = ListsHelper::getUserLists();
    @endphp
    {{-- <div id="fullpage"> --}}
        @foreach($demoposts as $video)
            @include('elements.feed.post-box-presentation-video',['video' => $video])
        @endforeach
    {{-- </div> --}}
    
<style>
 
    /* .aff_gauche {
        width: calc(100% - 40px);
    } */
    .aff_footer_post {
        padding: 0 !important;
    }

    .aff_header_post {
        margin-bottom: 3px;
        padding: 12px !important;
    }
    .aff_post_block {
        margin-bottom: 19%;
    }
    /* #aff_content{
        wid
    } */
    
</style>

   <script>
    window.addEventListener('load', videoScroll);
    window.addEventListener('scroll', videoScroll);
    function videoScroll() {
        if ( document.querySelectorAll('video[autoplay]').length > 0) {
            var windowHeight = window.innerHeight,
                videoEl = document.querySelectorAll('video[autoplay]');
            for (var i = 0; i < videoEl.length; i++) {

            var thisVideoEl = videoEl[i],
                videoHeight = thisVideoEl.clientHeight,
                videoClientRect = thisVideoEl.getBoundingClientRect().top;

            if ( videoClientRect <= ( (windowHeight) - (videoHeight*.5) ) && videoClientRect >= ( 0 - ( videoHeight*.5 ) ) ) {
                thisVideoEl.play();
            } else {
                thisVideoEl.pause();
            }

            }
        }
    }
   
   </script>
@else

<div class="aff_edit_info_form">
    <div class="aff_refferal_info">
        <div>
        {{__('Pas de video de presentation trouvé')}}
        </div>
    </div>
</div>

@endif
