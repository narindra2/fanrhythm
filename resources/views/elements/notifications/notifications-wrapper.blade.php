<div class="notifications-wrapper">
    @if(count($notifications))
    @foreach($notifications as $notification)
            @include('elements.notifications.notification-box', ['notification' => $notification])
            @if(!$loop->last)
           
            @endif
        @endforeach
       
        {{ $notifications->onEachSide(1)->links() }}

    @else
       <p>
       {{__('Aucune notification pour le moment')}}
       </p>
    @endif
</div>
