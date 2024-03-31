<form action="{{ route('search.get')}}" class="search-box-wrapper w-100" method="GET">
    <span onclick="submitSearch();">
      
<svg width="17px" height="17px" viewBox="0 0 17 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
        <g id="Page-de-recherche" transform="translate(-554.000000, -133.000000)" stroke="#8E8E8E" stroke-width="2">
            <g id="input" transform="translate(534.000000, 114.000000)">
                <g id="search" transform="translate(21.000000, 20.000000)">
                    <circle id="Oval" cx="6.5" cy="6.5" r="6.5"></circle>
                    <line x1="15" y1="15" x2="11" y2="11" id="Path"></line>
                </g>
            </g>
        </g>
    </g>
</svg>
    </span>

    <input type="text"  aria-label="Text input with dropdown button"
        placeholder="{{__("Rechercher par pseudo , hashtag ou autres … ")}}" name="query" value="{{isset($searchTerm) && $searchTerm ? $searchTerm : ''}}">
    <input type="hidden" name="filter"
        value="{{isset($activeFilter) && $activeFilter !== false ? $activeFilter : 'top'}}" />

    @if(isset($searchFilters['gender']) && $searchFilters['gender'])
    <input type="hidden" name="gender" value="{{$searchFilters['gender']}}" />
    @endif

    @if(isset($searchFilters['min_age']) && $searchFilters['min_age'])
    <input type="hidden" name="min_age" value="{{$searchFilters['min_age']}}" />
    @endif

    @if(isset($searchFilters['max_age']) && $searchFilters['max_age'])
    <input type="hidden" name="max_age" value="{{$searchFilters['max_age']}}" />
    @endif

    @if(isset($searchFilters['location']) && $searchFilters['location'])
    <input type="hidden" name="location" value="{{$searchFilters['location']}}" />
    @endif

</form>
