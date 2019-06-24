<?php
namespace MyClass;
class Goods extends \MyClass\Common{
	public function Index(){
		$c = $this->m('hqy_protuct')->count();
		$p = e('Page',$c,50);
		$list = $this->m('hqy_protuct')->limit($p->firstRow.','.$p->listRows)->select();
		$this->s('list',$list)->s('page',$p->show())->v('Goods/Index');
	}


	public function add(){
	    $cates = $this->m('hqy_protuct_cate')->order('id asc')->select();
	    $this->s('cates',$cates)->v();
    }



	public function Edit(){
		$info = $this->m('hqy_protuct')->find($_GET['id']);
		$this->s('info',$info)->v();
	}

	//编辑提交
	public function EditDo(){

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
                $this->success('新增成功！',t('Goods/Cates'));
          }else{
                $this->error('添加失败！',t('Goods/Cates'));
            }
        }else{
           $result= $this->m('hqy_protuct_cate')->where('id = '.$id)->save($data);
           if($result){
               $this->success('编辑成功！',t('Goods/Cates'));
           }else{
               $this->error('编辑失败！',t('Goods/Cates'));
           }
        }
    }

    public function cates_del(){
       $id = $_GET['id'];
       $cates = $this->m('hqy_protuct')->where('cate_id ='.$id)->find();
       if($cates){
           $this->error('类型存在关联数据，不能删除！',t('Goods/Cates'));
       }
       $res = $this->m('hqy_protuct_cate')->del($id);
       if($res){
           $this->success('删除成功！',t('Goods/Cates'));
       }else{
           $this->error('删除失败！',t('Goods/Cates_edit'));
       }
    }
}