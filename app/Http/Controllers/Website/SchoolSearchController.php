<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\School;
use Illuminate\Http\Request;

class SchoolSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('q');

        if (!$query) {
            return response()->json([]);
        }

        $schools = School::active()
            ->where('school_name', 'like', '%' . $query . '%')
            ->take(10)
            ->get(['school_id', 'school_name', 'city', 'state']);

        return response()->json($schools);
    }
}
