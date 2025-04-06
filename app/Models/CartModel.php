<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $allowedFields = ['id_menu', 'id_user', 'jumlah'];

    
public function addToCart($id_menu, $id_user)
{
    // Log the inputs
    log_message('debug', 'addToCart called with id_menu=' . $id_menu . ', id_user=' . $id_user);

    // Check if the item already exists in the user's cart
    $existing = $this->where('id_menu', $id_menu)
                     ->where('id_user', $id_user)
                     ->first();

    if ($existing) {
        // If it exists, increase the quantity
        log_message('debug', 'Item exists in cart. Updating quantity.');
        $this->update($existing['id_keranjang'], [
            'jumlah' => $existing['jumlah'] + 1
        ]);
    } else {
        // If it doesn't exist, add a new item
        log_message('debug', 'Item does not exist in cart. Inserting new item.');
        $this->insert([
            'id_menu' => $id_menu,
            'id_user' => $id_user,
            'jumlah' => 1
        ]);
    }
}
public function getCartByUser($id_user)
{
    return $this->select('keranjang.*, menu.harga')
                ->join('menu', 'menu.id_menu = keranjang.id_menu')
                ->where('keranjang.id_user', $id_user)
                ->findAll();
}
}
