@if(count($posts))
@foreach($posts as $post)
    @include('elements.feed.post-box')
@endforeach
    @include('elements.report-user-or-post',['reportStatuses' => ListsHelper::getReportTypes()])
    @include('elements.feed.post-delete-dialog')
    @include('elements.feed.post-list-management')
    @include('elements.photoswipe-container')
@else

@endif




