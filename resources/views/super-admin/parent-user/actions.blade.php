<x-delete-button :url="route('parent-user.destroy', $row->id)" title="Delete Parent User" />
<a href="{{ route('parent-user.edit', $row->id) }}" class="btn btn-icon btn-sm btn-primary-light" title="Edit">
    <i class="ti ti-edit"></i>
</a>
{{-- <a href="{{ route('parent-user.show', $row->id) }}" class="btn btn-icon btn-sm btn-info-light" title="View">
    <i class="ti ti-eye"></i>
</a> --}}
