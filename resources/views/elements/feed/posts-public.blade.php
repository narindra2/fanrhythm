
@foreach ($post->attachments as $attachement)
    <div class="col-6 col-sm-4 p-0 ">
        <div class="gallery">
            <a href="{{route('profile',['username'=>$post->user->username])}}">
                <img src="{{$attachement->path}}" class="image-item" alt="image">
            </a>
        </div>
    </div>
@endforeach
<style>
.gallery {
    margin: 0 4px 4px 0;
}
.image-item {
    width: 100%;
    height: 150px;
    object-fit: cover;
}
</style>