<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\BaseController;
use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CourierController extends BaseController
{
    public function index()
    {
        if (Gate::denies('courier.view')) {
            abort(403);
        }

        $couriers = Courier::paginate(15);
        return view('super-admin.couriers.index', compact('couriers'), $this->pageData('Couriers', 'Super Admin|Couriers'));
    }

    public function create()
    {
        if (Gate::denies('courier.create')) {
            abort(403);
        }

        return view('super-admin.couriers.create', [], $this->pageData('Add Courier', 'Super Admin|Couriers|Create'));
    }

    public function store(Request $request)
    {
        if (Gate::denies('courier.create')) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'api_integration_key' => ['nullable', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);
        Courier::create($request->all());

        return redirect()->route('couriers.index')->with('success', 'Courier created successfully.');
    }

    public function edit(Courier $courier)
    {
        if (Gate::denies('courier.edit')) {
            abort(403);
        }

        return view('super-admin.couriers.edit', compact('courier'), $this->pageData('Edit Courier', 'Super Admin|Couriers|Edit'));
    }

    public function update(Request $request, Courier $courier)
    {
        if (Gate::denies('courier.edit')) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'api_integration_key' => ['nullable', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $courier->update($request->all());

        return redirect()->route('couriers.index')->with('success', 'Courier updated successfully.');
    }

    public function destroy(Courier $courier)
    {
        if (Gate::denies('courier.delete')) {
            abort(403);
        }

        $courier->delete();

        return redirect()->route('couriers.index')->with('success', 'Courier deleted successfully.');
    }
}
