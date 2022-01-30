<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'desc',
        'user_id',
        'image_url',
    ];

    public function productReviews()
    {
        return $this->HasMany(ProductReview::class);
    }

    public function orderProducts($order_by)
    {
        $query = 'SELECT * FROM products ORDER BY created_at DESC';

        if ($order_by == 'best_seller') {
            $query = "SELECT pdt.*, orit.quantity FROM products AS pdt LEFT JOIN (SELECT product_id, SUM(quantity) AS quantity FROM order_items GROUP BY product_id) AS orit ON orit.product_id = pdt.id ORDER BY orit.quantity DESC";
        } elseif ($order_by == 'terbaik') {
            $query = 'SELECT p.*, pr.rating FROM products AS p LEFT JOIN (SELECT product_id, AVG(rating) AS rating FROM product_reviews GROUP BY product_id) AS pr ON pr.product_id = p.id ORDER BY pr.rating DESC';
        } elseif ($order_by == 'termurah') {
            $query = 'SELECT * FROM products ORDER BY price ASC';
        } elseif ($order_by == 'termahal') {
            $query = 'SELECT * FROM products ORDER BY price DESC';
        } elseif ($order_by == 'terbaru') {
            $query = 'SELECT * FROM products ORDER BY created_at DESC';
        }

        return DB::select($query);
    }

    public function adminProducts($admin_id)
    {
        $query = 'SELECT * FROM products ORDER BY created_at DESC';

        if ($admin_id == Auth::user()->id) {
            $query = 'SELECT * FROM products WHERE user_id = "'.$admin_id.'" ORDER BY user_id ASC';
        }

        return DB::select($query);
    }
}
