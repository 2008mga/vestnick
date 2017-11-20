<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Role
 *
 * @mixin \Eloquent
 */
class Role extends Model
{
    protected $fillable = ['name', 'can'];

    protected $casts = [
        'can' => 'array'
    ];

    public static function findByName($name)
    {
        return self::query()->where('name', $name)->firstOrFail();
    }
}
