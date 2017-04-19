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
                'value' => '0972.0505.89',
            ],[
                'key' => 'phone2',
                'value' => '0988.888.888',
            ], [
                'key' => 'commitment',
                'value' => '<div class="textwidget">
                <ul>
                            <li><span style="color: #ffffff;">Cung cấp thông tin nhanh chóng  &amp; chính xác nhất từ chủ đầu tư</span></li>
                            <li><span style="color: #ffffff;">Hỗ Trợ Quý khách lựa chọn căn hộ vị trí đẹp nhất</span></li>
                            <li><span style="color: #ffffff;">Hỗ trợ tư vấn trực tiếp chuyên sâu</span></li>
                            <li><span style="color: #ffffff;">Xem căn hộ mẫu trực tiếp</span></li>
                            <li><span style="color: #ffffff;">Không thu thêm bất cứ khoản phí nào</span></li>
                            <li><span style="color: #ffffff;">Hỗ trợ làm thủ tục trực tiếp với chủ đầu tư, trước và sau bán hàng</span></li>
                        </ul></div>',
            ],[
                'key' => 'address',
                'value' => 'Số 999 Phạm Hùng, Hà nội',
            ], [
                'key' => 'page_title',
                'value' => 'bất động sản',
            ], [
                'key' => 'meta_keyword',
                'value' => 'bất động sản,dự án',
            ], [
                'key' => 'meta_description',
                'value' => 'bất động sản',
            ]
        ];
        foreach ($appSettings as $appSetting) {
            AppSetting::create($appSetting);
        }
    }
}
