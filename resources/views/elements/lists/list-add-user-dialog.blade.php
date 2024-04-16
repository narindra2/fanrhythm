
@php
    $modalId = "";
    if (isset($the_user_id)) {
        $modalId  = "-".$the_user_id;
    }
@endphp
<div class="modal fade" tabindex="-1" role="dialog" id='list-add-user-dialog{{ $modalId   }}'>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Ajouter cette utilisateur dans une liste
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    
            <svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" opacity="0.352515811" stroke-linecap="round" stroke-linejoin="round">
                    <g id="8---Fil-d'actualité---Pourboire" transform="translate(-1101.000000, -248.000000)" stroke="#000000">
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
                <div class="add-user-lists-wrapper">
                    @foreach($lists as $list)
                        <div class="form-check aff_user_list_name_add">
                            <div>
                                <input class="form-check-input input-group-lg pointer-cursor" data-listID="{{$list->id}}" type="checkbox" value="" {{ListsHelper::isMemberList($list->members, $the_user_id ?? $user_id) ? 'checked' : ''}} id="list-{{$list->id}}">
                                <label class="pointer-cursor" for="list-{{$list->id}}">
                                    <div>
                                    {{__($list->name)}}
                                    </div>
                                 
                                </label>
                            </div>
                            <svg width="7px" height="13px" viewBox="0 0 7 13" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                    <g id="17---Listes" transform="translate(-1117.000000, -217.000000)" stroke="#8E8E8E" stroke-width="2">
                                        <g id="Group" transform="translate(534.000000, 213.500000)">
                                            <polyline id="Path" points="584 15 589 10 584 5"></polyline>
                                        </g>
                                    </g>
                                </g>
                            </svg>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
            
            </div>
        </div>
    </div>
</div>
