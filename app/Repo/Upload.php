<?php
/**
 * Created by PhpStorm.
 * User: baoxulong
 * Date: 2017/4/20
 * Time: 16:53
 */

namespace App\Repo;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;

class Upload
{
    public static function upload($img)
    {
        $accessKey = 'mkl6FxAJY-RYuOBu4m6aa6Mhl2J-z6cLWjXtqF-2';
        $secretKey = 'mls-nSV4ft0mTjRsR0LMnJ31MBXA3qFo6--VSuZr';
        $upManager = new UploadManager();
        $auth = new Auth($accessKey, $secretKey);
        $token = $auth->uploadToken('baoxulong');
        list($ret, $error) = $upManager->put($token, 'formput', 'hello world');
    }

}