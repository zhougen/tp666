<?php

namespace app\index\controller;


use app\common\model\category;

class Lists extends Common
{
    /**
     * 首页
     */
    public function index(){

        $headConfig = ['title'=>'周庚博客-分类页'];
        $this->assign('headConfig',$headConfig);
//获取左侧第一部分数据
        $cate_id = input('param.cate_id');
        $tag_id = input('param.tag_id');
        if($cate_id)
        {
            //当前分类所有子集分类id
            $cids = (new category())->getSon(db('cate')->select(),$cate_id);
            $cids[] = $cate_id;//把自己追加进去
            $headData = [
                'title'=>'分类',
                'name'=>db('cate')->where('cate_id',$cate_id)->value('cate_name'),
                'total'=>db('article')->whereIn('cate_id',$cids)->where('arc_recycle',1)->count(),
            ];
            //获取文章数据
            $articleData = db('article')->alias('a')
                ->join('__CATE__ c','a.cate_id=c.cate_id')->where('a.arc_recycle',1)->whereIn('a.cate_id',$cids)->select();
        }



        if($tag_id)
        {
            $headData = [
                'title'=>'标签',
                'name'=>db('tag')->where('tag_id',$tag_id)->value('tag_name'),
                'total'=>db('arc_tag')->alias('a')->join('__ARTICLE__ c','a.arc_id = c.arc_id')->where(['a.tag_id'=>$tag_id,'c.arc_recycle'=>1])->count(),
            ];
            //获取文章数据
            $articleData = db('article')->alias('a')
                ->join('__ARC_TAG__ at','a.arc_id=at.arc_id')
                ->join('__CATE__ c','a.cate_id=c.cate_id')
                ->where('a.arc_recycle',1)->where("at.tag_id",$tag_id)->select();

        }
        foreach($articleData as $k=>$v)
        {
            $articleData[$k]['tags'] = db('arc_tag')->alias('at')
                ->join('__TAG__ t','at.tag_id=t.tag_id')
                ->where('at.arc_id',$v['arc_id'])->field('t.tag_id,t.tag_name')->select();
        }
        $this->assign('headData',$headData);
        $this->assign('articleData',$articleData);

    




        return $this->fetch();
    }
}
