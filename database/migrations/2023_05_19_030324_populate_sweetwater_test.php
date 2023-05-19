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

        // Iterate over each comment in `sweetwater_test` to parse out expected ship date
        $comments = DB::table('sweetwater_test')->get();

        foreach ($comments as $row)
        {
            if (str_contains(($row->comments), 'Expected Ship Date:'))
            {
                $exp = '/Expected Ship Date: (\d+\/\d+\/\d+)/';
                $split = preg_split($exp, $row->comments, -1, PREG_SPLIT_DELIM_CAPTURE);
                $capture = $split[1];
                $row->comments = trim($split[0] . $split[2]);
                $row->shipdate_expected = DateTimeImmutable::createFromFormat('m/d/y', $capture);
                DB::table('sweetwater_test')->where('orderid', $row->orderid)->update(array('comments' => $row->comments, 'shipdate_expected' => $row->shipdate_expected));
            }
        }
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
