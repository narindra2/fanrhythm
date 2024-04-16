<div class="aff_post_block post-box" data-postID="{{ $video->id }}">

    <div class="aff_header_post">
        <a href="{{ route('profile', ['username' => $video->user->username]) }}">
            <img src="{{ $video->user->avatar }}">
            <div class="aff_info_name">
                <div>
                    <span>
                        {{ $video->user->name }}
                    </span>
                </div>
                <div>
                    <span>
                        <span>@</span>{{ $video->user->username }}
                    </span>
                </div>
            </div>
        </a>
        <div>
            {{-- @if (Auth::check() && $video->user_id === Auth::user()->id && $video->status == 0)
            <span class="aff_pending">
                {{__('En attente')}}
            </span>
            @endif
            @if (Auth::check() && $video->user_id === Auth::user()->id && $video->price > 0)
            <span class="aff_ppv">
                {{ucfirst(__("PPV"))}}
            </span>
            @endif --}}

            {{-- <a class="aff_post_date" @if (!Auth::check()) onclick="goToRegister()" @else
                onclick="PostsPaginator.goToPostPageKeepingNav({{$video->id}},{{$video->postPage}},'{{route('posts.get',['post_id'=>$video->id,'username'=>$video->user->username])}}')"
                @endif href="javascript:void(0)">{{$video->created_at->diffForHumans(null,false,true)}}
            </a> --}}
           
              <span class="pointer-cursor" style="padding-bottom: 4px;" data-toggle="tooltip" data-placement="top" title="{{ __('Add to your lists') }}" onclick="Lists.showListAddModal({{ $video->user->id }});">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                  </svg>
            </span>
            <div @if (!Auth::check()) onclick="goToRegister()" @endif class="dropdown {{GenericHelper::getSiteDirection() == 'rtl' ? 'dropright' : 'dropleft'}}">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <svg width="5px" height="15px" viewBox="0 0 5 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="post" transform="translate(-584.000000, -24.000000)" fill="#9E9E9E" stroke="#9E9E9E"
                                stroke-width="2.5">
                                <g id="date" transform="translate(443.000000, 24.000000)">
                                    <g id="more-horizontal"
                                        transform="translate(143.000000, 9.000000) rotate(90.000000) translate(-143.000000, -9.000000) translate(136.000000, 8.000000)">
                                        <circle id="Oval" cx="7" cy="0.875" r="1"></circle>
                                        <circle id="Oval" cx="13.125" cy="0.875" r="1"></circle>
                                        <circle id="Oval" cx="0.875" cy="0.875" r="1"></circle>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
                
                <div class="dropdown-menu">
                    @if (Auth::check())
                        <a class="dropdown-item" href="javascript:void(0);"
                            onclick="Lists.showListManagementConfirmation('{{'unfollow'}}', {{$video->user->id}});">
                            {{__("Se désabonner")}}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);"
                            onclick="Lists.showListManagementConfirmation('{{'block'}}', {{$video->user->id}});">
                            {{__("Bloquer")}}
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);"
                            onclick="Lists.showReportBox({{$video->user->id}},{{$video->id}});">
                            {{__("Signaler")}}
                        </a>
                        {{-- @if (Auth::check() && Auth::user()->id == $video->user->id)
                            <a class="dropdown-item" href="{{route('posts.edit',['post_id'=>$video->id])}}">
                                {{__("Modifier")}}
                            </a>
                            @if (!getSetting('compliance.minimum_posts_deletion_limit') || (getSetting('compliance.minimum_posts_deletion_limit') > 0 && count($video->user->posts) > getSetting('compliance.minimum_posts_deletion_limit')))
                                <a class="dropdown-item" href="javascript:void(0);"
                                    onclick="Post.confirmPostRemoval({{$video->id}});">
                                    {{__("Supprimer")}}
                                </a>
                            @endif
                        @endif --}}
                    @endif
                </div>
            </div>
        </div>

    </div>
    {{-- @if ($video->moderationStatus == $Moderation::STATUS_DECLINED)
    <div class="aff_post_text">
        <span class="text-danger "> * {{ __("Ce post ne respecte pas nos normes de modération et ne peut pas être
            publié") }}</span>
    </div>
    @endif --}}
    {{-- @if ($video->moderationStatus == $Moderation::STATUS_PENDING)
    <div class="aff_post_text">
        <span class="text-danger "> * {{ __("En attent de validation contenue média") }}</span>
    </div>
    @endif --}}

    {{-- @if (isset($video->text))
    <div class="aff_post_text">
        {!! nl2br(e($video->text)) !!}
    </div>
    @endif --}}

    @php
        $images = json_decode($video->images, true);
    @endphp
    @if (is_array($images))
        @foreach ($images as $image)
            <div class="post-media">
                <video controls class="d-block w-100 mb-2 videocontrol">
                    <source src='{{ url("storage/public/images/$image") }} ' type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endforeach
    @endif
    <div class="post-footer aff_footer_post">
        
    </div>
</div>
@if (Auth::check())
    @include('elements.lists.list-add-user-dialog', ['user_id' =>  $video->user->id,'the_user_id' =>  $video->user->id, 'lists' => $lists ])
@endif

