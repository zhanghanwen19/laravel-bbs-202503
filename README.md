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

- Laravel 清除所有缓存
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

### 📅 2025/05/23

- 你现在可以通过以下的方法来判断用户是否已经验证了邮箱地址:
    ```php
    auth()->user()->hasVerifiedEmail();
    ```

- 创建邮箱验证成功后的事件
    ```bash
    php artisan make:listener EmailVerified
    ```

- 可以使用以下命令来查看所有的事件
    ```bash
    php artisan event:list
    ```

- 创建完成之后在 [app/Listeners/EmailVerified.php](app/Listeners/EmailVerified.php) 中去做你想要的事情
    ```php
    public function handle(Verified $event)
    {
        session()->flash('success', 'Your email address has been verified.');
    }
    ```

- 最后要在 [AppServiceProvider.php](app/Providers/AppServiceProvider.php) 中注册事件监听
    ```php
    public function boot(): void
    {
        // 注册事件监听
        // https://laravel.com/docs/12.x/events
        Event::listen(
          EmailVerified::class, // 事件类, 在用户完成邮箱验证后触发
        );
    }
    ```

- 创建 users 控制器
    ```bash
    php artisan make:controller UsersController
    ```

- 创建一个数据迁移文件给 users 表添加 avatar 和 introduction
    ```bash
    php artisan make:migration add_avatar_and_introduction_to_users_table --table=users
    php artisan migrate
    ```

- 创建 UserRequest
    ```bash
    php artisan make:request UserRequest
    ```

- 在创建完 UserRequest 之后需要去修改一下默认的授权策略
    ```php
    public function authorize()
    {
        return true;
    }
    ```

### 📅 2025/05/26

- 安装 intervention/image
    ```bash
    composer require intervention/image
    ```

### 📅 2025/05/27

- 生成 UserPolicy
    ```bash
    php artisan make:policy UserPolicy --model=User
    ```

- 我们到目前为止学习了 Laravel 中的:
    - 中间件: 请求和响应之间进行处理, 例如验证用户是否登录, 检查用户权限等.
    - 事件和监听器: 应用程序中触发事件, 并在事件发生时执行相应的操作.
    - 授权策略: 应用程序中定义用户的权限, 并在应用程序中进行权限验证.
    - 请求验证: 应用程序中对用户的请求进行验证, 确保用户提交的数据是合法的.
    - 数据迁移: 应用程序中对数据库进行操作, 例如创建表, 修改表结构等.
    - 本地化: 应用程序中支持多种语言, 并在应用程序中进行语言切换.
    - Eloquent ORM : 应用程序中对数据库进行操作, 例如查询数据, 插入数据, 更新数据等.
    - 数据生成和数据填充: 应用程序中生成测试数据, 例如用户数据, 文章数据等.

- 生成 category 模型
    ```bash
    php artisan make:model Category -mcr
    ```
    - -m 表示生成数据迁移文件, -c 表示生成控制器, -r 表示生成资源控制器.

- 生成 category 表的初始化数据 migration
    ```bash
    php artisan make:migration seed_categories_data
    ```
    - 因为帖子分类应该是项目初始化的时候就要准备好的数据, 是我们项目的一部分, 所以我们没有像之前那样使用 seeder 来生成数据,
      而是直接在 migration 中生成数据. seeder 是用来生成测试数据的, 而 migration 是用来生成项目的一部分数据的.

- 运行数据迁移
    ```bash
    php artisan migrate
    ```

- 我们使用 Laravel 自带的命令来生成 Topic 的「话题骨架」
    ```bash
    php artisan make:model Topic -a -s -p
    ```
    - 参数含义
        - -a All：等同于 -mfcr（见下）
        - -m 创建数据库迁移文件 create_topics_table
        - -f 创建对应的 factory 工厂类
        - -c 创建控制器类（普通控制器）
        - -r 创建 resource 控制器（带 REST 方法）
        - -s 创建 Seeder（数据填充器）
        - -p 创建 Policy（策略类）

- 执行数据迁移
    ```bash
    php artisan migrate
    ```

### 📅 2025/05/28

- 创建 UserSeeder
    ```bash
    php artisan make:seeder UserSeeder
    ```

- 运行数据填充
    ```bash
    php artisan migrate:fresh --seed
    ```

- ⚠️ 我们现在的话题表叫做 topic, 你们要去修改数据迁移文件的名称以及内容
- ⚠️ 还有就是 topic 相关的文件名称都要去重新确认一下, 我们按照 Laravel 生成的来做

- 使用 yarn 安装 fontawesome
    ```bash
    yarn add @fortawesome/fontawesome-free
    ```

- 在 [app.scss](resources/sass/app.scss) 中引入 fontawesome

- 安装 barryvdh/laravel-debugbar
    ```bash
    composer require barryvdh/laravel-debugbar --dev
    ```
    ```bash
    php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
    ```

     
