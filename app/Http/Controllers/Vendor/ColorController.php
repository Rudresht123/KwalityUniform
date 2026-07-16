<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\BaseController;
use App\Models\SuperAdmin\Color;
use App\Services\ColorService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class ColorController extends BaseController
{
    protected ColorService $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    public function index(Request $request)
    {
        $vendor = auth()->user()->vendor;
        if (!$vendor) {
            return redirect()->route('home')->with('error', 'Vendor profile not found.');
        }

        if ($request->ajax()) {
            $colors = $this->colorService->getAllColors($vendor->vendor_id);

            return DataTables::of($colors)
                ->addIndexColumn()
                ->addColumn('color_preview', function ($row) {
                    return '<div style="background-color: ' . $row->hex_code . '; width: 30px; height: 30px; border-radius: 4px; border: 1px solid #ddd;"></div>';
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active 
                        ? '<span class="badge bg-success">ACTIVE</span>' 
                        : '<span class="badge bg-danger">INACTIVE</span>';
                })
                ->addColumn('options', function ($row) {
                    return view('vendor.color.actions', compact('row'))->render();
                })
                ->rawColumns(['color_preview', 'status', 'options'])
                ->make(true);
        }

        return view('vendor.color.index', $this->pageData('Color Management', 'Home|Colors'));
    }

    public function create()
    {
        return view('vendor.color.create', $this->pageData('Create Color', 'Home|Colors|Create'));
    }

    public function store(Request $request)
    {
        try {
            $vendor = auth()->user()->vendor;
            $data = $request->all();
            $data['vendor_id'] = $vendor->vendor_id;

            $this->colorService->createColor($data);
            return redirect()->route('color.index')->with('success', 'Color created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create color: ' . $e->getMessage());
        }
    }

    public function edit(Color $color)
    {
        $vendor = auth()->user()->vendor;
        if ($color->vendor_id !== $vendor->vendor_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('vendor.color.edit', compact('color'), $this->pageData('Edit Color', 'Home|Colors|Edit'));
    }

    public function update(Request $request, Color $color)
    {
        try {
            $vendor = auth()->user()->vendor;
            if ($color->vendor_id !== $vendor->vendor_id) {
                abort(403, 'Unauthorized action.');
            }

            $this->colorService->updateColor($color, $request->all());
            return redirect()->route('color.index')->with('success', 'Color updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update color: ' . $e->getMessage());
        }
    }

    public function destroy(Color $color)
    {
        try {
            $vendor = auth()->user()->vendor;
            if ($color->vendor_id !== $vendor->vendor_id) {
                abort(403, 'Unauthorized action.');
            }

            $this->colorService->deleteColor($color);
            
            if (request()->ajax()) {
                return response()->json(['status' => true, 'message' => 'Color deleted successfully.']);
            }
            
            return redirect()->route('color.index')->with('success', 'Color deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
            return back()->with('error', 'Failed to delete color: ' . $e->getMessage());
        }
    }
}
