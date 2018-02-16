<?php

namespace app\common\model;
use houdunwang\crypt\Crypt;
use think\Loader;
use think\Model;
use think\Validate;

class Admin extends Model
{

	protected $pk = 'admin_id';
   // 设置当前模型对应的完整数据表名称
   protected $table = 'admin';

   /**
    * [login 登陆]
    * @param  [type] $data [description]
    * @return [type]       [description]
    */
   public function login($data)
   {
   	
      //1.验证数据

      $validate = Loader::validate('Admin');
         if(!$validate->check($data)){

          return ['error'=>0,'msg'=>$validate->getError()];
             // dump($validate->getError());
         }

      //2.对比用户名和密码是否正确
      
        $userinfo = $this->where('admin_name',$data['admin_name'])->where('admin_password',Crypt::encrypt($data['admin_password']))->find();
        // echo $this->getlastsql();
        // dump($userinfo);die;
        if(!$userinfo){
          return ['error'=>0,'msg'=>'管理员帐号或者密码不正确'];
        }


      //3.把数据保存session

        session('admin.admin_id',$userinfo['admin_id']);
        session('admin.admin_name',$userinfo['admin_name']);

        return ['error'=>1,'msg'=>'登录成功！'];




   }


   /*
    * 修改密码
    * */
   public function pass($data){
    //1.执行验证
       $validate = new Validate([
           'admin_password'  => 'require',
           'new_password' => 'require',
           'confirm_password' => 'require|confirm:new_password',
       ],[
           'admin_password.require'  => '请输入原始密码',
           'new_password.require'  => '请输入新密码',
           'confirm_password.require'  => '请输入确认密码',
           'confirm_password.confirm'  => '确认密码与新密码不一致',
       ]);
       if (!$validate->check($data)) {
           return ['error'=>1,'msg'=>$validate->getError()];
       };
    //2.判断原始密码是否正确

       $userinfo = $this->where('admin_id',session('admin.admin_id'))->where('admin_password',Crypt::encrypt($data['admin_password']))->find();

       if(!$userinfo){
           return ['error'=>1,'msg'=>'原始密码不正确'];
       }

    //3.修改密码
      $res = $this->save([
           'admin_password'  => Crypt::encrypt($data['new_password']),
       ],['admin_id' => session('admin.admin_id')]);
       if($res){
           return ['error'=>0,'msg'=>'密码修改成功'];
       }else{
           return ['error'=>1,'msg'=>'密码修改失败'];
       }

   }










}
