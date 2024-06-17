<?php

use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('site_settings')->insert(
            array(
                array(
                    'title'=> 'KlientScape',
                    'email'=> 'info@klientscape.com',
                    'address'=>'Gairidhara, Kathmandu',
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at'=> \Carbon\Carbon::now(),
                ),
            ));
    }
}
