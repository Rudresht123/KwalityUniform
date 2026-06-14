@extends('layouts.common')

@section('content')
    {{-- Table Section --}}
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                @if (session('success'))
                    <div class="mb-3">
                        <x-alert type="success" :message="session('success')" />
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-3">
                        <x-alert type="error" :message="session('error')" />
                    </div>
                @endif

                <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between">
                    <div>
                        <div class="card-title">Vendors</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Manage All Vendors From Here</p>
                    </div>
                    <div class="mb-0 fs-12 mb-3 text-muted">
                        <a href="{{ route('vendor.create') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-plus"></i>
                            Add Vendor
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table  class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Organization Type</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th width="80">Action</th>
                            </tr>
                        </thead>

                       <tbody>
    <tr><td>1</td><td>School Uniform Supplier</td><td><span class="badge bg-success">Active</span></td><td>2026-05-01</td><td>...</td></tr>
    <tr><td>2</td><td>Sports Equipment Vendor</td><td><span class="badge bg-success">Active</span></td><td>2026-05-02</td><td>...</td></tr>
    <tr><td>3</td><td>Book & Stationery Supplier</td><td><span class="badge bg-danger">Inactive</span></td><td>2026-05-03</td><td>...</td></tr>
    <tr><td>4</td><td>Shoe Manufacturer</td><td><span class="badge bg-success">Active</span></td><td>2026-05-04</td><td>...</td></tr>
    <tr><td>5</td><td>School Bag Supplier</td><td><span class="badge bg-warning">Pending</span></td><td>2026-05-05</td><td>...</td></tr>
    <tr><td>6</td><td>ID Card Printing Vendor</td><td><span class="badge bg-success">Active</span></td><td>2026-05-06</td><td>...</td></tr>
    <tr><td>7</td><td>Textile Manufacturer</td><td><span class="badge bg-success">Active</span></td><td>2026-05-07</td><td>...</td></tr>
    <tr><td>8</td><td>Embroidery Service Provider</td><td><span class="badge bg-danger">Inactive</span></td><td>2026-05-08</td><td>...</td></tr>
    <tr><td>9</td><td>Corporate Uniform Supplier</td><td><span class="badge bg-success">Active</span></td><td>2026-05-09</td><td>...</td></tr>
    <tr><td>10</td><td>Garment Wholesaler</td><td><span class="badge bg-success">Active</span></td><td>2026-05-10</td><td>...</td></tr>

    <tr><td>11</td><td>School Accessories Vendor</td><td><span class="badge bg-warning">Pending</span></td><td>2026-05-11</td><td>...</td></tr>
    <tr><td>12</td><td>Custom Badge Manufacturer</td><td><span class="badge bg-success">Active</span></td><td>2026-05-12</td><td>...</td></tr>
    <tr><td>13</td><td>Winter Uniform Supplier</td><td><span class="badge bg-success">Active</span></td><td>2026-05-13</td><td>...</td></tr>
    <tr><td>14</td><td>School Tie Manufacturer</td><td><span class="badge bg-danger">Inactive</span></td><td>2026-05-14</td><td>...</td></tr>
    <tr><td>15</td><td>Belt & Accessories Supplier</td><td><span class="badge bg-success">Active</span></td><td>2026-05-15</td><td>...</td></tr>
    <tr><td>16</td><td>Educational Material Vendor</td><td><span class="badge bg-success">Active</span></td><td>2026-05-16</td><td>...</td></tr>
    <tr><td>17</td><td>Uniform Stitching Unit</td><td><span class="badge bg-warning">Pending</span></td><td>2026-05-17</td><td>...</td></tr>
    <tr><td>18</td><td>School Socks Supplier</td><td><span class="badge bg-success">Active</span></td><td>2026-05-18</td><td>...</td></tr>
    <tr><td>19</td><td>Fabric Distributor</td><td><span class="badge bg-success">Active</span></td><td>2026-05-19</td><td>...</td></tr>
    <tr><td>20</td><td>Logo Printing Vendor</td><td><span class="badge bg-danger">Inactive</span></td><td>2026-05-20</td><td>...</td></tr>

    <tr><td>21</td><td>School Blazer Supplier</td><td><span class="badge bg-success">Active</span></td><td>2026-05-21</td><td>...</td></tr>
    <tr><td>22</td><td>Cap & Hat Manufacturer</td><td><span class="badge bg-success">Active</span></td><td>2026-05-22</td><td>...</td></tr>
    <tr><td>23</td><td>Uniform Packaging Vendor</td><td><span class="badge bg-warning">Pending</span></td><td>2026-05-23</td><td>...</td></tr>
    <tr><td>24</td><td>Kids Apparel Supplier</td><td><span class="badge bg-success">Active</span></td><td>2026-05-24</td><td>...</td></tr>
    <tr><td>25</td><td>School Sweater Manufacturer</td><td><span class="badge bg-success">Active</span></td><td>2026-05-25</td><td>...</td></tr>
    <tr><td>26</td><td>Bulk Clothing Vendor</td><td><span class="badge bg-danger">Inactive</span></td><td>2026-05-26</td><td>...</td></tr>
    <tr><td>27</td><td>House T-Shirt Supplier</td><td><span class="badge bg-success">Active</span></td><td>2026-05-27</td><td>...</td></tr>
    <tr><td>28</td><td>Uniform Quality Inspection Agency</td><td><span class="badge bg-success">Active</span></td><td>2026-05-28</td><td>...</td></tr>
    <tr><td>29</td><td>School Dress Manufacturer</td><td><span class="badge bg-warning">Pending</span></td><td>2026-05-29</td><td>...</td></tr>
    <tr><td>30</td><td>Educational Supplies Distributor</td><td><span class="badge bg-success">Active</span></td><td>2026-05-30</td><td>...</td></tr>
</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Table Section --}}


@endsection
