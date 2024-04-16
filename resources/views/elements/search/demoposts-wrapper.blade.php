@if(count($demoposts))
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
</style>
    @if (Auth::check())
        @include('elements.lists.list-add-user-dialog', [
            'user_id' => 1,
            'lists' => ListsHelper::getUserLists(),
        ])
    @endif
@else

<div class="aff_edit_info_form">
    <div class="aff_refferal_info">
        <div>
        {{__('Pas de video de presentation trouvé')}}
        </div>
    </div>
</div>

@endif
