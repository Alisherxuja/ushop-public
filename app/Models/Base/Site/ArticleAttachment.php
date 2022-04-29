<?php

namespace App\Models\Base\Site;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $article_id
 * @property string $path
 * @property string $path_url
 * @property string $created_at
 * @property string $updated_at
 * @property Article $article
 */
class ArticleAttachment extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['article_id', 'created_by', 'updated_by', 'path', 'created_at', 'updated_at'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['path_url'];

    public function getPathUrlAttribute()
    {
        return $this->path ? asset(\Storage::disk('public')->url($this->path), env('APP_SSL')) : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo('App\Models\Base\Site\Article');
    }
}
