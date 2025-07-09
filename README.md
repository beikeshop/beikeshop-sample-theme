# BeikeShop 模板插件开发示例：SampleTheme

📖 [English Version](README.en.md)

这是一个 BeikeShop 的模板插件开发示例，通过参考本项目，你可以快速创建属于你自己的主题插件。

---

## 快速开始
将本插件下载到本地，解压后将目录 `SampleTheme` 放置到 BeikeShop 根目录下的 `plugins` 目录中

### 插件目录结构说明
```
SampleTheme/
├── Bootstrap.php              // 插件启动类需要实现一个 boot 公共方法: public function boot(), 再在该方法中添加 hook
├── config.json                // 插件配置文件
├── Resources/                 // 存放前端静态资源（如 CSS/JS）
│   └── beike/shop/sample_theme/
├── Seeders/                   // 示例数据文件
├── Static/                    // 示例图片、静态资源
│   ├── image/
│   │   ├── logo.png           // 插件 Logo
│   │   └── theme.jpg          // 模板预览图
│   ├── public/
│   │   └── catalog/sample_theme/
│   └── build/
│       └── beike/shop/sample_theme/
├── Themes/                    // Blade 模板文件
│   └── sample_theme/
```
- Resources/：存放 CSS、JS 等静态文件
- Seeders/：存放 demo 数据（可选）
- Static/：存放 demo 图片和构建资源
- Themes/：存放 Blade 模板文件

### 第一步：修改 `config.json`

打开插件目录下的 `config.json` 文件，将其中的 `code` 字段修改为你要开发的模板唯一标识（建议使用小写下划线命名），并同步修改其他相关信息：

```json
{
  "code": "your_theme_code",
  "name": {
      "zh_cn": "开发示例模板",
      "en": "Sample Template"
  },
  "description": {
      "zh_cn": "开发示例模板",
      "en": "Sample Template"
  },
  "..."
}
```

### 第二步：修改 Bootstrap.php
编辑 Bootstrap.php 文件，将 namespace 和相关类名中的 SampleTheme 替换为你的模板 code，格式如下：
```
namespace Plugins\YourThemeCode;
```
- YourThemeCode：使用你的模板 code，首字母需大写，并采用驼峰命名（如 MyTheme）。
- 命名需与 config.json 中的 code 相对应（风格除外）。

### 第三步：修改路径中的标识符
将插件以下目录或文件路径中包含的 sample_theme，替换为你的模板插件 code（统一小写，下划线命名）：

```
Resources/beike/shop/sample_theme
Themes/sample_theme
Static/public/build/beike/shop/sample_theme
Static/public/catalog/sample_theme
```

完成以上操作后，你就可以到后台【插件列表】去安装你的模板插件了，然后到【设计->模板设置】里面去找到你的模板，点击启用。这样前台就切换为你的模板了

## 📘 开发说明
### scss 样式编译：
1. 样式文件位置在：Resources/beike/shop/sample_theme/css 下面，是 scss 文件。需要编译，先在beikeshop 系统根目录运行 `npm install`
2. 打开 BeikeShop 根目录下 webpack.mix.js 文件，
3. 找到如下代码，然后把上下的注释去掉，开启此段代码，修改`themeFileName`的值为你的模板文件夹名称(注意，是模板的文件夹名称，不是code)，
```
/* 如果开发新模版，编译需要开启下面代码, 将 themeFileName 的值修改为你的模版文件名
const themeFileName =  'Fashion';
const themeCode = themeFileName.replace(/([A-Z])/g,"_$1").toLowerCase().replace(/^_/,'');

// 拷贝模版 blade 文件 到 themes 目录下
if (!mix.inProduction()) {
  mix.copy(`plugins/${themeFileName}/Themes`, 'themes');
}
// 编译模版 scss/js 到 public/build 下
mix.sass(`plugins/${themeFileName}/Resources/beike/shop/${themeCode}/css/bootstrap/bootstrap.scss`, `public/build/beike/shop/${themeCode}/css/bootstrap.css`)
.then(() => {
  fs.copyFileSync(`public/build/beike/shop/${themeCode}/css/bootstrap.css`, `plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/css/bootstrap.css`);
});

mix.sass(`plugins/${themeFileName}/Resources/beike/shop/${themeCode}/css/app.scss`, `public/build/beike/shop/${themeCode}/css/app.css`)
.then(() => {
  fs.copyFileSync(`public/build/beike/shop/${themeCode}/css/app.css`, `plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/css/app.css`);
});

mix.js(`plugins/${themeFileName}/Resources/beike/shop/${themeCode}/js/app.js`, `public/build/beike/shop/${themeCode}/js/app.js`)
.then(() => {
  fs.copyFileSync(`public/build/beike/shop/${themeCode}/js/app.js`, `plugins/${themeFileName}/Static/public/build/beike/shop/${themeCode}/js/app.js`);
});
*/
```
4. 开发阶段请运行 `npm run watch` 监听文件变化并自动编译，开发完成后运行 `npm run prod` 进行 CSS 和 JS 的压缩构建。

### 前台页面文件：
- `plugins/SampleTheme/Themes/sample_theme` 下的文件就是前台模板文件
- 插件在安装的时候会将这下面的文件复制到 `BeikeShop` 系统的 `themes/sample_theme` 下，所以你需要修改的页面文件, 应先从`themes/default` 目录中复制到你的插件模板目录 `plugins/SampleTheme/Themes/sample_theme` 下对应位置，然后再进行修改，这样系统就会加载你模板的文件

### 模板数据 Seeders
- 如果你的模板在首页有配置其他布局模块，你希望将数据保存到模板插件内，供用户安装的启用模板时替换首页数据。
- 找到数据库的 `settings` 表，name 是 `design_setting` 的数据，复制整个`value`。此时`value`还是 JSON 字符串格式，需要转为数据，可以打开这个网址 [在线JSON转PHP数组工具](https://uutool.cn/json2php/)，把复制的 JSON 放进去，点击开始转换。
- 然后将转换好的数据复制到 `SampleTheme/Seeders/ThemeSeeder` 这个文件的 `getHomeSetting` 函数内, 替换到`[]`，把数据 `return` 出去;
- 然后开启上面 `run` 函数内的代码
```
public function run()
{
    // $homeSetting = $this->getHomeSetting();
    // SettingRepo::update('system', 'base', ['design_setting' => $homeSetting]);
}
```
- 这样就完成了一个模板数据的存储

### 静态资源
- 模板的静态资源都在 `plugins/SampleTheme/Static` 下面，
- `image` 内是 logo.png 和 theme.jpg (预览图)，插件上线前请替换 logo.png 和模板预览图 theme.jpg 为你自己的素材
- `public/build` 就是模板css js 编译后的文件
- `public/catalog/sample_theme` 内就是模板前台配置需要用到图片 幻灯片 图片 icon 等等

### 打包发布模板插件
- 开发完成之后把插件目录打为压缩包 就可以到 `BeikeShop` 官网个人中心去发布插件了
- 发布后，其他用户可以通过插件市场购买 安装并启用你的模板。