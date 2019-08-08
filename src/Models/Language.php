<?php

namespace Rohitpavaskar\Localization\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

    protected $fillable = ['code', 'text'];

    

    public function scopeSearch($query, $filter) {
        if ($filter != '') {
            return $query->where('code', 'like', '%' . $filter . '%')
                            ->orWhere('text', 'like', '%' . $filter . '%');
        }
    }

}
