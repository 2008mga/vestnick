<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

/**
 * App\Tag
 *
 * @property-read mixed $news_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NewModel[] $news
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NewModel[] $newsMini
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $fillable = [
        'name',
        'additional_color',
        'description',
        'image'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'news_count'
    ];

    public function news()
    {
        return $this->belongsToMany(NewModel::class, 'new_tags', 'tag_id', 'new_id');
    }

    public function getNewsCountAttribute() {
        return $this->news()->count();
    }

    public function uploadImage(UploadedFile $image)
    {
        $image = Image::make($image)->fit(500);
        $filename = hash('sha256', $image->encode('data-url') . \Hash::make('laravel')) .'.png';
        $publicPath = '/images/tags/' . $filename;
        $path = public_path('/images/tags/' . $filename);

        $this->dropImage();

        $image->save($path);

        $this->image = $publicPath;

        return $this;
    }

    public function dropImage()
    {
        if ($this->image && file_exists(public_path($this->image))) {
            unlink(public_path($this->image));
        }
    }
}
