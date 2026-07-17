<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreSizeRequest;
use App\Http\Requests\SuperAdmin\UpdateSizeRequest;
use App\Models\SuperAdmin\Size;
use App\Services\SizeService;
use Illuminate\Http\Request;
use Laravel\Reverb\Loggers\Log;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class SizeController extends BaseController
{
    protected SizeService $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sizes = $this->sizeService->getAllSizes();

            return DataTables::of($sizes)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->is_active 
                        ? '<span class="badge bg-success">ACTIVE</span>' 
                        : '<span class="badge bg-danger">INACTIVE</span>';
                })
                ->addColumn('options', function ($row) {
                    return view('super-admin.size.actions', compact('row'))->render();
                })
                ->rawColumns(['status', 'options'])
                ->make(true);
        }

        return view('super-admin.size.index', $this->pageData('Size Management', 'Home|Product Attributes|Sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super-admin.size.create', $this->pageData('Create Size', 'Home|Product Attributes|Sizes|Create'));
    }

    public function ajaxStore(Request $request)
    {
        try {
            $data = $request->validate([
                'size_name' => 'required|string|max:255',
                'sort_order' => 'nullable|integer',
            ]);
            
            if (auth()->user()->hasRole('vendor')) {
                
                $data['vendor_id'] = auth()->user()->vendor?->vendor_id;
            }
            $data['display_name']=$request->input("size_name");
            $data['is_active'] = true;

            $size = $this->sizeService->createSize($data);
            return response()->json(['success' => true, 'size' => $size]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => $e->errors()], 422);
        } catch (Throwable $e) {
            // Detailed error for debugging
            return response()->json([
                'success' => false, 
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        return view('super-admin.size.show', compact('size'), $this->pageData('Size Details', 'Home|Product Attributes|Sizes|View'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        return view('super-admin.size.edit', compact('size'), $this->pageData('Edit Size', 'Home|Product Attributes|Sizes|Edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizeRequest $request, Size $size)
    {
        try {
            $this->sizeService->updateSize($size, $request->validated());
            return redirect()->route('size.index')->with('success', 'Size updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update size: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        try {
            $this->sizeService->deleteSize($size);
            
            if (request()->ajax()) {
                return response()->json([
                    'status' => true, 
                    'message' => 'Size deleted successfully.'
                ]);
            }
            
            return redirect()->route('size.index')->with('success', 'Size deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Failed to delete size: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to delete size: ' . $e->getMessage());
        }
    }
}
