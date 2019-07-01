<?php
namespace MyClass;
class Goods extends \MyClass\Common{
	public function Index(){
		$c = $this->m('hqy_protuct')->count();
		$p = e('Page',$c,50);
		$list = $this->m('hqy_protuct a')->field("a.*,b.title as btitle")->join('hqy_protuct_cate b on b.id = a.cates_id')->order('create_time desc')->limit($p->firstRow.','.$p->listRows)->select();
		foreach($list as $k =>$val){
		      $list[$k]['protuct_time'] = explode(' - ',$val['protuct_time']);
              $list[$k]['protuct_time']['0']= strtotime($list[$k]['protuct_time']['0']);
              $list[$k]['protuct_time']['1']= strtotime($list[$k]['protuct_time']['1']);
        }
		//halt($list);
		$this->s('list',$list)->s('page',$p->show())->v();
	}

	public function add(){
	    $cates = $this->m('hqy_protuct_cate')->order('id asc')->select();
	    $this->s('cates',$cates)->v();
    }

	public function Edit(){
		$info = $this->m('hqy_protuct')->find($_GET['id']);
        $cates = $this->m('hqy_protuct_cate')->order('id asc')->select();
		$this->s('info',$info)->s('cates',$cates)->v();
	}

	//编辑提交
	public function EditDo(){
         $id =$_POST['id'];
         $data['title']=$_POST['title'];
         $data['cates_id']=$_POST['cates_id'];
         $data['info']=$_POST['info'];
         $data['money']=$_POST['money'];
         $data['person']=$_POST['person'];
         $data['tel']=$_POST['tel'];
         $data['paytype']=$_POST['paytype'];
         $data['protuct_time']=$_POST['protuct_time'];
         if(empty($id)){
             $data['create_time']= time();
             $data['order_num'] = uniqid(date('ymd').mt_rand(1000,9999));
             $res = $this->m('hqy_protuct')->add($data);
             if($res){
                 $this->ajax('200','添加成功！');
             }else {
                 $this->ajax('400','添加失败！');
             }
         }else{
             $res = $this->m('hqy_protuct')->where('id ='.$id)->save($data);
             if($res){
                 $this->ajax('200','编辑成功!');
             }else {
                 $this->ajax('400','编辑失败！');
             }
         }

	}

	//项目详情
    public function Infos(){
	    $id  = $_GET['id'];
	    $infos = $this->m('hqy_protuct a')->field('a.*,b.title as btitle,b.id')->join('hqy_protuct_cate b on a.cates_id = b.id')->where('a.id = '.$id)->find();
	    $this->s('infos',$infos)->v();
    }

	public function Del_goods_order(){
         $id = $_GET['id'];
         $res = $this->m('hqy_protuct')->where('id ='.$id)->del();
         if($res){
              $this->ajax('200','删除成功！');
         }else{
             $this->ajax('400','删除失败！');
         }
    }

	/*
	public function OkPay(){
		$w['id'] = $_POST['id'];
		$data['pay']  = 1;
		$this->m('h_goods')->where($w)->save($data);
	}
	
	public function Ongoing(){
		$c = $this->m('h_goods')->count();
		$p = e('Page',$c,50);
		$list = $this->m('h_goods')->where('`show` > 0')->limit($p->firstRow.','.$p->listRows)->select();
		$this->s('list',$list)->s('page',$p->show())->v("Goods/Index");
	}
	*/

   //类型
	public function cates(){
        $p = e('Page',$this->m('hqy_protuct_cate')->count(),50);
        $list = $this->m('hqy_protuct_cate')->limit($p->firstRow.','.$p->listRows)->select();
        $this->s('list',$list)->s('page',$p->show())->v();
    }

    public  function cates_add(){
	    $this->v();
    }

    public function cates_edit(){
	    $id = $_GET['id'];
	    $info= $this->m('hqy_protuct_cate')->where('id ='.$id)->find();
	    $this->s('info',$info)->v();
    }

    public function Cates_edit_do(){
        $id  = $_POST['id'];
        $data['title']=$_POST['title'];
        if(empty($id)){
            $data['create_time']=time();
            $result=$this->m('hqy_protuct_cate')->add($data);
            if($result){
                $this->ajax('200','添加成功！');
          }else{
                $this->ajax('400','添加失败!');
            }
        }else{
           $result= $this->m('hqy_protuct_cate')->where('id = '.$id)->save($data);
           if($result){
               $this->ajax('200','编辑成功！');
           }else{
               $this->ajax('400','编辑失败！');
           }
        }
    }

    public function cates_del(){
       $id = $_POST['id'];
       $cates = $this->m('hqy_protuct')->where('cates_id ='.$id)->find();
       if($cates){
           $this->ajax('404','类型存在关联数据，不能删除！');
       }
       $res = $this->m('hqy_protuct_cate')->del($id);
       if($res){
           $this->ajax('200','删除成功！');
       }else{
           $this->ajax('400','删除失败！');
       }
    }

}