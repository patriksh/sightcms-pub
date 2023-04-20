{{-- Backpack admin panel view link for a CRUD item (used for frontend article view) --}}
<a href="{{ url($crud->route . '/' . $entry->getKey() . '/view') }}" class="btn btn-sm btn-link" target="_blank">
    <i class="la la-eye"></i> {{ __('Preview') }}
</a>