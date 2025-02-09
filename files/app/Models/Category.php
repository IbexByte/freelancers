<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'slug', 'image', 'status'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    // دالة لجلب الصورة الافتراضية إذا لم يتم رفع صورة
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-category.jpg');
    }

}
