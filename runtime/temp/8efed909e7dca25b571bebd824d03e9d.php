<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:67:"E:\web\WWW\blog\public/../application/index\view\content\index.html";i:1501123486;s:58:"E:\web\WWW\blog\public/../application/index\view\base.html";i:1501075645;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?php echo $headConfig['title']; ?></title>
    <!--描述和摘要-->
    <meta name="Description" content=""/>
    <meta name="Keywords" content=""/>
    <!--载入公共模板-->
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/org/bootstrap-3.3.5-dist/css/bootstrap.min.css" />
    <script src="__STATIC__/index/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__STATIC__/index/org/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/css/index.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/css/backTop.css"/>
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1><?php echo $webset['title']; ?></h1>
            </div>
        </div>
    </div>
</header>
<nav role="navigation" class="navbar navbar-default">
    <div class="container">
        <div class="row">
            <div class="col-sm-12" >

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">

                        <span class="sr-only">切换导航</span>

                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>


                <div class="collapse navbar-collapse" id="example-navbar-collapse">
                    <ul class="_menu" >
                        <li <?php if(!input('param.')): ?> class="_active" <?php endif; ?>><a href="__ROOT__/index.html">首页</a></li>
                        <?php if(is_array($cateData) || $cateData instanceof \think\Collection || $cateData instanceof \think\Paginator): if( count($cateData)==0 ) : echo "" ;else: foreach($cateData as $key=>$vo): ?>
                        <li <?php if(input('param.cate_id')==$vo['cate_id']): ?> class="_active" <?php endif; ?>><a  href="<?php echo url('index/lists/index',['cate_id'=>$vo['cate_id']]); ?>"><?php echo $vo['cate_name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>




<section>
    <div class="container">
        <div class="row">
            <!--标签规定文档的主要内容main-->
            <main class="col-md-8">

                
<article>
    <div class="_head">
        <h1><?php echo $arcData['arc_title']; ?></h1>
        <span>
								作者：
								<a href=""><?php echo $arcData['arc_author']; ?></a>
								</span>
        •
        <!--pubdate表⽰示发布⽇日期-->
        <time pubdate="pubdate" datetime="2015年8月31日星期一晚上9点44"><?php echo date('Y年m月d日',$arcData['sendtime']); ?></time>
    </div>
    <div class="_digest">
        <p>
            <?php echo $arcData['arc_content']; ?>
        </p>
    </div>
    <div class="_footer">
        <i class="glyphicon glyphicon-tags"></i>
        <?php if(is_array($arcData['tags']) || $arcData['tags'] instanceof \think\Collection || $arcData['tags'] instanceof \think\Paginator): if( count($arcData['tags'])==0 ) : echo "" ;else: foreach($arcData['tags'] as $key=>$v): ?>
        <a href="<?php echo url('index/lists/index',['tag_id'=>$v['tag_id']]); ?>"><?php echo $v['tag_name']; ?></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>

    </div>
</article>


            </main>


            <aside class="col-md-4 hidden-sm hidden-xs">
                <div class="_widget">
                    <h4>关于后盾</h4>
                    <div class="_info">
                        <p>最认真的PHP培训机构 只讲真功夫的PHP培训机构 最火爆的IT课程</p>
                        <p>
                            <i class="glyphicon glyphicon-volume-down"></i>
                            <a href="http://www.houdunwang.com" target="_blank">北京后盾网</a>
                        </p>
                    </div>
                </div>
                <div class="_widget">
                    <h4>分类列表</h4>
                    <div>

                        <?php if(is_array($allcateData) || $allcateData instanceof \think\Collection || $allcateData instanceof \think\Paginator): if( count($allcateData)==0 ) : echo "" ;else: foreach($allcateData as $key=>$vo): ?>
                        <a href=""><?php echo $vo['cate_name']; ?></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <div class="_widget">
                    <h4>标签云</h4>
                    <div class="_tag">
                        <?php if(is_array($tagData) || $tagData instanceof \think\Collection || $tagData instanceof \think\Paginator): if( count($tagData)==0 ) : echo "" ;else: foreach($tagData as $key=>$vo): ?>
                        <a href=""><?php echo $vo['tag_name']; ?></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </div>
                </div>

            </aside>
        </div>
    </div>
</section>



<footer class="hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="_title">最新文章</h4>

                <?php if(is_array($article) || $article instanceof \think\Collection || $article instanceof \think\Paginator): if( count($article)==0 ) : echo "" ;else: foreach($article as $key=>$vo): ?>
                <div id="" class="_single">
                    <p><a href=""><?php echo $vo['arc_title']; ?></a></p>
                    <time><?php echo date('Y年m月d日',$vo['sendtime']); ?></time>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
            <div class="col-sm-4 footer_tag">
                <div id="">
                    <h4 class="_title">标签云</h4>
                    <?php if(is_array($tagData) || $tagData instanceof \think\Collection || $tagData instanceof \think\Paginator): if( count($tagData)==0 ) : echo "" ;else: foreach($tagData as $key=>$vo): ?>
                    <a href=""><?php echo $vo['tag_name']; ?></a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </div>
            </div>
            <div class="col-sm-4">
                <h4 class="_title">友情链接</h4>
                <div id="" class="_single">
                    <?php if(is_array($linkData) || $linkData instanceof \think\Collection || $linkData instanceof \think\Paginator): if( count($linkData)==0 ) : echo "" ;else: foreach($linkData as $key=>$vo): ?>
                    <p><a href="<?php echo $vo['link_url']; ?>" target="_blank"><?php echo $vo['link_name']; ?></a></p>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </div>
            </div>
        </div>
    </div>
</footer>
<div class="footer_bottom">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a href=""><?php echo $webset['title']; ?></a>
                |
                <a href=""><?php echo $webset['compay']; ?></a>
                |
                <a href=""><?php echo $webset['eamil']; ?></a>
            </div>
        </div>
    </div>
</div>
<!--返回顶部自己写的插件-->
<script src="__STATIC__/index/js/backTop.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(function(){
        //插件使用
        $('.back_top').backTop({right:30});
    })
</script>
<div class="back_top hidden-xs hidden-md">
    <i class="glyphicon glyphicon-menu-up"></i>
</div>
</body>
</html>