<?php

namespace Rohitpavaskar\Localization\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model {

    protected $fillable = ['key', 'text', 'type', 'module', 'language'];

    public function scopeAdvancedFilter($query, $advancedFilter) {
        if (count($advancedFilter)) {
            if (isset($advancedFilter['status'])) {
                if ($advancedFilter['status'] != '') {
                    if ($advancedFilter['status'] == 'no_enrollment') {
                        $query->noEnrollments();
                    }
                    if ($advancedFilter['status'] == 'no_completion') {
                        $query->noCompletions();
                    }
                    if ($advancedFilter['status'] == 'no_questions') {
                        $query->noQuestions();
                    }
                }
            }
            if (isset($advancedFilter['name'])) {
                if ($advancedFilter['name'] != '') {
                    $query->where('name', 'like', '%' . $advancedFilter['name'] . '%');
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
}
