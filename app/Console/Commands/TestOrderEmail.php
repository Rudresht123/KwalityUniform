<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\SuperAdmin\ProductVariant;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class TestOrderEmail extends Command
{
    protected $signature = 'test:order-email';
    protected $description = 'Test the order placement and email confirmation flow';

    public function handle()
    {
        $user = User::first();
        if (!$user) {
            $this->error('No user found.');
            return 1;
        }

        Auth::login($user);
        $this->info("Logged in as user: {$user->email}");

        $cart = Cart::create([
            'cart_id' => \Illuminate\Support\Str::random(20),
            'user_id' => $user->id,
            'status' => 'active'
        ]);

        $variant = ProductVariant::first();
        if (!$variant) {
            $this->error('No product variant found.');
            return 1;
        }

        CartItem::create([
            'cart_item_id' => \Illuminate\Support\Str::random(20),
            'cart_id' => $cart->cart_id,
            'product_id' => $variant->product_id,
            'variant_id' => $variant->variant_id,
            'vendor_id' => $variant->product->vendor_id,
            'quantity' => 1,
            'unit_price' => $variant->selling_price ?? 100,
        ]);

        try {
            $orderService = app(OrderService::class);
            $order = $orderService->placeOrder($cart, ['delivery_type' => 'home']);
            $this->info("Order placed successfully: {$order->order_number}");
            $this->info("Check logs to verify if emails were sent.");
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
