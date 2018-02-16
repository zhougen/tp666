<?php

namespace app\admin\controller;

use think\Controller;

class Webset extends Controller
{

    /**
     * @return 配置首页
     */
    public function index(){
        $data = db('webset')->select();
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 编辑友链
     */
    public function edit(){

        $result = (new \app\common\model\Webset())->edit(input('post.'));

        if($result['error']){

            $this->success($result['msg'],'index');

        }else{
            $this->error($result['msg']);
        }
    }




}
