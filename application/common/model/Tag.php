<?php

namespace app\common\model;

use think\Model;

class Tag extends Model
{
    protected $pk = "tag_id";
    protected $table = "tag";

    public function add($data){


        $result = $this->validate(true)->save($data,$data['tag_id']);

        if($result){
            return ['error'=>1,'msg'=>'操作成功'];
        }else{
            return ['error'=>0,'msg'=>$this->getError()];
        }


    }



}
