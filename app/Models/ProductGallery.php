<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'products_id', 'photo', 'is_default'
    ];

    protected $hidden = [];


    public function product()
    {
        //mengapa belongsTo karena product gallery ini milikinya product
        //sc relaso
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    //sintax ini adalah untuk membuat url photo lebih singkat
    public function getPhotoAttribute($value)
    {
        return url('storage/' . $value);
    }
}