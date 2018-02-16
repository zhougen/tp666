<?php

namespace app\index\controller;


class Content extends Common
{
    /**
     * 首页
     */
    public function index(){
        $arc_id = input('param.arc_id');
        //文章点击数
        db('article')->where('arc_id',$arc_id)->setInc('arc_cilck');



        //查询文章内容
        $arcData = db('article')->where('arc_id',$arc_id)->find();
        $headConfig = ['title'=>'周庚博客-'.$arcData['arc_title']];
        $arcData['tags']=db('arc_tag')->alias('at')->join('__TAG__ t','at.tag_id=t.tag_id')->where(['at.arc_id'=>$arc_id])->field('t.tag_id,t.tag_name')->select();



        $this->assign('headConfig',$headConfig);
        $this->assign('arcData',$arcData);
        return $this->fetch();
    }
}
