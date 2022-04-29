<?php

namespace App\Models\Base\Settings;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $phone
 * @property integer $phone2
 * @property string $email
 * @property string $company_name
 * @property string $address_ru
 * @property string $address_uz
 * @property mixed $coordinates
 * @property string $title_ru
 * @property string $title_uz
 * @property string $description_ru
 * @property string $description_uz
 * @property string $logo
 * @property string $favicon
 * @property mixed $social
 * @property string $android_app_url
 * @property string $ios_app_url
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Setting extends Model
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
    protected $fillable = ['created_by', 'updated_by', 'deleted_by', 'phone', 'phone2', 'email', 'company_name', 'address_ru',
        'address_uz', 'coordinates', 'title_ru', 'title_uz', 'description_ru', 'description_uz', 'logo', 'favicon',
        'android_app_url', 'ios_app_url', 'created_at', 'updated_at', 'deleted_at', 'social'];

    protected $hidden = ['created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['telegram', 'fb', 'instagram'];

    public function getSocialAttribute($value)
    {
        return json_decode($value);
    }

    public function getTelegramAttribute($value)
    {
        if ($this->social) {
            foreach ($this->social as $item) {
                if ($item->name == 'telegram') {
                    return $item->value;
                }
            }
        }
        return null;
    }

    public function getFbAttribute($value)
    {
        if ($this->social) {
            foreach ($this->social as $item) {
                if ($item->name == 'fb') {
                    return $item->value;
                }
            }
        }
        return null;
    }

    public function getInstagramAttribute($value)
    {
        if ($this->social) {
            foreach ($this->social as $item) {
                if ($item->name == 'instagram') {
                    return $item->value;
                }
            }
        }
        return null;
    }
}
