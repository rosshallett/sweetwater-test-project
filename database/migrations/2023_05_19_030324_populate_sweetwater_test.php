<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PopulateSweetwaterTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $contents = Storage::disk('resources')->get('sweetwater_test.sql');
        $date = new \DateTime('now');

        // Make the `shipdate_expected` fields valid datetime values so they will insert correctly
        $contents = str_replace('0000-00-00 00:00:00', $date->format('Y-m-d H:i:s'), $contents);

        DB::unprepared($contents);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sweetwater_test');
    }
}
