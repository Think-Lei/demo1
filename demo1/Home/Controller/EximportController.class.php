<?php
/**
 * Created by PhpStorm.
 * User: wenlei
 * Date: 2017/11/7
 * Time: 上午10:14
 */
namespace Home\Controller;
use Think\Controller;
class EximportController extends Controller
{

    public function eximport()
    {
        $this->display();
    }

    //导入
    public function import()
    {
        $upload = new \Think\Upload();
        $upload->maxSize = 3145728;
        $upload->exts = array('xls', 'csv', 'xlsx');
        $upload->rootPath = './Uploads';
        $upload->savePath = '/excel/';
        $info = $upload->upload();

        if (!$info) {
            $this->error($upload->getError());
        } else {

           // print_r($info);
           $filename = './Uploads/' . $info['excel']['savepath'] . $info['excel']['savename'];
            import("Org.Yufan.ExcelReader");
            $ExcelReader = new \ExcelReader();
            $arr = $ExcelReader->reader_excel($filename);

            //print_r("$arr");
            foreach ($arr as $key => $value) {
              //  $data['id'] = $arr[$key]['0'];
                $data['username'] = $arr[$key]['1'];
                $data['password'] = $arr[$key]['2'];
                $data['student_id'] = $arr[$key]['3'];
                if($arr[$key]['0']>10000){
                    $this->error("最多一次导入一万条数据",'eximport');
                }
                M('info')->add($data);
            }
            $this->success('导入成功');
        }
    }

    //导出
    public function export()
    {
        import("ORG.Yufan.Excel");
        $list = M('info')->select();
        //print_r($list);
        $row = array();
        $row[0] = array('序号', '用户名', '密码', '学生账号');
        $i = 1;
        foreach ($list as $v) {
            $row[$i]['id'] = $i;
            $row[$i]['username'] = $v['username'];
            $row[$i]['password'] = $v['password'];
            $row[$i]['student_id'] = $v['student_id'];
            $i++;
        }

        $xls = new \Excel_XML('UTF-8', false, 'datalist');
        $xls->addArray($row);
        $xls->generateXML("shzu");
    }



}