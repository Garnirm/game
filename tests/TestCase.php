<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $save = DB::table('saves')->where('save_name', 'Unit test')->first();

        DB::table('buildings')->where('save_id', $save->id)->delete();
        DB::table('tiles')->where('save_id', $save->id)->delete();
        DB::table('cities')->where('save_id', $save->id)->delete();
        DB::table('saves')->where('id', $save->id)->delete();
    }

    public function tearDown(): void
    {
        $save = DB::table('saves')->where('save_name', 'Unit test')->first();

        DB::table('buildings')->where('save_id', $save->id)->delete();
        DB::table('tiles')->where('save_id', $save->id)->delete();
        DB::table('cities')->where('save_id', $save->id)->delete();
        DB::table('saves')->where('id', $save->id)->delete();

        DB::disconnect();
    }
}
