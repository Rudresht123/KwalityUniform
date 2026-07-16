<div class="btn-list">
    <x-edit-button :url="route('size.edit', $row->size_id)" />
    <x-delete-button :url="route('size.destroy', $row->size_id)" />
</div>
