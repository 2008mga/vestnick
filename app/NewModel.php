<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewModel extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'html',
        'is_private',
        'display_author',
        'slug',
        'views'
    ];

    protected $hidden = [
        'slug',
        'is_private',
        'display_author',
    ];

    protected $casts = [
        'is_private' => 'boolean',
        'display_author' => 'boolean',
    ];

    protected $appends = [
        'private_link',
    ];

    protected static function boot()
    {
        self::creating(function (NewModel $new) {
            $new->slug = bcrypt($new->table . '_qworuiqwir2o1i41204irq_' . $new->created_at);
            return $new;
        });

        parent::boot();
    }

    public function getPrivateLinkAttribute()
    {
        return route('new.private', $this->slug);
    }

    public function getLikesAttribute()
    {
        return $this->likes()->count();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'new_tags', 'new_id');
    }

    public function likes()
    {
        return $this->hasMany(NewLike::class, 'new_id');
    }
}
