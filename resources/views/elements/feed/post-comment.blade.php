<div class="post-comment aff_user_comment" data-commentID="{{$comment->id}}">
    <img class="rounded-circle" src="{{$comment->author->avatar}}">

    <div>
        <a href="{{route('profile',['username'=>$comment->author->username])}}">{{$comment->author->username}}
        @if($comment->author->email_verified_at && $comment->author->birthdate &&
        ($comment->author->verification && $comment->author->verification->status == 'verified'))
        <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Verified user">
                                <svg style="fill: #59b8f7; height: 16px;" viewBox="0 0 22 22" aria-label="Compte certifié" role="img" data-testid="icon-verified"><g><path d="M20.396 11c-.018-.646-.215-1.275-.57-1.816-.354-.54-.852-.972-1.438-1.246.223-.607.27-1.264.14-1.897-.131-.634-.437-1.218-.882-1.687-.47-.445-1.053-.75-1.687-.882-.633-.13-1.29-.083-1.897.14-.273-.587-.704-1.086-1.245-1.44S11.647 1.62 11 1.604c-.646.017-1.273.213-1.813.568s-.969.854-1.24 1.44c-.608-.223-1.267-.272-1.902-.14-.635.13-1.22.436-1.69.882-.445.47-.749 1.055-.878 1.688-.13.633-.08 1.29.144 1.896-.587.274-1.087.705-1.443 1.245-.356.54-.555 1.17-.574 1.817.02.647.218 1.276.574 1.817.356.54.856.972 1.443 1.245-.224.606-.274 1.263-.144 1.896.13.634.433 1.218.877 1.688.47.443 1.054.747 1.687.878.633.132 1.29.084 1.897-.136.274.586.705 1.084 1.246 1.439.54.354 1.17.551 1.816.569.647-.016 1.276-.213 1.817-.567s.972-.854 1.245-1.44c.604.239 1.266.296 1.903.164.636-.132 1.22-.447 1.68-.907.46-.46.776-1.044.908-1.681s.075-1.299-.165-1.903c.586-.274 1.084-.705 1.439-1.246.354-.54.551-1.17.569-1.816zM9.662 14.85l-3.429-3.428 1.293-1.302 2.072 2.072 4.4-4.794 1.347 1.246z"></path></g></svg>
                                </span>
        @endif
        </a>

        <div class="text-break">{{$comment->message}}</div>
        <ul>
            <li>
                {{$comment->created_at->format('g:i A')}}
            </li>
            <li>
                @if (!is_null($comment->reactioafans))
                    {{ count($comment->reactioafans) }}
                @else
                    0
                @endif
                
                <svg width="13px" height="11px" viewBox="0 0 13 11" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                        <g id="Accueil---Publication" transform="translate(-547.000000, -1194.000000)" stroke="#9E9E9E">
                            <g id="heart-(1)" transform="translate(548.000000, 1195.000000)">
                                <path d="M10.5811075,0.88407253 C10.0153253,0.318024701 9.24780056,2.43579123e-16 8.44747587,2.43579123e-16 C7.64715117,2.43579123e-16 6.87962641,0.318024701 6.31384423,0.88407253 L5.73244332,1.46547344 L5.15104241,0.88407253 C3.97267019,-0.294299656 2.06215137,-0.294299642 0.883779162,0.884072562 C-0.294593042,2.06244477 -0.294593056,3.97296359 0.883779131,5.15133581 L1.46518004,5.73273672 L5.73244332,10 L9.9997066,5.73273672 L10.5811075,5.15133581 C11.1471553,4.58555363 11.46518,3.81802887 11.46518,3.01770417 C11.46518,2.21737948 11.1471553,1.44985471 10.5811075,0.88407253 Z" id="Path"></path>
                            </g>
                        </g>
                    </g>
                </svg>
            </li>
            <li>
                <a href="javascript:void(0)" onclick="Post.addReplyUser('{{$comment->author->username}}')"
                    class="text-muted">{{__('Répondre')}}</a>
            </li>
        </ul>


    </div>


    <div>
        @if(Auth::user()->id == $comment->author->id)
        <span class="react-button" data-toggle="tooltip" data-placement="top" title="{{__("Delete")}}"
            onclick="Post.showDeleteCommentDialog({{$comment->post->id}},{{$comment->id}})">

            <svg width="11px" height="12px" viewBox="0 0 11 12" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                    stroke-linejoin="round">
                    <g id="trash-(1)" transform="translate(1.000000, 1.000000)" stroke="#000000">
                        <polyline id="Path" points="0 2 1 2 9 2"></polyline>
                        <path
                            d="M8,2 L8,9 C8,9.55228475 7.55228475,10 7,10 L2,10 C1.44771525,10 1,9.55228475 1,9 L1,2 M2.5,2 L2.5,1 C2.5,0.44771525 2.94771525,0 3.5,0 L5.5,0 C6.05228475,0 6.5,0.44771525 6.5,1 L6.5,2"
                            id="Shape"></path>
                    </g>
                </g>
            </svg>
        </span>
        @else
        <span class="react-button {{PostsHelper::didUserReact($comment->reactions) ? 'active' : ''}}"
            data-toggle="tooltip" data-placement="top" title="{{__("Like")}}"
            onclick="Post.reactTo('comment',{{$comment->id}})">

            <svg width="13px" height="12px" viewBox="0 0 13 12" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                    stroke-linejoin="round">
                    <g id="Accueil---Publication" transform="translate(-1114.000000, -1128.000000)" stroke="#000000">
                        <g id="Group-4" transform="translate(534.000000, 114.000000)">
                            <g id="post-comment" transform="translate(9.000000, 1008.000000)">
                                <g id="coeur" transform="translate(572.000000, 7.000000)">
                                    <path
                                        d="M10.4421053,0.847368421 C9.89919779,0.304206036 9.16270423,-0.00096085326 8.39473684,-0.00096085326 C7.62676946,-0.00096085326 6.89027589,0.304206036 6.34736842,0.847368421 L5.78947368,1.40526316 L5.23157895,0.847368421 C4.10084859,-0.283361906 2.26757248,-0.283361893 1.13684214,0.847368452 C0.00611179145,1.9780988 0.00611177779,3.8113749 1.13684211,4.94210526 L1.69473684,5.5 L5.78947368,9.59473684 L9.88421053,5.5 L10.4421053,4.94210526 C10.9852676,4.39919779 11.2904345,3.66270423 11.2904345,2.89473684 C11.2904345,2.12676946 10.9852676,1.39027589 10.4421053,0.847368421 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
        </span>
        @endif


    </div>

</div>
