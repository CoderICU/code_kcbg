<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($code) {
            if (!$code->sn) {
                $code->sn = static::generateSn();
                //如果生成失败，返回 false
                if (!$code->sn) {
                    return false;
                }
            }
        });
    }

    public static function findMaxSn()
    {
        return Code::max('sn');
    }

    public static function generateSn()
    {
        //yymmdd + 4位自增，从0开始
        $max_sn = static::findMaxSn();
        $prefix = date('ymd');
        if (!empty($max_sn)) {
            if (substr($max_sn, 0, 6) == $prefix) {
                $suffix = substr($max_sn, -(strlen($max_sn)-6));
                return $prefix . str_pad(strval($suffix+1), 4, '0', STR_PAD_LEFT);
            }
        }
        return $prefix . '0000';
    }

    public static function findAvailableNo()
    {
        $prefix = date('ymd');
        for ($i=0; $i < 18; $i++) {
            //随机生成 6 位的数字，并创建订单号
            $no = $prefix.random_int(1000, 9999).substr(microtime(true), -4);
            //判断是否已存在
            if (!static::query()->where('sn', $no)->exists()) {
                return $no;
            }
        }
        //写入日志
        \Log::warning('find code sn failed');

        return false;
    }
}
