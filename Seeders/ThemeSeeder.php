<?php
/**
 * SettingsSeeder.php
 *
 * @copyright  2022 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     Edward Yang <yangjin@guangda.work>
 * @created    2023-03-16 11:42:42
 * @modified   2023-03-16 11:42:42
 */

namespace Plugin\SampleTheme\Seeders;

use Beike\Repositories\SettingRepo;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        // $homeSetting = $this->getHomeSetting();
        // SettingRepo::update('system', 'base', ['design_setting' => $homeSetting]);
    }

    /**
     * 设置首页装修数据
     *
     * @return mixed
     * @throws \Exception
     */
    private function getHomeSetting(): mixed
    {
        return [];
    }
}
