<div class="btn-list">
    <x-edit-button :url="route('admin.edit', $row->id)" />
    <x-delete-button :url="route('admin.destroy', $row->id)" />
</div>
