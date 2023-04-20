{{-- Backpack admin panel WYSIWYG field - my implementation of tinyMCE. --}}

@php
    $field['value'] = old_empty_or_null($field['name'], '') ?? ($field['value'] ?? ($field['default'] ?? ''));
@endphp

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    <textarea
        name="{{ $field['name'] }}"
        data-init-function="bpFieldInitWysiwyg"
        @include('crud::fields.inc.attributes')>{{ $field['value'] }}</textarea>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

{{-- CUSTOM JS --}}
@push('crud_fields_scripts')
    @loadOnce('wysiwyg_tinymce')
        <script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            function bpFieldInitWysiwyg(element) {
                tinymce.init({
                    target: element.get(0),
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                });
            }
        </script>
    @endLoadOnce
@endpush
