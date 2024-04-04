@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.3.0/dist/photoswipe.css">
@stop
@if(count($posts))
    <div class="pswp-gallery " id="gallery">
    <div class="row m-0">
        @foreach($posts as $post)
            @foreach ($post->attachments as $attachment)
            <div class="col-6 col-sm-4 p-0">
                <div class="pswp-gallery__item">
                    @include('elements.feed.post-librairy-media',["attachment" => $attachment])
                    <div class="pswp-caption-content">
                        @include('elements.feed.post-librairy-user',["user" => $user])
                        @include('elements.feed.post-librairy-text',["post" => $post])
                    </div>
                </div>
            </div>
            @endforeach
        @endforeach
    </div>
</div>
        @include('elements.report-user-or-post',['reportStatuses' => ListsHelper::getReportTypes()])
        @include('elements.feed.post-delete-dialog')
        @include('elements.feed.post-list-management')
        @include('elements.feed.post-librairy-js-and-css')
@endif

