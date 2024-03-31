@foreach($devices as $device)
@if( ($type == 'verified' && $device->verified_at) || ($type == 'unverified' && !$device->verified_at) )
<div class="aff_device_list">

    <div>
        <span data-toggle="tooltip" data-placement="top" title="{{__($device->device_type)}}">
            @switch($device->device_type)
            @case('Desktop')
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-monitor">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                <line x1="8" y1="21" x2="16" y2="21"></line>
                <line x1="12" y1="17" x2="12" y2="21"></line>
            </svg>

            @break
            @case('Mobile')

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-smartphone">
                <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                <line x1="12" y1="18" x2="12.01" y2="18"></line>
            </svg>

            @break
            @case('Tablet')

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-tablet">
                <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                <line x1="12" y1="18" x2="12.01" y2="18"></line>
            </svg>

            @break
            @endswitch
        </span>


        <div>
            <div>
            {{$device->browser}} {{__("on")}} {{$device->platform}}
            </div>
            <div>
                Denière connexion {{$device->created_at}}
            </div>
        </div>
    </div>

    <span
                onclick="PrivacySettings.showDeviceDeleteConfirmation('{{$device->signature}}')">
                @include('elements.icon',['icon'=>'close-outline'])
            </span>

</div>

@endif
@endforeach
