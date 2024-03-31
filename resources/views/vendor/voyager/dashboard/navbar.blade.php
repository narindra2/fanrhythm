<div id="afrifan_dashboard_navbar">

    <button class="hamburger btn-link">

        <svg width="7px" height="12px" viewBox="0 0 7 12" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" opacity="0.277157738"
                stroke-linecap="round" stroke-linejoin="round">
                <g id="Color-logo---no-background" transform="translate(-258.000000, -25.000000)" stroke="#000000"
                    stroke-width="2">
                    <g id="chevron-right"
                        transform="translate(261.500000, 31.000000) scale(-1, 1) translate(-261.500000, -31.000000) translate(259.000000, 26.000000)">
                        <polyline id="Path" points="0 10 5 5 0 0"></polyline>
                    </g>
                </g>
            </g>
        </svg>
    </button>


    <div class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            <img src="{{ $user_avatar }}" class="profile-img">
            <div>
                <div>
                    {{ Auth::user()->name }}
                </div>
                <div>
                    {{ Auth::user()->email }}
                </div>
            </div>

            
            <svg width="10px" height="6px" viewBox="0 0 10 6" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                        stroke-linecap="round" stroke-linejoin="round">
                        <g id="Color-logo---no-background" transform="translate(-1616.000000, -30.000000)"
                            stroke="#000000" stroke-width="2">
                            <g id="chevron-down" transform="translate(1617.000000, 31.000000)">
                                <polyline id="Path" points="0 0 4 4 8 0"></polyline>
                            </g>
                        </g>
                    </g>
                </svg>

        </a>
        <ul class="dropdown-menu">
            <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
            
            @if(is_array($nav_items) && !empty($nav_items))

            @foreach($nav_items as $name => $item)


            <li {!! isset($item['classes']) && !empty($item['classes']) ? 'class="' .$item['classes'].'"' : '' !!}>
                @if(isset($item['route']) && $item['route'] == 'voyager.logout')
                <form action="{{ route('voyager.logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit">
                       Se déconnecter
                    </button>
                </form>
                @else
                <a href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#') }}"
                    {!! isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : '' !!}>
                    @if(isset($item['icon_class']) && !empty($item['icon_class']))
                    <i class="{!! $item['icon_class'] !!}"></i>
                    @endif
                    {{__($name)}}
                </a>
                @endif
            </li>
            @endforeach
            @endif
        </ul>
    </div>
</div>
