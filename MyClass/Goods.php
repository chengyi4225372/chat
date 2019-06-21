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
	    $this->v();
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


	public function cates(){
	    $this->v();
    }

    public  function cates_add(){
	    $this->v();
    }

    public function cates_edit(){
	    $this->v();
    }

    public function cates_edit_do(){

    }

    public function cates_del(){

    }
}