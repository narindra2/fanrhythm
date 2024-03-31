<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingModerationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = 
        [
            [
                'key' => 'moderations.moderation_status',
                'display_name' => 'Activer la verfication du purification des contenues medias',
                'value' => true,
                'details' => '',
                'type' => 'checkbox',
                'order' => 10,
                'group' => 'Moderations',
            ],

            // Post
            [
                'key' => 'moderations.post_porn',
                'display_name' => 'Pornographie ou des  actes sexuels',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.post_minor',
                'display_name' => "Détecte la présence des mineurs",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.post_nudity',
                'display_name' => 'Nudité',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.post_extremism',
                'display_name' => 'Des extrémistes, des drapeaux , des insignes.',
                'value' => 99,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.post_drugs',
                'display_name' => 'Des drogues',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.post_weapons',
                'display_name' => 'Les armes à feu',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.post_gore',
                'display_name' => "Violence graphique, des blessures, des accidents",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.post_csam',
                'display_name' => "Abus sexuels sur enfants",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.post_alcohol',
                'display_name' => "Les alcools , des bars et boîtes de nuit",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],


            //profile
            [
                'key' => 'moderations.profile_porn',
                'display_name' => 'Pornographie ou des actes sexuels',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.profile_minor',
                'display_name' => "Détecte la présence des mineurs",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.profile_nudity',
                'display_name' => 'Nudité ',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.profile_extremism',
                'display_name' => 'Des extrémistes, des drapeaux , des insignes.',
                'value' => 99,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.profile_drugs',
                'display_name' => 'Des drogues',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            
            [
                'key' => 'moderations.profile_weapons',
                'display_name' => 'Les armes à feu',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            
            [
                'key' => 'moderations.profile_gore',
                'display_name' => "Violence graphique, des blessures, des accidents",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.profile_csam',
                'display_name' => "Abus sexuels sur enfants",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.profile_alcohol',
                'display_name' => "Les alcools , des bars et boîtes de nuit",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],

            //Message
            [
                'key' => 'moderations.message_porn',
                'display_name' => 'Pornographie ou des actes sexuels',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.message_minor',
                'display_name' => "Détecte la présence des mineurs",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.message_nudity',
                'display_name' => 'Nudité ',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.message_extremism',
                'display_name' => 'Des extrémistes, des drapeaux , des insignes.',
                'value' => 99,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.message_drugs',
                'display_name' => 'Des drogues',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.message_weapons',
                'display_name' => 'Les armes à feu',
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.message_gore',
                'display_name' => "Violence graphique, des blessures, des accidents",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.message_csam',
                'display_name' => "Abus sexuels sur enfants",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],
            [
                'key' => 'moderations.message_alcohol',
                'display_name' => "Les alcools , des bars et boîtes de nuit",
                'value' => 50,
                'details' => '',
                'type' => 'range',
                'order' => 10,
                'group' => 'Moderations',
            ],

        ];
        \DB::table('settings')->whereIn("key" , collect( $data)->pluck("key")->all())->delete();
        \DB::table('settings')->insert($data);
    }
}
