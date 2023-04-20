{{-- Backpack admin panel view link for a CRUD item (used for frontend article category view) --}}
<a href="{{ url(str_replace(' category', '', $crud->entity_name)) . 's/' . $entry->slug }}" class="btn btn-sm btn-link" target="_blank">
    <i class="la la-eye"></i> {{ __('View') }}
</a>