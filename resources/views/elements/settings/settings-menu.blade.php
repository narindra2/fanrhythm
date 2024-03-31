<div class="aff_menu_reglage_bloc">
  
    @foreach($availableSettings as $route => $setting)
    @if ($route !== "wallet")
        <a href="{{route('my.settings',['type'=> $route])}}" class="{{$activeSettingsTab == $route ? 'active' : ''}}">
            <div>
                <span id="reglage-{{ 'setting-' . $route }}" class="aff_reglage_icons">

                </span>
                {{ucfirst(__($route))}}

                <i id="agence-{{ 'setting-' . $route }}"></i>
            </div>


            <svg width="7px" height="12px" viewBox="0 0 7 12" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                    stroke-linejoin="round">
                    <g id="Reglages" transform="translate(-1117.000000, -357.000000)" stroke="#8E8E8E" stroke-width="2">
                        <polyline id="Path" points="1118 368 1123 363 1118 358"></polyline>
                    </g>
                </g>
            </svg>

        </a>  
    @endif
   
    
    @endforeach
    
    <style>
        i#agence-setting-referrals:before {
                content: "{{ __('Agence') }}";
                background: #32a0f0;
                margin-left: 10px;
                border-radius: 4px;
                font-style: normal;
                font-size: 12px;
                color: var(--base-color);
                padding: 3px 8px;
            }

   </style>

</div>


