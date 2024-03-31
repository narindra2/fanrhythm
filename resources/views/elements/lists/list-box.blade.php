<a href="{{route('my.lists.show', ['list_id'=> $list->id])}}">
    <div>
        {{__($list->name)}}
    </div>
    <svg width="7px" height="12px" viewBox="0 0 7 12" version="1.1" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
            stroke-linejoin="round">
            <g id="Listes" transform="translate(-1117.000000, -145.000000)" stroke="#8E8E8E" stroke-width="2">
                <g id="Group" transform="translate(534.000000, 117.500000)">
                    <polyline id="Path" points="584 38.5 589 33.5 584 28.5"></polyline>
                </g>
            </g>
        </g>
    </svg>
</a>


@if(!$isLastItem)

@endif
