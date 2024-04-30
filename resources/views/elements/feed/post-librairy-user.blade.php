<div class="aff_header_post">
    <a href="{{route('profile',['username'=>$post->user->username])}}">

        <img src="{{$post->user->avatar}}">
        {!! $post->user->getUserStatusHtml() !!}
        <div class="aff_info_name">
            <div>
                <span>
                    {{$post->user->name}}
                </span>
            </div>
            {{-- <div>
                <span>
                    <span>@</span>{{$post->user->username}}
                </span>
            </div> --}}
            <div>
                <span>
                   {{ convert_to_real_time_humains($post->created_at)}}
                </span>
            </div>
        </div>
    </a>
    <div>
        @if(Auth::check() && $post->user_id === Auth::user()->id && $post->status == 0)
            <span class="aff_pending">
                {{__('En attente')}}
            </span>
        @endif
        @if(Auth::check() && $post->user_id === Auth::user()->id && $post->price > 0)
            <span class="aff_ppv">
                {{ucfirst(__("PPV"))}}
            </span>
        @endif
        {{-- <a class="aff_post_date"  href="javascript:void(0)">{{$post->created_at->diffForHumans(null,false,true)}}</a> --}}
        <div  @if(!Auth::check()) onclick="goToRegister()"   @endif class="dropdown {{GenericHelper::getSiteDirection() == 'rtl' ? 'dropright' : 'dropleft'}}">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <svg width="5px" height="18px" viewBox="0 0 5 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
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
               
                @if(Auth::check())
                
                <a class="dropdown-item" href="javascript:void(0);"
                    onclick="Lists.showListManagementConfirmation('{{'unfollow'}}', {{$post->user->id}});">
                    {{__("Se désabonner")}}
                </a>
                <a class="dropdown-item" href="javascript:void(0);"
                    onclick="Lists.showListManagementConfirmation('{{'block'}}', {{$post->user->id}});">
                    {{__("Bloquer")}}
                </a>
                <a class="dropdown-item" href="javascript:void(0);"
                    onclick="Lists.showReportBox({{$post->user->id}},{{$post->id}});">
                    {{__("Signaler")}}
                </a>
                @if(Auth::check() && Auth::user()->id == $post->user->id)
                <a class="dropdown-item"
                    href="{{route('posts.edit',['post_id'=>$post->id])}}">
                    {{__("Modifier")}}
                </a>
                @if(!getSetting('compliance.minimum_posts_deletion_limit') ||
                (getSetting('compliance.minimum_posts_deletion_limit') > 0 && count($post->user->posts)
                > getSetting('compliance.minimum_posts_deletion_limit')))
                <a class="dropdown-item" href="javascript:void(0);"
                    onclick="Post.confirmPostRemoval({{$post->id}});">
                    {{__("Supprimer")}}
                </a>
                @endif
                @endif
                @endif
            </div>
        </div>
    </div>

</div>