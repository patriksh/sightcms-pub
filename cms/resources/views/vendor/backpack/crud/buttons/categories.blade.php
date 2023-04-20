{{-- Backpack admin panel category link for a CRUD item (used for article categories, document categories...) --}}
<a href="{{ url($crud->route.'-category') }}" class="btn btn-secondary" data-style="zoom-in">
    <span class="ladda-label"><i class="la la-tag"></i>{{ __('Categories') }}</span>
</a>