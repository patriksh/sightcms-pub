{{-- Backpack admin panel Home block select field - modified select_from_array that loads the proper home block. --}}

@include('crud::fields.inc.wrapper_start')
    <label>{{ $field['label'] }}</label>
    <select
    	class="form-control"
        id="select_block"

    	@foreach ($field as $attribute => $value)
            @if (!is_array($value))
    		{{ $attribute }}="{{ $value }}"
            @endif
    	@endforeach
    	>

        @if (isset($field['allows_null']) && $field['allows_null']==true)
            <option value="">-</option>
        @endif

    	@if (count($field['options']))
    		@foreach ($field['options'] as $key => $value)
    			<option value="{{ $key }}"
					@if (isset($field['value']) && $key==$field['value'])
						 selected
					@endif
    			>{{ $value }}</option>
    		@endforeach
    	@endif
	</select>

    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- select_block crud field JS -->
        <script>
            function redirect_to_new_page_with_block_parameter() {
                var new_block = $("#select_block").val();
                var current_url = "{{ Request::url() }}";

                window.location.href = strip_last_block_parameter(current_url)+'?block='+new_block;
            }

            function strip_last_block_parameter(url) {
                // if it's a create or edit link with a block parameter
                if (url.indexOf("/create/") > -1 || url.indexOf("/edit/") > -1)
                {
                    // remove the last parameter of the url
                    var url_array = url.split('/');
                    url_array = url_array.slice(0, -1);
                    var clean_url = url_array.join('/');

                    return clean_url;
                }

                return url;
            }

            jQuery(document).ready(function($) {
                $('#select_block').data('current', $('#select_block').val());

                $("#select_block").change(function(e) {
                    var select_block_confirmation = confirm("Are you sure you want to change the home block? You will lose any unsaved modifications for this page.");
                    if (select_block_confirmation == true) {
                        redirect_to_new_page_with_block_parameter();
                    } else {
                        // txt = "You pressed Cancel!";
                        $('#select_block').val($('#select_block').data('current'));
                    }
                });

            });
        </script>
    @endpush
@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}