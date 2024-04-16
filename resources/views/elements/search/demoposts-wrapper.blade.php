@if(count($demoposts))
    @php
        $lists = ListsHelper::getUserLists();
    @endphp
    @foreach($demoposts as $video)
        @include('elements.feed.post-box-presentation-video',['video' => $video])
        
    @endforeach
<style>
    .aff_droite{
        /* display: none; */
    }
    .aff_gauche {
        width: calc(100% - 40px);
    }
    .aff_footer_post {
        padding: 0 !important;
    }

    .aff_header_post {
        margin-bottom: 3px;
        padding: 12px !important;
    }
</style>
   
@else

<div class="aff_edit_info_form">
    <div class="aff_refferal_info">
        <div>
        {{__('Pas de video de presentation trouvé')}}
        </div>
    </div>
</div>

@endif
