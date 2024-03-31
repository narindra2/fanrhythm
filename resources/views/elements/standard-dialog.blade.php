<div class="modal fade" tabindex="-1" role="dialog" id="{{$dialogName}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{__('Close')}}">
                    
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
                <p>{{$content}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" onclick="{{$actionFunction}}">{{$actionLabel}}</button>
            </div>
        </div>
    </div>
</div>
