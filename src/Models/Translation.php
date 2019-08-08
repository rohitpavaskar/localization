<?php

namespace Rohitpavaskar\Localization\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model {

    protected $fillable = ['key', 'text', 'type', 'module', 'language'];

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
            return $query->having('translations.key', 'like', '%' . $filter . '%')
                            ->orHaving('translations.text', 'like', '%' . $filter . '%')
                            ->orHaving('translations.module', 'like', '%' . $filter . '%')
                            ->orHaving('text_2', 'like', '%' . $filter . '%');
        }
    }

}
