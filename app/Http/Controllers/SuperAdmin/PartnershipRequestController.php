<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuperAdmin\SchoolPartnershipRequest;
use App\Models\SuperAdmin\VendorPartnershipRequest;
use App\Models\User;
use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\EmailService;

class PartnershipRequestController extends Controller
{
    public function index()
    {
        $schoolRequests = SchoolPartnershipRequest::where('status', 'pending')->get();
        $vendorRequests = VendorPartnershipRequest::where('status', 'pending')->get();

        return view('super-admin.partnerships.index', compact('schoolRequests', 'vendorRequests'));
    }

    public function approveSchoolRequest($id)
    {
        $request = SchoolPartnershipRequest::findOrFail($id);
        
        if ($request->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Request already processed.'], 400);
        }

        try {
            $schoolService = app(\App\Services\SchoolService::class);
            
            $data = [
                'school_name' => $request->school_name,
                'principal_name' => $request->contact_person,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address ?? 'Not Provided',
                'city' => $request->city ?? 'Not Provided',
                'state' => $request->state ?? 'Not Provided',
                'pincode' => $request->pincode ?? '000000',
                'is_active' => true,
            ];

            $schoolService->createSchool($data);
            $request->update(['status' => 'approved']);

            return response()->json(['success' => true, 'message' => 'School Partnership Approved and User Created!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error approving request: ' . $e->getMessage()], 500);
        }
    }

    public function approveVendorRequest($id)
    {
        $request = VendorPartnershipRequest::findOrFail($id);

        if ($request->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Request already processed.'], 400);
        }

        try {
            $vendorService = app(\App\Services\VendorService::class);
            
            $data = [
                'business_name' => $request->company_name,
                'category' => $request->category,
                'email' => $request->email,
                'phone' => $request->phone ?? 'Not Provided',
                'gstin' => $request->gstin,
                'address' => $request->address ?? 'Not Provided',
                'city' => $request->city ?? 'Not Provided',
                'state' => $request->state ?? 'Not Provided',
                'pincode' => $request->pincode ?? '000000',
                'pan_number' => $request->pan_number ?? 'NOT_PROVIDED',
                'bank_account_no' => $request->bank_account_no ?? '000000000000',
                'ifsc_code' => $request->ifsc_code ?? 'NOT_PROVIDED',
                'status' => 'approved',
                'is_active' => true,
            ];

            $vendorService->createVendor($data);
            $request->update(['status' => 'approved']);

            return response()->json(['success' => true, 'message' => 'Vendor Partnership Approved and User Created!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error approving request: ' . $e->getMessage()], 500);
        }
    }

    public function rejectRequest($type, $id)
    {
        $request = ($type === 'school') 
            ? SchoolPartnershipRequest::findOrFail($id) 
            : VendorPartnershipRequest::findOrFail($id);

        if ($request->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Request already processed.'], 400);
        }

        $request->update(['status' => 'rejected']);

        // Email Notification
        EmailService::send('partnership_rejected', $request->email, [
            'email' => $request->email,
        ]);

        return response()->json(['success' => true, 'message' => 'Partnership Request Rejected.']);
    }
}
