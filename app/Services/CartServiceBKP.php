<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    protected $sessionKey = 'cart';

    // Get all cart items
    public function getItems()
    {
        return Session::get($this->sessionKey, []);
    }

    // Add product to cart
    public function add($item)
    {
        $cart = $this->getItems();

        $id = $item['id'];
        $quantity = $item['quantity'] ?? 1;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $quantity,
                'attributes' => $item['attributes'] ?? []
            ];
        }

        Session::put($this->sessionKey, $cart);
        return $cart;
    }

    // Update quantity
    public function update($id, $quantity)
    {
        $cart = $this->getItems();

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, $quantity);
            Session::put($this->sessionKey, $cart);
        }

        return $cart;
    }

    // Remove an item
    public function remove($id)
    {
        $cart = $this->getItems();
        unset($cart[$id]);
        Session::put($this->sessionKey, $cart);
        return $cart;
    }

    // Clear cart
    public function clear()
    {
        Session::forget($this->sessionKey);
    }

    // Get subtotal
    public function getSubTotal()
    {
        $cart = $this->getItems();
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        return $subtotal;
    }

    // Get total (if you have tax/shipping, modify here)
    public function getTotal()
    {
        return $this->getSubTotal();
    }

    // Get item count
    public function getCount()
    {
        $cart = $this->getItems();
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}
