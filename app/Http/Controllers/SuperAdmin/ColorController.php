<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SuperAdmin\StoreColorRequest;
use App\Http\Requests\SuperAdmin\UpdateColorRequest;
use App\Models\SuperAdmin\Color;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class ColorController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $colors = Color::latest();

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
                    return view('super-admin.color.actions', compact('row'))->render();
                })
                ->rawColumns(['color_preview', 'status', 'options'])
                ->make(true);
        }

        return view('super-admin.color.index', $this->pageData('Color Management', 'Home|Product Attributes|Colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super-admin.color.create', $this->pageData('Create Color', 'Home|Product Attributes|Colors|Create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request)
    {
        try {
            Color::create($request->validated());
            return redirect()->route('color.index')->with('success', 'Color created successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to create color: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        return view('super-admin.color.show', compact('color'), $this->pageData('Color Details', 'Home|Product Attributes|Colors|View'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        return view('super-admin.color.edit', compact('color'), $this->pageData('Edit Color', 'Home|Product Attributes|Colors|Edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, Color $color)
    {
        try {
            $color->update($request->validated());
            return redirect()->route('color.index')->with('success', 'Color updated successfully.');
        } catch (Throwable $e) {
            return back()->withInput()->with('error', 'Failed to update color: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        try {
            $color->delete();
            
            if (request()->ajax()) {
                return response()->json([
                    'status' => true, 
                    'message' => 'Color deleted successfully.'
                ]);
            }
            
            return redirect()->route('color.index')->with('success', 'Color deleted successfully.');
        } catch (Throwable $e) {
            if (request()->ajax()) {
                return response()->json([
                    'status' => false, 
                    'message' => 'Failed to delete color: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to delete color: ' . $e->getMessage());
        }
    }
}
