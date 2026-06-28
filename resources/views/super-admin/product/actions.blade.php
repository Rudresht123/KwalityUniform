<div class="dropdown">
    <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ti ti-dots-vertical"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="{{ route('product.show', $row->product_id) }}">
                <i class="ti ti-eye me-2"></i> View
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('product.edit', $row->product_id) }}">
                <i class="ti ti-edit me-2"></i> Edit
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <x-delete-button :url="route('product.destroy', $row->product_id)" />
        </li>
    </ul>
</div>
