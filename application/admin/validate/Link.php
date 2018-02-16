<?php
/**
 * Created by PhpStorm
 * User:zhougen
 * Date:2017/7/25
 * Time:20:58
 */

namespace app\admin\validate;
use think\Validate;

class Link extends Validate{

    protected $rule = [
        'link_name'=>'require',
        'link_url'=>'require',
        'link_sort'=>'require|between:1,9999'
    ];
    protected $message = [
        'link_name.require'=>'请输入友情链接名称',
        'link_url.require'=>'请输入友情链接网址',
        'link_sort.require'=>'请输入友情链接排序',
        'link_sort.between'=>'排序号必须是1-9999之间',

    ];
}
