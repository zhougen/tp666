<?php

namespace app\common\model;

use think\Model;

class Webset extends Model
{
    protected $pk="webset_id";
    protected $table="webset";

    /**
     * 编辑配置
     */
    public function edit($data){

        $res = $this->validate([
            'webset_value'=>'require',
        ], [
            'webset_value.require'=>'请输入配置内容',
            ])->save($data,[$this->pk=>$data['webset_id']]);

            if($res){
                return ['error'=>1,'msg'=>'编辑成功'];
            }else{
                return ['error'=>0,'msg'=>$this->getError()];
            }

    }
}
