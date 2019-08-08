<?php

namespace Rohitpavaskar\Localization\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model {

    protected $fillable = ['key', 'text', 'type', 'module', 'language'];

    public function scopeAdvancedFilter($query, $advancedFilter) {
        if (count($advancedFilter)) {
            if (isset($advancedFilter['type'])) {
                if ($advancedFilter['type'] != '') {
                    $query->where('type', $advancedFilter['type']);
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
            return $query->having('key', 'like', '%' . $filter . '%')
                            ->orHaving('text', 'like', '%' . $filter . '%')
                            ->orHaving('module', 'like', '%' . $filter . '%')
                            ->orHaving('text_2', 'like', '%' . $filter . '%');
        }
    }

}
