# BeikeShop Theme Plugin Development Example: SampleTheme

📖 [中文版](README.md)

This is a sample theme plugin for BeikeShop. You can use this project as a reference to quickly develop your own theme plugin.

---

## 🚀 Quick Start

Download this plugin and extract the `SampleTheme` directory into the `plugins` directory at the root of your BeikeShop project:

### Plugin Directory Structure
```
SampleTheme/
├── Bootstrap.php              // Plugin bootstrap class. You must implement a public boot method: public function boot(), and register hooks inside it
├── config.json                // Plugin configuration file
├── Resources/                 // Frontend static resources (e.g. CSS/JS)
│   └── beike/shop/sample_theme/
├── Seeders/                   // Demo data files
├── Static/                    // Demo images and other static resources
│   ├── image/
│   │   ├── logo.png           // Plugin logo
│   │   └── theme.jpg          // Theme preview image
│   ├── public/
│   │   └── catalog/sample_theme/
│   └── build/
│       └── beike/shop/sample_theme/
├── Themes/                    // Blade template files
│   └── sample_theme/
```
- `Resources/`: Stores CSS, JS, and other frontend assets
- `Seeders/`: Contains demo seed data (optional)
- `Static/`: Contains images and compiled assets
- `Themes/`: Stores Blade template files

## 🛠️ Development Steps

### Step 1: Modify `config.json`

Edit the `config.json` file in the plugin directory and update the `code` field to a unique identifier for your theme (suggested: lowercase + underscore). Update other fields as needed:

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
  }
}
```

### Step 2: Modify Bootstrap.php
Edit the Bootstrap.php file and replace the namespace and class name from SampleTheme to your theme code. Format:
```
namespace Plugins\YourThemeCode;
```
- YourThemeCode: Must start with a capital letter and use CamelCase (e.g. MyTheme)
- This name should correspond to the code in config.json (style can vary)

Step 3: Replace sample_theme in paths
Replace all folder and file paths that contain sample_theme with your actual theme code (use lowercase + underscore style):

```
Resources/beike/shop/sample_theme
Themes/sample_theme
Static/public/build/beike/shop/sample_theme
Static/public/catalog/sample_theme
```

Once you've completed the above, you can go to Admin > Plugin List to install your theme plugin, then go to Design > Theme Settings to find and activate your theme. The frontend will switch to your theme immediately.

## Development Notes
### SCSS Compilation
1. SCSS files are located in: Resources/beike/shop/sample_theme/css. Before compiling, run npm install in the root directory of BeikeShop.
2. Open the webpack.mix.js file at the root of BeikeShop.
3. Locate the following code block. Uncomment it and update themeFileName to your theme folder name (⚠️ not the theme code):
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
4. During development, run npm run watch to watch file changes and compile automatically. After development, run npm run prod to build and minify CSS/JS files.

### Frontend Template Files：
- Files under plugins/SampleTheme/Themes/sample_theme are the frontend Blade templates.
- When installing the plugin, BeikeShop will copy these files to themes/sample_theme automatically.
- To modify any templates, first copy them from themes/default to plugins/SampleTheme/Themes/sample_theme, then edit as needed. The system will load your customized files.


### Theme Data Seeders
- If your homepage uses layout modules and you want to bundle default data with the theme plugin:
- Find the design_setting row in the settings table of the database.
- Copy the value (JSON format), and convert it to a PHP array using this online tool: 👉 https://uutool.cn/json2php/
- Paste the converted data into SampleTheme/Seeders/ThemeSeeder.php, inside the getHomeSetting method, replacing the [].
```
public function run()
{
    // $homeSetting = $this->getHomeSetting();
    // SettingRepo::update('system', 'base', ['design_setting' => $homeSetting]);
}
```

### Static Assets
- All static files are located under plugins/SampleTheme/Static
- image/ folder contains logo.png and theme.jpg (preview image) Make sure to replace them with your own assets before publishing
- public/build/: Contains compiled CSS and JS files
- public/catalog/sample_theme/: Contains frontend content images (e.g. banners, icons)

### Packaging & Publishing
- Once your theme is complete, compress the plugin folder into a ZIP file
- Upload it to your personal center at the BeikeShop official site
- After publishing, other users can install and activate your theme via the plugin marketplace