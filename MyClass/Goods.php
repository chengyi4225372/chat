<?php
namespace MyClass;
class Goods extends \MyClass\Common{
	public function Index(){
		$c = $this->m('h_protuct')->count();
		$p = e('Page',$c,50);
		$list = $this->m('h_protuct')->order('create_time desc')->limit($p->firstRow.','.$p->listRows)->select();
		$this->s('list',$list)->s('page',$p->show())->v();
	}

	public function add(){
	     $this->v();
    }

	public function Edit(){
		$info = $this->m('h_protuct')->find($_GET['id']);
		$this->s('info',$info)->v();
	}

	//编辑提交
	public function EditDo(){
         $id =$_POST['id'];
         $data['title']=$_POST['title'];
         $data['cates']=$_POST['cates'];
         $data['info']=$_POST['info'];
         $data['money']=$_POST['money'];
         $data['person']=$_POST['person'];
         $data['tel']=$_POST['tel'];
         $data['paytype']=$_POST['paytype'];
         $data['protuct_time']=$_POST['protuct_time'];
         $data['status'] = $_POST['status'];
         if(empty($id)){
             $data['create_time']= time();
             $data['order_num'] = uniqid(date('ymd').mt_rand(1000,9999));
             $res = $this->m('h_protuct')->add($data);
             if($res){
                 $this->ajax('200','添加成功！');
             }else {
                 $this->ajax('400','添加失败！');
             }
         }else{
             $res = $this->m('h_protuct')->where('id ='.$id)->save($data);
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
	    $infos = $this->m('h_protuct')->where('id = '.$id)->find();
	    $this->s('infos',$infos)->v();
    }

    // todo 暂时未使用 伪删除
	public function Del_goods_order(){
         $id = $_GET['id'];
         $res = $this->m('h_protuct')->where('id ='.$id)->del();
         if($res){
              $this->ajax('200','删除成功！');
         }else{
             $this->ajax('400','删除失败！');
         }
    }

}