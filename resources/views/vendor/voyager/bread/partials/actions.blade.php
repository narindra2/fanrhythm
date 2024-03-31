@if($data)
    @php
                // need to recreate object because policy might depend on record data
                $class = get_class($action);
                $action = new $class($dataType, $data);
    @endphp
    @can ($action->getPolicy(), $data)
        @if ($action->shouldActionDisplayOnRow($data))
            @if($action instanceof \TCG\Voyager\Actions\ViewAction and $dataType->name === 'invoices' and isset($data->id))
                <a target="_blank" href="{{ route('invoices.get', ['id' => 1]) }}" title="{{ $action->getTitle() }}">
                {{ $action->getTitle() }}
                </a>
            @else
                <a href="{{ $action->getRoute($dataType->name) }}" title="{{ $action->getTitle() }}">
                {{ $action->getTitle() }}
                </a>
            @endif
        @endif
    @endcan
@elseif (method_exists($action, 'massAction'))
    <form method="post" action="{{ route('voyager.'.$dataType->slug.'.action') }}" style="display:inline">
        {{ csrf_field() }}
        <button type="submit"> {{ $action->getTitle() }}</button>
        <input type="hidden" name="action" value="{{ get_class($action) }}">
        <input type="hidden" name="ids" value="" class="selected_ids">
    </form>
@endif
