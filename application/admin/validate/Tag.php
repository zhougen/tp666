<?php
/**
 * Created by PhpStorm
 * User:zhougen
 * Date:2017/7/23
 * Time:10:27
 */
namespace app\admin\validate;

use think\Validate;

class Tag extends Validate{

    protected $rule = [
        'tag_name'=>'require',
    ];
    protected $message = [
        'tag_name.require'=>'请输入标签名称',
    ];

}
