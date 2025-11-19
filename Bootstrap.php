<?php
/*
 * @FilePath: Bootstrap.php
 *
 * @copyright     2024 beikeshop.com - All Rights Reserved.
 * @link: https://beikeshop.com
 * @Author: pu shuo <pushuo@guangda.work>
 * @Date: 2024-12-28 01:08:42
 * @LastEditTime: 2024-12-28 01:11:01
 */

namespace Plugin\SampleTheme;

class Bootstrap
{
    public function boot()
    {
        // 兼容 1.6
        add_hook_blade('home.modules.after', function ($callback, $output, $data) {
            if (version_compare(config('beike.version'), '1.6.0') < 0) {
                return '<style>.module-image-banner .container-fluid {padding-right: 0;padding-left: 0;}</style>';
            }
        });

        // 兼容 2.0
        add_hook_blade('layout.header.code', function ($callback, $output, $data) {
            return view('SampleTheme::shop.compatible-20');
        });
    }
}
