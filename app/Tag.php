<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'additional_color'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function news()
    {
        return $this->belongsToMany(NewModel::class, 'new_tags', 'tag_id');
    }
}
