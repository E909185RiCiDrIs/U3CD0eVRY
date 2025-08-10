<?php
// 代码生成时间: 2025-08-11 03:47:43
class ShoppingCart {

    // Array to hold the cart items
    private $items = [];
# 优化算法效率

    // Add an item to the cart
# FIXME: 处理边界情况
    public function addItem($productId, $quantity) {
        if (!isset($this->items[$productId])) {
            $this->items[$productId] = ['quantity' => 0];
        }

        $this->items[$productId]['quantity'] += $quantity;
    }

    // Remove an item from the cart
    public function removeItem($productId) {
        if (isset($this->items[$productId])) {
# 优化算法效率
            unset($this->items[$productId]);
        }
    }
# 添加错误处理

    // Get the total number of items in the cart
    public function getTotalItems() {
        return array_sum(array_map(function($item) {
            return $item['quantity'];
        }, $this->items));
    }

    // Get the total cost of items in the cart
    public function getTotalCost($priceList) {
        $cost = 0;
        foreach ($this->items as $productId => $item) {
            if (isset($priceList[$productId])) {
                $cost += $priceList[$productId] * $item['quantity'];
            } else {
# TODO: 优化性能
                // Handle unknown product
# 添加错误处理
                throw new InvalidArgumentException("Product ID {$productId} is not found in the price list.");
            }
        }
        return $cost;
    }

    // Get the cart items
    public function getItems() {
        return $this->items;
# 改进用户体验
    }

}
