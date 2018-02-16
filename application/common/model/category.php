<?php

namespace app\common\model;

use houdunwang\arr\Arr;
use think\Model;

class category extends Model
{
    protected $pk = 'cate_id';
    protected $table = 'cate';

    /*
     * 添加栏目
     *
     * */
    public function add($data){
        $result = $this->validate(true)->save($data);
        if(false === $result){
            // 验证失败 输出错误信息
            return ['error'=>1,'msg'=>$this->getError()];
        }else{
            return ['error'=>0,'msg'=>'添加成功'];

        }

    }


    /**
     * 查询栏目（数组结构显示）
     */
    public function getAll(){
        $res = Arr::tree(db('cate')->order('cate_sort desc')->select(), 'cate_name', $fieldPri = 'cate_id', $fieldPid = 'cate_pid');

        return $res;

    }

    /**
     * 获取栏目
     */
    public function getCateData($cate_id){
        //1.首先找到所有子集
        $data = $this->getSon(db('cate')->select(),$cate_id);

        //2.再把自己追加进去
        $data[] = $cate_id;

        //3.找到他们之外的数据
        $field = db('cate')->whereNotIn('cate_id',$data)->select();
        return Arr::tree($field,'cate_name','cate_id','cate_pid');


    }

    /**
     * @param $cateSon
     * 查找所有子集
     */
    public function getSon($data,$cate_id){
        static $temp = [];
        foreach ($data as $k=>$v){

            if($cate_id == $v['cate_pid'])
            {
                $temp[] = $v['cate_id'];
                $this->getSon($data,$v['cate_id']);

            }
        }

        return $temp;


    }


    /**
     * 编辑栏目
     */
    public function edit($data){
       $result = $this->validate(true)->save($data,[$this->pk=>$data['cate_id']]);
       if($result){
           return ['error'=>1,'msg'=>'编辑成功'];
       }else{
           return ['error'=>0,$this->getError()];

       }

    }


    /**
     * 删除栏目
     */
    public function del($cate_id){
        //查询要删除的栏目的父级
        $cate_pid = $this->where('cate_id',$cate_id)->value('cate_pid');
        //修改要删除栏目子级的父级id
        $this->where('cate_pid',$cate_id)->update(['cate_pid'=>$cate_pid]);
        //执行当前数据的删除
        if(category::destroy($cate_id)){
            return ['error'=>1,'msg'=>'删除成功'];
        }else{

            return ['error'=>0,'msg'=>'删除失败'];
        }

    }



}
