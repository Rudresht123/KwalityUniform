<div class="btn-list">
    <x-edit-button :url="route('parent-category.edit', $row->parent_id)" />
    <x-delete-button :url="route('parent-category.destroy', $row->parent_id)" />
</div>
