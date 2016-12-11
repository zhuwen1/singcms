<?php
namespace Home\Controller;
use Think\Controller;
use Think\Exception;

class IndexController extends CommonController {
    public function index(){
		//获取排行
		$rankNews    = $this->getRank();
    	//首页大图数
  	   $topPicNews   = D('PositionContent')->select(array('status'=>1,'position'=>2),1);
  	   // print_r($topPicNews);
  	   //首页三小图推荐
  	   $topSmallNews = D('PositionContent')->select(array('status'=>1,'position'=>3),3);
       //新闻推荐
       $listNews     = D('News')->select(array('status'=>1,'thumb'=>array('neq','')),30);
       //广告位置推荐
       $adNews       = D('PositionContent')->select(array('status'=>1,'position'=>5),3);
       $this->assign('result',array(
    	  'topPicNews'    => $topPicNews,
       	  'topSmallNews'  => $topSmallNews,
       	  'listNews'      => $listNews,
          'adNews'        => $adNews,
		  'rankNews'      => $rankNews,
		  'catId'         => 0,
	   	));

       $this->display();
	}
	
}