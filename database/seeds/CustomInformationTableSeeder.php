<?php

use App\CustomInformation;
use Illuminate\Database\Seeder;

class CustomInformationTableSeeder extends Seeder {

    public function run()
    {
        DB::table('custom_informations')->delete();

        $custom_informations = array(
            array(
                'id' => 1,
                'email' => "core@gmail.com",
                'phone' => "core",
                'address' => "",
                'about_text' => "",
                'facebook_link' => "https://www.facebook.com/",
                'twitter_link' => "https://twitter.com/",
                'instagram_link' => "https://www.instagram.com/",
                'google_plus_link' => "https://plus.google.com/",
                'copyright' => "© 2017 Core Website by PLATINUN INK DESIGN",
            ),
        );

        foreach ($custom_informations as $custom_information) {
            CustomInformation::create($custom_information);
        }

    }

}
