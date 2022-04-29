<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $question
 * @property string $answer
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Faq extends Model
{
    const STATUS_CANCEL = 0;
    const STATUS_NEW = 1;
    const STATUS_DONE = 5;
    const STATUS_SHOW = 10;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'phone', 'question', 'answer', 'status', 'created_at', 'updated_at'];

}
