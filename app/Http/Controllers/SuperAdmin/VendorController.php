<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\StoreVendorRequest;
use App\Http\Requests\SuperAdmin\UpdateVendorRequest;
use App\Models\SuperAdmin\Vendor;
use App\Services\VendorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class VendorController extends BaseController
{
    /**
     * @var VendorService
     */
    private string $title;
    protected VendorService $vendorService;

    /**
     * VendorController constructor.
     *
     * @param VendorService $vendorService
     */
    public function __construct(VendorService $vendorService)
    {
        $this->title = 'Vendor Management';
        $this->vendorService = $vendorService;
    }

    /**
     * Display a listing of vendors.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $vendors = $this->vendorService->getAllVendor();
        return view('super-admin.vendor.index', compact('vendors'), $this->pageData($this->title, 'Home|Vendors'));
    }

    /**
     * Show the form for creating a new vendor.
     *
     * @return View
     */
    public function create(): View
    {
        return view('super-admin.vendor.create', $this->pageData('Vendor Management', 'Home|Vendors|Create Vendor'));
    }

    /**
     * Store a newly created vendor in storage.
     *
     * @param StoreVendorRequest $request
     * @return RedirectResponse
     */
    public function store(StoreVendorRequest $request): RedirectResponse
    {
        try {
            $this->vendorService->createVendor($request->validated(), $request->file('logo'));

            return redirect()->route('vendor.index')->with('success', 'Vendor created successfully and registration email sent.');
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to create vendor: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified vendor.
     *
     * @param Vendor $vendor
     * @return View
     */
    public function show(Vendor $vendor): View
    {
        return view('super-admin.vendor.show', compact('vendor'), $this->pageData('Vendor Management', 'Home|Vendors|Show Vendor'));
    }

    /**
     * Show the form for editing the specified vendor.
     *
     * @param Vendor $vendor
     * @return View
     */
    public function edit(Vendor $vendor): View
    {
        return view('super-admin.vendor.edit', compact('vendor'), $this->pageData('Edit Vendor', 'Home|Vendors|Edit Vendor'));
    }

    /**
     * Update the specified vendor in storage.
     *
     * @param UpdateVendorRequest $request
     * @param Vendor $vendor
     * @return RedirectResponse
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor): RedirectResponse
    {
        try {
            $this->vendorService->updateVendor($vendor, $request->validated(), $request->file('logo'));

            return redirect()->back()->with('success', 'Vendor updated successfully.');
        } catch (Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to update vendor: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified vendor from storage.
     * Note: Per user request, delete functionality is handled globally.
     *
     * @param Vendor $vendor
     * @return RedirectResponse
     */
    public function destroy(Vendor $vendor): RedirectResponse
    {
        // Skipping implementation as per user request.
        // If needed, this would call the global delete function.
        return redirect()->route('vendor.index')->with('error', 'Delete functionality is handled globally.');
    }
}
