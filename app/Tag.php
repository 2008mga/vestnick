<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'additional_color'
    ];

    public function news()
    {
        return $this->belongsToMany(NewModel::class, 'new_tags', 'tag_id');
    }
}
