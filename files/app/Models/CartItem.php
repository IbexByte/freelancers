<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['user_id', 'service_id', 'quantity'];

     // العلاقة مع المستخدم (المشتري)
     public function user()
     {
         return $this->belongsTo(User::class);
     }
 
     // العلاقة مع الخدمة (Service)
     public function service()
     {
         return $this->belongsTo(Service::class);
     }
}
