<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\School;
use Illuminate\Http\Request;

class SchoolSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('query') ?? $request->query('q');

        if (!$query) {
            return response()->json([
                'success' => true, 
                'schools' => []
            ]);
        }

        $schools = School::active()
            ->where('school_name', 'like', '%' . $query . '%')
            ->take(15)
            ->get(['school_id', 'school_name', 'city', 'state']);

        return response()->json([
            'success' => true,
            'schools' => $schools
        ]);
    }

    public function standards(Request $request)
    {
        $schoolId = $request->query('school_id');

        if (!$schoolId) {
            return response()->json(['success' => false, 'message' => 'School ID is required.'], 400);
        }

        $standards = \App\Models\SuperAdmin\SchoolStandard::where('school_id', $schoolId)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'standard_name']);

        return response()->json(['success' => true, 'standards' => $standards]);
    }
}
