<?php

use Illuminate\Database\Seeder;
use App\AppSetting;

class AppSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppSetting::truncate();
        $appSettings = [
            [
                'key' => 'company',
                'value' => 'Tên cty',
            ],
            [
                'key' => 'email',
                'value' => 'abc@com.vn',
            ], [
                'key' => 'phone',
                'value' => '0988.888.888',
            ], [
                'key' => 'address',
                'value' => 'Số 999 Phạm Hùng, Hà nội',
            ], [
                'key' => 'page_title',
                'value' => 'An awesome CMS!',
            ], [
                'key' => 'meta_keyword',
                'value' => 'awesome,cms',
            ], [
                'key' => 'meta_description',
                'value' => 'GCMS is an awesome CMS!',
            ]
        ];
        foreach ($appSettings as $appSetting) {
            AppSetting::create($appSetting);
        }
    }
}
