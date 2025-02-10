<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  // اسم الجدول الموجود في قاعدة البيانات
  protected $table = 'service_media';


  protected $fillable = [
    'file_path',
    'type',
    'service_id',
];

protected $appends = ['full_url'];

public function getFullUrlAttribute()
{
    return asset('storage/'.$this->file_path);
}

public function service()
{
    return $this->belongsTo(Service::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
