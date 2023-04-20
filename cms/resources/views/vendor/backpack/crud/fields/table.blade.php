{{-- Backpack admin panel Table field - a combination of my own implementation with some code from old Backpack version. --}}

@php
    $field['value'] = old_empty_or_null($field['name'], '') ?? ($field['value'] ?? ($field['default'] ?? ''));

    $field['min'] = $field['min'] ?? 0;
    $field['max'] = $field['max'] ?? 100;
    $field['columns'] = $field['columns'] ?? [];
@endphp

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    <input class="array-json" type="hidden" data-init-function="bpFieldInitTableElement" name="{{ $field['name'] }}" value="{{ $field['value'] }}" data-min="{{ $field['min'] }}" data-max="{{ $field['max'] }}" data-maxerrortitle="Cannot add new subentry" data-maxerrormessage="Maximum number of {{ $field['max'] }} reached">

    <div class="array-container form-group">
        <table class="table table-sm table-striped m-b-0">
            <thead>
                <tr>
                    @foreach ($field['columns'] as $column)
                        <th style="font-weight: 600">{{ $column }}</th>
                    @endforeach
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody class="table-striped items sortableOptions ui-sortable">
                <tr class="array-row clonable" style="display: none;">
                    @foreach ($field['columns'] as $columnId => $column)
                        <td>
                            <input class="form-control form-control-sm" type="text" data-cell-name="item.{{ $columnId }}">
                        </td>
                    @endforeach
                    <td>
                        <span class="btn btn-sm btn-light sort-handle pull-right ui-sortable-handle">
                            <span class="sr-only">sort item</span>
                            <i class="la la-sort" role="presentation" aria-hidden="true"></i>
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-light removeItem" type="button">
                            <span class="sr-only">delete item</span>
                            <i class="la la-trash" role="presentation" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="array-controls btn-group m-t-10">
            <button class="btn btn-sm btn-light" type="button" data-button-type="addItem">
                <i class="la la-plus"></i> Add subentry </button>
        </div>
    </div>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

{{-- CUSTOM JS --}}

