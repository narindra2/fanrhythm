@if(count($streams))

<div class="aff_edit_info_form">
    <div class="aff_refferal_info">
        <div>
            {{__('Live now')}}
        </div>

        <div class="row">
            @foreach($streams as $stream)
                @include('elements.streams.stream-element-public',[
                        'stream'=>$stream,
                        'showLiveIndicators' => isset($showLiveIndicators) && $showLiveIndicators ? true : false,
                        'showUsername' => isset($showUsername) && $showUsername == false ? false : true,
                        ])
            @endforeach
        </div>
 
    </div>
</div>

<style>
    .aff_droite{
        display: none;
    }

    .aff_gauche {
        width: calc(100% - 40px);
    }
</style>
@else

<div class="aff_edit_info_form">
    <div class="aff_refferal_info">
        <div>
        {{__('Nos lives sont exclusifs pour connaître les prochaines diffusions de vos créateurs merci de vous abonner')}}
        </div>
    </div>
</div>

@endif
