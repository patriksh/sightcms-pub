{{-- Backpack admin panel view link for a CRUD item (used for document file view) --}}
<a href="{{ asset($entry->file) }}" class="btn btn-sm btn-link" target="_blank">
    <i class="la la-eye"></i> {{ __('View') }}
</a>