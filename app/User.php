<?php

namespace App;

use App\Helpers\HasRole;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Intervention\Image\Facades\Image;
use Laravel\Passport\HasApiTokens;
use Laravel\Scout\Searchable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NewModel[] $news
 */
class User extends Authenticatable
{
    use Notifiable, HasRole, HasApiTokens;

    protected static $defaultAvatar;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'about', 'sex', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $with = [
        'roles'
    ];

    public function comments()
    {
        return $this->hasMany(NewComment::class,'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function news()
    {
        return $this->hasMany(NewModel::class, 'user_id');
    }

    public function uploadAvatar(UploadedFile $avatar)
    {
        $ext = $avatar->extension();
        $avatar = Image::make($avatar)->fit(300);


        $filename = hash('sha256', $avatar->encode('data-url') . \Hash::make('laravel')) . '.' . $ext;
        $publicPath = '/images/users/' . $filename;
        $path = public_path('/images/users/' . $filename);

        $this->dropAvatar();

        $avatar->save($path);

        $this->avatar = $publicPath;

        return $this;
    }

    public function dropAvatar()
    {
        if ($this->avatar && file_exists(public_path($this->avatar)) && $this->avatar != self::$defaultAvatar) {
            unlink(public_path($this->avatar));
        }
    }

    public function __construct(array $attributes = [])
    {
        self::$defaultAvatar = config('app.default_avatar');
        parent::__construct($attributes);
    }


    protected static function boot()
    {
        self::creating(function (User $user) {
            // hash password
            $user->password = \Hash::make($user->password);
            return $user;
        });

        self::updating(function (User $user) {
            // hash password

            if ($user->isDirty('password')) {
                $user->password = \Hash::make($user->password);
            }
            return $user;
        });

        self::deleting(function (User $user) {
            // delete avatar
            $user->dropAvatar();
        });

        parent::boot();
    }


}
