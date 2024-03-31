<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PublicPagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('public_pages')->delete();

        \DB::table('public_pages')->insert(array (
            0 =>
            array (
                'id' => 3,
                'slug' => 'terms-and-conditions',
                'title' => 'Terms and conditions',
                'content' => '',
                'created_at' => '2021-09-30 12:07:35',
                'updated_at' => '2021-09-30 12:07:35',
                'page_order' => 3,
                'shown_in_footer' => 1,
            ),
            1 =>
            array (
                'id' => 4,
                'slug' => 'privacy',
                'title' => 'Privacy Policy',
            'content' => '',
            'created_at' => '2021-09-30 12:09:39',
            'updated_at' => '2021-09-30 12:09:39',
            'page_order' => 2,
            'shown_in_footer' => 1,
        ),
        2 =>
        array (
            'id' => 5,
            'slug' => 'help',
            'title' => 'Help & FAQ',
            'content' => '<p style="margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif;">&nbsp;</p>',
            'created_at' => '2021-09-30 12:10:09',
            'updated_at' => '2023-03-09 15:07:20',
            'page_order' => 1,
            'shown_in_footer' => 1,
        )
    ));


    }
}
