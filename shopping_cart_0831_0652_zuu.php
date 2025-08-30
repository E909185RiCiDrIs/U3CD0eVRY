<?php
// 代码生成时间: 2025-08-31 06:52:22
// ShoppingCart.php
// 购物车类，用于管理用户的购物车
class ShoppingCart {
    private $items = array(); // 购物车中的商品

    // 添加商品到购物车
    public function add($product, $quantity) {
        if (isset($this->items[$product->id])) {
            // 如果商品已存在，则增加数量
            $this->items[$product->id]['quantity'] += $quantity;
        } else {
            // 如果商品不存在，则添加到购物车
            $this->items[$product->id] = array(
                'product' => $product,
                'quantity' => $quantity
            );
        }
    }

    // 从购物车中移除商品
    public function remove($productId) {
        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
        } else {
            // 如果商品不在购物车中，抛出异常
            throw new Exception("Product not found in cart.");
        }
    }

    // 更新购物车中的商品数量
    public function updateQuantity($productId, $newQuantity) {
        if (isset($this->items[$productId])) {
            if ($newQuantity <= 0) {
                // 如果数量为0或负数，则移除商品
                $this->remove($productId);
            } else {
                $this->items[$productId]['quantity'] = $newQuantity;
            }
        } else {
            // 如果商品不在购物车中，抛出异常
            throw new Exception("Product not found in cart.");
        }
    }

    // 获取购物车中所有商品
    public function getItems() {
        return $this->items;
    }

    // 清空购物车
    public function clear() {
        $this->items = array();
    }
}

// 使用示例
try {
    $cart = new ShoppingCart();
    $product1 = (object) array('id' => 1, 'name' => 'Product 1');
    $product2 = (object) array('id' => 2, 'name' => 'Product 2');

    // 添加商品到购物车
    $cart->add($product1, 2);
    $cart->add($product2, 3);

    // 更新商品数量
    $cart->updateQuantity(1, 5);

    // 移除商品
    $cart->remove(2);

    // 获取购物车中的商品
    $items = $cart->getItems();
    foreach ($items as $item) {
        echo "Product: " . $item['product']->name . ", Quantity: " . $item['quantity'] . "
";
    }

    // 清空购物车
    $cart->clear();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
