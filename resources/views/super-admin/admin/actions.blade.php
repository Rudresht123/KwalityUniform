<div class="btn-list">
    @if(Auth::id() !== $row->id)
        <a href="{{ route('impersonate.start', $row->id) }}" class="btn btn-sm btn-warning" title="Impersonate">
            <i class="ti ti-user-circle"></i>
        </a>
    @endif
    <x-edit-button :url="route('admin.edit', $row->id)" />
    <x-delete-button :url="route('admin.destroy', $row->id)" />
</div>
