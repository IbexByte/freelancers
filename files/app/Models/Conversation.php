<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['order_id', 'user_id', 'provider_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // الحصول على الطرف الآخر في المحادثة
    public function getParticipantAttribute()
    {
        return $this->user_id == auth()->id()
            ? $this->provider
            : $this->user;
    }

    // الحصول على آخر رسالة
    public function getLastMessageAttribute()
    {

        return $this->messages()->latest()->first();
    }

    public function latestMessage()
    {
        // تأكد أن إصدار Laravel لديك يدعم latestOfMany()
        return $this->hasOne(Message::class)->latestOfMany();
    }




}
