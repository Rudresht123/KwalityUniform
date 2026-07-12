<?php

namespace App\Repositories;

use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ActivityRepository
{
    /**
     * Get formatted recent activity for the dashboard timeline.
     */
    public function getRecentActivity(int $limit = 10, $userId = null): Collection
    {
        $user = $userId ? \App\Models\User::find($userId) : Auth::user();

        $query = Activity::with(['causer', 'subject'])->latest();

        // Super Admin & Admin => Show all activities
        if ($user && !$user->hasAnyRole(['super-admin', 'admin'])) {
            $query->where('causer_id', $user->id);
        }

        $logs = $query->take($limit)->get();

        return $logs->map(function ($log) {
            $mapping = [
                'School' => [
                    'icon' => 'ti-school',
                    'color' => 'var(--c-blue)',
                    'bg' => 'var(--c-blue-bg)',
                    'badge' => 'School',
                    'badge_class' => 'badge-blue',
                ],
                'Vendor' => [
                    'icon' => 'ti-building-store',
                    'color' => 'var(--c-violet)',
                    'bg' => 'var(--c-violet-bg)',
                    'badge' => 'Vendor',
                    'badge_class' => 'badge-violet',
                ],
                'Product' => [
                    'icon' => 'ti-package',
                    'color' => 'var(--c-amber)',
                    'bg' => 'var(--c-amber-bg)',
                    'badge' => 'Products',
                    'badge_class' => 'badge-amber',
                ],
                'ProductVariant' => [
                    'icon' => 'ti-dropbox',
                    'color' => 'var(--c-green)',
                    'bg' => 'var(--c-green-bg)',
                    'badge' => 'Stock',
                    'badge_class' => 'badge-green',
                ],
                'auth' => [
                    'icon' => 'ti-lock',
                    'color' => 'var(--c-blue)',
                    'bg' => 'var(--c-blue-bg)',
                    'badge' => 'Account',
                    'badge_class' => 'badge-blue',
                ],
            ];

            $type = $log->log_name;
            $config = $mapping[$type] ?? [
                'icon' => 'ti-alert-triangle',
                'color' => 'var(--c-red)',
                'bg' => 'var(--c-red-bg)',
                'badge' => 'System',
                'badge_class' => 'badge-red',
            ];

            $subjectName = '';
            if ($log->subject) {
                if ($log->subject instanceof \App\Models\SuperAdmin\Product) {
                    $subjectName = $log->subject->product_name;
                } elseif ($log->subject instanceof \App\Models\SuperAdmin\Vendor) {
                    $subjectName = $log->subject->business_name;
                } elseif ($log->subject instanceof \App\Models\SuperAdmin\School) {
                    $subjectName = $log->subject->school_name;
                } elseif ($log->subject instanceof \App\Models\User) {
                    $subjectName = $log->subject->name;
                } elseif (method_exists($log->subject, 'getName')) {
                    $subjectName = $log->subject->getName();
                }
            }

            $description = $log->description ?: "Activity in {$type}";
            $displayName = $subjectName ? "{$description} {$subjectName}" : $description;
            $causerName = $log->causer?->name ?? 'System';

            $url = null;
            if ($log->subject_id) {
                switch ($log->subject_type) {
                    case \App\Models\SuperAdmin\Product::class:
                        $url = route('product.edit', $log->subject_id);
                        break;
                    case \App\Models\SuperAdmin\ProductVariant::class:
                        $product = \App\Models\SuperAdmin\Product::whereHas('variants', function ($q) use ($log) {
                            $q->where('variant_id', $log->subject_id);
                        })->first();
                        if ($product) {
                            $url = route('product.edit', $product->product_id);
                        }
                        break;
                    case \App\Models\SuperAdmin\Vendor::class:
                        $url = route('vendor.show', $log->subject_id);
                        break;
                }
            }

            return [
                'icon' => $config['icon'],
                'color' => $config['color'],
                'bg' => $config['bg'],
                'name' => $displayName,
                'meta' => "by {$causerName}",
                'badge' => $config['badge'],
                'badge_class' => $config['badge_class'],
                'time' => Carbon::parse($log->created_at)->diffForHumans(),
                'url' => $url,
            ];
        });
    }
}
