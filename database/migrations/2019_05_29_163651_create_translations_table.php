<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Rohitpavaskar\Localization\LocalizationServiceProvider;
use Rohitpavaskar\Localization\Models\Translation;

class CreateTranslationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->text('text')->nullable();
            $table->string('type')->default('application');
            $table->string('module')->default('common');
            $table->string('language', 5)->default('en');
            $table->enum('is_updated', ['0', '1'])->default('0');
            $table->unique(['key', 'type', 'module', 'language']);
            $table->timestamps();
        });

        $labels = array(
            array(
                'key' => 'failed',
                'text' => 'These credentials do not match our records.',
                'type' => 'auth',
                'module' => 'backend',
                'language' => 'en'
            ),
            array(
                'key' => 'throttle',
                'text' => 'Too many login attempts. Please try again in :seconds seconds.',
                'type' => 'auth',
                'module' => 'backend',
                'language' => 'en'
            ),
            array(
                'key' => 'previous',
                'text' => '&laquo; Previous',
                'type' => 'pagination',
                'module' => 'backend',
                'language' => 'en'
            ),
            array(
                'key' => 'next',
                'text' => 'Next &raquo;',
                'type' => 'pagination',
                'module' => 'backend',
                'language' => 'en'
            ),
            array(
                'key' => 'password',
                'text' => 'Passwords must be at least eight characters and match the confirmation.',
                'type' => 'passwords',
                'module' => 'backend',
                'language' => 'en'
            ),
            array(
                'key' => 'reset',
                'text' => 'Your password has been reset!',
                'type' => 'passwords',
                'module' => 'backend',
                'language' => 'en'
            ),
            array(
                'key' => 'sent',
                'text' => 'We have e-mailed your password reset link!',
                'type' => 'passwords',
                'module' => 'backend',
                'language' => 'en'
            ),
            array(
                'key' => 'token',
                'text' => 'This password reset token is invalid.',
                'type' => 'passwords',
                'module' => 'backend',
                'language' => 'en'
            ),
            array(
                'key' => 'user',
                'text' => "We can't find a user with that e-mail address.",
                'type' => 'passwords',
                'module' => 'backend',
                'language' => 'en'
            ),
            array(
                'key' => 'accepted',
                'text' => 'The :attribute must be accepted.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'active_url',
                'text' => 'The :attribute is not a valid URL.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'after',
                'text' => 'The :attribute must be a date after :date.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'after_or_equal',
                'text' => 'The :attribute must be a date after or equal to :date.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'alpha',
                'text' => 'The :attribute may only contain letters.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'alpha_dash',
                'text' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'alpha_num',
                'text' => 'The :attribute may only contain letters and numbers.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'array',
                'text' => 'The :attribute must be an array.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'before',
                'text' => 'The :attribute must be a date before :date.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'before_or_equal',
                'text' => 'The :attribute must be a date before or equal to :date.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'between.numeric',
                'text' => 'The :attribute must be between :min and :max.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'between.file',
                'text' => 'The :attribute must be between :min and :max kilobytes.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'between.string',
                'text' => 'The :attribute must be between :min and :max characters.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'between.array',
                'text' => 'The :attribute must have between :min and :max items.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'boolean',
                'text' => 'The :attribute field must be true or false.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'confirmed',
                'text' => 'The :attribute confirmation does not match.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'date',
                'text' => 'The :attribute is not a valid date.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'date_equals',
                'text' => 'The :attribute must be a date equal to :date.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'date_format',
                'text' => 'The :attribute does not match the format :format.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'different',
                'text' => 'The :attribute and :other must be different.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'digits',
                'text' => 'The :attribute must be :digits digits.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'digits_between',
                'text' => 'The :attribute must be between :min and :max digits.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'dimensions',
                'text' => 'The :attribute has invalid image dimensions.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'distinct',
                'text' => 'The :attribute field has a duplicate value.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'email',
                'text' => 'The :attribute must be a valid email address.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'ends_with',
                'text' => 'The :attribute must end with one of the following: :values',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'exists',
                'text' => 'The selected :attribute is invalid.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'file',
                'text' => 'The :attribute must be a file.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'filled',
                'text' => 'The :attribute field must have a value.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'gt.numeric',
                'text' => 'The :attribute must be greater than :value.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'gt.file',
                'text' => 'The :attribute must be greater than :value kilobytes.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'gt.string',
                'text' => 'The :attribute must be greater than :value characters.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'gt.array',
                'text' => 'The :attribute must have more than :value items.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'gte.numeric',
                'text' => 'The :attribute must be greater than or equal :value.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'gte.file',
                'text' => 'The :attribute must be greater than or equal :value kilobytes.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'gte.string',
                'text' => 'The :attribute must be greater than or equal :value characters.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'gte.array',
                'text' => 'The :attribute must have :value items or more.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'image',
                'text' => 'The :attribute must be an image.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'in',
                'text' => 'The selected :attribute is invalid.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'in_array',
                'text' => 'The :attribute field does not exist in :other.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'integer',
                'text' => 'The :attribute must be an integer.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'ip',
                'text' => 'The :attribute must be a valid IP address.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'ipv4',
                'text' => 'The :attribute must be a valid IPv4 address.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'ipv6',
                'text' => 'The :attribute must be a valid IPv6 address.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'json',
                'text' => 'The :attribute must be a valid JSON string.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'lt.numeric',
                'text' => 'The :attribute must be less than :value.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'lt.file',
                'text' => 'The :attribute must be less than :value kilobytes.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'lt.string',
                'text' => 'The :attribute must be less than :value characters.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'lt.array',
                'text' => 'The :attribute must have less than :value items.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'lte.numeric',
                'text' => 'The :attribute must be less than or equal :value.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'lte.file',
                'text' => 'The :attribute must be less than or equal :value kilobytes.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'lte.string',
                'text' => 'The :attribute must be less than or equal :value characters.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'lte.array',
                'text' => 'The :attribute must not have more than :value items.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'max.numeric',
                'text' => 'The :attribute may not be greater than :max.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'max.file',
                'text' => 'The :attribute may not be greater than :max kilobytes.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'max.string',
                'text' => 'The :attribute may not be greater than :max characters.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'max.array',
                'text' => 'The :attribute may not have more than :max items.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'mimes',
                'text' => 'The :attribute must be a file of type: :values.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'mimetypes',
                'text' => 'The :attribute must be a file of type: :values.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'min.numeric',
                'text' => 'The :attribute must be at least :min.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'min.file',
                'text' => 'The :attribute must be at least :min kilobytes.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'min.string',
                'text' => 'The :attribute must be at least :min characters.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'min.array',
                'text' => 'The :attribute must have at least :min items.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'not_in',
                'text' => 'The selected :attribute is invalid.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'not_regex',
                'text' => 'The :attribute format is invalid.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'numeric',
                'text' => 'The :attribute must be a number.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'present',
                'text' => 'The :attribute field must be present.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'regex',
                'text' => 'The :attribute format is invalid.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'required',
                'text' => 'The :attribute field is required.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'required_if',
                'text' => 'The :attribute field is required when :other is :value.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'required_unless',
                'text' => 'The :attribute field is required unless :other is in :values.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'required_with',
                'text' => 'The :attribute field is required when :values is present.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'required_with_all',
                'text' => 'The :attribute field is required when :values are present.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'required_without',
                'text' => 'The :attribute field is required when :values is not present.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'required_without_all',
                'text' => 'The :attribute field is required when none of :values are present.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'same',
                'text' => 'The :attribute and :other must match.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'size.numeric',
                'text' => 'The :attribute must be :size.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'size.file',
                'text' => 'The :attribute must be :size kilobytes.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'size.string',
                'text' => 'The :attribute must be :size characters.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'size.array',
                'text' => 'The :attribute must contain :size items.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'starts_with',
                'text' => 'The :attribute must start with one of the following: :values',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'string',
                'text' => 'The :attribute must be a string.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'timezone',
                'text' => 'The :attribute must be a valid zone.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'unique',
                'text' => 'The :attribute has already been taken.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'uploaded',
                'text' => 'The :attribute failed to upload.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'url',
                'text' => 'The :attribute format is invalid.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ), array(
                'key' => 'uuid',
                'text' => 'The :attribute must be a valid UUID.',
                'type' => 'validation',
                'module' => 'common',
                'language' => 'en'
            ),
        );

        Translation::insert($labels);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('translations');
    }

}
