<div class="aff_post_comment_form">
    <div>
        <img class="rounded-circle" src="{{Auth::user()->avatar}}">

        <div class="input-group">
            <textarea name="message" class="form-control comment-textarea comment-text"
                placeholder="{{__('Ajouter un commentaire ...')}}" onkeyup="textAreaAdjust(this)"></textarea>
            <div class="input-group-append z-index-3 d-flex align-items-center justify-content-center">
                <span class="h-pill rounded trigger" data-toggle="tooltip" data-placement="top"
                    title="Like">

                    <svg width="17px" height="17px" viewBox="0 0 17 17" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            stroke-linecap="round" stroke-linejoin="round">
                            <g id="Accueil---Publication" transform="translate(-1063.000000, -1260.000000)"
                                stroke="#000000">
                                <g id="Group-4" transform="translate(534.000000, 114.000000)">
                                    <g id="Group-3" transform="translate(15.000000, 1129.000000)">
                                        <g id="smile" transform="translate(515.000000, 18.000000)">
                                            <circle id="Oval" cx="7.5" cy="7.5" r="7.5"></circle>
                                            <path d="M4.5,9 C4.5,9 5.625,10.5 7.5,10.5 C9.375,10.5 10.5,9 10.5,9"
                                                id="Path"></path>
                                            <line x1="5.25" y1="5.25" x2="5.2575" y2="5.25" id="Path"></line>
                                            <line x1="9.75" y1="5.25" x2="9.7575" y2="5.25" id="Path"></line>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </span>
            </div>
            <span class="invalid-feedback text-bold" role="alert"></span>
        </div>

        <button onclick="Post.addComment({{$post->id}})">

            <svg width="15px" height="15px" viewBox="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round"
                    stroke-linejoin="round">
                    <g id="Accueil---Publication" transform="translate(-1091.000000, -1262.000000)" stroke="#000000">
                        <g id="Group-4" transform="translate(534.000000, 114.000000)">
                            <g id="Group-3" transform="translate(15.000000, 1129.000000)">
                                <g id="send-(1)" transform="translate(543.000000, 20.000000)">
                                    <line x1="13" y1="0" x2="5.85" y2="7.15" id="Path"></line>
                                    <polygon id="Path" points="13 0 8.45 13 5.85 7.15 0 4.55"></polygon>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
        </button>
    </div>
</div>