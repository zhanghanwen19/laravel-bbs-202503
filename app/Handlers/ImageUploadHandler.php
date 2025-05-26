<?php

namespace App\Handlers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageUploadHandler
{
    /**
     * 允许的上传图片后缀名
     *
     * @var array|string[]
     */
    protected array $allowedExt = ['png', 'jpg', 'gif', 'jpeg'];

    /**
     * 保存上传的图片
     *
     * @param UploadedFile $file
     * @param string $folder 存储的文件夹名称
     * @param string $filePrefix 文件名前缀，通常是模型 ID
     * @param int $maxWidth 图片最大宽度，默认为 416px
     * @return array|false 返回图片存储路径或 false
     */
    public function save(UploadedFile $file, string $folder, string $filePrefix = '', int $maxWidth = 416): array|false
    {
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        $folderName = "uploads/images/$folder/" . date("Ym/d", time());

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/laravel-bbs/public/uploads/images/avatars/201709/21/
        $uploadPath = public_path() . '/' . $folderName;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension() ?: 'png');

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $filePrefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // 判断上传的文件是否是允许上传的后缀名
        if (!in_array($extension, $this->allowedExt)) {
            return false;
        }

        // 将图片移动到我们的目标存储路径中
        $file->move($uploadPath, $filename);

        // http://127.0.0.1:8000/uploads/images/avatars/201709/21/1_1493521050_7BVc9v9ujP.png
        return [
            'path' => config('app.url') . "/$folderName/$filename"
        ];
    }
}
