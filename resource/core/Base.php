<?php

/**
 * HỆ THỐNG TRẮC NGHIỆM ONLINE
 * Base Function
 * @author: Nong Van Du (Dzu)
 * Mail: dzu6996@gmail.com
 * @link https://github.com/meesudzu/trac-nghiem-online
 **/

class Base
{
    public function __construct()
    {
    }
    public function uploadImage($file, $path)
    {
        $expl = explode('.', $file['name']);
        $ext = $expl[(count($expl)-1)];
        $name = $this->convertString($expl[0]);
        $hash = md5(time());
        if ($ext === 'jpg' || $ext === 'png' || $ext === 'jpeg') {
            $new_name = $hash .'_' . $name . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $path . $new_name)) {
                return $new_name;
            } else {
                return false;
            }
        }
    }
    public function convertString($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
}
