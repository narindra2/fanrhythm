<div class="modal fade" tabindex="-1" role="dialog" id="message-set-price-dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title mb-0">{{__('Set message price')}}</h5>
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
                <p>{{__('Paid messages are locked for subscribers as well. Text is not locked, only media.')}}</p>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="amount-label">@include('elements.icon',['icon'=>'cash-outline','variant'=>'medium'])</span>
                    </div>
                    <input id="message-price" type="number" class="form-control mb-0" name="text" required  placeholder="{{__('Post price')}}" value="{{getSetting('payments.min_ppv_content_price')??5}}" min="{{ getSetting('payments.min_ppv_content_price') ?? 5}}" max="{{getSetting('payments.max_ppv_content_price') ?? 10000000}}" step="5">
                    <span class="invalid-feedback" role="alert">
                        <strong>{{__('The price must be between :min and :max.',['min' => getSetting('payments.min_ppv_content_price') ?? 5, 'max' => getSetting('payments.max_ppv_content_price') ?? 10000000])}}</strong>
                    </span>
                </div>
            </div>
            <div class="modal-footer pr-4 pl-4 pt-2 pb-4">
                <button type="button" class="btn btn-white d-none" onclick="messenger.clearMessagePrice()">{{__('Clear')}}</button>
                <button type="button" class="btn btn-primary" onclick="messenger.saveMessagePrice()">{{__('Save')}}</button>
            </div>
        </div>
    </div>
</div>
