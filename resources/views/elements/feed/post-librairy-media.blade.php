@if((Auth::check() && Auth::user()->id !== $post->user_id && $post->price > 0 && !PostsHelper::hasUserUnlockedPost($post->postPurchases)) || (!Auth::check() && $post->price > 0 ))

    <a  href="{{asset('/img/no-post.png')}}" data-pswp-width="2500" data-pswp-height="1666"  target="_blank">
        <img src="{{asset('/img/no-post.png')}}"  class="image-item"  alt="image" />
     </a>
@else
<a  href="{{ $attachment->path }}" data-pswp-width="2500" data-pswp-height="1666"  target="_blank">
    <img src="{{ $attachment->path }}"  class="image-item"  alt="image" />
    {{-- <span class="pswp-caption-content">Caption content</span> --}}
 </a>
@endif

 