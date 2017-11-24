<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class NewModel extends Model
{
    use Searchable;

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

    public function user()
    {
        return $this->belongsTo(User::class)->select(['email', 'id', 'name']);
    }

    public function toSearchableArray()
    {
        $data = $this->with(['user', 'tags']);

        return $data->get()->first()->toArray();

    }


}
