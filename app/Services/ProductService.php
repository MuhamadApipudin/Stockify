<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function getAllProducts()
    {
        // Memanggil fungsi getAll() dari repository kamu
        return $this->productRepo->getAll();
    }

    public function storeProduct(array $data)
    {
        // Logika Bisnis: Generate SKU otomatis jika kosong
        if (empty($data['sku'])) {
            $data['sku'] = 'SKU-' . strtoupper(uniqid());
        }

        // Memanggil fungsi create() dari repository kamu
        return $this->productRepo->create($data);
    }
    public function getProductById($id)
{
    return \App\Models\Product::findOrFail($id); // Gunakan findOrFail agar langsung error 404 jika tidak ada
    
}
   public function updateProduct($id, array $data)
{
    $product = Product::findOrFail($id);

    // Jika SKU kosong dari form, jangan update SKU-nya (pakai yang lama)
    if (empty($data['sku'])) {
        unset($data['sku']); 
    }

    return $product->update($data);
}
    public function deleteProduct($id)
    {
        // Jika ada relasi yang memiliki foreign key ke products, penghapusan akan ditolak.
        // Hapus dulu data turunan yang mereferensikan products.
        $product = Product::findOrFail($id);

        // transactions (FK via transactions.product_id)
        $product->transactions()->delete();

        // stock_opnames (FK via stock_opnames.product_id)
        // Relasi di model Product belum didefinisikan, jadi pakai query langsung.
        \DB::table('stock_opnames')->where('product_id', $product->id)->delete();

        return $product->delete();
    }


}