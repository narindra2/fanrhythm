<div class="modal fade" tabindex="-1" role="dialog" id="suggest-description-dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Suggest a description')}}</h5>
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
                <p>{{__('Use AI to generate your description.')}}</p>
                <div class="input-group">
                    <textarea id="ai-request" rows="6" type="text" class="form-control" name="text" required  placeholder="{{__('Add a few words about what your suggestion should be about')}}"></textarea>
                    <span class="invalid-feedback" role="alert">
                        <strong>{{__("Description must be at least 5 characters.")}}</strong>
                    </span>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-white mb-0" onclick="AiSuggestions.clearSuggestion()">{{__('Clear')}}</button>
                </div>
                <div>
                    <button type="button" class="btn btn-secondary mb-0 suggest-description" onclick="AiSuggestions.suggestDescription()">{{__('Suggest')}}</button>
                    <button type="button" class="btn btn-primary mb-0" onclick="AiSuggestions.saveSuggestion()">{{__('Save')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
