<?php 
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate{
	protected $rule = [
		'admin_name'=>'require',
		'admin_password'=>'require',
		'code'=>'require|captcha'
	];

	protected $message = [
		'admin_name.require'=>'请输入管理员帐号',
		'admin_password.require'=>'请输入管理员密码',
		'code.require'=>'请输入验证码',
		'code.captcha'=>'验证码不正确'
	];

}