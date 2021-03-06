<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    protected $fillable = [
        'brand_name', 'brand_logo'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Admin\Product');
    }

    public function countAllBrands()
    {
        return $this->all()->count();
    }

    /**
     * Check exists brand image in storage
     *
     * @return void
     */
    public function getStorageBrandImageAttribute()
    {
        if (Storage::disk('s3')->exists($this->brand_logo)) {
            return true;
        }
        return false;
    }
}
