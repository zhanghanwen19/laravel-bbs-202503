### 🐼 Pandaria

---

### 📅 2025/05/20

### 使用 Laravel 12 来初始化我们的项目

- 使用 Laravel 12 来初始化我们的项目
    ```bash
    composer create-project laravel/laravel laravel-bbs-202503
    ```

- 启动项目
    ```bash
    cd laravel-bbs-202503
    npm install
    php artisan serve
    npm run dev
    ```

- 初始化项目仓库
    ```bash
    git init
    git add .
    git commit -m "init"
    ```

- 我们推荐大家使用 GitHub desktop 来管理我们的项目...
    - [GitHub Desktop](https://desktop.github.com/)

- 也可以在 GitHub 中创建一个新的仓库
    - [GitHub](https://github.com/)
    ```bash
    git remote add origin <这里是你创建的仓库地址, 因为我们用的是 ssh, 所以你的链接应该是 git@...github.com:...>
    git push
    ```

- 安装 Bootstrap 和 Popper.js
  ```bash
  npm install bootstrap @popperjs/core
  ```

---

### 📅 2025/05/21

- 安装 laravel/ui
    ```bash
    composer require laravel/ui --dev
    php artisan ui bootstrap
    npm install
    ```

- 修改 [package.json](package.json) 文件中的引入, 我们的项目使用 yarn 来管理前端资源, 修改完成之后运行
    ```bash
    rm package-lock.json
    rm -rf node_modules
    yarn install
    yarn add @fortawesome/fontawesome-free
    ```

- 提交代码
    ```bash
    git add .
    git commit -m "增加字体图标, 该用 yarn 来管理前端资源"
    git push
    ```

- 安装 laravel ui:auth
    ```bash
    php artisan ui:auth

    The [layouts/app.blade.php] view already exists. Do you want to replace it? (yes/no) [no]
    ❯
    
    The [Controller.php] file already exists. Do you want to replace it? (yes/no) [yes]
    ❯
    
    INFO  Authentication scaffolding generated successfully.
   ```

- 删除 home.blade.php 和 HomeController.php
    ```bash
    rm app/Http/Controllers/HomeController.php
    rm resources/views/home.blade.php
    ```

- 提交代码
    ```bash
    git add .
    git commit -m "生成用户认证代码"
    ```

- 修改本地化支持日语
    ```dotenv
    APP_LOCALE=ja
    APP_FALLBACK_LOCALE=ja
    APP_FAKER_LOCALE=ja_JP
    ```
    ```bash
    composer require laravel-lang/common
    php artisan lang:add ja
    ```
    ```bash
    git add .
    git commit -m "修改本地化支持日语"
    ```

- Laravel 清楚所有缓存
    ```bash
    php artisan optimize:clear
    ```

- 修复跳转链接
    ```bash
    git add .
    git commit -m "修复跳转链接"
    ```

- 安装 [mews/captcha](https://github.com/mewebstudio/captcha)
    ```bash
    composer require mews/captcha
    php artisan vendor:publish --provider='Mews\Captcha\CaptchaServiceProvider'
    ```
- 在 [providers.php](bootstrap/providers.php) 中添加
    ```php
    return [
        // ...
        Mews\Captcha\CaptchaServiceProvider::class
    ];
    ```
- 在 [app.php](config/app.php) 中添加
    ```php
    'aliases' => [
        // ...
        'Captcha' => Mews\Captcha\Facades\Captcha::class,
    ],
    ```

- 提交代码
    ```bash
    git add .
    git commit -m "安装验证码"
    ```
  
