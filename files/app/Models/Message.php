<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة.
     *
     * @var array
     */
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'content',
        'read',
    ];
   
    public function conversation() {
        return $this->belongsTo(Conversation::class);
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
