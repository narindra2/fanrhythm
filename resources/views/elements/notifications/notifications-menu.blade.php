<div class="aff_profil_tab aff_profil_tab_no_padding notif_blade">
    <div>
        <a class="{{!$activeType ? 'active' : ''}}" href="{{route('my.notifications')}}">
            <div>
                {{__('Toutes')}}
            </div>
        </a>
    </div>
    @foreach($notificationTypes as $type)
    <div>
        <a class=" {{$activeType == $type ? 'active' : ''}}" href="{{route('my.notifications',['type' => $type])}}">
            <div>
                {{__(ucfirst($type))}}
            </div>
        </a>
    </div>
    @endforeach
</div>
