<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'site.name',
                'display_name' => 'Site name',
                'value' => 'afrifans',
                'details' => '',
                'type' => 'text',
                'order' => 10,
                'group' => 'Site',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'site.description',
                'display_name' => 'Site description',
                'value' => 'afrifans description',
                'details' => '',
                'type' => 'text',
                'order' => 20,
                'group' => 'Site',
            ),
            2 => 
            array (
                'id' => 5,
                'key' => 'admin.bg_image',
                'display_name' => 'Admin Background Image',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 5,
                'group' => 'Admin',
            ),
            3 => 
            array (
                'id' => 6,
                'key' => 'admin.title',
                'display_name' => 'Admin Title',
                'value' => 'afrifans  Admin',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ),
            4 => 
            array (
                'id' => 7,
                'key' => 'admin.description',
                'display_name' => 'Admin Description',
                'value' => 'Welcome to afrifans Admin Panel. Log in to manage and customize your site!',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Admin',
            ),
            5 => 
            array (
                'id' => 8,
                'key' => 'admin.loader',
                'display_name' => 'Admin Loader',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Admin',
            ),
            6 => 
            array (
                'id' => 9,
                'key' => 'admin.icon_image',
                'display_name' => 'Admin Icon Image',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 4,
                'group' => 'Admin',
            ),
            7 => 
            array (
                'id' => 12,
                'key' => 'feed.feed_posts_per_page',
                'display_name' => 'Posts per page',
                'value' => '3',
                'details' => NULL,
                'type' => 'text',
                'order' => 1,
                'group' => 'Feed',
            ),
            8 => 
            array (
                'id' => 15,
                'key' => 'feed.feed_suggestions_card_per_page',
                'display_name' => 'Suggestion box cards per page',
                'value' => '3',
                'details' => NULL,
                'type' => 'text',
                'order' => 90,
                'group' => 'Feed',
            ),
            9 => 
            array (
                'id' => 16,
                'key' => 'feed.feed_suggestions_total_cards',
                'display_name' => 'Suggestion box total cards',
                'value' => '3',
                'details' => NULL,
                'type' => 'text',
                'order' => 80,
                'group' => 'Feed',
            ),
            10 => 
            array (
                'id' => 30,
                'key' => 'media.ffprobe_path',
                'display_name' => 'FFProbe Path',
                'value' => 'E:\\ffmpegs\\ffmpeg-2021-09-22-git-447cf53774-full_build\\bin\\ffprobe.exe',
                'details' => '',
                'type' => 'text',
                'order' => 13,
                'group' => 'Media',
            ),
            11 => 
            array (
                'id' => 31,
                'key' => 'media.ffmpeg_path',
                'display_name' => 'FFMpeg Path',
                'value' => 'E:\\ffmpegs\\ffmpeg-2021-09-22-git-447cf53774-full_build\\bin\\ffmpeg.exe',
                'details' => '',
                'type' => 'text',
                'order' => 12,
                'group' => 'Media',
            ),
            12 => 
            array (
                'id' => 32,
                'key' => 'media.allowed_file_extensions',
                'display_name' => 'Allowed file extensions',
                'value' => 'png,jpg,jpeg,wav,mp3,ogg,mp4,avi,mov,moov,m4v,mpeg,wmv,avi,asf,webp,svg,dng, DNG,gif',
                'details' => '{
"description": "If ffmpeg is not available, video formats will fallback to mp4 only."
}',
                'type' => 'text',
                'order' => 14,
                'group' => 'Media',
            ),
            13 => 
            array (
                'id' => 33,
                'key' => 'media.max_file_upload_size',
                'display_name' => 'Max file uploads size',
                'value' => '100',
                'details' => '{
"description":  "File size in MB. Do not exceed PHP maximum upload size & post size as video uploads might silently fail."
}',
                'type' => 'text',
                'order' => 15,
                'group' => 'Media',
            ),
            14 => 
            array (
                'id' => 34,
                'key' => 'websockets.pusher_app_key',
                'display_name' => 'Pusher App Key',
                'value' => '9889b8061cc282e6b64c',
                'details' => NULL,
                'type' => 'text',
                'order' => 20,
                'group' => 'Websockets',
            ),
            15 => 
            array (
                'id' => 36,
                'key' => 'websockets.pusher_app_secret',
                'display_name' => 'Pusher App Secret',
                'value' => '47057b8aa728cdb005e1',
                'details' => NULL,
                'type' => 'text',
                'order' => 30,
                'group' => 'Websockets',
            ),
            16 => 
            array (
                'id' => 37,
                'key' => 'websockets.pusher_app_cluster',
                'display_name' => 'Pusher Cluster Zone',
                'value' => 'eu',
                'details' => NULL,
                'type' => 'text',
                'order' => 40,
                'group' => 'Websockets',
            ),
            17 => 
            array (
                'id' => 38,
                'key' => 'websockets.pusher_app_id',
                'display_name' => 'Pusher App ID',
                'value' => '1305749',
                'details' => NULL,
                'type' => 'text',
                'order' => 10,
                'group' => 'Websockets',
            ),
            18 => 
            array (
                'id' => 39,
                'key' => 'payments.invoices_sender_name',
                'display_name' => 'Invoices Sender Name',
                'value' => 'Web Development for Digital Marketing Agency',
                'details' => NULL,
                'type' => 'text',
                'order' => 21,
                'group' => 'Payments',
            ),
            19 => 
            array (
                'id' => 40,
                'key' => 'payments.invoices_sender_country_name',
                'display_name' => 'Invoices Sender Country Name',
                'value' => 'Australia',
                'details' => NULL,
                'type' => 'text',
                'order' => 22,
                'group' => 'Payments',
            ),
            20 => 
            array (
                'id' => 41,
                'key' => 'payments.invoices_sender_street_address',
                'display_name' => 'Invoices Sender Street Address',
                'value' => '121 Kopkes Road',
                'details' => NULL,
                'type' => 'text',
                'order' => 23,
                'group' => 'Payments',
            ),
            21 => 
            array (
                'id' => 42,
                'key' => 'payments.invoices_sender_state_name',
                'display_name' => 'Invoices Sender State Name',
                'value' => 'Victoria',
                'details' => NULL,
                'type' => 'text',
                'order' => 24,
                'group' => 'Payments',
            ),
            22 => 
            array (
                'id' => 43,
                'key' => 'payments.invoices_sender_city_name',
                'display_name' => 'Invoices Sender City Name',
                'value' => '3351',
                'details' => NULL,
                'type' => 'text',
                'order' => 25,
                'group' => 'Payments',
            ),
            23 => 
            array (
                'id' => 44,
                'key' => 'payments.invoices_sender_postcode',
                'display_name' => 'Invoices Sender Postcode',
                'value' => 'PITFIELD',
                'details' => NULL,
                'type' => 'text',
                'order' => 26,
                'group' => 'Payments',
            ),
            24 => 
            array (
                'id' => 45,
                'key' => 'payments.invoices_sender_company_number',
                'display_name' => 'Invoices Sender Company Number',
            'value' => '(03) 5391 1216',
                'details' => NULL,
                'type' => 'text',
                'order' => 27,
                'group' => 'Payments',
            ),
            25 => 
            array (
                'id' => 46,
                'key' => 'payments.invoices_prefix',
                'display_name' => 'Invoices Prefix',
                'value' => 'OF',
                'details' => NULL,
                'type' => 'text',
                'order' => 28,
                'group' => 'Payments',
            ),
            26 => 
            array (
                'id' => 52,
                'key' => 'media.apply_watermark',
                'display_name' => 'Apply watermark',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : true
}',
                'type' => 'checkbox',
                'order' => 32,
                'group' => 'Media',
            ),
            27 => 
            array (
                'id' => 53,
                'key' => 'media.watermark_image',
                'display_name' => 'Watermark image',
                'value' => '[{"download_link":"settings\\\\March2023\\\\keYAXyejO5iV7OTLRbN4.png","original_name":"-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpovbSsLQJf0ebcZThQ6tCvq4GGqOT1I6vZn3lU18hwmOvN8IXvjVCLqSwwOj6rYJiRdg42NAuE-lW5kri5hpbuvM7AzHtmsnMh4imPzUa3gB4aaOw9hfC.png"}]',
                'details' => NULL,
                'type' => 'file',
                'order' => 33,
                'group' => 'Media',
            ),
            28 => 
            array (
                'id' => 54,
                'key' => 'site.light_logo',
                'display_name' => 'Light site logo',
                'value' => '[{"download_link":"settings\\\\April2023\\\\iM7kSJm7gNaAlJAwb32x.gif","original_name":"example-1.gif"}]',
                'details' => NULL,
                'type' => 'file',
                'order' => 40,
                'group' => 'Site',
            ),
            29 => 
            array (
                'id' => 55,
                'key' => 'site.dark_logo',
                'display_name' => 'Dark site logo',
                'value' => '',
                'details' => NULL,
                'type' => 'file',
                'order' => 50,
                'group' => 'Site',
            ),
            30 => 
            array (
                'id' => 56,
                'key' => 'site.favicon',
                'display_name' => 'Site favicon',
                'value' => '',
                'details' => NULL,
                'type' => 'file',
                'order' => 60,
                'group' => 'Site',
            ),
            31 => 
            array (
                'id' => 57,
                'key' => 'payments.stripe_public_key',
                'display_name' => 'Stripe Public Key',
                'value' => 'pk_test_xv386XPJbOmiKWKIO9nXhKOp00Tchm6Abo',
                'details' => NULL,
                'type' => 'text',
                'order' => 37,
                'group' => 'Payments',
            ),
            32 => 
            array (
                'id' => 58,
                'key' => 'payments.stripe_secret_key',
                'display_name' => 'Stripe Secret Key',
                'value' => 'sk_test_vNVDqIZ1hSgizBeiEvDjpJob00BzHu4ZGv',
                'details' => NULL,
                'type' => 'text',
                'order' => 38,
                'group' => 'Payments',
            ),
            33 => 
            array (
                'id' => 59,
                'key' => 'payments.stripe_webhooks_secret',
                'display_name' => 'Stripe Webhooks Secret',
                'value' => 'whsec_2sGm04hlWf7RjWYNQ1B1RoaZKHRVswtv',
                'details' => NULL,
                'type' => 'text',
                'order' => 39,
                'group' => 'Payments',
            ),
            34 => 
            array (
                'id' => 60,
                'key' => 'payments.paypal_client_id',
                'display_name' => 'Paypal Client Id',
                'value' => 'AWHdgt2Vehu1aZ83gO8tcpQ-8QgrqiH6ngb1GOvnVlUD77nvIa1WioOSFIcJTZzHOfHjhq7LJCDhTd4b',
                'details' => NULL,
                'type' => 'text',
                'order' => 40,
                'group' => 'Payments',
            ),
            35 => 
            array (
                'id' => 61,
                'key' => 'payments.paypal_secret',
                'display_name' => 'Paypal Secret',
                'value' => 'ELDBivM1NdT5QLzTA4P-SYmalNAYdQ0wdHFIHGgTKSVK9ivfXoMepVSPxonSgvgXEhq067TZH9U43FOn',
                'details' => NULL,
                'type' => 'text',
                'order' => 41,
                'group' => 'Payments',
            ),
            36 => 
            array (
                'id' => 74,
                'key' => 'payments.paypal_live_mode',
                'display_name' => 'Paypal Live Mode',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true
}',
                'type' => 'checkbox',
                'order' => 42,
                'group' => 'Payments',
            ),
            37 => 
            array (
                'id' => 78,
                'key' => 'emails.driver',
                'display_name' => 'Email driver',
                'value' => 'mailgun',
                'details' => '{
"default" : "log",
"options" : {
"log": "Log",
"sendmail": "Sendmail",
"smtp": "SMTP",
"mailgun": "Mailgun"
}
}',
                'type' => 'select_dropdown',
                'order' => 43,
                'group' => 'Emails',
            ),
            38 => 
            array (
                'id' => 79,
                'key' => 'emails.from_name',
                'display_name' => 'Mail from name',
                'value' => 'afrifans',
                'details' => NULL,
                'type' => 'text',
                'order' => 44,
                'group' => 'Emails',
            ),
            39 => 
            array (
                'id' => 80,
                'key' => 'emails.from_address',
                'display_name' => 'Mail from address',
                'value' => 'noreply@fanrhythm.com',
                'details' => NULL,
                'type' => 'text',
                'order' => 45,
                'group' => 'Emails',
            ),
            40 => 
            array (
                'id' => 81,
                'key' => 'emails.mailgun_domain',
                'display_name' => 'Mailgun domain',
                'value' => 'mail.fanrhythm.com',
                'details' => NULL,
                'type' => 'text',
                'order' => 46,
                'group' => 'Emails',
            ),
            41 => 
            array (
                'id' => 82,
                'key' => 'emails.mailgun_secret',
                'display_name' => 'Mailgun secret',
                'value' => '5c938791da61a4e51b52e5f5daee6507-0be3b63b-ab81e329',
                'details' => NULL,
                'type' => 'text',
                'order' => 47,
                'group' => 'Emails',
            ),
            42 => 
            array (
                'id' => 83,
                'key' => 'emails.smtp_host',
                'display_name' => 'SMTP Host',
                'value' => 'sadasdd',
                'details' => NULL,
                'type' => 'text',
                'order' => 49,
                'group' => 'Emails',
            ),
            43 => 
            array (
                'id' => 84,
                'key' => 'emails.smtp_port',
                'display_name' => 'SMTP Port',
                'value' => '5877',
                'details' => NULL,
                'type' => 'text',
                'order' => 50,
                'group' => 'Emails',
            ),
            44 => 
            array (
                'id' => 85,
                'key' => 'emails.smtp_encryption',
                'display_name' => 'SMTP Encryption',
                'value' => 'tls',
                'details' => '{
"default" : "tls",
"options" : {
"tls": "TLS",
"ssl": "SSL"
}
}',
                'type' => 'radio_btn',
                'order' => 51,
                'group' => 'Emails',
            ),
            45 => 
            array (
                'id' => 86,
                'key' => 'emails.smtp_username',
                'display_name' => 'SMTP Username',
                'value' => 'ifkinlovemetro@hotmail.com3',
                'details' => NULL,
                'type' => 'text',
                'order' => 52,
                'group' => 'Emails',
            ),
            46 => 
            array (
                'id' => 87,
                'key' => 'emails.smtp_password',
                'display_name' => 'SMTP Password',
                'value' => 'THEKernelisgone133',
                'details' => NULL,
                'type' => 'text',
                'order' => 53,
                'group' => 'Emails',
            ),
            47 => 
            array (
                'id' => 88,
                'key' => 'emails.mailgun_endpoint',
                'display_name' => 'Mailgun endpoint',
                'value' => 'api.eu.mailgun.net',
                'details' => NULL,
                'type' => 'text',
                'order' => 48,
                'group' => 'Emails',
            ),
            48 => 
            array (
                'id' => 95,
                'key' => 'storage.driver',
                'display_name' => 'Driver',
                'value' => 'public',
                'details' => '{
"default" : "public",
"options" : {
"public": "Local",
"s3": "S3",
"wasabi": "Wasabi",
"do_spaces": "DigitalOcean Spaces",
"minio": "Minio"
}
}',
                'type' => 'select_dropdown',
                'order' => 54,
                'group' => 'Storage',
            ),
            49 => 
            array (
                'id' => 96,
                'key' => 'storage.aws_access_key',
                'display_name' => 'Aws Access Key',
                'value' => 'AKIAXNL53EM76XSUGGT7',
                'details' => NULL,
                'type' => 'text',
                'order' => 55,
                'group' => 'Storage',
            ),
            50 => 
            array (
                'id' => 97,
                'key' => 'storage.aws_secret_key',
                'display_name' => 'Aws Secret Key',
                'value' => '/xOTfWIi9z5cFsh2DCcjIVJjc9lNp7nTY9vj9QKU',
                'details' => NULL,
                'type' => 'text',
                'order' => 56,
                'group' => 'Storage',
            ),
            51 => 
            array (
                'id' => 98,
                'key' => 'storage.aws_region',
                'display_name' => 'Aws Region',
                'value' => 'us-east-1',
                'details' => NULL,
                'type' => 'text',
                'order' => 57,
                'group' => 'Storage',
            ),
            52 => 
            array (
                'id' => 99,
                'key' => 'storage.aws_bucket_name',
                'display_name' => 'Aws Bucket Name',
                'value' => 'justf-demo',
                'details' => NULL,
                'type' => 'text',
                'order' => 58,
                'group' => 'Storage',
            ),
            53 => 
            array (
                'id' => 100,
                'key' => 'storage.aws_cdn_enabled',
                'display_name' => 'Aws CloudFront Enabled',
                'value' => '1',
                'details' => '{
"true" : "On",
"off" : "Off",
"checked" : false
}',
                'type' => 'checkbox',
                'order' => 59,
                'group' => 'Storage',
            ),
            54 => 
            array (
                'id' => 101,
                'key' => 'storage.aws_cdn_presigned_urls_enabled',
                'display_name' => 'Aws CloudFront PreSigned Url\'s Enabled',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false
}',
                'type' => 'checkbox',
                'order' => 61,
                'group' => 'Storage',
            ),
            55 => 
            array (
                'id' => 102,
                'key' => 'storage.aws_cdn_key_pair_id',
                'display_name' => 'Aws CloudFront Key Pair Id',
                'value' => 'K21TNBDNZ3B5TR',
                'details' => NULL,
                'type' => 'text',
                'order' => 62,
                'group' => 'Storage',
            ),
            56 => 
            array (
                'id' => 103,
                'key' => 'storage.aws_cdn_private_key_path',
                'display_name' => 'Aws CloudFront Private Key Path',
                'value' => 'private_key.pem',
                'details' => NULL,
                'type' => 'text',
                'order' => 63,
                'group' => 'Storage',
            ),
            57 => 
            array (
                'id' => 104,
                'key' => 'storage.cdn_domain_name',
                'display_name' => 'Aws CloudFront Domain Name',
                'value' => 'dplwsh2tkj4da.cloudfront.net',
                'details' => NULL,
                'type' => 'text',
                'order' => 60,
                'group' => 'Storage',
            ),
            58 => 
            array (
                'id' => 106,
                'key' => 'compliance.enable_cookies_box',
                'display_name' => 'Enable cookies box',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : true
}',
                'type' => 'checkbox',
                'order' => 1130,
                'group' => 'Compliance',
            ),
            59 => 
            array (
                'id' => 108,
                'key' => 'site.allow_theme_switch',
                'display_name' => 'Allow theme switch',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : true,
"description" : "Allow users to switch between light and dark modes."
}',
                'type' => 'checkbox',
                'order' => 70,
                'group' => 'Site',
            ),
            60 => 
            array (
                'id' => 109,
                'key' => 'site.default_user_theme',
                'display_name' => 'Default theme',
                'value' => 'light',
                'details' => '{
"default" : "light",
"options" : {
"light": "Light theme",
"dark": "Dark theme"
}
}',
                'type' => 'radio_btn',
                'order' => 80,
                'group' => 'Site',
            ),
            61 => 
            array (
                'id' => 110,
                'key' => 'site.allow_direction_switch',
                'display_name' => 'Allow direction switch',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : true,
"description": "Allow users to switch site direction from ltr to rtl."
}',
                'type' => 'checkbox',
                'order' => 90,
                'group' => 'Site',
            ),
            62 => 
            array (
                'id' => 111,
                'key' => 'site.default_site_direction',
                'display_name' => 'Default site direction',
                'value' => 'ltr',
                'details' => '{
"default" : "ltr",
"options" : {
"ltr": "Left to right",
"rtl": "Right to left"
}
}',
                'type' => 'radio_btn',
                'order' => 100,
                'group' => 'Site',
            ),
            63 => 
            array (
                'id' => 112,
                'key' => 'site.allow_language_switch',
                'display_name' => 'Allow language switch',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : true,
"description": "Allow users to change site\'s language."
}',
                'type' => 'checkbox',
                'order' => 110,
                'group' => 'Site',
            ),
            64 => 
            array (
                'id' => 113,
                'key' => 'site.default_site_language',
                'display_name' => 'Default site language',
                'value' => 'en',
                'details' => '{
"description" : "Language code. Must have a present language file in the resources/lang directory."
}',
                'type' => 'text',
                'order' => 120,
                'group' => 'Site',
            ),
            65 => 
            array (
                'id' => 114,
                'key' => 'feed.disable_right_click',
                'display_name' => 'Disable right click on posts',
                'value' => '0',
                'details' => '{
"description": "If enabled, right click on posts media elements will be disabled, alongside view source shortcut."
}',
                'type' => 'checkbox',
                'order' => 6,
                'group' => 'Feed',
            ),
            66 => 
            array (
                'id' => 116,
                'key' => 'site.homepage_type',
                'display_name' => 'Homepage type',
                'value' => 'landing',
                'details' => '{
"default" : "landing",
"options" : {
"landing": "Landing page",
"login": "Login page"
}
}',
                'type' => 'radio_btn',
                'order' => 130,
                'group' => 'Site',
            ),
            67 => 
            array (
                'id' => 119,
                'key' => 'site.enforce_user_identity_checks',
                'display_name' => 'Enforce User Identity Check',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : true,
"description" : "If enabled, users will only be able to post content & start streams if ID is verified."
}',
                'type' => 'checkbox',
                'order' => 170,
                'group' => 'Site',
            ),
            68 => 
            array (
                'id' => 120,
                'key' => 'payments.currency_code',
                'display_name' => 'Site Currency Code',
                'value' => 'USD',
                'details' => NULL,
                'type' => 'text',
                'order' => 66,
                'group' => 'Payments',
            ),
            69 => 
            array (
                'id' => 121,
                'key' => 'payments.currency_symbol',
                'display_name' => 'Site Currency Symbol',
                'value' => '₹',
                'details' => NULL,
                'type' => 'text',
                'order' => 67,
                'group' => 'Payments',
            ),
            70 => 
            array (
                'id' => 123,
                'key' => 'site.app_url',
                'display_name' => 'Site url',
                'value' => 'http://localhost/only-fuck/public',
                'details' => NULL,
                'type' => 'text',
                'order' => 0,
                'group' => 'Site',
            ),
            71 => 
            array (
                'id' => 124,
                'key' => 'site.allow_pwa_installs',
                'display_name' => 'Allow PWA Installs',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : false,
"description" : "Turns the site into an installable PWA on all devices. Website must be server from a root domain."
}',
                'type' => 'checkbox',
                'order' => 299,
                'group' => 'Site',
            ),
            72 => 
            array (
                'id' => 126,
                'key' => 'social-media.facebook_url',
                'display_name' => 'Facebook',
                'value' => '#',
                'details' => NULL,
                'type' => 'text',
                'order' => 80,
                'group' => 'Social media',
            ),
            73 => 
            array (
                'id' => 127,
                'key' => 'social-media.instagram_url',
                'display_name' => 'Instagram',
                'value' => '#',
                'details' => NULL,
                'type' => 'text',
                'order' => 81,
                'group' => 'Social media',
            ),
            74 => 
            array (
                'id' => 128,
                'key' => 'social-media.twitter_url',
                'display_name' => 'Twitter',
                'value' => '#',
                'details' => NULL,
                'type' => 'text',
                'order' => 82,
                'group' => 'Social media',
            ),
            75 => 
            array (
                'id' => 129,
                'key' => 'social-media.whatsapp_url',
                'display_name' => 'Whatsapp',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 83,
                'group' => 'Social media',
            ),
            76 => 
            array (
                'id' => 130,
                'key' => 'social-media.tiktok_url',
                'display_name' => 'Tik Tok',
                'value' => '#',
                'details' => NULL,
                'type' => 'text',
                'order' => 84,
                'group' => 'Social media',
            ),
            77 => 
            array (
                'id' => 131,
                'key' => 'social-media.youtube_url',
                'display_name' => 'Youtube',
                'value' => '#',
                'details' => NULL,
                'type' => 'text',
                'order' => 85,
                'group' => 'Social media',
            ),
            78 => 
            array (
                'id' => 138,
                'key' => 'payments.withdrawal_min_amount',
                'display_name' => 'Withdrawal request minimum amount',
                'value' => '1',
                'details' => '{
"description": "Default: 20"
}',
                'type' => 'text',
                'order' => 91,
                'group' => 'Payments',
            ),
            79 => 
            array (
                'id' => 139,
                'key' => 'payments.withdrawal_max_amount',
                'display_name' => 'Withdrawal request maximum amount',
                'value' => '500',
                'details' => '{
"description": "Default: 500"
}',
                'type' => 'text',
                'order' => 92,
                'group' => 'Payments',
            ),
            80 => 
            array (
                'id' => 140,
                'key' => 'payments.deposit_min_amount',
                'display_name' => 'Deposit minimum amount',
                'value' => '5',
                'details' => '{}',
                'type' => 'text',
                'order' => 93,
                'group' => 'Payments',
            ),
            81 => 
            array (
                'id' => 141,
                'key' => 'payments.deposit_max_amount',
                'display_name' => 'Deposit maximum amount',
                'value' => '500',
                'details' => '{}',
                'type' => 'text',
                'order' => 94,
                'group' => 'Payments',
            ),
            82 => 
            array (
                'id' => 142,
                'key' => 'media.enforce_mp4_conversion',
                'display_name' => 'Enforce mp4 videos re-conversion',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : true,
"description": "Allows you skip mp4 re-conversion to platform standards, saving upload time and CPU usage. Recommended value: On."
}',
                'type' => 'checkbox',
                'order' => 13,
                'group' => 'Media',
            ),
            83 => 
            array (
                'id' => 143,
                'key' => 'media.max_videos_length',
                'display_name' => 'Max videos length',
                'value' => '0',
                'details' => '{
"description": "Maximum videos length, specified in seconds. (0 = unlimited)"
}',
                'type' => 'text',
                'order' => 15,
                'group' => 'Media',
            ),
            84 => 
            array (
                'id' => 144,
                'key' => 'custom-code-ads.custom_css',
                'display_name' => 'Custom CSS Code',
                'value' => NULL,
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 155,
                'group' => 'Custom Code / Ads',
            ),
            85 => 
            array (
                'id' => 145,
                'key' => 'custom-code-ads.custom_js',
                'display_name' => 'Custom JS Code',
                'value' => NULL,
                'details' => NULL,
                'type' => 'code_editor',
                'order' => 154,
                'group' => 'Custom Code / Ads',
            ),
            86 => 
            array (
                'id' => 146,
                'key' => 'feed.feed_suggestions_autoplay',
                'display_name' => 'Autoplay suggestions box slides',
                'value' => '0',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : true,
}',
                'type' => 'checkbox',
                'order' => 70,
                'group' => 'Feed',
            ),
            87 => 
            array (
                'id' => 147,
                'key' => 'storage.was_access_key',
                'display_name' => 'Wasabi Access Key',
                'value' => '333',
                'details' => NULL,
                'type' => 'text',
                'order' => 111,
                'group' => 'Storage',
            ),
            88 => 
            array (
                'id' => 148,
                'key' => 'storage.was_secret_key',
                'display_name' => 'Wasabi Secret Key',
                'value' => '333',
                'details' => NULL,
                'type' => 'text',
                'order' => 112,
                'group' => 'Storage',
            ),
            89 => 
            array (
                'id' => 149,
                'key' => 'storage.was_region',
                'display_name' => 'Wasabi Region',
                'value' => '44',
                'details' => NULL,
                'type' => 'text',
                'order' => 113,
                'group' => 'Storage',
            ),
            90 => 
            array (
                'id' => 150,
                'key' => 'storage.was_bucket_name',
                'display_name' => 'Wasabi Bucket',
                'value' => '555',
                'details' => NULL,
                'type' => 'text',
                'order' => 114,
                'group' => 'Storage',
            ),
            91 => 
            array (
                'id' => 151,
                'key' => 'feed.allow_gallery_zoom',
                'display_name' => 'Allow post galleries Zoom in',
                'value' => '0',
                'details' => '{
"description": "If enabled, high-res photos will feature a zoom in/out option when previewing posts media."
}',
                'type' => 'checkbox',
                'order' => 7,
                'group' => 'Feed',
            ),
            92 => 
            array (
                'id' => 152,
                'key' => 'media.use_url_watermark',
                'display_name' => 'Use profile url watermark',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : false,
"description": "If enabled, the media will include a watermark containing the user profile URL."
}',
                'type' => 'checkbox',
                'order' => 116,
                'group' => 'Media',
            ),
            93 => 
            array (
                'id' => 153,
                'key' => 'custom-code-ads.sidebar_ad_spot',
                'display_name' => 'Sidebar Ad',
                'value' => '<img class="mw-100" src="https://dplwsh2tkj4da.cloudfront.net/assets/afrifans-AD.png" title="Your ad here"/>',
                'details' => '{
"description" : "Will be shown on user feed & profiles, over the right sidebar."
}',
                'type' => 'code_editor',
                'order' => 117,
                'group' => 'Custom Code / Ads',
            ),
            94 => 
            array (
                'id' => 154,
                'key' => 'site.hide_identity_checks',
                'display_name' => 'Hide identity checks menu',
                'value' => '0',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : false,
"description" : "If enabled, the users ID check module link will be hidden from the menus."
}',
                'type' => 'checkbox',
                'order' => 180,
                'group' => 'Site',
            ),
            95 => 
            array (
                'id' => 155,
                'key' => 'feed.suggestions_skip_empty_profiles',
                'display_name' => 'Skip empty profiles out of the suggestions box',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : false,
"description" : "If enabled, users will only get suggestions of profiles that have both avatar and cover filled in."
}',
                'type' => 'checkbox',
                'order' => 40,
                'group' => 'Feed',
            ),
            96 => 
            array (
                'id' => 156,
                'key' => 'payments.coinbase_api_key',
                'display_name' => 'CoinBase Api Key',
                'value' => '4228e8c1-93e2-4ce7-b9cd-b04bfe9c49db',
                'details' => NULL,
                'type' => 'text',
                'order' => 35,
                'group' => 'Payments',
            ),
            97 => 
            array (
                'id' => 157,
                'key' => 'payments.coinbase_webhook_key',
                'display_name' => 'CoinBase Webhooks Secret',
                'value' => 'ed6815c6-4cc9-4ad0-8727-4dfdfe31bcb7',
                'details' => NULL,
                'type' => 'text',
                'order' => 36,
                'group' => 'Payments',
            ),
            98 => 
            array (
                'id' => 158,
                'key' => 'social-login.facebook_client_id',
                'display_name' => 'Facebook client ID',
                'value' => 'a',
                'details' => NULL,
                'type' => 'text',
                'order' => 70,
                'group' => 'Social login',
            ),
            99 => 
            array (
                'id' => 159,
                'key' => 'social-login.facebook_secret',
                'display_name' => 'Facebook client secret',
                'value' => 'a',
                'details' => NULL,
                'type' => 'text',
                'order' => 118,
                'group' => 'Social login',
            ),
            100 => 
            array (
                'id' => 160,
                'key' => 'social-login.twitter_client_id',
                'display_name' => 'Twitter client ID',
                'value' => 'KRlB3iRtWSIW8ENyonFXmka8g',
                'details' => NULL,
                'type' => 'text',
                'order' => 119,
                'group' => 'Social login',
            ),
            101 => 
            array (
                'id' => 161,
                'key' => 'social-login.twitter_secret',
                'display_name' => 'Twitter client secret',
                'value' => 'ZNwQQkD0UAguRrAueyhg0DBilWhxy3z0aIDtVavpZfSucyRApp',
                'details' => NULL,
                'type' => 'text',
                'order' => 120,
                'group' => 'Social login',
            ),
            102 => 
            array (
                'id' => 162,
                'key' => 'social-login.google_client_id',
                'display_name' => 'Google client ID',
                'value' => 'd',
                'details' => NULL,
                'type' => 'text',
                'order' => 121,
                'group' => 'Social login',
            ),
            103 => 
            array (
                'id' => 163,
                'key' => 'social-login.google_secret',
                'display_name' => 'Google client secret',
                'value' => 'd',
                'details' => NULL,
                'type' => 'text',
                'order' => 122,
                'group' => 'Social login',
            ),
            104 => 
            array (
                'id' => 164,
                'key' => 'site.slogan',
                'display_name' => 'Site slogan',
                'value' => 'ale ale',
                'details' => NULL,
                'type' => 'text',
                'order' => 30,
                'group' => 'Site',
            ),
            105 => 
            array (
                'id' => 165,
                'key' => 'profiles.allow_profile_qr_code',
                'display_name' => 'Allow QR code generate on profiles',
                'value' => '0',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : false,
"description" : "If enabled, a button that allows generating and saving QR codes is shown."
}',
                'type' => 'checkbox',
                'order' => 90,
                'group' => 'Profiles',
            ),
            106 => 
            array (
                'id' => 166,
                'key' => 'profiles.allow_gender_pronouns',
                'display_name' => 'Allow gender pronouns',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true,
"description": "If enabled, users will be able to enter custom pronouns which will be shown on profiles."
}',
                'type' => 'checkbox',
                'order' => 80,
                'group' => 'Profiles',
            ),
            107 => 
            array (
                'id' => 167,
                'key' => 'site.redirect_page_after_register',
                'display_name' => 'Redirect page after register',
                'value' => 'settings',
                'details' => '
{
"default" : "feed",
"options" : {
"feed": "Feed page",
"settings": "User profile settings page"
}
}',
                'type' => 'radio_btn',
                'order' => 150,
                'group' => 'Site',
            ),
            108 => 
            array (
                'id' => 168,
                'key' => 'payments.allow_manual_payments',
                'display_name' => 'Allow manual payments',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true
}',
                'type' => 'checkbox',
                'order' => 43,
                'group' => 'Payments',
            ),
            109 => 
            array (
                'id' => 169,
                'key' => 'media.use_chunked_uploads',
                'display_name' => 'Use chunked uploads',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "If enabled, file uploads will be split across multiple requests, allowing to bypass Cloudflare or max file limits."
}',
                'type' => 'checkbox',
                'order' => 15,
                'group' => 'Media',
            ),
            110 => 
            array (
                'id' => 170,
                'key' => 'media.upload_chunk_size',
                'display_name' => 'Chunks size',
                'value' => '2',
                'details' => '{
"description": "File upload chunks size in MB. Can not exceed maximum server upload size."
}',
                'type' => 'text',
                'order' => 15,
                'group' => 'Media',
            ),
            111 => 
            array (
                'id' => 171,
                'key' => 'site.enforce_email_validation',
                'display_name' => 'Enforce email validations',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "If enabled, all users will be disabled site access until they verified the email. If turned of, users will still receive a confirmation pop up in user settings."
}',
                'type' => 'checkbox',
                'order' => 160,
                'group' => 'Site',
            ),
            112 => 
            array (
                'id' => 172,
                'key' => 'site.homepage_redirect',
                'display_name' => 'Homepage redirect',
                'value' => NULL,
                'details' => '{
"description": "If this setting is used, the `Homepage type` setting will not be used anymore."
}',
                'type' => 'text',
                'order' => 140,
                'group' => 'Site',
            ),
            113 => 
            array (
                'id' => 173,
                'key' => 'media.users_covers_size',
            'display_name' => 'User cover images (re)size',
                'value' => '599x180',
                'details' => '{
"description": "Size to which the covers will be resized to. Increasing the resolution will give higher quality cover images, but bigger files. Make sure to use the same aspect ratio."
}',
                'type' => 'text',
                'order' => 1120,
                'group' => 'Media',
            ),
            114 => 
            array (
                'id' => 174,
                'key' => 'security.enable_2fa',
                'display_name' => 'Enable email 2FA on logins',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true,
"description": "If enabled, users which have 2FA enabled for their account, will be prompted with a security check when logging from new devices."
}',
                'type' => 'checkbox',
                'order' => 85,
                'group' => 'Security',
            ),
            115 => 
            array (
                'id' => 175,
                'key' => 'security.default_2fa_on_register',
                'display_name' => 'Default 2FA setting on user register',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true,
"description": "If enabled, users will have 2FA enabled by default, when creating new accounts."
}',
                'type' => 'checkbox',
                'order' => 90,
                'group' => 'Security',
            ),
            116 => 
            array (
                'id' => 176,
                'key' => 'security.allow_users_2fa_switch',
                'display_name' => 'Allow users to turn off 2FA',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true,
"description": "If disabled, users won\'t be able to change their 2FA settings."
}',
                'type' => 'checkbox',
                'order' => 95,
                'group' => 'Security',
            ),
            117 => 
            array (
                'id' => 177,
                'key' => 'profiles.default_profile_type_on_register',
                'display_name' => 'Default profile type on user register',
                'value' => 'free',
                'details' => '{
"default" : "paid",
"options" : {
"paid": "Paid profile",
"free": "Free profile",
"open": "Open profile"
},
"description": "Paid = Subscription locked content, Free = Follow locked, Open = Content is available to un-registered users. PPV content is locked for all scenarios."
}',
                'type' => 'radio_btn',
                'order' => 20,
                'group' => 'Profiles',
            ),
            118 => 
            array (
                'id' => 178,
                'key' => 'profiles.default_users_to_follow',
                'display_name' => 'Default users to follow on user register',
                'value' => '13,14',
                'details' => '{
"description": "List of user-IDs to be followed by all users when registering, separated by a comma. If users are free, their content will be shown on the feed of new users."
}',
                'type' => 'text',
                'order' => 36,
                'group' => 'Profiles',
            ),
            119 => 
            array (
                'id' => 179,
                'key' => 'storage.do_access_key',
                'display_name' => 'DO Access Key',
                'value' => 'DO00AAX7MRJNLVGY2N22',
                'details' => NULL,
                'type' => 'text',
                'order' => 120,
                'group' => 'Storage',
            ),
            120 => 
            array (
                'id' => 180,
                'key' => 'storage.do_secret_key',
                'display_name' => 'DO Secret Key',
                'value' => 'oZc3JfPVPqE/qF+iUdN0Sz+iWe2W52ZLpIRc6jenX7c',
                'details' => NULL,
                'type' => 'text',
                'order' => 121,
                'group' => 'Storage',
            ),
            121 => 
            array (
                'id' => 181,
                'key' => 'storage.do_region',
                'display_name' => 'DO Region',
                'value' => 'fra1',
                'details' => NULL,
                'type' => 'text',
                'order' => 123,
                'group' => 'Storage',
            ),
            122 => 
            array (
                'id' => 183,
                'key' => 'storage.do_bucket_name',
                'display_name' => 'DO Bucket',
                'value' => 'jf-bucket',
                'details' => NULL,
                'type' => 'text',
                'order' => 122,
                'group' => 'Storage',
            ),
            123 => 
            array (
                'id' => 184,
                'key' => 'payments.nowpayments_api_key',
                'display_name' => 'NowPayments Api Key',
                'value' => 'MJSA1C9-G7146ZS-JMGWD4V-BD4QA92',
                'details' => NULL,
                'type' => 'text',
                'order' => 33,
                'group' => 'Payments',
            ),
            124 => 
            array (
                'id' => 185,
                'key' => 'payments.nowpayments_ipn_secret_key',
                'display_name' => 'NowPayments IPN Secret Key',
                'value' => 'CJUNOU0AKmosqN65xx7dSYWPcjSWv8No',
                'details' => NULL,
                'type' => 'text',
                'order' => 34,
                'group' => 'Payments',
            ),
            125 => 
            array (
                'id' => 186,
                'key' => 'profiles.default_user_privacy_setting_on_register',
                'display_name' => 'Default user privacy setting on user register',
                'value' => 'public',
                'details' => '{
"default" : "public",
"options" : {
"public": "Public profile",
"private": "Private profile"
},
"description": "If private, the profiles will be hidden from search results."
}',
                'type' => 'radio_btn',
                'order' => 30,
                'group' => 'Profiles',
            ),
            126 => 
            array (
                'id' => 187,
                'key' => 'payments.withdrawal_payment_methods',
                'display_name' => 'Withdrawal allowed payment methods',
                'value' => 'Bank transfer, PayPal, Crypto, Other',
                'details' => '{
"description": "Comma separated values (Bank transfer, Stripe, PayPal, Crypto, Other)"
}',
                'type' => 'text',
                'order' => 90,
                'group' => 'Payments',
            ),
            127 => 
            array (
                'id' => 188,
                'key' => 'security.enforce_app_ssl',
                'display_name' => 'Enforce platform SSL usage',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Usually not required, rarely, some hosting providers needs it."
}',
                'type' => 'checkbox',
                'order' => 130,
                'group' => 'Security',
            ),
            128 => 
            array (
                'id' => 189,
                'key' => 'media.users_avatars_size',
            'display_name' => 'User avatar images (re)size',
                'value' => '96x96',
                'details' => '{
"description": "Size to which the avatars will be resized to. Increasing the resolution will give higher quality cover images, but bigger files. Make sure to use the same aspect ratio."
}',
                'type' => 'text',
                'order' => 1130,
                'group' => 'Media',
            ),
            129 => 
            array (
                'id' => 190,
                'key' => 'streams.allow_streams',
                'display_name' => 'Allow streams',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
}',
                'type' => 'checkbox',
                'order' => 163,
                'group' => 'Streams',
            ),
            130 => 
            array (
                'id' => 191,
                'key' => 'streams.max_live_duration',
                'display_name' => 'Max Live Stream Duration',
                'value' => '1',
                'details' => '{
"description": "Maximum time duration for a live stream set in hours"
}',
                'type' => 'text',
                'order' => 165,
                'group' => 'Streams',
            ),
            131 => 
            array (
                'id' => 192,
                'key' => 'streams.pushr_key',
                'display_name' => 'Pushr Key',
                'value' => 'ed05f391f43a77c27f9e74ac09f54dd252f758a2',
                'details' => NULL,
                'type' => 'text',
                'order' => 175,
                'group' => 'Streams',
            ),
            132 => 
            array (
                'id' => 193,
                'key' => 'streams.pushr_zone_id',
                'display_name' => 'Pushr Zone Id',
                'value' => '1737',
                'details' => NULL,
                'type' => 'text',
                'order' => 185,
                'group' => 'Streams',
            ),
            133 => 
            array (
                'id' => 194,
                'key' => 'streams.allow_dvr',
                'display_name' => 'Allow VOD',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Enabling VODs allow creators to watch their previous live streams (no extra fees when using Pushr provider)"
}',
                'type' => 'checkbox',
                'order' => 205,
                'group' => 'Streams',
            ),
            134 => 
            array (
                'id' => 195,
                'key' => 'streams.pushr_encoder',
                'display_name' => 'Pushr Encoder',
                'value' => 'eu',
                'details' => '{
"description": "Pushr stream encoder. EG: `eu`"
}',
                'type' => 'text',
                'order' => 195,
                'group' => 'Streams',
            ),
            135 => 
            array (
                'id' => 196,
                'key' => 'streams.allow_mux',
                'display_name' => 'Allow MUX',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false
}',
                'type' => 'checkbox',
                'order' => 215,
                'group' => 'Streams',
            ),
            136 => 
            array (
                'id' => 197,
                'key' => 'streams.allow_480p',
                'display_name' => 'Allow 480p',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false
}',
                'type' => 'checkbox',
                'order' => 235,
                'group' => 'Streams',
            ),
            137 => 
            array (
                'id' => 198,
                'key' => 'streams.allow_360p',
                'display_name' => 'Allow 360p',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false
}',
                'type' => 'checkbox',
                'order' => 225,
                'group' => 'Streams',
            ),
            138 => 
            array (
                'id' => 199,
                'key' => 'streams.allow_576p',
                'display_name' => 'Allow 576p',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false
}',
                'type' => 'checkbox',
                'order' => 245,
                'group' => 'Streams',
            ),
            139 => 
            array (
                'id' => 200,
                'key' => 'streams.allow_720p',
                'display_name' => 'Allow 720p',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false
}',
                'type' => 'checkbox',
                'order' => 255,
                'group' => 'Streams',
            ),
            140 => 
            array (
                'id' => 201,
                'key' => 'streams.allow_1080p',
                'display_name' => 'Allow 1080p',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false
}',
                'type' => 'checkbox',
                'order' => 265,
                'group' => 'Streams',
            ),
            141 => 
            array (
                'id' => 202,
                'key' => 'colors.theme_color_code',
                'display_name' => 'Theme color code',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 210,
                'group' => 'Colors',
            ),
            142 => 
            array (
                'id' => 203,
                'key' => 'colors.theme_gradient_from',
                'display_name' => 'Theme gradient from',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 220,
                'group' => 'Colors',
            ),
            143 => 
            array (
                'id' => 204,
                'key' => 'colors.theme_gradient_to',
                'display_name' => 'Theme gradient to',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 230,
                'group' => 'Colors',
            ),
            144 => 
            array (
                'id' => 205,
                'key' => 'payments.default_subscription_price',
                'display_name' => 'Default subscription price',
                'value' => '6',
                'details' => NULL,
                'type' => 'text',
                'order' => 75,
                'group' => 'Payments',
            ),
            145 => 
            array (
                'id' => 206,
                'key' => 'payments.min_tip_value',
                'display_name' => 'Min tips value',
                'value' => '0.50',
                'details' => NULL,
                'type' => 'text',
                'order' => 85,
                'group' => 'Payments',
            ),
            146 => 
            array (
                'id' => 207,
                'key' => 'payments.max_tip_value',
                'display_name' => 'Max tips value',
                'value' => '500',
                'details' => NULL,
                'type' => 'text',
                'order' => 86,
                'group' => 'Payments',
            ),
            147 => 
            array (
                'id' => 208,
                'key' => 'media.ffmpeg_video_conversion_quality_preset',
                'display_name' => 'FFMpeg video conversion quality preset',
                'value' => 'quality',
                'details' => '{
"description" : "Going for better quality will reduce the processing time but increase the file size, next to it\'s original size.",
"default" : "size",
"options" : {
"size": "Size optimized",
"balanced": "Balanced profile",
"quality": "Quality optimized"
}
}',
                'type' => 'radio_btn',
                'order' => 13,
                'group' => 'Media',
            ),
            148 => 
            array (
                'id' => 209,
                'key' => 'payments.offline_payments_owner',
                'display_name' => 'Account owner',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 44,
                'group' => 'Payments',
            ),
            149 => 
            array (
                'id' => 210,
                'key' => 'payments.offline_payments_account_number',
                'display_name' => 'Account number',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 45,
                'group' => 'Payments',
            ),
            150 => 
            array (
                'id' => 211,
                'key' => 'payments.offline_payments_bank_name',
                'display_name' => 'Bank name',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 46,
                'group' => 'Payments',
            ),
            151 => 
            array (
                'id' => 212,
                'key' => 'payments.offline_payments_routing_number',
                'display_name' => 'Routing number',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 47,
                'group' => 'Payments',
            ),
            152 => 
            array (
                'id' => 213,
                'key' => 'payments.offline_payments_iban',
                'display_name' => 'IBAN',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 48,
                'group' => 'Payments',
            ),
            153 => 
            array (
                'id' => 214,
                'key' => 'payments.offline_payments_swift',
                'display_name' => 'BIC / SWIFT',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 49,
                'group' => 'Payments',
            ),
            154 => 
            array (
                'id' => 215,
                'key' => 'payments.ccbill_account_number',
                'display_name' => 'CCBill Account Number',
                'value' => '951492',
                'details' => NULL,
                'type' => 'text',
                'order' => 28,
                'group' => 'Payments',
            ),
            155 => 
            array (
                'id' => 216,
                'key' => 'payments.ccbill_subaccount_number_recurring',
                'display_name' => 'CCBill SubAccount Number Recurring Payments',
                'value' => '0107',
                'details' => NULL,
                'type' => 'text',
                'order' => 29,
                'group' => 'Payments',
            ),
            156 => 
            array (
                'id' => 217,
                'key' => 'payments.ccbill_subaccount_number_one_time',
                'display_name' => 'CCBill SubAccount Number One Time Payments',
                'value' => '0108',
                'details' => NULL,
                'type' => 'text',
                'order' => 30,
                'group' => 'Payments',
            ),
            157 => 
            array (
                'id' => 218,
                'key' => 'payments.ccbill_flex_form_id',
                'display_name' => 'CCBill FlexForm Id',
                'value' => '5a581569-a463-468c-97fa-1efc8892a3a1',
                'details' => NULL,
                'type' => 'text',
                'order' => 31,
                'group' => 'Payments',
            ),
            158 => 
            array (
                'id' => 219,
                'key' => 'payments.ccbill_salt_key',
                'display_name' => 'CCBill Salt Key',
                'value' => 'aC3N2hEDCTn307e7SLV70f68',
                'details' => NULL,
                'type' => 'text',
                'order' => 32,
                'group' => 'Payments',
            ),
            159 => 
            array (
                'id' => 220,
                'key' => 'compliance.enable_age_verification_dialog',
                'display_name' => 'Enable age verification dialog',
                'value' => '0',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : true,
"description" "Can be generally used for denying user access for minors, adult content info, etc."
}',
                'type' => 'checkbox',
                'order' => 1140,
                'group' => 'Compliance',
            ),
            160 => 
            array (
                'id' => 221,
                'key' => 'compliance.age_verification_cancel_url',
                'display_name' => 'Age verification box cancel url',
                'value' => 'https://google.com',
                'details' => NULL,
                'type' => 'text',
                'order' => 1150,
                'group' => 'Compliance',
            ),
            161 => 
            array (
                'id' => 222,
                'key' => 'payments.maximum_subscription_price',
                'display_name' => 'Maximum subscription price',
                'value' => '50',
                'details' => NULL,
                'type' => 'text',
                'order' => 77,
                'group' => 'Payments',
            ),
            162 => 
            array (
                'id' => 223,
                'key' => 'payments.minimum_subscription_price',
                'display_name' => 'Minimum subscription price',
                'value' => '0.50',
                'details' => NULL,
                'type' => 'text',
                'order' => 76,
                'group' => 'Payments',
            ),
            163 => 
            array (
                'id' => 224,
                'key' => 'media.ffmpeg_audio_encoder',
                'display_name' => 'FFMPEG Audio encoder',
                'value' => 'libmp3lame',
                'details' => '{
"default" : "aac",
"options" : {
"aac": "AAC Encoder",
"libfdk_aac": "libfdk_aac Encoder",
"libmp3lame": "LAME MP3 Encoder"
},
"description": "AAC is recommended"
}',
                'type' => 'select_dropdown',
                'order' => 13,
                'group' => 'Media',
            ),
            164 => 
            array (
                'id' => 225,
                'key' => 'security.recaptcha_enabled',
                'display_name' => 'Enable Google reCAPTCHA',
                'value' => '0',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : false,
"description": "If enabled, it will be used on all public form pages."
}',
                'type' => 'checkbox',
                'order' => 1200,
                'group' => 'Security',
            ),
            165 => 
            array (
                'id' => 226,
                'key' => 'security.recaptcha_site_key',
                'display_name' => 'reCAPTCHA Site Key',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 1210,
                'group' => 'Security',
            ),
            166 => 
            array (
                'id' => 227,
                'key' => 'security.recaptcha_site_secret_key',
                'display_name' => 'reCAPTCHA Secret Key',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 1220,
                'group' => 'Security',
            ),
            167 => 
            array (
                'id' => 229,
                'key' => 'feed.min_post_description',
                'display_name' => 'Minimum post description length',
                'value' => '10',
                'details' => '{
"description": "If set to 0/empty, at least one post attachment is required. Otherwise, attachments are optional."
}',
                'type' => 'text',
                'order' => 5,
                'group' => 'Feed',
            ),
            168 => 
            array (
                'id' => 230,
                'key' => 'media.max_avatar_cover_file_size',
                'display_name' => 'Max avatar & cover file size',
                'value' => '4',
                'details' => '{
"description": "File size in MB. Used for both avatar & cover"
}',
                'type' => 'text',
                'order' => 1140,
                'group' => 'Media',
            ),
            169 => 
            array (
                'id' => 231,
                'key' => 'security.allow_geo_blocking',
                'display_name' => 'Allow users to be able to geoblock their profiles',
                'value' => '1',
                'details' => '{
"on" : "On",
"off" : "Off",
"checked" : false,
"description": "If enabled, users will be able to disallow certain countries to access their content."
}',
                'type' => 'checkbox',
                'order' => 80,
                'group' => 'Security',
            ),
            170 => 
            array (
                'id' => 232,
                'key' => 'security.abstract_api_key',
            'display_name' => 'IP geolocation API key (Abstract API)',
                'value' => 'ddd',
                'details' => NULL,
                'type' => 'text',
                'order' => 81,
                'group' => 'Security',
            ),
            171 => 
            array (
                'id' => 233,
                'key' => 'social-media.telegram_link',
                'display_name' => 'Telegram',
                'value' => '#',
                'details' => NULL,
                'type' => 'text',
                'order' => 86,
                'group' => 'Social media',
            ),
            172 => 
            array (
                'id' => 234,
                'key' => 'payments.ccbill_datalink_username',
                'display_name' => 'CCBill DataLink Username',
                'value' => NULL,
                'details' => '{
"description": "Used for cancelling CCBill subscriptions programmatically. Enables users cancelling their CCBill subscriptions from their profile"
}',
                'type' => 'text',
                'order' => 33,
                'group' => 'Payments',
            ),
            173 => 
            array (
                'id' => 235,
                'key' => 'payments.ccbill_datalink_password',
                'display_name' => 'CCBill DataLink Password',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 34,
                'group' => 'Payments',
            ),
            174 => 
            array (
                'id' => 236,
                'key' => 'payments.ccbill_checkout_disabled',
                'display_name' => 'Disable for checkout',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Won`t be shown on checkout, but it`s still available for deposits."
}',
                'type' => 'checkbox',
                'order' => 36,
                'group' => 'Payments',
            ),
            175 => 
            array (
                'id' => 237,
                'key' => 'payments.ccbill_recurring_disabled',
                'display_name' => 'Disable for recurring payments',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Won`t be available for subscription payments, but it`s still available for deposits and one time payments."
}',
                'type' => 'checkbox',
                'order' => 36,
                'group' => 'Payments',
            ),
            176 => 
            array (
                'id' => 238,
                'key' => 'payments.stripe_checkout_disabled',
                'display_name' => 'Disable for checkout',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Won`t be shown on checkout, but it`s still available for deposits."
}',
                'type' => 'checkbox',
                'order' => 40,
                'group' => 'Payments',
            ),
            177 => 
            array (
                'id' => 239,
                'key' => 'payments.stripe_recurring_disabled',
                'display_name' => 'Disable for recurring payments',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Won`t be available for subscription payments, but it`s still available for deposits and one time payments."
}',
                'type' => 'checkbox',
                'order' => 42,
                'group' => 'Payments',
            ),
            178 => 
            array (
                'id' => 240,
                'key' => 'payments.paypal_checkout_disabled',
                'display_name' => 'Disable for checkout',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Won`t be shown on checkout, but it`s still available for deposits."
}',
                'type' => 'checkbox',
                'order' => 44,
                'group' => 'Payments',
            ),
            179 => 
            array (
                'id' => 241,
                'key' => 'payments.paypal_recurring_disabled',
                'display_name' => 'Disable for recurring payments',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Won`t be available for subscription payments, but it`s still available for deposits and one time payments."
}',
                'type' => 'checkbox',
                'order' => 46,
                'group' => 'Payments',
            ),
            180 => 
            array (
                'id' => 242,
                'key' => 'payments.nowpayments_checkout_disabled',
                'display_name' => 'Disable for checkout',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Won`t be shown on checkout, but it`s still available for deposits."
}',
                'type' => 'checkbox',
                'order' => 36,
                'group' => 'Payments',
            ),
            181 => 
            array (
                'id' => 243,
                'key' => 'payments.coinbase_checkout_disabled',
                'display_name' => 'Disable for checkout',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Won`t be shown on checkout, but it`s still available for deposits."
}',
                'type' => 'checkbox',
                'order' => 38,
                'group' => 'Payments',
            ),
            182 => 
            array (
                'id' => 244,
                'key' => 'profiles.allow_users_enabling_open_profiles',
                'display_name' => 'Allow users making their profiles open',
                'value' => '1',
                'details' => '{
"true" : "Off",
"false" : "Off",
"checked" : false,
"description": "If enabled, users will be able to make their profiles open so anyone can their (non PPV) content."
}',
                'type' => 'checkbox',
                'order' => 10,
                'group' => 'Profiles',
            ),
            183 => 
            array (
                'id' => 245,
                'key' => 'payments.paystack_secret_key',
                'display_name' => 'Paystack Secret Key',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 28,
                'group' => 'Payments',
            ),
            184 => 
            array (
                'id' => 246,
                'key' => 'payments.paystack_checkout_disabled',
                'display_name' => 'Disable for checkout',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Won`t be shown on checkout, but it`s still available for deposits."
}',
                'type' => 'checkbox',
                'order' => 44,
                'group' => 'Payments',
            ),
            185 => 
            array (
                'id' => 247,
                'key' => 'license.product_license_key',
                'display_name' => 'Product license key',
                'value' => '9da71fe8-3b7d-492e-9b39-91eeb5527b1a',
                'details' => '{
"description": "Your product license key. Can be taken out of your Codecanyon downloads page."
}',
                'type' => 'text',
                'order' => 0,
                'group' => 'License',
            ),
            186 => 
            array (
                'id' => 248,
                'key' => 'payments.withdrawal_default_fee_percentage',
                'display_name' => 'Withdrawal fee percentage',
                'value' => '10',
                'details' => NULL,
                'type' => 'text',
                'order' => 96,
                'group' => 'Payments',
            ),
            187 => 
            array (
                'id' => 249,
                'key' => 'payments.withdrawal_allow_fees',
                'display_name' => 'Enable withdrawal fee',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Will enable admins to add a default fee percentage which will automatically apply to each withdrawal request."
}',
                'type' => 'checkbox',
                'order' => 94,
                'group' => 'Payments',
            ),
            188 => 
            array (
                'id' => 250,
                'key' => 'payments.withdrawal_allow_only_for_verified',
                'display_name' => 'Enable only for verified creators',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Will enable withdrawal section into creators wallet only if they verified their identity."
}',
                'type' => 'checkbox',
                'order' => 98,
                'group' => 'Payments',
            ),
            189 => 
            array (
                'id' => 251,
                'key' => 'storage.minio_access_key',
                'display_name' => 'Minio Access Key',
                'value' => 'asas',
                'details' => NULL,
                'type' => 'text',
                'order' => 130,
                'group' => 'Storage',
            ),
            190 => 
            array (
                'id' => 252,
                'key' => 'storage.minio_secret_key',
                'display_name' => 'Minio Secret Key',
                'value' => 'asasdasdsa',
                'details' => NULL,
                'type' => 'text',
                'order' => 140,
                'group' => 'Storage',
            ),
            191 => 
            array (
                'id' => 253,
                'key' => 'storage.minio_region',
                'display_name' => 'Minio Region',
                'value' => 'dasdasd',
                'details' => NULL,
                'type' => 'text',
                'order' => 150,
                'group' => 'Storage',
            ),
            192 => 
            array (
                'id' => 254,
                'key' => 'storage.minio_bucket_name',
                'display_name' => 'Minio Bucket',
                'value' => 'asdasdasda',
                'details' => NULL,
                'type' => 'text',
                'order' => 160,
                'group' => 'Storage',
            ),
            193 => 
            array (
                'id' => 255,
                'key' => 'storage.minio_endpoint',
                'display_name' => 'Minio Endpoint',
                'value' => 'sdasdsadas',
                'details' => NULL,
                'type' => 'text',
                'order' => 170,
                'group' => 'Storage',
            ),
            194 => 
            array (
                'id' => 256,
                'key' => 'referrals.enabled',
                'display_name' => 'Enable referral system',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
}',
                'type' => 'checkbox',
                'order' => 1240,
                'group' => 'Referrals',
            ),
            195 => 
            array (
                'id' => 257,
                'key' => 'referrals.fee_percentage',
                'display_name' => 'Referrals earning fee percentage',
                'value' => '5',
                'details' => '{
"description": "Payout percentage given to users from their referred people total earnings. If set to 0, referred users will generate no income."
}',
                'type' => 'text',
                'order' => 1242,
                'group' => 'Referrals',
            ),
            196 => 
            array (
                'id' => 258,
                'key' => 'referrals.apply_for_months',
                'display_name' => 'Referrals months limit',
                'value' => '12',
                'details' => '{
"description": "Represents the number of months since users created their accounts so people who referred them earn a fee from their total earnings."
}',
                'type' => 'text',
                'order' => 1244,
                'group' => 'Referrals',
            ),
            197 => 
            array (
                'id' => 259,
                'key' => 'referrals.fee_limit',
                'display_name' => 'Referrals fee limit',
                'value' => '1000',
                'details' => '{
"description": "Allows users to earn up to the specified limit per referred user."
}',
                'type' => 'text',
                'order' => 1246,
                'group' => 'Referrals',
            ),
            198 => 
            array (
                'id' => 260,
                'key' => 'profiles.default_wallet_balance_on_register',
                'display_name' => 'Default wallet balance on user register',
                'value' => '0',
                'details' => '{
"description" : "Default wallet balance to be credited to new users."
}
',
                'type' => 'text',
                'order' => 33,
                'group' => 'Profiles',
            ),
            199 => 
            array (
                'id' => 261,
                'key' => 'feed.suggestions_skip_unverified_profiles',
                'display_name' => 'Skip unverified profiles out of the suggestions box',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
}',
                'type' => 'checkbox',
                'order' => 50,
                'group' => 'Feed',
            ),
            200 => 
            array (
                'id' => 262,
                'key' => 'feed.suggestions_use_featured_users_list',
                'display_name' => 'Use featured users for the suggestions box',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
}',
                'type' => 'checkbox',
                'order' => 60,
                'group' => 'Feed',
            ),
            201 => 
            array (
                'id' => 263,
                'key' => 'referrals.referrals_default_link_page',
                'display_name' => 'Default referrals link page',
                'value' => 'profile',
                'details' => '{
"default" : "profile",
"options" : {
"profile": "User profile page",
"register": "Register page",
"home": "Homepage"
},
"description": "The default page for which the referral link will be created for."
}',
                'type' => 'radio_btn',
                'order' => 1248,
                'group' => 'Referrals',
            ),
            202 => 
            array (
                'id' => 264,
                'key' => 'profiles.allow_profile_bio_markdown',
                'display_name' => 'Allow users to use markdown in profile description',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true,
"description": "If enabled, users will be able to use markdown in their profile bios."
}',
                'type' => 'checkbox',
                'order' => 40,
                'group' => 'Profiles',
            ),
            203 => 
            array (
                'id' => 265,
                'key' => 'profiles.allow_profile_bio_markdown_links',
                'display_name' => 'Allow hyperlinks in the markdown formatting',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true,
"description": "If enabled, users will be able to post links within their descriptions."
}',
                'type' => 'checkbox',
                'order' => 50,
                'group' => 'Profiles',
            ),
            204 => 
            array (
                'id' => 266,
                'key' => 'profiles.disable_profile_bio_excerpt',
                'display_name' => 'Disable profile\'s bio field excerpt',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true,
"description": "If set to On, the bio will be auto-expanded and show more/less labels will be hidden."
}',
                'type' => 'checkbox',
                'order' => 60,
                'group' => 'Profiles',
            ),
            205 => 
            array (
                'id' => 267,
                'key' => 'profiles.max_profile_bio_length',
                'display_name' => 'Maximum profile bio characters length',
                'value' => '15001',
                'details' => '{
"description": "Max profile bio length. If set to 0, no limit will be set."
}',
                'type' => 'text',
                'order' => 70,
                'group' => 'Profiles',
            ),
            206 => 
            array (
                'id' => 268,
                'key' => 'websockets.driver',
                'display_name' => 'Websockets driver',
                'value' => 'pusher',
                'details' => '{
"default" : "pusher",
"options" : {
"pusher": "Pusher",
"soketi": "Soketi"
}
}',
                'type' => 'select_dropdown',
                'order' => 1,
                'group' => 'Websockets',
            ),
            207 => 
            array (
                'id' => 269,
                'key' => 'websockets.soketi_host_address',
                'display_name' => 'Soketi Host Address',
                'value' => 'soketi.qdev.tech',
                'details' => NULL,
                'type' => 'text',
                'order' => 10,
                'group' => 'Websockets',
            ),
            208 => 
            array (
                'id' => 270,
                'key' => 'websockets.soketi_host_port',
                'display_name' => 'Soketi Host Port',
                'value' => '443',
                'details' => NULL,
                'type' => 'text',
                'order' => 20,
                'group' => 'Websockets',
            ),
            209 => 
            array (
                'id' => 271,
                'key' => 'websockets.soketi_app_id',
                'display_name' => 'Soketi App ID',
                'value' => 'app-id',
                'details' => NULL,
                'type' => 'text',
                'order' => 30,
                'group' => 'Websockets',
            ),
            210 => 
            array (
                'id' => 272,
                'key' => 'websockets.soketi_app_key',
                'display_name' => 'Soketi App Key',
                'value' => 'app-key',
                'details' => NULL,
                'type' => 'text',
                'order' => 40,
                'group' => 'Websockets',
            ),
            211 => 
            array (
                'id' => 273,
                'key' => 'websockets.soketi_app_secret',
                'display_name' => 'Soketi App Secret',
                'value' => 'app-secret',
                'details' => NULL,
                'type' => 'text',
                'order' => 50,
                'group' => 'Websockets',
            ),
            212 => 
            array (
                'id' => 274,
                'key' => 'websockets.soketi_use_TSL',
                'display_name' => 'Use TSL for Soketi',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false
}',
                'type' => 'checkbox',
                'order' => 60,
                'group' => 'Websockets',
            ),
            213 => 
            array (
                'id' => 299,
                'key' => 'compliance.admin_approved_posts_limit',
                'display_name' => 'Admin pre-approved posts limit',
                'value' => '0',
                'details' => '
{
"description" : "The number of posts that needs admin approval. After this number of posts has been reached, the creator can post freely (value = 0 means no limit)."
}',
                'type' => 'text',
                'order' => 1180,
                'group' => 'Compliance',
            ),
            214 => 
            array (
                'id' => 300,
                'key' => 'compliance.minimum_posts_until_creator',
                'display_name' => 'Required number of posts to be able to receive payments',
                'value' => '0',
                'details' => '{
"description": "Set a minimum number of posts for users to be able to earn money. Users won`t be able to receive money until they reach this limit (value = 0 means no limit)."
}',
                'type' => 'text',
                'order' => 1170,
                'group' => 'Compliance',
            ),
            215 => 
            array (
                'id' => 301,
                'key' => 'compliance.minimum_posts_deletion_limit',
                'display_name' => 'Deletion minimum posts limit',
                'value' => '0',
                'details' => '{
"description": "Set a minimum posts deletion limit for creators. Enforce them to have a minimum number of posts on their accounts (value = 0 means no limit)."
}',
                'type' => 'text',
                'order' => 1190,
                'group' => 'Compliance',
            ),
            216 => 
            array (
                'id' => 302,
                'key' => 'compliance.monthly_posts_before_inactive',
                'display_name' => 'Monthly posts required to keep account active',
                'value' => '0',
                'details' => '
{
"description" : "The minimum monthly posts number a creator must publish before having his account marked as inactive. If value = 0, no inactivity rule will be applied."
}',
                'type' => 'text',
                'order' => 1170,
                'group' => 'Compliance',
            ),
            217 => 
            array (
                'id' => 303,
                'key' => 'compliance.disable_creators_ppv_delete',
                'display_name' => 'Disable creators ability to delete purchased PPV content',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true,
"description": "If enabled, creators won\'t be able to delete paid PPV content (paid posts/messages) if already paid by a customer."
}',
                'type' => 'checkbox',
                'order' => 1190,
                'group' => 'Compliance',
            ),
            218 => 
            array (
                'id' => 329,
                'key' => 'payments.stripe_oxxo_provider_enabled',
                'display_name' => 'Allow OXXO',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "Allow OXXO payment provider through Stripe. This will be shown as different option in checkout"
}',
                'type' => 'checkbox',
                'order' => 100,
                'group' => 'Payments',
            ),
            219 => 
            array (
                'id' => 330,
                'key' => 'payments.min_ppv_content_price',
                'display_name' => 'Min PPV content price',
                'value' => '1',
                'details' => '{
"description": "Applies to paid posts, messages and streams."
}',
                'type' => 'text',
                'order' => 100,
                'group' => 'Payments',
            ),
            220 => 
            array (
                'id' => 331,
                'key' => 'payments.max_ppv_content_price',
                'display_name' => 'Max PPV content price',
                'value' => '500',
                'details' => '{
"description": "Applies to paid posts, messages and streams."
}',
                'type' => 'text',
                'order' => 110,
                'group' => 'Payments',
            ),
            221 => 
            array (
                'id' => 332,
                'key' => 'social-media.reddit_url',
                'display_name' => 'Reddit',
                'value' => NULL,
                'details' => NULL,
                'type' => 'text',
                'order' => 90,
                'group' => 'Social media',
            ),
            222 => 
            array (
                'id' => 344,
                'key' => 'media.enable_ffmpeg',
                'display_name' => 'Enable FFmpeg',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "If disabled, FFmpeg won\'t convert any videos, only mp4 videos will be allowed for upload."
}',
                'type' => 'checkbox',
                'order' => 5,
                'group' => 'Media',
            ),
            223 => 
            array (
                'id' => 345,
                'key' => 'admin.send_notifications_on_contact',
                'display_name' => 'Admin notifications for contact messages',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "If enabled, the admin users will receive an email with the contents of the contact message."
}',
                'type' => 'checkbox',
                'order' => 6,
                'group' => 'Admin',
            ),
            224 => 
            array (
                'id' => 354,
                'key' => 'site.hide_create_post_menu',
                'display_name' => 'Hide create post menu',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "If enabled, the create post module link will be hidden from the menus. Useful if running the site on one-creator mode."
}',
                'type' => 'checkbox',
                'order' => 185,
                'group' => 'Site',
            ),
            225 => 
            array (
                'id' => 355,
                'key' => 'feed.hide_suggestions_slider',
                'display_name' => 'Hide the users suggestion box',
                'value' => '0',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : false,
"description": "If enabled, the users suggestion slider will be hidden from the feed page."
}',
                'type' => 'checkbox',
                'order' => 9,
                'group' => 'Feed',
            ),
            226 => 
            array (
                'id' => 361,
                'key' => 'site.default_og_image',
                'display_name' => 'Default site og:image',
                'value' => '',
                'details' => '{"description" : "The image to be used when sharing the site over social media sites."}',
                'type' => 'file',
                'order' => 65,
                'group' => 'Site',
            ),
            227 => 
            array (
                'id' => 362,
                'key' => 'profiles.enable_new_post_notification_setting',
                'display_name' => 'Enable new post notification setting',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true,
"description": "If enabled, subscribers will be allowed to manage their (new) posts email notifications, while creators can choose to notify them or not, when creating new posts."
}',
                'type' => 'checkbox',
                'order' => 100,
                'group' => 'Profiles',
            ),
            228 => 
            array (
                'id' => 363,
                'key' => 'profiles.default_new_post_notification_setting',
                'display_name' => 'Default new post notification setting on user register',
                'value' => '1',
                'details' => '{
"true" : "On",
"false" : "Off",
"checked" : true,
"description": "The default value for weather the user should receive emails when new content has been posted."
}',
                'type' => 'checkbox',
                'order' => 110,
                'group' => 'Profiles',
            ),
        ));
        
        
    }
}