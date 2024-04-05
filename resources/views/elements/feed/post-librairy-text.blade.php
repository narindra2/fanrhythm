@if (isset($post->text))
    <div class="aff_post_text">
    {!! nl2br(e($post->text)) !!}
    </div>
@endif
