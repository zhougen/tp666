<?php

namespace app\common\model;

use think\Model;

class Link extends Model
{
    protected $pk = 'link_id';
    protected $table = 'link';

    /**
     * 获取所有数据
     */
    public function getAll(){
         return $this->order('link_sort desc,link_id desc')->paginate(10);


    }


    /**
     * 添加友链
     */
    public function add($data){

        $result = $this->validate(true)->save($data,[ $this->pk=>$data['link_id'] ]);
        if($result){
            return ['error'=>1,'msg'=>'添加成功'];
        }else{

            return ['error'=>0,'msg'=>$this->getError()];
        }
    }

    /**
     * 删除友情链接
     */
    public function del($link_id){

        if(Link::destroy($link_id)){

            return ['error'=>1,'msg'=>'删除成功'];
        }else{

            return ['error'=>0,'msg'=>'删除失败'];
        }
    }






}
