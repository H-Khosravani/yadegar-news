<?php

namespace Mlk\User\Models;
use Mlk\Article\Models\Article;
use Mlk\Comment\Models\Comment;
use Laravel\Sanctum\HasApiTokens;
use Overtrue\LaravelLike\Traits\Liker;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Liker;

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

    # Relation categories Table  :
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    # Relation articles Table  :
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    # Relation category Table  :
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    # Methods :
    public function path()
    {
        return route('users.author', $this->name);
    }

    public function image()
    {
        return asset('assets/imgs/logo2.svg');
    }
}
