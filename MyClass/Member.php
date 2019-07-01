<?php
namespace MyClass;
use Extend\excel;
class Member extends \MyClass\Common
{
    protected  $root ='Chinax3';

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
                $this->ajax('200','修改成功!');
            }else{
                $this->ajax('400','修改失败!');
            }
        }else{
            $data['create_time']=time();
            $result = $this->m('hqy_member')->add($data);
            if($result){
                $this->ajax('200','添加成功!');
            }else{
              $this->ajax('400','添加失败！');
            }
        }
    }

    public function Del(){
        $id = $_POST['id'];
        $result = $this->m('hqy_member')->where('id ='.$id)->del();
        if($result){
            $this->ajax('200','删除成功!');
        }else{
            $this->ajax('400','删除失败!');
        }
    }

    //phpexcel 导入
    public function Excel_upload(){
          $filenames = $_FILES['file']['name'];
          $type = pathinfo($filenames);
          if($type['extension'] != 'xlsx'){
              $this->ajax('404','上传类型不符合要求！');
          }
        //设置文件保存目录 注意包含
        $uploaddir = "./Public/Uploads/" . date("Y-m-d") . '/';
        if (!file_exists($uploaddir)) {
            mkdir($uploaddir, 0777, true);
        }
        $path = $uploaddir . md5(uniqid(rand())) . '.' .$type['extension'] ; //产生随机文件名
        //下面必须是tmp_name 因为是从临时文件夹中移动
        $files_path = file_put_contents($filenames, $path); //写入到制定的文件夹中
        if (!file_exists($files_path)) {
            $this->ajax('401','上传文件丢失');
         }
         $res = $this->excel_array($filenames,$path);
         if($res){
             $this->ajax('200','上传成功!');
         }else{
             $this->ajax('400','上传失败!');
         }
    }

    //导入 模板



}