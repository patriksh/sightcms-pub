{{-- Backpack admin panel preferences link for a CRUD item (used for articles, documents...) --}}
<a href="{{ url('admin/preference/' . $crud->entity_name) }}" class="btn btn-secondary" data-style="zoom-in">
    <span class="ladda-label"><i class="la la-gear"></i>{{ __('Preferences') }}</span>
</a>