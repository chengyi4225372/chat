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
//               $this->ajax('400','添加失败！');
                return json_encode();
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


   public function excel_array($filenames){
       require_once   ROOT.'/Extend/excel/PHPExcel/IOFactory.php';
       //加载excel文件
       $filename = $filenames;
       $objPHPExcelReader = PHPExcel_IOFactory::load($filename);
       $sheet = $objPHPExcelReader->getSheet(0);        // 读取第一个工作表(编号从 0 开始)
       $highestRow = $sheet->getHighestRow();           // 取得总行数
       $highestColumn = $sheet->getHighestColumn();     // 取得总列数
       $arr = array('A','B','C','D','E','F','G','H','I','J','K','L','M', 'N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
       // 一次读取一列
       $res_arr = array();
       for ($row = 2; $row <= $highestRow; $row++) {
           $row_arr = array();
           for ($column = 0; $arr[$column] != 'F'; $column++) {
               $val = $sheet->getCellByColumnAndRow($column, $row)->getValue();
               $row_arr[] = $val;
           }
           $res_arr[] = $row_arr;
       }
       //return $res_arr;
       var_dump($res_arr);
       exit();
   }

    //phpexcel 导入
    public function Excel_upload(){
          $filenames = $_FILES['file']['name'];
          $type = pathinfo($filenames);
          if($type['extension'] != 'xlsx'){
              $this->ajax('404','上传类型不符合要求！');
          }
         $res = $this->excel_array($filenames);
          var_dump($res);
          exit();
    }
}