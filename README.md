# 🐼 Pandaria Forum

Pandaria 是一个基于 Laravel 12.14.1 构建的现代化论坛系统，结合了 Bootstrap 5 和 Tailwind
CSS。

---

## 📦 技术栈

- Laravel Framework 12.14.1
- PHP 8.4+
- MySQL 8.0+
- Composer 依赖管理
- Vite 构建工具
- Yarn 前端依赖管理
- Bootstrap ^5.3.6
- Tailwind CSS ^3.4.1
- Redis、Queue、Horizon 支持
- FontAwesome 图标支持
- 支持中间件、事件监听器、任务调度、队列等完整功能

---

## 🚀 安装步骤

```bash
git clone git@github.com:LuStormstout/laravel-bbs-202503.git
cd laravel-bbs-202503

# 后端依赖
composer install

# 前端依赖
yarn install

# 环境配置
cp .env.example .env
php artisan key:generate

# 数据库配置 & 迁移 & 填充
php artisan migrate --seed

# 启动本地服务
php artisan serve
yarn dev
```

---

## 📂 目录结构简览

- `app/` 应用核心逻辑（模型、控制器、服务）
- `resources/views/` Blade 模板文件
- `resources/js/` 自定义 JavaScript 文件
- `resources/sass/` 样式定义，整合 Tailwind 与 Bootstrap
- `routes/web.php` 路由定义
- `database/` 数据迁移、填充器、工厂
- `public/` 前端资源入口

---

## 📅 定时任务（Scheduler）

Pandaria 使用 Laravel 的任务调度系统运行定期任务，例如活跃用户统计。

你需要在操作系统中设置 Cron 任务来每分钟运行 Laravel 的 `schedule:run` 命令：

```bash
* * * * * cd /你的项目路径/laravel-bbs-202503 && php artisan schedule:run >> /dev/null 2>&1
```

### macOS 设置 Cron（使用 crontab）

```bash
crontab -e
```

添加上述命令。确保路径正确。

---

## 🌐 Nginx 配置示例

```nginx
server {
listen 80;
server_name your-domain.com;

    root /path/to/laravel-bbs-202503/public;
    index index.php index.html;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ .php$ {
        include fastcgi_params;
        fastcgi_pass unix:/run/php/php8.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    }

    location ~ /.ht {
        deny all;
    }
}
```

---

## 🛠️ 包含的扩展

- `Laravel Horizon` 队列可视化管理
- `Captcha` 图片验证码验证
- `Spatie Laravel Permission` 权限角色管理
- `Laravel Impersonate` 用户模拟登录
- `Intervention Image` 图像处理
- `Purifier` 富文本 XSS 清理
- ...更多请查看 `composer.json` 文件。

---

## 📜 License

MIT
