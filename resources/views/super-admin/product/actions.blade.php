<div class="btn-list">
    <x-edit-button :url="route('product.edit', $row->product_id)" />
    <x-delete-button :url="route('product.destroy', $row->product_id)" />
</div>
