@if((Auth::check() && Auth::user()->id !== $post->user_id && $post->price > 0 && !PostsHelper::hasUserUnlockedPost($post->postPurchases)) || (!Auth::check() && $post->price > 0 ))
    <a  href="{{asset('/img/no-post.png')}}" data-pswp-width="2000" data-pswp-height="1666"  target="_blank">
        <img src="{{asset('/img/no-post.png')}}"  class="image-item"  alt="image" />
     </a>
@else
     @php
           $attachment_type = AttachmentHelper::getAttachmentType($attachment->type);
     @endphp

     @if ($attachment_type =="image")
        <a  href="{{ $attachment->path }}" data-pswp-width="2500" data-pswp-height="1666"  target="_blank">
            <img src="{{ $attachment->path }}"  class="image-item"  alt="image" />
        </a>
     @endif
     @if ($attachment_type =="video")
      <a href="#" 
           {{-- data-pswp-video-src="https://web.fanrhythm.com/storage/posts/videos/7e0e69f262774adeab02b849f32620a1.mp4" --}}
           data-pswp-video-src="{{ $attachment->path }}"
            data-pswp-width="900"
            data-pswp-height="600"
            data-pswp-type="video">
            <video width="960" class="pswp__video image-item" src="{{ $attachment->path }}" controls></video>
        </a>
     @endif
    
    
@endif

 