<?php

namespace App\Models\Base\Site;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property boolean $is_main
 * @property string $image
 * @property string $image_url
 * @property string $url
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Banner extends Model
{
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
    protected $fillable = ['is_main', 'image', 'url', 'status', 'created_at', 'updated_at'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? \Storage::disk('public')->url($this->image) : null;
    }

}
