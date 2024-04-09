@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photoswipe@5.3.0/dist/photoswipe.css">
@stop
@if(count($posts))
    <div class="pswp-gallery " id="gallery">
        <div class="row m-0 posts-wrapper">
            @foreach($posts as $post)
                @include('elements.feed.post-library-post', ["post" => &$post])
            @endforeach
        </div>
    </div>
    @include('elements.report-user-or-post',['reportStatuses' => ListsHelper::getReportTypes()])
    @include('elements.feed.post-delete-dialog')
    @include('elements.feed.post-list-management')
    @include('elements.feed.post-librairy-js-and-css')


@endif

