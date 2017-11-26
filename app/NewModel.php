<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * App\NewModel
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NewLike[] $likes
 * @property-read mixed $private_link
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class NewModel extends Model
{

    protected $table = 'news';

    protected $fillable = [
        'short_name',
        'full_name',
        'is_private',
        'display_author',
        'slug',
        'views',
        'text'
    ];

    protected $hidden = [
        'slug',
    ];

    protected $casts = [
        'is_private' => 'boolean',
        'display_author' => 'boolean',
    ];

    protected $appends = [
        'private_link',
        'user_current'
    ];

    protected static function boot()
    {
        self::creating(function (NewModel $new) {
            $new->slug = bcrypt($new->table . '_qworuiqwir2o1i41204irq_' . $new->created_at);
            return $new;
        });

        parent::boot();
    }

    public function comments()
    {
        return $this->hasMany(NewComment::class, 'new_id');
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

    public function user()
    {
        return $this->belongsTo(User::class)->select(['email', 'id', 'name', 'avatar']);
    }

    public function getUserCurrentAttribute()
    {
        if ($this->display_author) {
            return $this->user;
        }

        return null;
    }


}
