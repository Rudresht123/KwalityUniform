<?php

namespace App\Http\Livewire;

use App\Models\SuperAdmin\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class VendorTable extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $perPage = '10';

    protected $updatesQueryString = ['search', 'statusFilter', 'perPage', 'page'];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $vendors = $this->getVendors();

        return view('livewire.vendor-table', [
            'vendors' => $vendors,
        ]);
    }

    protected function getVendors(): LengthAwarePaginator
    {
        $query = Vendor::query();

        if ($this->search !== '') {
            $query->where(function ($sub) {
                $sub->where('business_name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('phone', 'like', "%{$this->search}%");
            });
        }

        if (in_array($this->statusFilter, ['pending', 'approved', 'suspended'], true)) {
            $query->where('status', $this->statusFilter);
        }

        return $query->latest('created_at')->paginate((int) $this->perPage);
    }
}
