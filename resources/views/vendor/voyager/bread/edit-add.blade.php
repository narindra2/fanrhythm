@php
    $edit = !is_null($dataTypeContent->getKey());
    $add = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.' . ($edit ? 'edit' : 'add')) . ' ' .
    $dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')

    <div class="aff_paddin_dash">
        <div class="mflit">
            <h1 class="page-title">
                {{ __('voyager::generic.' . ($edit ? 'edit' : 'add')) . ' ' . $dataType->getTranslatedAttribute('display_name_singular') }}
            </h1>
            <div>
                @include('voyager::multilingual.language-selector')
            </div>
        </div>
    </div>



@stop

@section('content')
    <div class="page-content browse aff_paddin_dash">
        <div>
            <div>

                <div>
                    <!-- form start -->
                    <form role="form" class="form-edit-add"
                        action="{{ $edit ? route('voyager.' . $dataType->slug . '.update', $dataTypeContent->getKey()) : route('voyager.' . $dataType->slug . '.store') }}"
                        method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if ($edit)
                            {{ method_field('PUT') }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-edit_afrifan">


                            <div class="afrifan_input_design">

                                @if ($dataType->slug == 'user-verifies')
                                    <div class="identity-files-preview itove">
                                        @foreach ($dataType->editRows as $row)
                                            @if ($row->field == 'files' && $dataTypeContent->{$row->field})
                                                <p class="control-label" for="name">
                                                    {{ __('Identification images preview') }}</p>
                                                @foreach (json_decode($dataTypeContent->{$row->field}) as $row)
                                                    <a href="{{ asset(Storage::url($row)) }}">
                                                        <img src="{{ asset(Storage::url($row)) }}" class="admin-id-asset" />
                                                    </a>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Adding / Editing -->
                                @php
                                    $dataTypeRows = $dataType->{$edit ? 'editRows' : 'addRows'};
                                @endphp
                                {{-- @dd($dataTypeRows) --}}
                                @foreach ($dataTypeRows as $row)
                                    <!-- GET THE DISPLAY OPTIONS -->
                                    <div id ="{{ $row->field }}">
                                        @php
                                            $display_options = $row->details->display ?? null;
                                            if ($dataTypeContent->{$row->field . '_' . ($edit ? 'edit' : 'add')}) {
                                                $dataTypeContent->{$row->field} =
                                                    $dataTypeContent->{$row->field . '_' . ($edit ? 'edit' : 'add')};
                                            }
                                            if ($dataType->slug == 'withdrawals') {
                                                // $dataTypeContent->amount_to_be_paid =  0;
                                            }
                                        @endphp
                                        @if (isset($row->details->legend) && isset($row->details->legend->text))
                                            <legend class="bread-label text-{{ $row->details->legend->align ?? 'center' }}"
                                                style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};">
                                                {{ $row->details->legend->text }}</legend>
                                        @endif

                                        <div class="@if ($row->type == 'hidden') hidden @endif {{ $errors->has($row->field) ? 'has-error' : '' }}"
                                            @if (isset($display_options->id)) {{ "id=$display_options->id" }} @endif>
                                            {{ $row->slugify }}
                                            <label class="afrifan_setting_label" for="name">
                                                @if ($row->field == 'created_at' && $dataType->slug == 'user-verifies')
                                                    Date of acceptance become a creator
                                                @else
                                                    {{ $row->getTranslatedAttribute('display_name') }}
                                                @endif
                                            </label>

                                            <div class="afrifan_input_type_ui">
                                                @include('voyager::multilingual.input-hidden-bread-edit-add')
                                                @if (isset($row->details->view))
                                                    @include($row->details->view, [
                                                        'row' => $row,
                                                        'dataType' => $dataType,
                                                        'dataTypeContent' => $dataTypeContent,
                                                        'content' => $dataTypeContent->{$row->field},
                                                        'action' => $edit ? 'edit' : 'add',
                                                        'view' => $edit ? 'edit' : 'add',
                                                        'options' => $row->details,
                                                    ])
                                                @elseif ($row->type == 'relationship')
                                                    @include('vendor.voyager.bread.relationship', [
                                                        'options' => $row->details,
                                                    ])
                                                @else
                                                    {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                                @endif

                                                @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                    {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                                @endforeach
                                                @if ($errors->has($row->field))
                                                    @foreach ($errors->get($row->field) as $error)
                                                        <span class="help-block">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div><!-- panel-body -->

                        </div>

                        <div class="afrifan_footer_button">
                        @section('submit-buttons')
                            <button type="submit"
                                class="btn-primary afri_btn_2 save">{{ __('voyager::generic.save') }}</button>
                        @stop
                        @yield('submit-buttons')
                    </div>
                </form>

                <iframe id="form_target" name="form_target" class="d-none"></iframe>
                <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                    enctype="multipart/form-data" class="edit-add-bread">
                    <input name="image" id="upload_file" type="file"
                        onchange="$('#my_form').submit();this.value='';">
                    <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-danger" id="confirm_delete_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
            </div>

            <div class="modal-body">
                <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                <button type="button" class="btn btn-danger"
                    id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Delete File Modal -->
@stop

@section('javascript')
<script>
    var params = {};
    var $file;

    function deleteHandler(tag, isMulti) {
        return function() {
            $file = $(this).siblings(tag);

            params = {
                slug: '{{ $dataType->slug }}',
                filename: $file.data('file-name'),
                id: $file.data('id'),
                field: $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
        };
    }

    $('document').ready(function() {
        $('.toggleswitch').bootstrapToggle();

        //Init datepicker for date fields if data-datepicker attribute defined
        //or if browser does not handle date inputs
        $('.form-group input[type=date]').each(function(idx, elt) {
            if (elt.hasAttribute('data-datepicker')) {
                elt.type = 'text';
                $(elt).datetimepicker($(elt).data('datepicker'));
            } else if (elt.type != 'date') {
                elt.type = 'text';
                $(elt).datetimepicker({
                    format: 'L',
                    extraFormats: ['YYYY-MM-DD']
                }).datetimepicker($(elt).data('datepicker'));
            }
        });

        @if ($isModelTranslatable)
            $('.side-body').multilingual({
                "editing": true
            });
        @endif

        $('.side-body input[data-slug-origin]').each(function(i, el) {
            $(el).slugify();
        });

        $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
        $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
        $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
        $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

        $('#confirm_delete').on('click', function() {
            $.post('{{ route('voyager.' . $dataType->slug . '.media.remove') }}', params, function(
                response) {
                if (response &&
                    response.data &&
                    response.data.status &&
                    response.data.status == 200) {

                    toastr.success(response.data.message);
                    $file.parent().fadeOut(300, function() {
                        $(this).remove();
                    })
                } else {
                    toastr.error("Error removing file.");
                }
            });

            $('#confirm_delete_modal').modal('hide');
        });
        $('[data-toggle="tooltip"]').tooltip();
        /** withdrawals edit */ 
        if ($("#fee").length && $("#amount").length) {
            let amount_to_pay =  parseFloat($("[name='amount']").val() - $("[name='fee']").val()).toFixed(2); ;
            $(`
                <div id="amount_to_pay">
                    <div class=" ">
                        <label class="afrifan_setting_label" for="name">  Amount to be paid </label>
                        <div class="afrifan_input_type_ui">
                            <input type="text" class="form-control" name="fee" placeholder="Fee" value="${amount_to_pay}">
                        </div>
                    </div>
                </div>
                
                `).insertAfter("#fee");
        }

    });
</script>
@stop
