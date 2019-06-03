<?php
/**
 * Created by papinThink
 * Author: GaoYu <gaoyu@time-stone.cn>
 * Date: 2019/1/7
 * Time: 16:47
 */

namespace app\admin\model;

use think\Model;

class LoginLog extends Model
{
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;

    public function searchNameAttr($query, $value)
    {
        if ($value) {
            $query->where('user|name', 'like', '%' . $value . '%');
        }
    }

    public function searchCreateTimeAttr($query, $value, $data)
    {
        if ($value[0] && $value[1]) {
            $query->whereBetweenTime('create_time', $value[0], $value[1]);
        }
    }
}