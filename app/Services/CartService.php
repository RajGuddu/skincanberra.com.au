<?php

namespace App\Services;

use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartService
{
    public function add($data)
    {
        $cartItem = Cart::add([
            'id' => $data['id'],
            'name' => $data['name'],
            'price' => $data['price'],
            'quantity' => $data['quantity'] ?? 1,
            'attributes' => $data['attributes'] ?? []
        ]);
        session()->save();
        return $cartItem;
    }

    public function getItems()
    {
        return Cart::getContent();
    }

    public function getSubTotal()
    {
        return Cart::getSubTotal();
    }
    public function getTotal()
    {
        return Cart::getTotal();
    }
    public function getCount()
    {
        return Cart::getContent()->count(); // unique item count
    }

    public function getTotalQuantity()
    {
        return Cart::getTotalQuantity(); // total quantity sum
    }
    public function update($id, $quantity)
    {
        $result = Cart::update($id, [
            'quantity' => [
                'relative' => true, // if false: the given quantity is used otherwise its add quantity
                'value' => $quantity
            ],
        ]);
        session()->save();
        return $result;
    }

    public function remove($id)
    {
        $result = Cart::remove($id);
        session()->save();

        return $result;
    }

    public function clear()
    {
        Cart::clear();
        session()->save();
    }
}
