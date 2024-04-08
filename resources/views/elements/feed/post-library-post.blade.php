@foreach ($post->attachments as $attachment)
    <div class="col-6 col-sm-4 p-0 " data-postId="{{$post->id}}" >
        <div class="pswp-gallery__item">
            
            @include('elements.feed.post-librairy-media',["attachment" => $attachment , "post" => $post])
            <div class="pswp-caption-content" >
                @include('elements.feed.post-librairy-user',["user" => $post->user])
                @include('elements.feed.post-librairy-text',["post" => $post])
            </div>
            {{-- <span class="pswp__custom-caption  ">Caption content</span> --}}
        </div>
    </div>
@endforeach
