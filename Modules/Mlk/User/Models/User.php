<?php

namespace Mlk\User\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name','email','password'];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function textStatusEmailVerifiedAt() : string
    {
        if($this->email_verified_at)
            return 'تایید شده';

        return 'تایید نشده';
    }


    public function cssStatusEmailVerifiedAt() : string
    {
        if($this->email_verified_at)
            return 'success';

        return 'danger';
    }

}
