<?php

namespace app\index\controller;


class Index extends Common
{
    public function index(){

        $headConfig = ['title'=>'周庚博客-首页'];
        $this->assign('headConfig',$headConfig);

        $articleData = db('article')->alias('a')->order('sendtime desc')->join('__CATE__ c','a.cate_id = c.cate_id')->select();

        foreach ($articleData as $k=>$v){
            $articleData[$k]['tags']=db('arc_tag')->alias('at')->join('__TAG__ t','at.tag_id = t.tag_id')->where('arc_id',$v['arc_id'])->field('t.tag_id,t.tag_name')->select();

        }

        $this->assign('articleData',$articleData);
        return $this->fetch();
    }
}
