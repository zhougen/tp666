<?php

namespace app\admin\controller;
use app\common\model\Admin;
use houdunwang\crypt\Crypt;
use think\Controller;

class Login extends Controller
{
    
   public function login()
   {
      // echo Crypt::encrypt('admin888');die;
   	// echo Crypt::decrypt('h3vPU8JGuF3VS/uxIpjRSw==');

      if(request()->isPost()){

   		$res = (new Admin())->login(input('post.'));
         // halt($res);die();
   		if(!$res['error']){
            $this->error('登录失败');die();

         }else{
            $this->success($res['msg'],'admin/entry/index');
         }
   	}
   	return $this->fetch();
   }




}
