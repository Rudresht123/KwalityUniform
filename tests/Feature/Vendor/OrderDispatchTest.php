<?php

namespace Tests\Feature\Vendor;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\SuperAdmin\Vendor;
use App\Models\Courier;
use App\Models\Product;
use App\Enums\OrderStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderDispatchTest extends TestCase
{
    use RefreshDatabase;

    public function test_vendor_can_view_pending_dispatch_items(): void
    {
        // Need to seed roles/permissions, TestCase does this in setUp
        $vendor = Vendor::factory()->create();
        $user = $vendor->user; // Access the user created by the factory
        
        $order = Order::factory()->create(['status' => 'confirmed']);
        $orderItem = OrderItem::factory()->create([
            'order_id' => $order->id,
            'vendor_id' => $vendor->vendor_id,
        ]);

        $this->actingAs($user)
             ->get(route('vendor.orders.dispatch'))
             ->assertStatus(200)
             ->assertSee($orderItem->product->name);
    }

    public function test_vendor_can_dispatch_items(): void
    {
        $this->withoutMiddleware();

        $vendor = Vendor::factory()->create();
        $user = $vendor->user;

        // Debug: check role
        // $this->assertTrue($user->hasRole('vendor'), 'User does not have vendor role');

        $courier = Courier::factory()->create();

        $order = Order::factory()->create(['status' => 'confirmed']);
        $orderItem = OrderItem::factory()->create([
            'order_id' => $order->id,
            'vendor_id' => $vendor->vendor_id,
        ]);

        $response = $this->actingAs($user)
             ->post(route('vendor.orders.ship'), [
                 'order_item_ids' => [$orderItem->id],
                 'courier_id' => $courier->id,
                 'tracking_number' => 'TRK12345',
             ]);

        $response->assertRedirect(route('vendor.orders.dispatch'))
             ->assertSessionHas('success');

        $this->assertDatabaseHas('shipments', [
            'vendor_id' => $vendor->vendor_id,
            'tracking_number' => 'TRK12345',
            'courier_id' => $courier->id,
        ]);
    }
}
