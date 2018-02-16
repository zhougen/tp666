<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        //读取网站配置
        $webset = $this->websetload();
        $this->assign('webset',$webset);
        //读取顶级栏目
        $cateData = $this->loadCateData();
        $this->assign('cateData',$cateData);
        //读取全部栏目数据
        $allcateData = $this->loadAllCateData();
        $this->assign('allcateData',$allcateData);
        //读取标签栏目数据
        $tagData = $this->loadtag();
        $this->assign('tagData',$tagData);
        //读取友情链接
        $linkData = $this->loadLink();
        $this->assign('linkData',$linkData);
        //读取文章信息
        $article = $this->loadArticle();
        $this->assign('article',$article);

    }

    /**
     * 读取文章信息
     */
    public function loadArticle(){

        return db('article')->order('sendtime desc')->limit(2)->field('arc_title,arc_id,sendtime')->select();


    }

    /**
     * 读取友情链接
     */
    public function loadLink(){

        return db('link')->order('link_sort desc')->select();

    }

    /**
     * 读取全部标签数据
     */
    public function loadtag(){

        return db('tag')->order('tag_id desc')->select();
    }

    /**
     * 读取全部栏目数据
     */
    public function loadAllCateData(){

        return db('cate')->order('cate_sort desc')->select();
    }


    /**
     * @return 读取网站配置
     */
    public function websetload(){
        return db('webset')->column('webset_name,webset_value');

    }

    /**
     * 读取顶级栏目
     */
    public function loadCateData(){

        return db('cate')->where('cate_pid',0)->order('cate_sort desc')->limit(5)->select();
    }




}
