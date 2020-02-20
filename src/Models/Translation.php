<?php

namespace Rohitpavaskar\Localization\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model {

    protected $fillable = ['key', 'text', 'type', 'module', 'language', 'is_updated'];

    public function scopeAdvancedFilter($query, $advancedFilter) {
        if (count($advancedFilter)) {
            if (isset($advancedFilter['type'])) {
                if ($advancedFilter['type'] != '' && $advancedFilter['type'] != 'all') {
                    $query->where('translations.type', $advancedFilter['type']);
                }
            }
            if (isset($advancedFilter['id'])) {
                if ($advancedFilter['id'] != '') {
                    $query->where('id', $advancedFilter['id']);
                }
            }
            return $query;
        }
    }

    public function scopeSearch($query, $filter) {
        if ($filter != '') {
            return $query->where('translations.key', 'like', '%' . $filter . '%')
                            ->orWhere('translations.text', 'like', '%' . $filter . '%')
                            ->orWhere('translations.module', 'like', '%' . $filter . '%')
                            ->orWhere('t2.text', 'like', '%' . $filter . '%');
        }
    }

}
