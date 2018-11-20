<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'social_type',
        'social_id',
        'username',
        'first_name',
        'last_name',
        'gender',
        'active',
        'birthday_at',
        'phone_number',
        'email',
        'address',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function sendPasswordResetNotification($token)
    {
        $user = $this;
        $link = route('password.reset', $token);
        
        $data = [
                'name' => $user->first_name . ' ' . $user->last_name,
                'link' => $link,
                'imageUrl' =>  public_path() . '/img/salon-logo.png'
            ];

        Mail::send('activation.reset_pasword', $data, function($message) use ($user)
        {   
            $message->to($user->email)->subject('Reset Password mail');
        });
    }
    
    
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
    
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
