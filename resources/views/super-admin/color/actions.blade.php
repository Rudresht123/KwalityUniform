<div class="btn-list">
    <x-edit-button :url="route('color.edit', $row->color_id)" />
    <x-delete-button :url="route('color.destroy', $row->color_id)" />
</div>