@push('crud_fields_scripts')

    @loadOnce('bpFieldInitTableElement')
    <script src="{{ asset('packages/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script>
        function bpFieldInitTableElement(element) {
            var $tableWrapper = element.parent('[bp-field-type=table]');
            var $rows = (element.attr('value') != '') ? $.parseJSON(element.attr('value')) : '';
            var $max = element.attr('data-max');
            var $min = element.attr('data-min');
            var $maxErrorTitle = element.attr('data-maxErrorTitle');
            var $maxErrorMessage = element.attr('data-maxErrorMessage');
            var $addButton = $tableWrapper.find('[data-button-type=addItem]')

            // add rows with the information from the database
            if($rows != '[]') {
                $.each($rows, function(key) {
                    addItem();

                    $.each(this, function(column , value) {
                        $tableWrapper.find('tbody tr:last').find('input[data-cell-name="item.' + column + '"]').val(value);
                    });

                    // if it's the last row, update the JSON
                    if ($rows.length == key+1) {
                        updateTableFieldJson();
                    }
                });
            }

            // add minimum rows if needed
            var items = $tableWrapper.find('tbody tr').not('.clonable');
            if($min > 0 && items.length < $min) {
                $rowsToAdd = Number($min) - Number(items.length);

                for(var i = 0; i < $rowsToAdd; i++){
                    addItem();
                }
            }

            items = $tableWrapper.find('tbody tr').not('.clonable');
            if($max > -1 && items.length == $max) {
                $addButton.hide();
            }

            // after adding previous values and min rows, update the row action buttons
            updateTableRowsActionButtons(items)

            $tableWrapper.find('.sortableOptions').sortable({
                handle: '.sort-handle',
                axis: 'y',
                helper: function(e, ui) {
                    ui.children().each(function() {
                        $(this).width($(this).width());
                    });
                    return ui;
                },
                update: function( event, ui ) {
                    updateTableFieldJson();
                }
            });

            $addButton.click(function() {                    
                addItem();
                updateTableFieldJson();

                let totalRows = $tableWrapper.find('tbody tr').not('.clonable');
                let totalCount = $tableWrapper.find('tbody tr').not('.clonable').length;
                // hide the add button when max is reached.
                if (totalCount == $max) {
                    $addButton.hide();
                }
                updateTableRowsActionButtons(totalRows);
            });

            function addItem() {
                $tableWrapper.find('tbody').append($tableWrapper.find('tbody .clonable').clone().show().removeClass('clonable'));
            }

            function updateTableRowsActionButtons(totalRows) {
                let totalCount = totalRows.length;

                // show/hide row buttons
                totalRows.each(function(){
                    // show the delete buttons on all rows if we are above the minimum
                    if(totalCount > $min) {   
                        $(this).find('.removeItem').show();
                    }
                    // hide the delete buttons on all rows if we are at minimum rows
                    if(totalCount <= $min) {   
                        $(this).find('.removeItem').hide();
                    }
                    // show the sort button when more than one row is on table
                    if (totalCount > 1) {
                        $(this).find('.sort-handle').show();
                    }
                    // hide the sort button when there is only one row
                    if (totalCount == 1) {
                        $(this).find('.sort-handle').hide();
                    }
                });
            }

            $tableWrapper.on('click', '.removeItem', function() {                    
                $(this).closest('tr').remove();
                updateTableFieldJson();

                var totalRows = $tableWrapper.find('tbody tr').not('.clonable');

                if(totalRows.length < $max) {
                    $addButton.show();
                }
                updateTableRowsActionButtons(totalRows);   
            });

            $tableWrapper.find('tbody').on('keyup', function() {
                updateTableFieldJson();
            });

            function updateTableFieldJson() {
                var $rows = $tableWrapper.find('tbody tr').not('.clonable');
                var $hiddenField = $tableWrapper.find('input.array-json');

                var json = '[';
                var otArr = [];
                var tbl2 = $rows.each(function(i) {
                    x = $(this).children().closest('td').find('input');
                    var itArr = [];
                    x.each(function() {
                        if(this.value.length > 0) {
                            var key = $(this).attr('data-cell-name').replace('item.','');
                            itArr.push('"' + key + '":' + JSON.stringify(this.value));
                        }
                    });
                    otArr.push('{' + itArr.join(',') + '}');
                })
                json += otArr.join(",") + ']';

                var totalRows = $rows.length;

                $hiddenField.val( totalRows ? json : null ).trigger('change');
            }

            $tableWrapper.find('input.array-json').on('CrudField:disable', function(e) {
                $tableWrapper.find('[data-button-type=addItem]').attr('disabled','disabled');
                
                $tableWrapper.find('.removeItem').each(function(i, el) {
                    $(el).on('click.prevent', function(e) {
                        e.stopImmediatePropagation();
                        return false;
                    });
                    // make the event we just registered, the first to be triggered
                    $._data($(el).get(0), "events").click.reverse();
                });
                $tableWrapper.find('input, textarea, select').attr('disabled', 'disabled');
                $tableWrapper.find('.sortableOptions').sortable("option","disabled", true);
            });

            $tableWrapper.find('input.array-json').on('CrudField:enable', function(e) {
                $tableWrapper.find('[data-button-type=addItem]').removeAttr('disabled');
                
                $tableWrapper.find('.removeItem').each(function(i, el) {
                    $(el).unbind('click.prevent');
                });
                $tableWrapper.find('input, textarea, select').removeAttr('disabled');
                $tableWrapper.find('.sortableOptions').sortable("option","disabled", false);
            });

            // on page load, make sure the input has the old values
            updateTableFieldJson();
        }
    </script>
    @endLoadOnce
@endpush
