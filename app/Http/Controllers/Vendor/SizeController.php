<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Size;
use App\Services\SizeService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class SizeController extends BaseController
{
    protected SizeService $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }

    public function index(Request $request)
    {
        $vendor = auth()->user()->vendor;
        if (!$vendor) {
            return redirect()->route('home')->with('error', 'Vendor profile not found.');
        }

        if ($request->ajax()) {
            $sizes = $this->sizeService->getAllSizes($vendor->vendor_id);

            return DataTables::of($sizes)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->is_active 
                        ? '<span class="badge bg-success">ACTIVE</span>' 
                        : '<span class="badge bg-danger">INACTIVE</span>';
                })
                ->addColumn('options', function ($row) {
                    return view('vendor.size.actions', compact('row'))->render();
                })
                ->rawColumns(['status', 'options'])
                ->make(true);
        }

        return view('vendor.size.index', $this->pageData('Size Management', 'Home|Sizes'));
    }

    public function create()
    {
        return view('vendor.size.create', $this->pageData('Create Size', 'Home|Sizes|Create'));
    }

    public function store(Request $request)
    {
        try {
            $vendor = auth()->user()->vendor;
            $data = $request->all();
            $data['vendor_id'] = $vendor->vendor_id;

            $this->sizeService->createSize($data);
            return redirect()->route('size.index')->with('success', 'Size created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create size: ' . $e->getMessage());
        }
    }

    public function edit(Size $size)
    {
        $vendor = auth()->user()->vendor;
        if ($size->vendor_id !== $vendor->vendor_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('vendor.size.edit', compact('size'), $this->pageData('Edit Size', 'Home|Sizes|Edit'));
    }

    public function update(Request $request, Size $size)
    {
        try {
            $vendor = auth()->user()->vendor;
            if ($size->vendor_id !== $vendor->vendor_id) {
                abort(403, 'Unauthorized action.');
            }

            $this->sizeService->updateSize($size, $request->all());
            return redirect()->route('size.index')->with('success', 'Size updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update size: ' . $e->getMessage());
        }
    }

    public function destroy(Size $size)
    {
        try {
            $vendor = auth()->user()->vendor;
            if ($size->vendor_id !== $vendor->vendor_id) {
                abort(403, 'Unauthorized action.');
            }

            $this->sizeService->deleteSize($size);
            
            if (request()->ajax()) {
                return response()->json(['status' => true, 'message' => 'Size deleted successfully.']);
            }
            
            return redirect()->route('size.index')->with('success', 'Size deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
            return back()->with('error', 'Failed to delete size: ' . $e->getMessage());
        }
    }
}
