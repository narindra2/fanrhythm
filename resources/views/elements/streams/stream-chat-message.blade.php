<div class="d-flex {{$streamOwnerId == Auth::user()->id ? '' : 'mb-1'}} stream-chat-message align-items-center {{isset($message) ? ' ' : 'stream-chat-message-template'}} {{$streamOwnerId == $message->user->id ? 'chat_is_owner justify-content-end pl-md-5 ml-md-4' : 'chat_is_not_owner pr-md-5 mr-md-4'}}" data-commentid="{{$message->id}}">
   <div class="chat-message-action d-none">
        <span class="h-pill h-pill-accent_del rounded " onClick="Stream.deleteComment({{$message->id}})">
        <ion-icon name="trash-outline" role="img" class="md hydrated" aria-label="trash outline"></ion-icon>
        </span>
    </div> 
    <div class="d-flex message_avatar_ui align-items-end">
        <a href="{{route('profile',['username'=>$message->user->id])}}" class="{{$streamOwnerId == $message->user->id ? 'd-none' : 'text-dak'}}">
           <img src="{{isset($message) ? $message->user->avatar : ''}}" alt="">
        </a>
        <div>
            <span class="{{$streamOwnerId == $message->user->id ? 'd-none' : 'text-dak'}} chat-message-user">
                <a href="{{route('profile',['username'=>$message->user->username])}}">
                {{isset($message) ? $message->user->username : ''}}
                </a>
            </span>

            <span class="chat-message-content">{{isset($message) ? $message->message : ''}}</span>
        </div>
    </div>
</div>

