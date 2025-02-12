<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
       // السماح بكتابة الحقول التالية
  protected $fillable = [
        'order_id',
        'user_id',
        'service_id',
        'rating',
        'comment'
    ];
       /**
        * علاقة التقييم مع الخدمة.
        */
       public function service()
       {
           return $this->belongsTo(Service::class);
       }
   
       /**
        * علاقة التقييم مع المستخدم الذي قام به.
        */
       public function user()
       {
           return $this->belongsTo(User::class);
       }

           // العلاقة مع الطلب (Order)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

  
}
