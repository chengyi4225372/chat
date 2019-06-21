<?php
namespace MyClass;
class Member extends \MyClass\Common
{
    public function Index()
    {
        $p = e('Page',$this->m('hqy_member')->count(),50);
        $list = $this->m('hqy_member')->limit($p->firstRow.','.$p->listRows)->select();
        $this->s('list',$list)->s('page',$p->show())->v();
    }

    public function Edit(){
        $info =$this-> m('hqy_member')->find($_GET['id']);
        $this->s('info',$info)->v();
    }

    public function add(){
         $this->v();
    }

    public function Edit_do(){
        $id = $_POST['id'];
        $data['names']=$_POST['names'];
        $data['shen']=$_POST['shen'];
        $data['tel']=$_POST['tel'];
        $data['cates']=trim($_POST['cates']);
        $data['remark']=trim($_POST['remark']);
        if(!empty($id)){
            $result = $this->m('hqy_member')->where('id ='.$id)->save($data);
            if($result){
                echo json_encode(array('code'=>200,'msg'=>'修改成功！'));
                exit();
            }else{
                echo json_encode(array('code'=>400,'msg'=>'修改失败！'));
                exit();
            }
        }else{
            $data['create_time']=time();
            $result = $this->m('hqy_member')->add($data);
            if($result){
                echo json_encode(array('code'=>200,'msg'=>'添加成功！'));
                exit();
            }else{
                echo json_encode(array('code'=>400,'msg'=>'添加失败！'));
                exit();
            }
        }
    }

}