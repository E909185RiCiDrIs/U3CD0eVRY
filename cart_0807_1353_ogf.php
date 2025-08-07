<?php
// 代码生成时间: 2025-08-07 13:53:23
class ShoppingCart {
    /**
     * @var array Holds the items in the cart.
     */
    private $items = [];

    /**
     * Adds an item to the cart.
     *
     * @param string $id The item ID.
     * @param string $name The item name.
     * @param float $price The item price.
     * @param int $quantity The quantity of the item to add.
     */
    public function addItem($id, $name, $price, $quantity) {
        if (!isset($this->items[$id])) {
            $this->items[$id] = [
                'name' => $name,
                'price' => $price,
                'quantity' => 0
            ];
        }

        $this->items[$id]['quantity'] += $quantity;
    }

    /**
     * Removes an item from the cart.
     *
     * @param string $id The item ID.
     */
    public function removeItem($id) {
        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        } else {
            // Handle error: Item not found in cart.
            throw new Exception("Item with ID $id not found in cart.");
        }
    }

    /**
     * Updates the quantity of an item in the cart.
     *
     * @param string $id The item ID.
     * @param int $quantity The new quantity.
     */
    public function updateQuantity($id, $quantity) {
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] = $quantity;
        } else {
            // Handle error: Item not found in cart.
            throw new Exception("Item with ID $id not found in cart.");
        }
    }

    /**
     * Removes all items from the cart.
     */
    public function clearCart() {
        $this->items = [];
    }

    /**
     * Returns the total price of all items in the cart.
     *
     * @return float The total price.
     */
    public function getTotalPrice() {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Returns the cart items.
     *
     * @return array The cart items.
     */
    public function getItems() {
        return $this->items;
    }
}
