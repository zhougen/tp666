<?php

namespace app\admin\controller;

use app\common\model\Admin;
use think\Controller;

class Entry extends Common
{

    /*
     * 后台首页
     * */
   public function index($value='')
   {
   	return $this->fetch();
   }


   /*
    * 修改管理员密码
    * */
   public function  pass(){

    if(request()->isPost()){
        $res = (new Admin())->pass(input('post.'));
        if($res['error']){
            $this->error($res['msg']);
        }else{

            session(null);
            $this->success($res['msg'],'admin/entry/index');
        }

    }
       return $this->fetch();

   }


   /*
    * 退出
    * */
   public function out($a=''){
       dump($a);die;
/*        if($_POST['out']=='login'){
            session('null');
            $this->success('退出成功','admin/login/login');
        }*/

   }




}
