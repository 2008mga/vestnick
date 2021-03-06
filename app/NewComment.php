<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewComment extends Model
{
    protected $fillable = [
        'text',
        'user_id',
        'new_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function newModel()
    {
        return $this->hasOne(NewModel::class, 'new_id');
    }
}
