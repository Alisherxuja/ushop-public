<?php

namespace App\Models\Base\Site;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $title_ru
 * @property string $title_uz
 * @property string $slug
 * @property string $content_ru
 * @property string $content_uz
 * @property int $view_count
 * @property int $status
 * @property string $keywords
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property ArticleAttachment[] $articleAttachments
 */
class Article extends Model
{
    use Sluggable;

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_by', 'updated_by', 'title_ru', 'title_uz', 'status', 'slug', 'content_ru', 'content_uz', 'view_count', 'keywords', 'description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleAttachments()
    {
        return $this->hasMany('App\Models\Base\Site\ArticleAttachment');
    }

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

    public static function search(Request $request)
    {
        return self::query()
            ->when($request->title, function (Builder $query) use ($request) {
                $query->orWhere('title_ru', 'ilike', '%' . $request->title . '%')
                    ->orWhere('title_uz', 'ilike', '%' . $request->title . '%');
            })
            ->when(!is_null($request->status), function (\Illuminate\Database\Eloquent\Builder $query) use ($request) {
                $query->where('status', $request->status);
            });
    }
}
