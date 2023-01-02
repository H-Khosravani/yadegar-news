<?php

namespace Mlk\Category\Models;

use Mlk\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'parent_id', 'title', 'slug', 'keywords', 'description', 'status'];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';
    public static array $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function getParent()
    {
        if (is_null($this->parent_id)) return 'ندارد';

        return $this->parentCategory->title;
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function path() # Link Generator Helper Function From (Slug To Link) For Category
    {
        return route('categories.details', $this->slug);
    }

}
