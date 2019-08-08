<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Rohitpavaskar\Localization\Models\Language;

class CreateLanguagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('languages')) {
            Schema::create('languages', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('code');
                $table->string('text');
                $table->timestamps();
            });

            $data = array(
                array(
                    'code' => 'en',
                    'text' => 'English'
                ),
                array(
                    'code' => 'en-us',
                    'text' => 'English US'
                ),
                array(
                    'code' => 'en-uk',
                    'text' => 'English UK'
                ),
            );

            Language::insert($data);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('languages');
    }

}
