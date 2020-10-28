<?php namespace App\Models;

use App\Models\BaseModel;
use App\Models\PersubModel;
use App\Models\PeraddModel;
use App\Models\BasicModel;

class CommonModel extends BaseModel
{
    function __construct() {
        parent::__construct();
    }

    function getManagerMenu(array $options=array()) {
        $builder = $this->dDB->table('ispt_main.menual');
        $builder->orderBy('mu_pid asc, menu_order asc');
        $rows=$builder->get()->getResultArray();
        $menu=array();
        $firstMenu='';
        foreach($rows as $row) {
            if($row['mu_pid']==0) {
                $menu[$row['pid']]=$row;
            }
            else {
                $menu[$row['mu_pid']]['sub'][]=$row;
                if(!$firstMenu) $firstMenu=$row['menu_url'];
            }
        }
        if($options['per_id'] && $options['mn_pid']) {
            $persub_model = new PersubModel();
            $peradd_model = new PeraddModel();

            $rows=$peradd_model->where('mn_pid', $options['mn_pid'])->findAll();
            if(count($rows)<1) $rows=$persub_model->where('bn_pid', $options['per_id'])->findAll();
            foreach($rows as $row) $pRows[$row['mu_pid']]=array('mb_pid'=>$row['mn_pid'], 'access'=>$row['aa_access']?$row['aa_access']:$row['ba_access'], 'save'=>$row['aa_save']?$row['aa_save']:$row['ba_save'], 'del'=>$row['aa_del']?$row['aa_del']:$row['ba_del'], 'print'=>$row['aa_print']?$row['aa_print']:$row['ba_print'], 'excel'=>$row['aa_excel']?$row['aa_excel']:$row['ba_excel']);
            // debug($pRows, $menu);
            // exit;
            $firstMenu='';
            $managerMenu=array();
            foreach($menu as $main_menu) {
                foreach($main_menu['sub'] as $sub_menu) {
                    $detail_per=$pRows[$sub_menu['pid']];
                    if($detail_per) {
                        if($detail_per['access']!='Y') continue;
                        if(!$firstMenu) $firstMenu=$sub_menu['menu_url'];
                        if(!$managerMenu[$main_menu['pid']]) {
                            unset($main_menu['sub']);
                            $managerMenu[$main_menu['pid']]=$main_menu;
                        }
                        //$managerMenu[$main_menu['pid']]['sub'][]=array('pid'=>$sub_menu['pid'], 'mu_pid'=>$sub_menu['mu_pid'], 'menu_name'=>$sub_menu['menu_name'], 'menu_url'=>$sub_menu['menu_url'], 'access'=>$detail_per['aa_access']?$detail_per['aa_access']:$detail_per['ba_access'], 'save'=>$detail_per['aa_save']?$detail_per['aa_save']:$detail_per['ba_save'], 'del'=>$detail_per['aa_del']?$detail_per['aa_del']:$detail_per['ba_del'], 'print'=>$detail_per['aa_print']?$detail_per['aa_print']:$detail_per['ba_print'], 'excel'=>$detail_per['aa_excel']?$detail_per['aa_excel']:$detail_per['ba_excel']);
                        $managerMenu[$main_menu['pid']]['sub'][]=array('pid'=>$sub_menu['pid'], 'mu_pid'=>$sub_menu['mu_pid'], 'menu_name'=>$sub_menu['menu_name'], 'menu_url'=>$sub_menu['menu_url'], 'access'=>$detail_per['access'], 'save'=>$detail_per['save'], 'del'=>$detail_per['del'], 'print'=>$detail_per['print'], 'excel'=>$detail_per['excel']);
                    }
                }
            }
        }
        else $managerMenu = $menu;
        return array('menu'=>$managerMenu, 'first_menu'=>$firstMenu);
    }

    function getCodeData($options=array()) {
        $builder = $this->dDB->table('tb_code');
        if($options['select']) $builder->select($options['select'], false);
        if($options['where']) $builder->where($options['where']);
        if($options['p_cd_code']) $builder->where('p_cd_pid=(SELECT cd_pid FROM tb_code WHERE cd_code='.$this->dDB->escape($options['p_cd_code']).')', null, false);
        $builder->orderBy('cd_order asc, cd_code asc');
        $rows=$builder->get()->getResultArray();
        $result=array();
        if($options['returnType']=='code') {
            foreach($rows as $row) $result[$row['cd_code']]=$row;
        }
        else if($options['returnType']=='pid') {
            foreach($rows as $row) $result[$row['cd_pid']]=$row;
        }
        else $result=$rows;
        return $result;
    }

    function UpdateCodeData($params, $upWhere) {
        $upData=array('up_id'=>$params['mn_pid'], 'up_date'=>date('Y-m-d'));
        if($params['cd_name']) $upData['cd_name']=$params['cd_name'];
        if($params['cd_use']) $upData['cd_use']=$params['cd_use'];
        if($params['cd_order']) $upData['cd_order']=$params['cd_order'];
        
        $builder = $this->dDB->table('tb_code');
        $builder->update($upData, $upWhere);
    }

    function InsertCodeData($params) {
        $maxCodeRows=$this->getCodeData(array('where'=>array('p_cd_pid'=>$params['p_cd_pid']), 'select'=>'max(cd_code) as max_code' ));
        if($maxCodeRows[0]) $new_code=getSerial($maxCodeRows[0]['max_code']+1, 3);
        else $new_code='001';

        $maxOrderRows=$this->getCodeData(array('where'=>array('p_cd_pid'=>$params['p_cd_pid']), 'select'=>'max(cd_order) as max_order' ));
        if($maxOrderRows[0]) $new_order=$maxOrderRows[0]['max_order']+1;
        else $new_order=1;

        $regData=array('p_cd_pid'=>$params['p_cd_pid'], 'cd_name'=>$params['cd_name'], 'cd_code'=>$new_code, 'cd_use'=>$params['cd_use'], 'cd_order'=>$new_order, 'reg_id'=>$params['mn_pid'], 'reg_date'=>date('Y-m-d'));
        $builder = $this->dDB->table('tb_code');
        $builder->insert($regData);
    }

    // 직원코드 생성
    function makeMnNo() {
        $fix_code='ST';
        $builder = $this->dDB->table('tb_manager');
        $builder->selectMax('mn_no', 'max_no');
        $row=$builder->get()->getRowArray();
        if(!$row['max_no']) $new_no=$fix_code.getSerial(1, 6);
        else {
            $now_no=intval(str_replace($fix_code, '', $row['max_no']));
            $new_no=$fix_code.getSerial($now_no+1, 6);
        }
        return $new_no;
    }

    // 거래처코드 생성
    function makeCtCode() {
        $fix_code='CL';
        $builder = $this->dDB->table('tb_customer');
        $builder->selectMax('ct_code', 'max_no');
        $row=$builder->get()->getRowArray();
        if(!$row['max_no']) $new_no=$fix_code.getSerial(1, 6);
        else {
            $now_no=intval(str_replace($fix_code, '', $row['max_no']));
            $new_no=$fix_code.getSerial($now_no+1, 6);
        }
        return $new_no;
    }
    
}