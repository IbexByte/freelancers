<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'email',
        'password',
    ];


  
    
    public function isOnline()
    {
        return $this->last_active_at && 
               $this->last_active_at->gt(now()->subMinutes(5));
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_active_at' => 'datetime',
        ];
    }


        // العلاقة مع الخدمات المقدمة (كمزود خدمة)
        public function services()
        {
            return $this->hasMany(Service::class, 'user_id');
        }
    
        // العلاقة مع الطلبات (كعميل)
        public function orders()
        {
            return $this->hasMany(Order::class, 'user_id');
        }
    
        // العلاقة مع الطلبات (كمزود خدمة)
        public function providedOrders()
        {
            return $this->hasMany(Order::class, 'provider_id');
        }
    
        // العلاقة مع عناصر عربة التسوق (CartItems)
        public function cartItems()
        {
            return $this->hasMany(CartItem::class);
        }
    
        // العلاقة مع المراجعات (Reviews)
        public function reviews()
        {
            return $this->hasMany(Review::class);
        }

        public function conversations(){
            return $this->hasMany(Conversation::class );
        }
    
}
