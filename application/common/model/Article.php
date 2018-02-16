<?php

namespace app\common\model;

use think\Model;

class Article extends Model
{
    protected $pk     = 'arc_id';
    protected $table  = 'article';
    protected $auto   = [ 'admin_id' ];
    protected $insert = [ 'sendtime' ];
    protected $update = [ 'updatetime' ];

    protected function setAdminIdAttr ( $value )
    {
        return session( 'admin.admin_id' );
    }

    protected function setSendTimeAttr ( $value )
    {
        return time();
    }

    protected function setUpdateTimeAttr ( $value )
    {
        return time();
    }

    /**
     * 获取文章首页数据
     */
    public function getAll ($is_recycle)
    {
        return db( 'article' )->alias( 'a' )->join( '__CATE__ c' , 'a.cate_id=c.cate_id' )->where( 'a.arc_recycle' , $is_recycle )->field( 'a.arc_id,a.arc_title,a.arc_author,a.sendtime,c.cate_name,a.arc_sort' )->order( 'a.arc_sort desc,a.sendtime desc,a.arc_id desc' )->paginate( 2 );

    }

    /**
     *
     * 添加文章
     */
    public function store($data){

        if(!isset($data['tag_id'])){
            return ['error'=>0,'msg'=>'请填加标签'];
        }

        $result = $this->validate(true)->allowField(true)->save($data);
        if($result){

            foreach ($data['tag_id'] as $v) {
                $arcTagData = [
                    'arc_id' => $this->arc_id ,
                    'tag_id' => $v ,
                ];
                ( new arcTag() )->save( $arcTagData );
            }


            return ['error'=>1,'msg'=>'添加成功'];
        }else{
            return ['error'=>0,'msg'=>$this->getError()];
        }

    }


    /**
     *ajax修改排序
     */
    public function changesort($data){

        $result = $this->validate(
          [
              'arc_sort'=>'require|between:1,9999',
          ],
          [
              'arc_sort.require'=>'文章排序不能为空',
              'arc_sort.between'=>'文章排序必须是1-9999之间'
          ]
        )->save($data,[ $this->pk=>$data['arc_id'] ]);

        if($result){

            return ['error'=>1,'msg'=>'修改成功'];
        }else{
            return ['error'=>0,'msg'=>$this->getError()];
        }


    }


    /**
     * 编辑文章
     */
    public function edit($data){
        $result = $this->validate(true)->allowField(true)->save($data,[$this->pk=>$data['arc_id']]);
        if($result){
            //修改标签
            //1.删除原有的标签
            (new arcTag())->where('arc_id',$data['arc_id'])->delete();
            //2.增加新标签
            foreach ($data['tag_id'] as $v) {
                $arcTagData = [
                    'arc_id' => $this->arc_id ,
                    'tag_id' => $v ,
                ];
                ( new arcTag() )->save( $arcTagData );
            }



            return ['error'=>1,'msg'=>'修改成功'];
        }else{
            return ['error'=>0,'msg'=>$this->getError()];
        }

    }


    /**
     * @param 删除文章
     */
    public function del($arc_id){
        if(Article::destroy($arc_id)){

            return ['error'=>1,'msg'=>'删除成功'];
        }else{

            return ['error'=>0,'msg'=>'删除失败'];
        }
    }





}
