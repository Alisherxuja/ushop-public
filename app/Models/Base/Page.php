<?php

namespace App\Models\Base;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title_uz
 * @property string $title_ru
 * @property string $slug
 * @property string $content_uz
 * @property string $content_ru
 * @property string $created_at
 * @property string $updated_at
 */
class Page extends Model
{

    use Sluggable;
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['title_uz', 'title_ru', 'slug', 'content_uz', 'content_ru', 'created_at', 'updated_at'];
    /**
     * @return \string[][]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_ru'
            ]
        ];
    }
}
