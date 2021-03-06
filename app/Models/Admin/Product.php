<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Brand;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Auth;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_code',
        'product_quantity',
        'category_id',
        'subcategory_id',
        'brand_id',
        'product_size',
        'product_color',
        'selling_price',
        'product_details',
        'video_link',
        'image_one',
        'image_two',
        'image_three',
        'main_slider',
        'hot_deal',
        'best_rated',
        'trend',
        'mid_slider',
        'hot_new',
        'status',
        'discount_price',
    ];

    public function order_details()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function wish_lists()
    {
        return $this->hasMany('App\Models\WishList');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function current_user_wish()
    {
        return $this->wish_lists()->where('user_id', Auth::id());
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Admin\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Admin\Brand');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\Admin\Subcategory');
    }

    /**
     * Check created_at of product in a month
     *
     * @return void
     */
    public function getCompareDateAttribute()
    {
        $now = Carbon::now();
        $create_date = new Carbon($this->created_at);

        if ($create_date->addMonth()->gt($now)) {
            return true;
        }
        return false;
    }

    /**
     * Get latest three products that main slider status is 1
     *
     * @return Object
     */
    public function getMainSliderProduct() {
        return $this->select('products.*', 'brands.brand_name')
                    ->join('brands', 'products.brand_id', '=', 'brands.id')
                    ->where('main_slider', 1)
                    ->orderBy('id', 'DESC')
                    ->limit(3)
                    ->get();
    }

    /**
     * Get products that best rated is 1
     *
     * @return Object
     */
    public function getBestRatedProducts() {
        return $this->where('status', 1)
                    ->where('best_rated', 1)
                    ->orderBy('id', 'DESC')
                    ->limit(8)
                    ->get();
    }

    /**
     * Caluculate discount percentage
     *
     * @return Int
     */
    public function caluculateDiscountPercent() {
        $amount = $this->selling_price - $this->discount_price;
        return round($amount / $this->selling_price * 100);
    }

    /**
     * Get products to show at middle slider with category & brand name
     *
     * @return Object
     */
    public function getMiddleSliderProducts() {
        return $this->select('products.*', 'categories.category_name', 'brands.brand_name')
                    ->join('categories', 'products.category_id', 'categories.id')
                    ->join('brands', 'products.brand_id', 'brands.id')
                    ->where('products.mid_slider', 1)
                    ->orderBy('id', 'DESC')
                    ->limit(3)
                    ->get();
    }

    /**
     * Get products by category id
     *
     * @param String $id
     * @return Object
     */
    public function getProductsByCategoryId($id) {
        return $this->where('category_id', $id)
                    ->where('status', 1)
                    ->limit(10)
                    ->orderBy('id', 'DESC')
                    ->get();
    }

    /**
     * Get info of a product with relations
     *
     * @param String $id
     * @return Object
     */
    public function getProductToDisplayInfo($id) {
        return $this->with([
                        'category:id,category_name',
                        'subcategory:id,subcategory_name',
                        'brand:id,brand_name',
                        'current_user_wish',
                    ])
                    ->find($id);
    }

    /**
     * Configure to save product info to cart
     *
     * @param String $id
     * @return Array
     */
    public function configureProductInfo($id) {
        $product = $this->where('id', $id)->first();

        $data = array();
        $data['id'] = $product->id;
        $data['name'] = $product->product_name;
        $data['qty'] = 1;
        $data['weight'] = 1;
        $data['options']['image'] = $product->image_one;
        $data['options']['color'] = '';
        $data['options']['size'] = '';

        if ($product->discount_price === NULL) {
            $data['price'] = $product->selling_price;
        } else {
            $data['price'] = $product->discount_price;
        }

        return $data;
    }

    /**
     * Get paginate categories
     *
     * @param String $id
     * @return Object
     */
    public function getPaginateCategories($id) {
        return $this->with('current_user_wish')->where('category_id', $id)->paginate(10);
    }

    /**
     * Get paginate products
     *
     * @param String $id
     * @return Object
     */
    public function getPaginateProducts($id) {
        return $this->with('current_user_wish')->where('subcategory_id', $id)->paginate(10);
    }

    /**
     * Get brands by category id
     *
     * @param String $id
     * @return Array
     */
    public function getBrandsByCategoryId($id) {
        $brnad_ids = $this->select('brand_id')->where('category_id', $id)->groupBy('brand_id')->get();
        $brands = [];
        foreach ($brnad_ids as $brand) {
            $brands[] = Brand::where('id', $brand->brand_id)->first();
        }

        return $brands;
    }

    /**
     * Get brands by sub category id
     *
     * @param String $id
     * @return Array
     */
    public function getBrandsBySubCategoryId($id) {
        $brnad_ids = $this->select('brand_id')->where('subcategory_id', $id)->groupBy('brand_id')->get();
        $brands = [];
        foreach ($brnad_ids as $brand) {
            $brands[] = Brand::where('id', $brand->brand_id)->first();
        }

        return $brands;
    }

    public function countAllProducts()
    {
        return $this->all()->count();
    }

    /**
     * Check exists product image one in storage
     *
     * @return void
     */
    public function getStorageProductImageOneAttribute()
    {
        if (Storage::disk('s3')->exists($this->image_one)) {
            return true;
        }
        return false;
    }

    /**
     * Check exists product image two in storage
     *
     * @return void
     */
    public function getStorageProductImageTwoAttribute()
    {
        if (Storage::disk('s3')->exists($this->image_two)) {
            return true;
        }
        return false;
    }

    /**
     * Check exists product image three in storage
     *
     * @return void
     */
    public function getStorageProductImageThreeAttribute()
    {
        if (Storage::disk('s3')->exists($this->image_three)) {
            return true;
        }
        return false;
    }
}
