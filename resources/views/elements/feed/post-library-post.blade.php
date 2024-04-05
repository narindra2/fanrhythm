@foreach ($post->attachments as $attachment)
    <div class="col-6 col-sm-4 p-0 ">
        <div class="pswp-gallery__item">
            @include('elements.feed.post-librairy-media',["attachment" => $attachment])
            <div class="pswp-caption-content">
                @include('elements.feed.post-librairy-user',["user" => $post->user])
                @include('elements.feed.post-librairy-text',["post" => $post])
                <div class="post-footer aff_footer_post">
                    <div>
                        <div>
                            {{-- Likes --}}
                            @if($post->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') &&  $post->user->open_profile))
                            <div class="react-button {{PostsHelper::didUserReact($post->reactions) ? 'active' : ''}}"
                                data-toggle="tooltip" data-placement="top" title="{{__('Like')}}"
                                onclick="Post.reactTo('post',{{$post->id}})">
            
                                <svg width="21px" height="18px" viewBox="0 0 21 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <g id="post" transform="translate(-16.000000, -785.000000)" stroke="#000000"
                                            stroke-width="2">
                                            <g id="coeur" transform="translate(17.000000, 786.000000)">
                                                <path
                                                    d="M16.7073684,1.35578947 C15.8387165,0.486729657 14.6603268,-0.00153736522 13.4315789,-0.00153736522 C12.2028311,-0.00153736522 11.0244414,0.486729657 10.1557895,1.35578947 L9.26315789,2.24842105 L8.37052632,1.35578947 C6.56135774,-0.45337905 3.62811597,-0.453379028 1.81894742,1.35578952 C0.00977886632,3.16495807 0.00977884447,6.09819984 1.81894737,7.90736842 L2.71157895,8.8 L9.26315789,15.3515789 L15.8147368,8.8 L16.7073684,7.90736842 C17.5764282,7.03871646 18.0646953,5.86032676 18.0646953,4.63157895 C18.0646953,3.40283113 17.5764282,2.22444143 16.7073684,1.35578947 Z"
                                                    id="Path"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
            
                                <svg width="21px" height="18px" viewBox="0 0 21 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Group" transform="translate(-16.000000, -785.000000)" fill="#FA5454" stroke="#FA5454"
                                            stroke-width="2">
                                            <g id="coeur" transform="translate(17.000000, 786.000000)">
                                                <path
                                                    d="M16.7073684,1.35578947 C15.8387165,0.486729657 14.6603268,-0.00153736522 13.4315789,-0.00153736522 C12.2028311,-0.00153736522 11.0244414,0.486729657 10.1557895,1.35578947 L9.26315789,2.24842105 L8.37052632,1.35578947 C6.56135774,-0.45337905 3.62811597,-0.453379028 1.81894742,1.35578952 C0.00977886632,3.16495807 0.00977884447,6.09819984 1.81894737,7.90736842 L2.71157895,8.8 L9.26315789,15.3515789 L15.8147368,8.8 L16.7073684,7.90736842 C17.5764282,7.03871646 18.0646953,5.86032676 18.0646953,4.63157895 C18.0646953,3.40283113 17.5764282,2.22444143 16.7073684,1.35578947 Z"
                                                    id="Path"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            @else
                            {{-- <div class="disabled" data-toggle="tooltip" data-placement="top" title=""
                                data-original-title="{{ _('Abonnez-vous à moi') }}" --}} <div class="disabled" data-toggle="modal"
                                data-target="#subrcribe-dialog" data-toggle="tooltip" @if (!Auth::check() ) onclick="goToRegister()"
                                @endif>
                                <svg width="21px" height="18px" viewBox="0 0 21 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <g id="post" transform="translate(-16.000000, -785.000000)" stroke="#000000"
                                            stroke-width="2">
                                            <g id="coeur" transform="translate(17.000000, 786.000000)">
                                                <path
                                                    d="M16.7073684,1.35578947 C15.8387165,0.486729657 14.6603268,-0.00153736522 13.4315789,-0.00153736522 C12.2028311,-0.00153736522 11.0244414,0.486729657 10.1557895,1.35578947 L9.26315789,2.24842105 L8.37052632,1.35578947 C6.56135774,-0.45337905 3.62811597,-0.453379028 1.81894742,1.35578952 C0.00977886632,3.16495807 0.00977884447,6.09819984 1.81894737,7.90736842 L2.71157895,8.8 L9.26315789,15.3515789 L15.8147368,8.8 L16.7073684,7.90736842 C17.5764282,7.03871646 18.0646953,5.86032676 18.0646953,4.63157895 C18.0646953,3.40283113 17.5764282,2.22444143 16.7073684,1.35578947 Z"
                                                    id="Path"></path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            @endif
                        </div>
            
            
                        <div>
                            <a href="#">
                                <span>{{count($post->reactions)}}</span>
                                {{trans_choice('likes', count($post->reactions))}}
                            </a>
            
                            @if($post->isSubbed || (Auth::check() && getSetting('profiles.allow_users_enabling_open_profiles') &&
                            $post->user->open_profile))
                            <a
                                href="{{Route::currentRouteName() != 'posts.get' ? route('posts.get',['post_id'=>$post->id,'username'=>$post->user->username]) : '#comments'}}">
                                <span>
                                    {{count($post->comments)}}
                                </span>
                                {{trans_choice('comments', count($post->comments))}}
                            </a>
                            @else
                            <a href="#" data-toggle="modal" data-target="#subrcribe-dialog" data-toggle="tooltip"
                                @if(!Auth::check()) onclick="goToRegister()" @endif>
                                <span>
                                    {{count($post->comments)}}
                                </span>
                                {{trans_choice('comments', count($post->comments))}}
                                </span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
@endforeach
