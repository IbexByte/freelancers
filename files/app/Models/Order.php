<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $casts = [
        'requested_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'service_id',
        'provider_id',
        'status',
        'requested_at',
        'approved_at',
        'delivered_at',
        'completed_at',
        'estimated_delivery_time'
    ];

    const STATUSES = [
        'pending_approval',
        'approved',
        'in_progress',
        'delivered',
        'completed',
        'cancelled',
    ];
      // العلاقة مع المستخدم (المشتري)
      public function user()
      {
          return $this->belongsTo(User::class);
      }
  
      // العلاقة مع مزود الخدمة (البائع)
      public function provider()
      {
          return $this->belongsTo(User::class, 'provider_id');
      }
  
      // العلاقة مع الخدمة (Service)
      public function service()
      {
          return $this->belongsTo(Service::class);
      }
  
      // العلاقة مع المراجعة (Review)
      public function review()
      {
          return $this->hasOne(Review::class);
      }
  
}
