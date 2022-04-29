<?php

namespace App\Models\Base\Site;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'adds';
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
    protected $fillable = ['name', 'image', 'url', 'status', 'created_at', 'updated_at'];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset(\Storage::disk('public')->url($this->image), env('APP_SSL')) : null;
    }

}