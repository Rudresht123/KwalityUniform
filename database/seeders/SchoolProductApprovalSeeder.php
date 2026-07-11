<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin\School;
use App\Models\SuperAdmin\Product;
use App\Models\SuperAdmin\SchoolProductApproval;

class SchoolProductApprovalSeeder extends Seeder
{
    public function run(): void
    {
        $schools = School::where('is_active', true)->limit(4)->get();
        $products = Product::where('approval_status', 'approved')->where('is_active', true)->limit(16)->get();

        if ($schools->count() < 4) {
            $this->command->error('Not enough active schools found.');
            return;
        }
        if ($products->count() < 16) {
            $this->command->error('Not enough approved products found.');
            return;
        }

        $productIdx = 0;
        foreach ($schools as $school) {
            for ($i = 4; $i < 4; $i++) {
                $product = $products[$productIdx++];
                SchoolProductApproval::updateOrCreate(
                    ['school_id' => $school->school_id, 'product_id' => $product->product_id],
                    [
                        'status' => 'approved', 
                        'actioned_at' => now(),
                        'actioned_by' => \App\Models\User::role('super-admin')->first()?->id
                    ]
                );
            }
        }
        $this->command->info('Successfully approved 4 products for each of the 4 schools.');
    }
}
