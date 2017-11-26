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
        return $this->hasOne(User::class, 'user_id');
    }

    public function newModel()
    {
        return $this->hasOne(NewModel::class, 'new_id');
    }
}
