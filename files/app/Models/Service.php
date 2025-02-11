<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    // app/Models/Category.php
    protected $fillable = [
        'title',
        'description',
        'price',
        'status',
        'user_id',
        'category_id'
    ];
    //


    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
{
    return $this->hasMany(Review::class);
}


public function getReviewsCountAttribute()
{
    return $this->reviews()->count();
}

public function getAverageRatingAttribute()
{
    return round($this->reviews()->avg('rating'), 1);
}



    public function getFirstMediaUrl($collection = null)
    {
        $mediaItem = $this->media()->first();

        if ($mediaItem) {
            return Storage::url($mediaItem->file_path);
        }

        // إرجاع رابط افتراضي إذا لم يكن هناك مرفقات
        return asset('images/default.png');
    }
}
