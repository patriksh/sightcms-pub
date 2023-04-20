{{-- Backpack admin panel view link for a CRUD item (used for frontend article view) --}}
<a href="{{ url(str_replace(' ', '-', $crud->entity_name)) . '/' . $entry->slug }}" class="btn btn-sm btn-link" target="_blank">
    <i class="la la-eye"></i> {{ __('View') }}
</a>