
@php
    $notLockedPost = (Auth::check() && Auth::user()->id !== $post->user_id && $post->price > 0 && !PostsHelper::hasUserUnlockedPost($post->postPurchases)) 
    || (!Auth::check() && $post->price > 0 ) ||  (!Auth::check()) || (Auth::check() && !\App\Providers\ListsHelperServiceProvider::isUserFollowing(Auth::id(), $post->user_id))  ;
    $attachments = $post->attachments;
    $countAttchmt = count($attachments);
@endphp
@foreach ($attachments as $attachment)
    @php
        $attachment_type = AttachmentHelper::getAttachmentType($attachment->type);
    @endphp
    <div class="col-6 col-sm-4 p-0 " data-postId="{{$post->id}}" >
        <div class="pswp-gallery__item">
            @include('elements.feed.post-librairy-media',["attachment" => $attachment , "post" => $post])
            <div class="pswp-caption-content" >
                @include('elements.feed.post-librairy-user',["user" => $post->user])
                @include('elements.feed.post-librairy-text',["post" => $post])
            </div>
        </div>
    </div>
    {{-- @php
        if ($notLockedPost && $countAttchmt > 1) {
           break;
        }
    @endphp --}}
@endforeach
