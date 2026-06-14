<div class="btn-list">
    <x-edit-button :url="route('category.edit', $row->category_id)" />
    <x-delete-button :url="route('category.destroy', $row->category_id)" />
</div>
