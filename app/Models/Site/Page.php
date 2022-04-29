<?php

namespace App\Models\Site;

class Page extends \App\Models\Base\Page
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $primaryKey = 'slug';

}