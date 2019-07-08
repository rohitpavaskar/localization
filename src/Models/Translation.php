<?php

namespace Rohitpavaskar\Localization\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model {

    protected $fillable = ['key', 'text', 'type', 'module', 'language'];

}
