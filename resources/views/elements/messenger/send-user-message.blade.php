<div class="modal fade" tabindex="-1" role="dialog" id="messageModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-default">
                    {{ isset($user) ?   __('Envoyer un message',['user' => $user->name]) :  __('Envoyer un message') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{__('Close')}}">

                    <svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                            opacity="0.352515811" stroke-linecap="round" stroke-linejoin="round">
                            <g id="8---Fil-d'actualité---Pourboire" transform="translate(-1101.000000, -248.000000)"
                                stroke="#000000">
                                <g id="Group-3" transform="translate(534.000000, 222.000000)">
                                    <g id="x-(4)" transform="translate(568.000000, 27.000000)">
                                        <line x1="12" y1="0" x2="0" y2="12" id="Path"></line>
                                        <line x1="0" y1="0" x2="12" y2="12" id="Path"></line>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="new-message-has-contacts">
                    <form id="userMessageForm" role="form" autocomplete="off">
                        <div class="mfv-errorBox"></div>
                    
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if(!isset($user))
                        <div class="aff_envoyer_a">
                              {{__('Destinataire')}}
                            </div>
                        <div class="input-holder aff_send_to_new_user">
                            <select id="select-repo" name="receiverID" class="repositories form-control input-sm"
                                placeholder="{{__('Selectionnez un destinataire')}}"></select>
                        </div>
                        <br />
                        @else
                        <input type="hidden" name="receiverID" value="{{$user->id}}">
                        @endif
                        <div class="form-group focused">
                            <div class="aff_envoyer_a">
                                {{__('Votre message')}}
                            </div>

                            <div class="input-holder aff_send_new_message_modal">
                                    <textarea  name="message" placeholder="{{__('Ex: Bonjour, je souhaite ...')}}"
                                        id="messageText"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit"
                        onclick="messenger.{{isset($user) ? 'sendDMFromProfilePage' : 'createConversation'}}()"
                        class="btn-primary btn mr-0 new-conversation-label mb-0"> 
                    {{__('Envoyer mon message')}}
                    </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
