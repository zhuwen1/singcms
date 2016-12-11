<?php
namespace Home\Controller;
use Think\Controller;
class DetailController extends CommonController{
    public function index(){
        $id = intval($_GET['id']);
        if(!$id || $id<0){
            return $this->error("id不合法");
        }
        $news = D('News')->find($id);
        if(!news || $news['status'] != 1){
            return $this->error('ib不存在或者不合法');
        }
        
        $count = intval($new['count']) + 1;
        D('News')->updateCount($id,$count);

        $content  = D('NewsContent')->find($id);
        $news['content'] = htmlspecialchars_decode($content['content']);
        $advNews  = D('PositionContent')->select(array('status'=>1,'postition_id'=>5),2);
        $rankNews = $this->getRank();
        $this->assign('result',array(
        'rankNews' => $rankNews,
        'advNews'  => $advNews,
        'catId'    => $id,
        'news'     => $news,
        ));
        // print_r($news);
        $this->display("Detail/index");
    }

}