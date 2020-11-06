<?php namespace App\Controllers;

use App\Models\StockModel;
use App\Models\BasicModel;
use App\Models\PurchaseModel;
use App\Models\PermainModel;
use App\Models\PersubModel;
use App\Models\PeraddModel;
use App\Models\PurchaseItemModel;
use App\Models\PurchaseCancelModel;
use App\Models\PcmanageModel;
use App\Models\StockInoutModel;
use App\Models\StockMainModel;
use App\Models\StockMoveModel;
use App\Models\StockCheckModel;
use App\Models\StockCheckItemModel;
use App\Models\StockAdjustModel;
use App\Models\StockPartRequestModel;
use App\Models\StockPartRequestItemModel;
use App\Models\TraderModel;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Stock extends BaseController
{
    function __construct() {
		parent::init();
        $this->stock_model = new StockModel();
		$this->basic_model = new BasicModel();
		$this->permain_model = new PermainModel();
        $this->persub_model = new PersubModel();
        $this->peradd_model = new PeraddModel();
		$this->purchase_model = new PurchaseModel();
		$this->purchase_item_model = new PurchaseItemModel();
		$this->purchase_cancel_model = new PurchaseCancelModel();
		$this->pcmanager_model = new PcmanageModel();
		$this->stock_inout_model = new StockInoutModel();
		$this->stock_main_model = new StockMainModel();
		$this->stock_move_model = new StockMoveModel();
		$this->stock_check_item_model = new StockCheckItemModel();
		$this->stock_adjust_model = new StockAdjustModel();
		$this->stock_check_model = new StockCheckModel();
		$this->stock_part_request_model = new StockPartRequestModel();
		$this->stock_part_request_item_model = new StockPartRequestItemModel();

		$trader_model = new TraderModel();


		$this->io_state = Array("A" => "발주요청","B" => "부분입고","C" => "입고완료","D" => "발주취소");
		$this->si_state = Array("A" => "발주","B" => "반입","C" => "이동","D" => "기타");
		$this->setting['code']['so_state'] = Array("A" => "주문","B" => "이동","C" => "페기","D" => "기타", "E"=>"기사");
		$this->setting['code']['sa_kind'] =  Array("A" => "실사","B" => "불량","C" => "파손","D" => "기타");
		$this->setting['code']['pi_state'] =  Array("A" => "요청","B" => "완료","C" => "취소");


		//창고
        if(!$this->setting['code']['Storage']) $this->setting['code']['Storage'] = $this->common_model->getCodeData(array('p_cd_code'=>'0501', 'returnType'=>'pid'));
		//AS폐기
        if(!$this->setting['code']['ASDis']) $this->setting['code']['ASDis'] = $this->common_model->getCodeData(array('p_cd_code'=>'0319', 'returnType'=>'pid'));
		//직원
		if(!$this->setting['manager']) $this->setting['manager'] = $this->getManagerList();

		// 매입처
        $this->setting['trader'] = $trader_model->where('ct_use', 'Y')->whereIn('ct_kind', array('B', 'C'))->findAll();

    }

	function getManagerList() {
		$options['page'] = 1;
		$options['rcnt'] = 0;
		$rows = $this->basic_model->getManagerList($options);
		foreach($rows as $row) {
			$data[$row['mn_pid']] = $row;
		}

		return $data;
	}

	public function index()
	{
        $link=ManagerDefaultLink($this->session->get('menu'));
		return redirect()->to($link);
    }

	//실행 모듈 모음
	function execute($remode='') {
		if($remode == '') {
			$this->Params = $this->request->getPost();
		}
        if($this->Params['mode'] == 'reg_purchase') {//구매발주 저장
            $RegData=$this->Params;
            $Scripts=array();


            if(!$this->Params['io_pid']) {
				$RegData['reg_id'] = $this->session->get('ss_mn_pid');
                $insert_id=$this->purchase_model->insert($RegData);
			    $io_pid = $insert_id;
				$options["searchNdate"] = date("Y-m-d");
            }
            else {
                unset($RegData['io_pid']);
				$RegData['up_id'] = $this->session->get('ss_mn_pid');
                $this->purchase_model->update($this->Params['io_pid'], $RegData);
				$io_pid = $this->Params['io_pid'];
            }

			if(count($this->Params['pd_pid']) > 0) {
				$total_price = 0;
				for($i=0;$i<count($this->Params['pd_pid']);$i++) {
					if($this->Params['pd_pid'][$i]) {
						$iRegData["oi_kind"] = $this->Params['oi_kind'][$i];
						$iRegData["pd_pid"] = $this->Params['pd_pid'][$i];
						$iRegData["io_pid"] = $io_pid;
						$iRegData["oi_num"] = getSerial(($i+1),7);
						$iRegData["oi_name"] = $this->Params['oi_name'][$i];
						$iRegData["oi_in_price"] = str_replace(",","",$this->Params['oi_in_price'][$i]);
						$iRegData["oi_qea"] = str_replace(",","",$this->Params['oi_qea'][$i]);
						$iRegData["oi_real_in_price"] = str_replace(",","",$this->Params['oi_real_in_price'][$i]);
						$iRegData["oi_re_qea"] = $this->Params['oi_qea'][$i];
						if(!$this->Params['oi_pid'][$i]) {
							$iRegData['reg_id'] = $this->session->get('ss_mn_pid');
							$insert_id=$this->purchase_item_model->insert($iRegData);
							//debug($iRegData, $this->oitem_model->dDB->getLastQuery());
						}
						else {
							unset($RegData['oi_pid']);
							$iRegData['up_id'] = $this->session->get('ss_mn_pid');
							$this->purchase_item_model->update($this->Params['oi_pid'][$i], $iRegData);
						}
						$total_price += $iRegData["oi_qea"] * $iRegData["oi_real_in_price"];
					}
				}
				if(!$this->Params['io_pid']) {
					$sn=getSerial($this->stock_model->getPurchaseList($options), 4);
					$upData["io_num"] = "PO".date("Ymd")."-".$sn;
				}
				$upData["io_price"] = $total_price;
				$upData['up_id'] = $this->session->get('ss_mn_pid');
				$this->purchase_model->update($io_pid, $upData);
			}


            jsExecute(array('parent.location.reload()'));
        } else if($this->Params['mode'] == 'purch_cancel') {//구매발주 취소
			$RegData=$this->Params;
            $Scripts=array();


            if(!$this->Params['oic_pid']) {
				$RegData['reg_id'] = $this->session->get('ss_mn_pid');
                $insert_id=$this->purchase_cancel_model->insert($RegData);
				$item=$this->purchase_item_model->find($this->Params['oi_pid']);
				$upData['oi_re_qea'] = $item['oi_re_qea'] - $this->Params['oic_qea'];
				$upData['up_id'] = $this->session->get('ss_mn_pid');
				$this->purchase_item_model->update($this->Params['oi_pid'], $upData);
            }
            else {
                unset($RegData['oic_pid']);
				$cancel=$this->purchase_cancel_model->find($this->Params['oic_pid']);
                $this->purchase_cancel_model->update($this->Params['oic_pid'], $RegData);
				$item=$this->purchase_item_model->find($this->Params['oi_pid']);
				$upData['oi_re_qea'] = $item['oi_re_qea'] - $this->Params['oic_qea'] + $cancel['oic_qea'];
				$upData['up_id'] = $this->session->get('ss_mn_pid');
				$this->purchase_item_model->update($this->Params['oi_pid'], $upData);
            }
			jsExecute(array('parent.location.reload()'));
		} else if($this->Params['mode'] == 'reg_wear') { // 입/출고 저장
			//$RegData=$this->Params;
            $Scripts=array();
			if($this->Params['si_kind'] == 'A') {
				$plus = "1";
				$numCode = "IN";
			} else {
				$plus = "-1";
				$numCode = "OU";
			}
			$rows = $this->stock_inout_model->selectMax('si_num')->where('left(reg_date, 10)', date("Y-m-d"))->where('si_kind', $this->Params['si_kind'])->find()[0];


			if($rows == ""){
				$sn = "0001";
			} else {

				$sn = (int)substr($rows['si_num'],-4) +1 ;
				$sn = getSerial($sn,4);
			}



			for($i=0;$i<count($this->Params['oi_pid']);$i++) {
				$RegData['oi_pid'] = $this->Params['oi_pid'][$i];

				$RegData['pd_pid'] = $this->Params['pd_pid'][$i];
				$RegData['si_pd_name'] = $this->Params['si_pd_name'][$i];
				$RegData['si_qea'] = $this->Params['si_qea'][$i];
				if($RegData['si_qea'] > 0 && $RegData['si_qea'] != '') {
					$item=$this->purchase_item_model->find($RegData['oi_pid']);
					if($this->Params['si_pid'][$i]) {
						$wear=$this->stock_inout_model->find($this->Params['si_pid'][$i]);
						$pd_pid = $wear["pd_pid"];
						$p_kind = $wear["si_p_kind"];
						$store = $wear["si_store"];
					} else {
						$pd_pid = $RegData["pd_pid"];
						$p_kind = $this->Params['si_p_kind'][$i];
						$store = $this->Params["si_store"];
					}

					$stock = $this->stock_main_model->where('pd_pid', $pd_pid)->where('st_kind', $p_kind)->where('st_store', $store)->find()[0];

					$RegData['si_memo'] = $this->Params['si_memo'];
					if(!$this->Params['si_pid'][$i]) {
						$RegData["si_num"] = $numCode.date("Ymd")."-".$sn;
						$RegData['ct_pid'] = $this->Params['ct_pid'][$i];
						$RegData['si_kind2'] = $this->Params['si_kind2'];
						$RegData['si_p_kind'] = $this->Params['si_p_kind'][$i];
						$RegData['sm_pid'] = $this->Params['sm_pid'][$i];
						$RegData['si_date'] = $this->Params['si_date'];
						$RegData['si_store'] = $this->Params['si_store'];
						$RegData['si_kind'] = $this->Params['si_kind'];

						$RegData['reg_id'] = $this->session->get('ss_mn_pid');
						$insert_id=$this->stock_inout_model->insert($RegData);
//debug($rows, $this->stock_inout_model);
						if($stock['st_pid']) {
							$RegData2['st_qea'] = $stock['st_qea'] + ($RegData['si_qea'] * $plus);
							$RegData2['up_id'] = $this->session->get('ss_mn_pid');
							$this->stock_main_model->update($stock['st_pid'], $RegData2);
						} else {
							$RegData2['st_store'] = $RegData['si_store'];
							$RegData2['pd_pid'] = $RegData['pd_pid'];
							$RegData2['st_qea'] = ($RegData['si_qea'] * $plus);
							$RegData2['st_kind'] = $RegData['si_p_kind'];
							$RegData2['reg_id'] = $this->session->get('ss_mn_pid');
							$this->stock_main_model->insert($RegData2);
						}


						if($RegData['oi_pid']) {
							$RegData3['oi_re_qea'] = $item['oi_re_qea'] - $RegData['si_qea'];
							$RegData3['up_id'] = $this->session->get('ss_mn_pid');
							$this->purchase_item_model->update($RegData['oi_pid'], $RegData3);
						}



					}
					else {

						$RegData['up_id'] = $this->session->get('ss_mn_pid');
						$this->stock_inout_model->update($this->Params['si_pid'][$i], $RegData);

						if($this->Params['oi_pid'][$i]) {
							$RegData3['oi_re_qea'] = $item['oi_re_qea'] - $RegData['si_qea'] + $wear['si_qea'];
							$RegData3['up_id'] = $this->session->get('ss_mn_pid');
							$this->purchase_item_model->update($this->Params['oi_pid'][$i], $RegData3);
						}


						$RegData2['st_qea'] = $stock['st_qea'] + ($RegData['si_qea'] * $plus) - ($wear['si_qea'] * $plus);
						$RegData2['up_id'] = $this->session->get('ss_mn_pid');
						$this->stock_main_model->update($stock['st_pid'], $RegData2);
					}
				}
			}

			jsExecute(array('parent.location.reload()'));
		} else if($this->Params['mode'] == 'del_wear') { // 입/출고 삭제
			$upData["si_del"] = 'Y';
			$upData['up_id'] = $this->session->get('ss_mn_pid');
			$this->stock_inout_model->update($this->Params['si_pid'], $upData);

			$wear=$this->stock_inout_model->find($this->Params['si_pid']);
			if($wear['si_kind'] == 'A') {
				$plus = "1";
			} else {
				$plus = "-1";
			}

			$item=$this->purchase_item_model->find($wear['oi_pid']);
			$stock = $this->stock_main_model->where('pd_pid', $wear['pd_pid'])->where('st_kind', $wear['si_p_kind'])->where('st_store', $wear['si_store'])->find()[0];

			$RegData3['oi_re_qea'] = $item['oi_re_qea'] + ($wear['si_qea'] * $plus);
			$RegData3['up_id'] = $this->session->get('ss_mn_pid');
			$this->purchase_item_model->update($this->Params['oi_pid'], $RegData3);


			$RegData2['st_qea'] = $stock['st_qea'] - ($wear['si_qea'] * $plus);
			$RegData2['up_id'] = $this->session->get('ss_mn_pid');
			$this->stock_main_model->update($stock['st_pid'], $RegData2);

			jsExecute(array('parent.delete_ok()'));
		} else if($this->Params['mode'] == 'reg_move') {// 이동저장
			$rows = $this->stock_move_model->selectMax('sm_num')->where('left(reg_date, 10)', date("Y-m-d"))->find()[0];
			//debug($rows, $this->stock_inout_model);

			if($rows == ""){
				$sn = "0001";
			} else {

				$sn = (int)substr($rows['sm_num'],-4) +1 ;
				$sn = getSerial($sn,4);
			}

			$RegData["sm_num"] = "TR".date("Ymd")."-".$sn;

			for($i=0;$i<count($this->Params['oi_pid']);$i++) {
				$RegData['oi_pid'] = $this->Params['oi_pid'][$i];

				$RegData['pd_pid'] = $this->Params['pd_pid'][$i];
				$RegData['sm_pd_name'] = $this->Params['si_pd_name'][$i];
				$RegData['sm_qea'] = $this->Params['si_qea'][$i];
				if($RegData['sm_qea'] > 0 && $RegData['sm_qea'] != '') {

					$RegData['sm_memo'] = $this->Params['si_memo'];
					if(!$this->Params['si_pid'][$i]) {
						$RegData['ct_pid'] = $this->Params['ct_pid'][$i];
						$RegData['sm_p_kind'] = $this->Params['si_p_kind'][$i];
						$RegData['sm_out_store'] = $this->Params['sm_out_store'];
						$RegData['sm_in_store'] = $this->Params['sm_in_store'];
						$RegData['reg_id'] = $this->session->get('ss_mn_pid');
						$insert_id=$this->stock_move_model->insert($RegData);

					}
					else {

						$RegData['up_id'] = $this->session->get('ss_mn_pid');
						$this->stock_move_model->update($this->Params['si_pid'][$i], $RegData);
					}
				}
			}

			jsExecute(array('parent.location.reload()'));
		} else if($this->Params['mode'] == 'del_move') { // 이동 삭제
			$upData["sm_del"] = 'Y';
			$upData['up_id'] = $this->session->get('ss_mn_pid');
			$this->stock_move_model->update($this->Params['del_sm_pid'], $upData);

			jsExecute(array('parent.delete_ok()'));
		} else if($this->Params['mode'] == 'move_in') { //이동용 입/출고 저장
			$options['page'] = '1';
			$options['rcnt'] = '0';
			$options['nogroup'] = 'Y';
			$rows = $this->stock_model->getStockMoveList($options);
			if( $this->Params['kind'] == 'A') {
				$kind2 = "C" ;
				$inout = "in";
			} else{
				$kind2 = "B";
				$inout = "out";
			}
			$kind = $this->Params['kind'];
			unset($this->Params);
			$this->Params['mode'] = 'reg_wear';
			foreach($rows as $i=>$row) {
				$this->Params['oi_pid'][$i] = '';
				$this->Params['pd_pid'][$i] = $row['pd_pid'];
				$this->Params['si_pd_name'][$i] = $row['sm_pd_name'];
				$this->Params['si_qea'][$i] = $row['sm_qea'];
				$this->Params['si_pid'][$i] ='';
				$this->Params['ct_pid'][$i] = $row['ct_pid'];
				$this->Params['si_p_kind'][$i] = $row['sm_p_kind'];
				$this->Params['sm_pid'][$i] = $row['sm_pid'];
				if($i==0) {
					$this->Params['si_memo'] = $row['sm_memo'];
					$this->Params['si_kind2'] = $kind2;
					$this->Params['si_date'] = date('Y-m-d');
					$this->Params['si_store'] = $row['sm_'.$inout.'_store'];
					$this->Params['si_kind'] = $kind;
				}

				$upData['sm_'.$inout.'_mn_pid'] = $this->session->get('ss_mn_pid');
				$upData['sm_'.$inout.'_date'] = date('Y-m-d H:i:s');
				$this->stock_move_model->update($row['sm_pid'], $upData);

				//debug($this->stock_move_model);
			}

			$this->execute('re');

			//jsExecute(array('parent.location.reload()'));

		} else if($this->Params['mode'] == 'real_excel') { //실사재관리용 제품/부품 목록 엑셀 다운로드
			$i=0;
			$store = $this->Params['sr_store'];

			if($this->Params['pd_cate']) {
				$options['page'] = '1';
				$options['rcnt'] = '0';
				$options['in_pid1'] = $this->Params['pd_cate'];
				$pd_rows = $this->pcmanager_model->getProductList($options);

				foreach($pd_rows as $row) {

					$stock = $this->stock_main_model->where('pd_pid', $row['pd_pid'])->where('st_kind', 'A')->where('st_store', $store)->find()[0];

					$datas[$i]['kind'] = "상품";
					$datas[$i]['pid'] = $row['pd_pid'];
					$datas[$i]['code'] = $row['pd_code'];
					$datas[$i]['name'] = $row['pd_name'];
					$datas[$i]['stock'] = $stock['st_qea'];
					$i++;
				}
			}

			if($this->Params['pt_cate']) {
				$options2['page'] = '1';
				$options2['rcnt'] = '0';
				$options2['in_pid1'] = $this->Params['pt_cate'];
				$pt_rows = $this->pcmanager_model->getPartsList($options2);

				foreach($pt_rows as $row) {

					$stock = $this->stock_main_model->where('pd_pid', $row['pd_pid'])->where('st_kind', 'B')->where('st_store', $store)->find()[0];

					$datas[$i]['kind'] = "부품";
					$datas[$i]['pid'] = $row['pt_pid'];
					$datas[$i]['code'] = $row['pt_code'];
					$datas[$i]['name'] = $row['pt_name'];
					$datas[$i]['stock'] = $stock['st_qea'];
					$i++;
				}
			}

			$cells = array(
				'A' => array(15, 'kind', '구분'),
				'B' => array(20, 'pid',  '키'),
				'C' => array(20, 'code', '코드'),
				'D' => array(20, 'name', '이름'),
				'E' => array(20, 'stock', '현재고'),
				'E' => array(20, 'rstock', '실재고')
			);



			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();

			foreach ($cells as $key => $val) {
				$cellName = $key.'1';

				$sheet->getColumnDimension($key)->setWidth($val[0]);
				$sheet->getRowDimension('1')->setRowHeight(25);
				$sheet->setCellValue($cellName, $val[2]);
				$sheet->getStyle($cellName)->getFont()->setBold(true);
				$sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
				$sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
			}


			for ($i = 2; $row = array_shift($datas); $i++) {
				foreach ($cells as $key => $val) {
					$sheet->setCellValue($key.$i, $row[$val[1]]);
				}
			}

			$filename = date('Ymd').'_'.get_cookie('pk_name').'_item';

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

			$writer = new Xlsx($spreadsheet);
			$writer->save('php://output');
			exit;
		} else if($this->Params['mode'] == 'reg_check') { //실사재고 저장
			$file = $this->request->getFile('file_stock_excel');
			//print_r($file); exit;
			$filename = $file->getName();
			$file_type= pathinfo($filename, PATHINFO_EXTENSION);

			if($file_type == 'xls' || $file_type == 'xlsx') {

				$spreadsheet = IOFactory::load($file->getPathName());
			} else {
				$Scripts[] = "parent.alertBox('엑셀파일이 아님니다. 확인해 주세요', parent.gcUtil.loader, 'hide')";
				jsExecute($Scripts);
				exit;
			}


			$rows = $this->stock_check_model->selectMax('sr_num')->where('left(reg_date, 10)', date("Y-m-d"))->find()[0];

			if($rows == ""){
				$sn = "0001";
			} else {

				$sn = (int)substr($rows['sr_num'],-4) +1 ;
				$sn = getSerial($sn,4);
			}

			$RegData = $this->Params;
			$RegData['sr_num'] = "RC".date("Ymd")."-".$sn;
			$sr_pid = $this->stock_check_model->insert($RegData);


			$spreadData = $spreadsheet-> getActiveSheet()->toArray();
			$row_cnt=count($spreadData);

			$store = $this->Params['sr_store'];
			$sr_stock_use = $this->Params['sr_stock_use'];
			$sr_memo = $this->Params['sr_memo'];
			for($i=1;$i<$row_cnt;$i++) {
				$st_kind = $spreadData[$i][0]  == '상품' ? 'A':'B';
				$stock = $this->stock_main_model->where('pd_pid', $spreadData[$i][1])->where('st_kind', $st_kind)->where('st_store', $store)->find()[0];

				$RegData2['sr_pid'] = $sr_pid;
				$RegData2['si_store'] = $store;
				$RegData2['st_kind'] = $st_kind;
				$RegData2['pd_pid'] = $spreadData[$i][1];
				$RegData2['sr_qea'] = $spreadData[$i][5];
				$RegData2['st_qea'] = $stock['st_qea'];

				$this->stock_check_item_model->insert($RegData2);

				if($sr_stock_use == 'Y') {

					if($spreadData[$i][5] != $stock['st_qea']) {
						$RegData3['sa_store'] = $store;
						$RegData3['sa_kind'] = 'A';
						$RegData3['sa_p_kind'] = $st_kind;
						$RegData3['pd_pid'] = $spreadData[$i][1];
						$RegData3['sa_qea'] = $spreadData[$i][5];
						$RegData3['st_qea'] = $stock['st_qea'];
						$RegData3['sa_memo'] = $sr_memo;

						$this->stock_adjust_model->insert($RegData3);

						$RegData4['st_qea'] = $spreadData[$i][5];
						if($stock['st_pid']) {
							$this->stock_main_model->update($stock['st_pid'], $RegData4);
						} else {
							$RegData4['st_store'] = $store;
							$RegData4['st_kind'] = $st_kind;
							$RegData4['pd_pid'] = $spreadData[$i][1];
							$this->stock_main_model->insert($RegData4);
						}
					}
				}
			}

			$msg="정상적으로 등록되었습니다.";

			$Scripts[] = "parent.alertBox('".$msg."', parent.win_load)";
            jsExecute($Scripts);
            exit;

		} else if($this->Params['mode'] == 'reg_adjust') { //재고조정 저장

			for($i=0;$i<count($this->Params['pd_pid']);$i++) {

				$RegData['sa_qea'] = $this->Params['sa_qea'][$i];
				$RegData['sa_store'] = $this->Params['sa_store'];
				$RegData['sa_kind'] = $this->Params['sa_kind'];
				if($RegData['sa_qea'] > 0 && $RegData['sa_qea'] != '') {
					$stock = $this->stock_main_model->where('pd_pid', $this->Params['pd_pid'][$i])->where('st_kind', $this->Params['sa_p_kind'][$i])->where('st_store', $this->Params['sa_store'])->find()[0];
debug($stock);
					$RegData['st_qea'] = $stock['st_qea'];
					$RegData['sa_memo'] = $this->Params['sa_memo'];

					if(!$this->Params['sa_pid']) {
						$RegData['pd_pid'] = $this->Params['pd_pid'][$i];
						$RegData['sa_p_kind'] = $this->Params['sa_p_kind'][$i];
						$RegData['reg_id'] = $this->session->get('ss_mn_pid');
						$insert_id=$this->stock_adjust_model->insert($RegData);

						debug($this->stock_adjust_model);
					}
					else {
						$RegData['up_id'] = $this->session->get('ss_mn_pid');
						$this->stock_adjust_model->update($this->Params['sa_pid'], $RegData);
					}



					$RegData4['st_qea'] = $RegData['sa_qea'];
					if($stock['st_pid']) {
						$this->stock_main_model->update($stock['st_pid'], $RegData4);
					} else {
						$RegData4['st_store'] = $this->Params['sa_store'];
						$RegData4['st_kind'] = $this->Params['sa_p_kind'][$i];
						$RegData4['pd_pid'] = $this->Params['pd_pid'][$i];
						$this->stock_main_model->insert($RegData4);
					}
				}
			}

			$msg="정상적으로 등록되었습니다.";

			$Scripts[] = "parent.alertBox('".$msg."', parent.win_load)";
            jsExecute($Scripts);
            exit;
		} else if($this->Params['mode'] == 'reg_part_request') { //부품요청
			$RegData=$this->Params;
            $Scripts=array();

			$RegData['reg_id'] = $this->session->get('ss_mn_pid');
			$insert_id=$this->stock_part_request_model->insert($RegData);
			$pi_pid = $insert_id;
			$options["searchNdate"] = date("Y-m-d");

			if(count($this->Params['pt_pid']) > 0) {
				for($i=0;$i<count($this->Params['pt_pid']);$i++) {
					if($this->Params['ii_qea'][$i] > 0) {
						$iRegData["pt_pid"] = $this->Params['pt_pid'][$i];
						$iRegData["pi_pid"] = $pi_pid;
						$iRegData["pt_name"] = $this->Params['pt_name'][$i];
						$iRegData["ii_qea"] = str_replace(",","",$this->Params['ii_qea'][$i]);
						$iRegData['reg_id'] = $this->session->get('ss_mn_pid');
						$insert_id=$this->stock_part_request_item_model->insert($iRegData);
						//debug($iRegData, $this->oitem_model->dDB->getLastQuery());
					}
				}

			}

			$msg="정상적으로 등록되었습니다.";

			$Scripts[] = "parent.alertBox('".$msg."', parent.win_load)";
            jsExecute($Scripts);
		} else if($this->Params['mode'] == 'canel_part_request') { //부품요청취소

			foreach($this->Params['pi_pid'] as $k=>$v) {
				$UpData['pi_state'] = 'C';
				$UpData['up_id'] = $this->session->get('ss_mn_pid');
				$this->stock_part_request_model->update($v, $UpData);
			}

			$msg="정상적으로 취소되었습니다.";

			$Scripts[] = "parent.alertBox('".$msg."', parent.win_load)";
            jsExecute($Scripts);
		}else if($this->Params['mode'] == 'reg_part_confirm') { //부품요청처리
            $Scripts=array();

			$RegData['up_id'] = $this->session->get('ss_mn_pid');
			$RegData['pi_state'] = 'B';
			$RegData['pi_confirm_date'] = date('Y-m-d H:i:s');
			$insert_id=$this->stock_part_request_model->update($this->Params['pi_pid'],$RegData);
			$pi_pid = $insert_id;
			$options["searchNdate"] = date("Y-m-d");

			$data = $this->Params;

			if(count($data['ii_real_qea']) > 0) {
				for($i=0;$i<count($data['ii_real_qea']);$i++) {
					if($data['ii_real_qea'][$i] > 0) {
						$iRegData["ii_real_qea"] = str_replace(",","",$data['ii_real_qea'][$i]);
						$iRegData['up_id'] = $this->session->get('ss_mn_pid');
						$insert_id=$this->stock_part_request_item_model->update($data['ii_pid'][$i],$iRegData);
						//debug($iRegData, $this->oitem_model->dDB->getLastQuery());

					}
				}
				$options['page'] = 1;
				$options['rcnt'] = 0;
				$options['nogroup'] = 'Y';
				$options['pi_pid'] =$this->Params['pi_pid'];

				$rows = $this->stock_model->getStockPartRequstList($options);

				unset($this->Params);
				$this->Params['mode'] = 'reg_wear';
				foreach($rows as $i=>$row) {

					$this->Params['oi_pid'][$i] = '';
					$this->Params['pd_pid'][$i] = $row['pt_pid'];
					$this->Params['si_pd_name'][$i] = $row['pt_name'];
					$this->Params['si_qea'][$i] = $row['ii_real_qea'];
					$this->Params['si_pid'][$i] ='';
					$this->Params['ct_pid'][$i] = $row['ct_pid'];
					$this->Params['si_p_kind'][$i] = 'B';
					if($i==0) {
						$this->Params['si_memo'] = $row['pi_memo'];
						$this->Params['si_kind2'] = "E";
						$this->Params['si_date'] = date('Y-m-d');
						$this->Params['si_store'] = $row['pi_store'];
						$this->Params['si_kind'] = $row['pi_kind'];
					}
				}

				$this->execute('re');

			}

			//$msg="정상적으로 등록되었습니다.";

			//$Scripts[] = "parent.alertBox('".$msg."', parent.win_load)";
           // jsExecute($Scripts);
		}
    }

	//ajax용 처리
	function ajax_request() {
		if($this->Params['mode']=='get_oikind') {
			$add_name = false;
			if($this->Params['kind'] == 'A') {
				$pid = 'pd_pid';
				$name = 'pd_name';
				$in_price = 'pd_in_price';
				$rows = $this->stock_model->prodList($this->Params);
			} else if($this->Params['kind'] == 'B') {
				$pid = 'pt_pid';
				$name = 'pt_name';
				$in_price = 'pt_in_price';
				$rows = $this->stock_model->partList($this->Params);
			} else if($this->Params['kind'] == 'C') {
				$pid = 'io_pid';
				$name = 'io_num';
				$in_price = '';
				$options['searchNkind'] = 'Y';
				$options["nogroup"] = 'Y';
				$options['page'] = '1';
				$options['rcnt'] = '0';
				$rows=$this->stock_model->getPurchaseList($options);
				$add_name = true;
			}
			$option = '<option value="">선택</option>';
			if(count($rows) > 0) {
				foreach($rows as $row) {
					$stock = array();
					if($this->Params['store'] != "") {
						$stock = $this->stock_main_model->where('pd_pid', $row[$pid])->where('st_kind', $this->Params['kind'])->where('st_store', $this->Params['store'])->find()[0];
												$add = '';
						if($add_name) {
							$add = $row['oi_name'];
						}
						if($stock['st_pid']) {
							$option .= '<option value="'.$row[$pid].'" in_price="'.$row[$in_price].'" stock="'.$stock['st_qea'].'">'.$row[$name].$add.'</option>';
						}

					} else {
						$add = '';
						if($add_name) {
							$add = $row['oi_name'];
						}
						$option .= '<option value="'.$row[$pid].'" in_price="'.$row[$in_price].'" >'.$row[$name].$add.'</option>';
					}
				}
			}
            // debug($this->Params, $this->stock_model);
            echo $option;
        } else if($this->Params['mode'] == 'get_purchase') {
			$purchase=$this->purchase_model->find($this->Params['pid']);
			$options['io_pid'] = $this->Params['pid'];
			$purchase['item'] = $this->stock_model->getPurItemList($options);
			//debug($this->Params, $purchase);
			echo json_encode($purchase);
		} else if($this->Params['mode'] == 'item_del') {
			$iRegData["oi_del"] = 'Y';
			$this->purchase_item_model->update($this->Params['oi_pid'][$i], $iRegData);
			$result["res"] = true;
			//debug($this->Params, $this->purchase_item_model);
			echo json_encode($result);
		} else if($this->Params['mode'] == 'get_waer_data') {
			$qea_val = 'si_qea';

			if($this->Params['si_num']) {
				$options['page'] = '1';
				$options['rcnt'] = '0';
				$options['nogroup'] = 'Y';
				$options['searchKind'] = $this->Params['kind'];
				$options["si_num"] = $this->Params['si_num'];
				$rows = $this->stock_model->getWearList($options);
				$pname = 'si_pd_name';
				$pd_pid = 'pd_pid';
				$oi_kind = 'si_p_kind';
				$pid = 'si_pid';
			} else if($this->Params['sm_num']) {
				$options['page'] = '1';
				$options['rcnt'] = '0';
				$options['nogroup'] = 'Y';
				$options["sm_num"] = $this->Params['sm_num'];
				$rows = $this->stock_model->getStockMoveList($options);
				$pname = 'sm_pd_name';
				$pd_pid = 'pd_pid';
				$oi_kind = 'sm_p_kind';
				$qea_val = 'sm_qea';
				$pid = 'sm_pid';
			} else if($this->Params['si_kind2'] == 'A') {
				$options["nogroup"] = 'Y';
				$options['page'] = '1';
				$options['rcnt'] = '0';
				$options["io_pid"] = $this->Params['sch_pid'];
				$rows=$this->stock_model->getPurchaseList($options);
				$pname = 'oi_name';
				$pd_pid = 'pd_pid';
				$oi_kind = 'oi_kind';
			} else if($this->Params['sch_pkind'] == 'A') {
				$options["pd_pid"] = $this->Params['sch_pid'];
				$rows[0] = $this->pcmanager_model->getProductList($options);
				$pname = 'pd_name';
				$pd_pid = 'pd_pid';
				$pkind_name = '상품';
				$pkind = 'A';
			} else {
				$options["pt_pid"] = $this->Params['sch_pid'];
				$rows=$this->stock_model->partList($options);
				$pname = 'pt_name';
				$pd_pid = 'pt_pid';
				$pkind_name = '부품';
				$pkind = 'B';
			}

			//debug($this->Params, $this->stock_model);
			$html = '';
			foreach($rows as $row) {
				if($this->Params['si_num'] || $this->Params['sm_num'] || $this->Params['si_kind2'] == 'A') {
					$kind_name = $row['kind_name'];
					$si_p_kind = $row[$oi_kind];
				} else {
					$kind_name = $pkind_name;
					$si_p_kind = $pkind;
				}

				//debug($rows);
				$html .= '<tr>';
				if($this->Params['kind'] == 'A') {
					$html .= '	<td>'.$row['oi_num'].'</td>';
					$qea = $row['oi_re_qea'];
				} else {
					$stock = $this->stock_main_model->where('pd_pid', $row[$pd_pid])->where('st_kind', $si_p_kind)->where('st_store', $this->Params['si_store'])->find()[0];
					$qea = $stock['st_qea'];
					//debug( $this->stock_main_model);
				}
				$html .= '	<td>'.$ct_name[$row['ct_pid']].'</td>';
				$html .= '	<td>'.$kind_name.'</td>';
				$html .= '	<td>'.$row[$pname].'</td>';
				$html .= '	<td>'.number_format($qea).'</td>';
				$html .= '	<td><input type="text" name="si_qea[]" class="mWt60 h_20 txac" value="'.$row[$qea_val].'" onkeyyp="inputNumberAutoComma(this)"/></td>';
				$html .= '	<td>';
				$html .= '	<button type="button" class="small bt_red" onclick="confirmBox(\'삭제하시겠습니까?\', row_del, {pid:\''.$row[$pid].'\',tr:$(this).parent().parent()})">삭제</button> ';
				$html .= '	<input type="hidden" name="si_pid[]" value="'.$row[$pid].'">';
				$html .= '	<input type="hidden" name="oi_pid[]" value="'.$row['oi_pid'].'">';
				$html .= '	<input type="hidden" name="pd_pid[]" value="'.$row[$pd_pid].'">';
				$html .= '	<input type="hidden" name="si_pd_name[]" value="'.$row[$pname].'">';
				$html .= '	<input type="hidden" name="si_p_kind[]" value="'.$si_p_kind.'">';
				$html .= '	<input type="hidden" name="ct_pid[]" value="'.$row['ct_pid'].'"></td>';
				$html .= '</tr>';
			}
			echo $html;
		} else if($this->Params['mode'] == 'get_re_item') {
			$options['page'] = 1;
			$options['rcnt'] = 0;
			$options['nogroup'] = 'Y';
			$options['pi_pid'] =$this->Params['pi_pid'];
			$rows = $this->stock_model->getStockPartRequstList($options);
			$html = '';

			$options2['rcnt'] = 0;
			$options2['page'] = 1;
			$pt_rows = $this->pcmanager_model->getPartsList($options2);
			foreach($pt_rows as $row) {
				$pt_data[$row['pt_pid']] = $row;
			}

			foreach($rows as $row) {
				$stock = $this->stock_main_model->where('pd_pid', $row['pt_pid'])->where('st_kind', 'B')->where('st_store', $row['pi_store'])->find()[0];
				$html .= '<tr>';
				$html .= '	<td>'.$pt_data[$row['pt_pid']]['pt_code'].'</td>';
				$html .= '	<td>'.$row['pt_name'].'</td>';
				$html .= '	<td>'.$stock['st_qea'].'</td>';
				$html .= '	<td>'.$row['ii_qea'].'</td>';
				$html .= '	<td><input type="text" name="ii_real_qea[]" class="mWt60 h_20 txac" value="" /></td>';
				$html .= '	<input type="hidden" name="ii_pid[]" value="'.$row['ii_pid'].'">';
				$html .= '</tr>';
			}
			echo $html;
		}
	}

	//구매발주
	public function purchase_order()
	{
		$viewParams=$this->Params;
		$viewParams['manager'] = $this->basic_model->getManagerList(array("rcnt"=>0,"page"=>1));
		$viewParams['state'] = $this->io_state;

        $this->_header();
        echo view('stock/purchase_order', $viewParams);
        $this->_footer();
	}

	//구매발주 목록
	function purchase_order_data() {
        $this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;
        $viewParams=$this->Params;
        $rows=$this->stock_model->getPurchaseList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->io_state;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);

		$options['searchMn'] = $this->Params['searchMn'];
		foreach($rows as $row) {
			$options['io_pid'] = $row['io_pid'];
			$itemlist[$row['io_pid']] = $this->stock_model->getPurItemList($options);
		}

		$viewParams['itemlist'] = $itemlist;


        $listHtml=view('stock/purchase_order_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));

    }

	//구매발주 엑셀
	function purchase_order_excel() {
        $this->Params['rcnt']=0;
        $this->Params['page']=1;
        $rows=$this->stock_model->getPurchaseList($this->Params);
        $datas=array();
        $totCnt = count($rows);
        if($totCnt<1) return;
		$i=0;
		$options['searchMn'] = $this->Params['searchMn'];
        foreach($rows as $row) {
			$mrows[$i] = $row['rowcnt'];
            $datas[$i]['no'] = $totCnt--;
            $datas[$i]['io_date'] = $row['io_date'];
            $datas[$i]['io_num'] = $row['io_num'];
            $datas[$i]['io_state'] = $this->io_state[$row['io_state']];
            $datas[$i]['ct_name'] = $row['ct_name'];
            $datas[$i]['io_price'] = number_format($row['io_price']);
            $datas[$i]['mn_name'] = $row['mn_name'];
            $datas[$i]['io_bigo'] = $row['io_bigo'];

			$options['io_pid'] = $row['io_pid'];
			$irows = $this->stock_model->getPurItemList($options);
			foreach($irows as $row2) {
				$itmp = explode(",", $row2["inqea"]);
				$iqea = '';
				foreach($itmp as $k=>$v) {
					$itmp2 = explode("|", $v);
					$iqea .= $itmp2[1].'
';
				}

				$ctmp = explode(",", $row2["canqea"]);
				$cqea = '';
				$cbigo = '';
				foreach($ctmp as $k=>$v) {
					$ctmp2 = explode("|", $v);
					$cqea .= $ctmp2[0].'
';
					$cbigo .= $ctmp2[1].'
';
				}
				$datas[$i]['oi_num'] = $row2['oi_num'];
				$datas[$i]['oi_name'] = $row2['oi_name'];
				$datas[$i]['kind_name'] = $row2['kind_name'];
				$datas[$i]['oi_in_price'] = number_format($row2['oi_in_price']);
				$datas[$i]['oi_real_in_price'] = number_format($row2['oi_real_in_price']);
				$datas[$i]['oi_qea'] = number_format($row2['oi_qea']);
				$datas[$i]['oi_total_price'] = number_format($row2['oi_real_in_price']*$row2['oi_qea']);
				$datas[$i]['iqea'] = $iqea;
				$datas[$i]['oi_re_qea'] = number_format($row2['oi_re_qea']);
				$datas[$i]['cqea'] = $cqea;
				$datas[$i]['cbigo'] = $cbigo;

				$i++;
			}
        }
//print_r($datas);

        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(20, 'io_date',  '발주일'),
            'C' => array(20, 'io_num', '발주번호'),
            'D' => array(20, 'io_state', '상태'),
            'E' => array(20, 'ct_name', '발주처'),
            'F' => array(20, 'io_price', '총발주금액'),
            'G' => array(20, 'mn_name', '발주자'),
            'H' => array(20, 'io_bigo', '비고'),
            'I' => array(20, 'oi_num', '상세발주번호'),
            'J' => array(20, 'oi_name', '상품'),
            'K' => array(20, 'kind_name', '구분'),
            'L' => array(20, 'oi_in_price', '입고가'),
            'M' => array(20, 'oi_real_in_price', '실입고가'),
			'N' => array(20, 'oi_qea', '발주수량'),
			'O' => array(20, 'oi_total_price', '발주금액'),
			'p' => array(20, 'iqea', '입고수량'),
			'Q' => array(20, 'oi_re_qea', '잔여수량'),
			'R' => array(20, 'cqea', '취소수량'),
			'S' => array(20, 'cbigo', '취소비고')
        );



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

		$mkey = array('A','B','C','D','E','F','G','H');
        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
				if($mrows[$i-2] > 1 && (in_array($key, $mkey))) {
					$sheet->mergeCells($key.$i.":".$key.($i+$mrows[$i-2]-1));
				}
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_'.get_cookie('pk_name').'_purchase';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

	function item_list_data() {
		$viewParams = Array();
		$rows=$this->stock_model->getPurchaseList($this->Params);
		$listHtml=view('stock/pop_item_list', $viewParams);

	}

	public function wear()
	{
		$viewParams=$this->Params;
		$viewParams['setting'] = $this->setting;
		$viewParams['si_state'] = $this->si_state;
        $this->_header();
        echo view('stock/wear', $viewParams);
        $this->_footer();
	}

	function wear_data() {
        $this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;
		$this->Params['searchKind']="A";
        $viewParams=$this->Params;
        $rows=$this->stock_model->getWearList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->si_state;
		$viewParams['setting'] = $this->setting;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);


		$options['searchWord'] = $this->Params['searchWord'];
		$options['nogroup'] = 'Y';
		$options['rcnt']=0;
        $options['page']=1;
		$options['searchKind'] = 'A';
		foreach($rows as $row) {
			$options['si_num'] = $row['si_num'];
			$itemlist[$row['si_num']] = $this->stock_model->getWearList($options);
		}
//print_r($itemlist);
		$viewParams['itemlist'] = $itemlist;

        $listHtml=view('stock/wear_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));

    }

	function wear_excel() {
		$this->Params['rcnt']=0;
        $this->Params['page']=1;

        $this->Params['searchKind']="A";
        $rows=$this->stock_model->getWearList($this->Params);


		$totCnt = count($rows);
        if($totCnt<1) return;

		$options['searchWord'] = $this->Params['searchWord'];
		$options['nogroup'] = 'Y';
		$options['rcnt']=0;
		$options['page']=1;
		$options['searchKind'] = 'A';

		$i=0;
        foreach($rows as $row) {
			$mrows[$i] = $row['rowcnt'];
            $datas[$i]['no'] = $totCnt--;
            $datas[$i]['si_date'] = $row['si_date'];
            $datas[$i]['si_num'] = $row['si_num'];
            $datas[$i]['si_kind2'] = $this->si_state[$row['si_kind2']];
            $datas[$i]['si_store'] = $this->setting['code']['Storage'][$row['si_store']]['cd_name'];


			$options['si_num'] = $row['si_num'];
			$irows = $this->stock_model->getWearList($options);

            foreach($irows as $row2) {
				$datas[$i]['ct_name'] = $row2['ct_name'];
				$datas[$i]['kind_name'] = $row2['kind_name'];
				$datas[$i]['si_pd_name'] = $row2['si_pd_name'];
				$datas[$i]['si_qea'] = number_format($row2['si_qea']);
				$datas[$i]['oi_num'] = $row2['oi_num'];
				$datas[$i]['oi_re_qea'] = number_format($row2['oi_re_qea'])."/".number_format($row2['oi_qea']);
				$datas[$i]['reg_name'] = $row2['reg_name'];
				$datas[$i]['si_memo'] = $row2['si_memo'];
				$i++;
			}
        }
//print_r($datas);
//debug($datas); exit;
        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(20, 'si_date',  '입고일'),
            'C' => array(20, 'si_num', '입고번호'),
            'D' => array(20, 'si_kind2', '유형'),
            'E' => array(20, 'si_store', '창고'),
            'F' => array(20, 'ct_name', '매입처'),
            'G' => array(20, 'kind_name', '구분'),
            'H' => array(20, 'si_pd_name', '상품'),
            'I' => array(20, 'si_qea', '입고수량'),
            'J' => array(20, 'oi_num', '상세발주코드'),
            'K' => array(20, 'oi_re_qea', '잔여/발주'),
            'L' => array(20, 'reg_name', '등록자'),
            'M' => array(20, 'si_memo', '비고')

        );



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

		$mkey = array('A','B','C','D','E');
        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
				if($mrows[$i-2] > 1 && (in_array($key, $mkey))) {
					$sheet->mergeCells($key.$i.":".$key.($i+$mrows[$i-2]-1));
				}
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_'.get_cookie('pk_name').'_wear';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;

    }

	public function shipped()
	{
		$viewParams=$this->Params;
		$viewParams['setting'] = $this->setting;
		$viewParams['si_state'] = $this->si_state;

        $this->_header();
        echo view('stock/shipped', $viewParams);
        $this->_footer();
	}

	function shipped_data() {
        $this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;
		$this->Params['searchKind']="B";
        $viewParams=$this->Params;
        $rows=$this->stock_model->getWearList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->setting['code']['so_state'];
		$viewParams['setting'] = $this->setting;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);

		$options['searchWord'] = $this->Params['searchWord'];
		$options['nogroup'] = 'Y';
		$options['rcnt']=0;
        $options['page']=1;
		$options['searchKind'] = 'B';
		foreach($rows as $row) {
			$options['si_num'] = $row['si_num'];
			$itemlist[$row['si_num']] = $this->stock_model->getWearList($options);
		}
//print_r($itemlist);
		$viewParams['itemlist'] = $itemlist;


        $listHtml=view('stock/shipped_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));

    }

	function shipped_excel() {
		$this->Params['rcnt']=0;
        $this->Params['page']=1;

        $this->Params['searchKind']="B";
        $rows=$this->stock_model->getWearList($this->Params);


		$totCnt = count($rows);
        if($totCnt<1) return;

		$options['searchWord'] = $this->Params['searchWord'];
		$options['nogroup'] = 'Y';
		$options['rcnt']=0;
		$options['page']=1;
		$options['searchKind'] = 'B';

		$i=0;
        foreach($rows as $row) {
			$mrows[$i] = $row['rowcnt'];
            $datas[$i]['no'] = $totCnt--;
            $datas[$i]['si_date'] = $row['si_date'];
            $datas[$i]['si_num'] = $row['si_num'];
            $datas[$i]['si_kind2'] = $this->si_state[$row['si_kind2']];
            $datas[$i]['si_store'] = $this->setting['code']['Storage'][$row['si_store']]['cd_name'];


            $options['si_num'] = $row['si_num'];
			$irows = $this->stock_model->getWearList($options);

            foreach($irows as $row2) {
				$datas[$i]['ct_name'] = $row2['ct_name'];
				$datas[$i]['kind_name'] = $row2['kind_name'];
				$datas[$i]['si_pd_name'] = $row2['si_pd_name'];
				$datas[$i]['si_qea'] = number_format($row2['si_qea']);
				$datas[$i]['od_code'] = $row2['od_code'];
				$datas[$i]['mb_pid'] = $row2['mb_pid'];
				$datas[$i]['reg_name'] = $row2['reg_name'];
				$datas[$i]['si_memo'] = $row2['si_memo'];
				$i++;
			}
        }
//print_r($datas);
//debug($datas); exit;
        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(20, 'si_date',  '출고일'),
            'C' => array(20, 'si_num', '출고번호'),
            'D' => array(20, 'si_kind2', '유형'),
            'E' => array(20, 'si_store', '창고'),
            'F' => array(20, 'ct_name', '거래처'),
            'G' => array(20, 'kind_name', '구분'),
            'H' => array(20, 'si_pd_name', '상품'),
            'I' => array(20, 'si_qea', '출고수량'),
            'J' => array(20, 'od_code', '주문번호'),
            'K' => array(20, 'mb_pid', '고객코드'),
            'L' => array(20, 'reg_name', '등록자'),
            'M' => array(20, 'si_memo', '비고')

        );



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

		$mkey = array('A','B','C','D','E');
        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
				if($mrows[$i-2] > 1 && (in_array($key, $mkey))) {
					$sheet->mergeCells($key.$i.":".$key.($i+$mrows[$i-2]-1));
				}
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_'.get_cookie('pk_name').'_shipped';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;

    }

	public function stock_status()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('stock/stock_status', $viewParams);
        $this->_footer();
	}

	public function stock_status_data()
	{
		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;
		$this->Params['searchKind']="A";
        $viewParams=$this->Params;
        $rows=$this->stock_model->getStockStatusList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->si_state;
		$viewParams['setting'] = $this->setting;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);

        $listHtml=view('stock/stock_status_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
	}

	function stock_status_excel() {
		$this->Params['rcnt']=0;
        $this->Params['page']=1;
		$this->Params['searchKind']="A";
        $rows=$this->stock_model->getStockStatusList($this->Params);


		$totCnt = count($rows);
        if($totCnt<1) return;

		$options['searchMn'] = $this->Params['searchMn'];
        foreach($rows as $i=>$row) {
			$mrows[$i] = $row['rowcnt'];
            $datas[$i]['no'] = $totCnt--;
            $datas[$i]['st_store'] = $this->setting['code']['Storage'][$row['st_store']]['cd_name'];
            $datas[$i]['ct_name'] = $row['ct_name'];
            $datas[$i]['pd_name'] = $row['pd_name'];
            $datas[$i]['st_qea'] = number_format($row['st_qea']);
            $datas[$i]['odsum'] = number_format($row['odsum']);
            $datas[$i]['g_qea'] = number_format($row['st_qea']-$row['odsum']);
            $datas[$i]['insum'] = number_format($row['insum']);
			$datas[$i]['outsum'] = number_format($row['outsum']);
			$datas[$i]['ajtsum'] = number_format($row['ajtsum']);
			$datas[$i]['disum'] = number_format($row['disum']);
			$datas[$i]['reg_date'] = substr($row['reg_date'],0,10);

        }
//print_r($datas);
//debug($datas); exit;
        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(20, 'st_store',  '창고'),
            'C' => array(20, 'ct_name', '거래처'),
            'D' => array(20, 'pd_name', '제품명'),
            'E' => array(20, 'st_qea', '현재고'),
            'F' => array(20, 'odsum', '출고대기'),
            'G' => array(20, 'g_qea', '가용재고'),
            'H' => array(20, 'insum', '입고합계'),
            'I' => array(20, 'outsum', '출고합계'),
            'J' => array(20, 'ajtsum', '조정'),
            'K' => array(20, 'disum', '폐기'),
            'L' => array(20, 'reg_date', '등록일')
        );



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }


        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_'.get_cookie('pk_name').'_stock_status';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;

    }

	public function stock_move()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('stock/stock_move', $viewParams);
        $this->_footer();
	}

	public function stock_move_data()
	{
		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;

        $viewParams=$this->Params;
        $rows=$this->stock_model->getStockMoveList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->si_state;
		$viewParams['setting'] = $this->setting;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);

		$options['searchWord'] = $this->Params['searchWord'];
		$options['nogroup'] = 'Y';
		$options['rcnt']=0;
        $options['page']=1;

		foreach($rows as $row) {
			$options['sm_num'] = $row['sm_num'];
			$itemlist[$row['sm_num']] = $this->stock_model->getStockMoveList($options);
		}
//print_r($itemlist);
		$viewParams['itemlist'] = $itemlist;

        $listHtml=view('stock/stock_move_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
	}

	function stock_move_excel() {
		$this->Params['rcnt']=0;
        $this->Params['page']=1;

        $rows=$this->stock_model->getStockMoveList($this->Params);


		$totCnt = count($rows);
        if($totCnt<1) return;

		$options['searchWord'] = $this->Params['searchWord'];
		$options['nogroup'] = 'Y';
		$options['rcnt']=0;
		$options['page']=1;
		$options['searchKind'] = 'B';

		$i=0;
        foreach($rows as $row) {
			$mrows[$i] = $row['rowcnt'];
            $datas[$i]['no'] = $totCnt--;
            $datas[$i]['reg_date'] = substr($row['reg_date'],0,10);
            $datas[$i]['sm_num'] = $row['sm_num'];
            $datas[$i]['out_store'] = $this->setting['code']['Storage'][$row['sm_in_store']]['cd_name'];
			$datas[$i]['in_store'] = $this->setting['code']['Storage'][$row['sm_out_store']]['cd_name'];


            $options['sm_num'] = $row['sm_num'];
			$irows = $this->stock_model->getStockMoveList($options);

            foreach($irows as $row2) {
				$datas[$i]['ct_name'] = $row2['ct_name'];
				$datas[$i]['kind_name'] = $row2['kind_name'];
				$datas[$i]['sm_pd_name'] = $row2['sm_pd_name'];
				$datas[$i]['sm_qea'] = number_format($row2['sm_qea']);
				$datas[$i]['od_code'] = $row2['od_code'];
				$datas[$i]['reg_name'] = $row2['reg_name'];
				$datas[$i]['reg_name'] = $row2['reg_name'];
				$datas[$i]['sm_memo'] = $row2['sm_memo'];
				if($row2['sm_in_mn_pid']) {
					$datas[$i]['in_name'] = $row2['sm_in_mn_pid']."(".$row2['sm_in_date'].")";
				} else {
					$datas[$i]['in_name'] = '';
				}
				if($row2['sm_out_mn_pid']) {
					$datas[$i]['out_memo'] = $row2['sm_out_mn_pid']."(".$row2['sm_out_date'].")";
				} else {
					$datas[$i]['out_memo'] = '';
				}
				$i++;
			}
        }
//print_r($datas);
//debug($datas); exit;
        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(20, 'reg_date',  '등록일'),
            'C' => array(20, 'sm_num', '이동번호'),
            'D' => array(20, 'out_store', '보낸창고'),
            'E' => array(20, 'in_store', '받는창고'),
            'F' => array(20, 'ct_name', '거래처'),
            'G' => array(20, 'kind_name', '구분'),
            'H' => array(20, 'sm_pd_name', '제품명'),
            'I' => array(20, 'sm_qea', '이동수량'),
            'J' => array(20, 'reg_name', '등록자'),
            'K' => array(20, 'sm_memo', '비고'),
            'L' => array(20, 'in_name', '보낸창고승인'),
            'M' => array(20, 'out_memo', '받는창고승인')

        );



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

		$mkey = array('A','B','C','D','E');
        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
				if($mrows[$i-2] > 1 && (in_array($key, $mkey))) {
					$sheet->mergeCells($key.$i.":".$key.($i+$mrows[$i-2]-1));
				}
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_'.get_cookie('pk_name').'_move';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;

    }

	public function stock_check()
	{
		$viewParams=$this->Params;

		$options['type'] = 'pid';
		$options['where'] = 'p_pc_pid is null';
		$pd_cate = $this->pcmanager_model->getCategorys($options);
		$options2['type'] = 'pid';
		$options2['where'] = 'p_tc_pid is null';
		$pt_cate = $this->pcmanager_model->getPartCategorys($options2);


		$viewParams['pd_cate'] = $pd_cate;
		$viewParams['pt_cate'] = $pt_cate;

        $this->_header();
        echo view('stock/stock_check', $viewParams);
        $this->_footer();
	}

	public function stock_check_data()
	{
		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;

        $viewParams=$this->Params;
        $rows=$this->stock_model->getStockCheckList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->si_state;
		$viewParams['setting'] = $this->setting;

		$options['type'] = 'pid';
		$options['where'] = 'p_pc_pid is null';
		$pd_cate = $this->pcmanager_model->getCategorys($options);
		$options2['type'] = 'pid';
		$options2['where'] = 'p_tc_pid is null';
		$pt_cate = $this->pcmanager_model->getPartCategorys($options2);

		$viewParams['pd_cate'] = $pd_cate;
		$viewParams['pt_cate'] = $pt_cate;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);



//print_r($itemlist);
		$viewParams['itemlist'] = $itemlist;

        $listHtml=view('stock/stock_check_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
	}

	public function stock_check_item()
	{
		$this->Params['rcnt'] = 0;
		$this->Params['page'] = 1;

		$rows=$this->stock_model->getStockCheckItemList($this->Params);

		$totCnt=$this->stock_model->found_rows()["total"];

		$viewParams['num'] = $totCnt;
		$viewParams['rows'] = $rows;
		$viewParams['totCnt'] = $totCnt;

		$options['page'] = '1';
		$options['rcnt'] = '0';
		$pd_rows = $this->pcmanager_model->getProductList($options);

		foreach($pd_rows as $row) {
			$pd_data[$row['pd_pid']] = $row;
		}
		$pt_rows = $this->pcmanager_model->getPartsList($options);
		foreach($pt_rows as $row) {
			$pt_data[$row['pt_pid']] = $row;
		}

		$viewParams['pd_data'] = $pd_data;
		$viewParams['pt_data'] = $pt_data;

		$options['type'] = 'js';
		$pd_cate = $this->pcmanager_model->getCategorys($options);
		$options2['type'] = 'js';
		$pt_cate = $this->pcmanager_model->getPartCategorys($options2);

		$viewParams['pd_cate'] = $pd_cate;
		$viewParams['pt_cate'] = $pt_cate;

		$listHtml=view('stock/pop_check_list_data', $viewParams);
		echo json_encode(array('html'=>$listHtml));
	}

	public function stock_check_item_excel()
	{
		$this->Params['rcnt'] = 0;
		$this->Params['page'] = 1;

		$rows=$this->stock_model->getStockCheckItemList($this->Params);

		$totCnt=$this->stock_model->found_rows()["total"];



		$options['page'] = '1';
		$options['rcnt'] = '0';
		$pd_rows = $this->pcmanager_model->getProductList($options);

		foreach($pd_rows as $row) {
			$pd_data[$row['pd_pid']] = $row;
		}
		$pt_rows = $this->pcmanager_model->getPartsList($options);
		foreach($pt_rows as $row) {
			$pt_data[$row['pt_pid']] = $row;
		}

		$options['type'] = 'js';
		$pd_cate = $this->pcmanager_model->getCategorys($options);
		$options2['type'] = 'js';
		$pt_cate = $this->pcmanager_model->getPartCategorys($options2);

		foreach($rows as $i=>$row) {

			if($row['st_kind'] == 'A') {
				$kind = '상품';
				$c1 = substr($pd_data[$row['pd_pid']]['pd_pc_code'],0,3);
				$c2 = substr($pd_data[$row['pd_pid']]['pd_pc_code'],3,3);
				$c3 = substr($pd_data[$row['pd_pid']]['pd_pc_code'],6,3);
				if($c3 != '000') {
					$category = $pd_cate[$c1][$c2][$c3]['name'];
				} else if($c2 != '000') {
					$category = $pd_cate[$c1][$c2]['name'];
				} else {
					$category = $pd_cate[$c1]['name'];
				}
				$code = $pd_data[$row['pd_pid']]['pd_code'];
				$name = $pd_data[$row['pd_pid']]['pd_name'];
			} else {
				$kind = '부품';
				$c1 = substr($pd_data[$row['pd_pid']]['pt_pc_code'],0,3);
				$c2 = substr($pd_data[$row['pd_pid']]['pt_pc_code'],3,3);
				$c3 = substr($pd_data[$row['pd_pid']]['pt_pc_code'],6,3);
				if($c3 != '000') {
					$category = $pt_cate[$c1][$c2][$c3]['name'];
				} else if($c2 != '000') {
					$category = $pt_cate[$c1][$c2]['name'];
				} else {
					$category = $pt_cate[$c1]['name'];
				}
				$code = $pt_data[$row['pd_pid']]['pt_code'];
				$name = $pt_data[$row['pd_pid']]['pt_name'];
			}

			$mrows[$i] = $row['rowcnt'];
            $datas[$i]['no'] = $totCnt--;
            $datas[$i]['ct_name'] = $row['ct_name'];
            $datas[$i]['kind'] = $kind;
            $datas[$i]['category'] = $category;
            $datas[$i]['code'] = $code;
            $datas[$i]['name'] = $name;
            $datas[$i]['si_qea'] = number_format($row['si_qea']);
			$datas[$i]['st_qea'] = number_format($row['st_qea']);
			$datas[$i]['ad_qea'] = number_format($row['si_qea']-$row['st_qea']);
			$datas[$i]['disum'] = number_format($row['disum']);

        }
//print_r($datas);
//debug($datas); exit;
        $cells = array(
            'A' => array(15, 'no', 'No'),
            'C' => array(20, 'ct_name', '거래처'),
            'D' => array(20, 'kind', '구분'),
            'E' => array(20, 'category', '카테고리'),
            'F' => array(20, 'code', '상품코드'),
            'G' => array(20, 'name', '상품'),
            'H' => array(20, 'si_qea', '실사재고'),
            'I' => array(20, 'st_qea', '현재고'),
            'J' => array(20, 'ad_qea', '차이수량')
        );



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }


        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_'.get_cookie('pk_name').'_stock_status';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
	}

	public function stock_adjust()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('stock/stock_adjust', $viewParams);
        $this->_footer();
	}

	public function stock_adjust_data()
	{
		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;

        $viewParams=$this->Params;
        $rows=$this->stock_model->getStockAdjustList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->si_state;
		$viewParams['setting'] = $this->setting;

		$options['page'] = '1';
		$options['rcnt'] = '0';
		$pd_rows = $this->pcmanager_model->getProductList($options);

		foreach($pd_rows as $row) {
			$pd_data[$row['pd_pid']] = $row;
		}
		$pt_rows = $this->pcmanager_model->getPartsList($options);
		foreach($pt_rows as $row) {
			$pt_data[$row['pt_pid']] = $row;
		}

		$viewParams['pd_data'] = $pd_data;
		$viewParams['pt_data'] = $pt_data;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);



//print_r($itemlist);
		$viewParams['itemlist'] = $itemlist;

        $listHtml=view('stock/stock_adjust_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
	}

	public function stock_adjust_excel()
	{
		$this->Params['rcnt'] = 0;
		$this->Params['page'] = 1;

        $viewParams=$this->Params;
        $rows=$this->stock_model->getStockAdjustList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];

		$options['page'] = '1';
		$options['rcnt'] = '0';
		$pd_rows = $this->pcmanager_model->getProductList($options);

		foreach($pd_rows as $row) {
			$pd_data[$row['pd_pid']] = $row;
		}
		$pt_rows = $this->pcmanager_model->getPartsList($options);
		foreach($pt_rows as $row) {
			$pt_data[$row['pt_pid']] = $row;
		}

		foreach($rows as $i=>$row) {

			if($row['sa_p_kind'] == 'A') {
				$kind = '상품';
				$c1 = substr($pd_data[$row['pd_pid']]['pd_pc_code'],0,3);
				$c2 = substr($pd_data[$row['pd_pid']]['pd_pc_code'],3,3);
				$c3 = substr($pd_data[$row['pd_pid']]['pd_pc_code'],6,3);
				if($c3 != '000') {
					$category = $pd_cate[$c1][$c2][$c3]['name'];
				} else if($c2 != '000') {
					$category = $pd_cate[$c1][$c2]['name'];
				} else {
					$category = $pd_cate[$c1]['name'];
				}
				$code = $pd_data[$row['pd_pid']]['pd_code'];
				$name = $pd_data[$row['pd_pid']]['pd_name'];
			} else {
				$kind = '부품';
				$c1 = substr($pd_data[$row['pd_pid']]['pt_pc_code'],0,3);
				$c2 = substr($pd_data[$row['pd_pid']]['pt_pc_code'],3,3);
				$c3 = substr($pd_data[$row['pd_pid']]['pt_pc_code'],6,3);
				if($c3 != '000') {
					$category = $pt_cate[$c1][$c2][$c3]['name'];
				} else if($c2 != '000') {
					$category = $pt_cate[$c1][$c2]['name'];
				} else {
					$category = $pt_cate[$c1]['name'];
				}
				$code = $pt_data[$row['pd_pid']]['pt_code'];
				$name = $pt_data[$row['pd_pid']]['pt_name'];
			}

			$mrows[$i] = $row['rowcnt'];
            $datas[$i]['no'] = $totCnt--;
            $datas[$i]['sa_store'] = $this->setting["code"]["Storage"][$row['sa_store']]["cd_name"];
            $datas[$i]['kind'] = $kind;
            $datas[$i]['code'] = $code;
            $datas[$i]['name'] = $name;
            $datas[$i]['st_qea'] = number_format($row['st_qea']);
			$datas[$i]['sa_qea'] = number_format($row['sa_qea']);
			$datas[$i]['ad_qea'] = number_format($row['sa_qea']-$row['st_qea']);
			$datas[$i]['reg_name'] = ($row['reg_id']);
			$datas[$i]['sa_kind'] = $this->setting["code"]["sa_kind"][$row['sa_kind']];
			$datas[$i]['sa_memo'] = $row['sa_memo'];

        }
//print_r($datas);
//debug($datas); exit;
        $cells = array(
            'A' => array(15, 'no', 'No'),
            'C' => array(20, 'sa_store', '창고'),
            'D' => array(20, 'kind', '구분'),
            'E' => array(20, 'code', '상품코드'),
            'F' => array(20, 'name', '제품명'),
            'G' => array(20, 'st_qea', '조정전'),
            'H' => array(20, 'sa_qea', '조정후'),
            'I' => array(20, 'ad_qea', '조정수량'),
			'J' => array(20, 'reg_name', '등록자'),
			'K' => array(20, 'sa_kind', '유형'),
			'L' => array(20, 'sa_memo', '비고')
        );



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }


        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_'.get_cookie('pk_name').'_stock_adjust';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;

	}

	public function parts_stock()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('stock/parts_stock', $viewParams);
        $this->_footer();
	}

	public function parts_stock_data()
	{
		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;

        $this->Params['searchKind']="B";
		$viewParams=$this->Params;
        $rows=$this->stock_model->getStockStatusList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->si_state;
		$viewParams['setting'] = $this->setting;

		$pt_rows = $this->pcmanager_model->getPartsList($options);
		foreach($pt_rows as $row) {
			$pt_data[$row['pt_pid']] = $row;
		}

		$options2['type'] = 'pid';
		$pt_cate = $this->pcmanager_model->getPartCategorys($options2);

		$viewParams['pt_cate'] = $pt_cate;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);



//print_r($itemlist);
		$viewParams['itemlist'] = $itemlist;

        $listHtml=view('stock/parts_stock_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
	}

	public function parts_stock_excel()
	{
		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;

        $this->Params['searchKind']="B";
		$viewParams=$this->Params;
        $rows=$this->stock_model->getStockStatusList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->si_state;
		$viewParams['setting'] = $this->setting;

		$pt_rows = $this->pcmanager_model->getPartsList($options);
		foreach($pt_rows as $row) {
			$pt_data[$row['pt_pid']] = $row;
		}

		$options2['type'] = 'pid';
		$pt_cate = $this->pcmanager_model->getPartCategorys($options2);

		foreach($rows as $i=>$row) {

			$category = $pt_cate[$row['pt_tc_pid1']]['tc_name'];
			if($row['pt_tc_pid2']) {
				$category .= " > ".$pt_cate[$row['pt_tc_pid2']]['tc_name'];
			}

			$mrows[$i] = $row['rowcnt'];
            $datas[$i]['no'] = $totCnt--;
            $datas[$i]['st_store'] = $this->setting["code"]["Storage"][$row['st_store']]["cd_name"];
            $datas[$i]['ct_name'] = $row['ct_name'];
            $datas[$i]['category'] = $category;
            $datas[$i]['pt_name'] = $row['pt_name'];
            $datas[$i]['pt_out_price'] = number_format($row['pt_out_price']);
			$datas[$i]['pt_wages'] = number_format($row['pt_wages']);
			$datas[$i]['st_qea'] = number_format($row['st_qea']);
			$datas[$i]['disum'] = number_format($row['disum']);
			$datas[$i]['m_out'] = number_format($row['disum']);
			$datas[$i]['m_in'] = number_format($row['disum']);

        }
//print_r($datas);
//debug($datas); exit;
        $cells = array(
            'A' => array(15, 'no', 'No'),
            'C' => array(20, 'st_store', '창고'),
            'D' => array(20, 'ct_name', '매입처'),
            'E' => array(20, 'category', '카테고리'),
            'F' => array(20, 'pt_name', '부품명'),
            'G' => array(20, 'pt_out_price', '부품가'),
            'H' => array(20, 'pt_wages', '공임비'),
            'I' => array(20, 'st_qea', '현재고'),
			'J' => array(20, 'disum', '폐기재고'),
			'K' => array(20, 'm_out', '기사출고'),
			'L' => array(20, 'm_in', '기사반입')
        );



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }


        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_'.get_cookie('pk_name').'_stock_part';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
	}

	public function parts_request()
	{
		$viewParams=$this->Params;
		$partCategorysJS=$this->pcmanager_model->getPartCategorys(array('type'=>'js'));

		$viewParams['partCategorysJS'] = $partCategorysJS;


        $this->_header();
        echo view('stock/parts_request', $viewParams);
        $this->_footer();
	}

	public function parts_request_data()
	{

		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;

        $this->Params['searchKind']="B";
		$viewParams=$this->Params;
        $rows=$this->stock_model->getStockPartRequstList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->si_state;
		$viewParams['setting'] = $this->setting;

		$options['rcnt'] = 0;
		$options['page'] = 1;
		$options['nogroup'] = 'Y';
		$options['searchMn'] = $this->Params['searchMn'];
		foreach($rows as $row) {
			$options['pi_pid'] = $row['pi_pid'];
			$itemlist[$row['pi_pid']] = $this->stock_model->getStockPartRequstList($options);
		}

		$options2['rcnt'] = 0;
		$options2['page'] = 1;
		$pt_rows = $this->pcmanager_model->getPartsList($options2);
		foreach($pt_rows as $row) {
			$pt_data[$row['pt_pid']] = $row;
		}

		$viewParams['pt_data'] = $pt_data;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);



//print_r($itemlist);
		$viewParams['itemlist'] = $itemlist;

        $listHtml=view('stock/parts_request_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
	}

	public function parts_request_excel()
	{

		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;

        $this->Params['searchKind']="B";
		$viewParams=$this->Params;
        $rows=$this->stock_model->getStockPartRequstList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];

		$options = $this->Params;
		$options['rcnt'] = 0;
		$options['page'] = 1;
		$options['nogroup'] = 'Y';


		$options2['rcnt'] = 0;
		$options2['page'] = 1;
		$pt_rows = $this->pcmanager_model->getPartsList($options2);
		foreach($pt_rows as $row) {
			$pt_data[$row['pt_pid']] = $row;
		}

		$i = 0;
		foreach($rows as $row) {
			$options['pi_pid'] = $row['pi_pid'];
			$rows2 = $this->stock_model->getStockPartRequstList($options);

			$category = $pt_cate[$row['pt_tc_pid1']]['tc_name'];
			if($row['pt_tc_pid2']) {
				$category .= " > ".$pt_cate[$row['pt_tc_pid2']]['tc_name'];
			}

			$mrows[$i] = $row['rowcnt'];
            $datas[$i]['no'] = $totCnt--;
			$datas[$i]['reg_date'] = substr($row['reg_date'],0,10);
			$datas[$i]['pi_kind'] = ($row['pi_kind'] == 'A' ? '출고':'반입');
			$datas[$i]['pi_state'] = $this->setting['code']['pi_state'][$row['pi_state']];
			$datas[$i]['pi_mn_pid'] = $this->setting['manager'][$row['pi_mn_pid']]['mn_name'];
            foreach($rows2 as $row2) {
			$datas[$i]['pt_code'] = $pt_data[$row2['pt_pid']]['pt_code'];
			$datas[$i]['pt_name'] = $row2['pt_name'];
			$datas[$i]['ii_qea'] = number_format($row['ii_qea']);
			$datas[$i]['pi_store'] = $this->setting["code"]["Storage"][$row['pi_store']]["cd_name"];
            $datas[$i]['pi_confirm_date'] = $row['pi_confirm_date'];
            $datas[$i]['ii_real_qea'] = number_format($row2['ii_real_qea']);
			$datas[$i]['pi_memo'] = $row['pi_memo'];
        	$i++;
			}

        }
//print_r($datas);
//debug($datas); exit;
        $cells = array(
            'A' => array(15, 'no', 'No'),
            'C' => array(20, 'reg_date', '요청일'),
            'D' => array(20, 'pi_kind', '구분'),
            'E' => array(20, 'pi_state', '상태'),
            'F' => array(20, 'pi_mn_pid', '요청자'),
            'G' => array(20, 'pt_code', '부품코드'),
            'H' => array(20, 'pt_name', '부품명'),
            'I' => array(20, 'ii_qea', '요청수량'),
			'J' => array(20, 'pi_store', '창고'),
			'K' => array(20, 'pi_confirm_date', '처리일시'),
			'L' => array(20, 'ii_real_qea', '처리수량'),
			'M' => array(20, 'pi_memo', '비고')
        );



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }


        $mkey = array('A','B','C','D','E','I','J','L');
        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
				if($mrows[$i-2] > 1 && (in_array($key, $mkey))) {
					$sheet->mergeCells($key.$i.":".$key.($i+$mrows[$i-2]-1));
				}
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }
        $filename = date('Ymd').'_'.get_cookie('pk_name').'_stock_part_request';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
	}

	public function parts_disposal()
	{
		$viewParams=$this->Params;
		$partCategorysJS=$this->pcmanager_model->getPartCategorys(array('type'=>'js'));

		$viewParams['partCategorysJS'] = $partCategorysJS;

        $this->_header();
        echo view('stock/parts_disposal', $viewParams);
        $this->_footer();
	}

	public function parts_disposal_data()
	{

		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;

        $this->Params['searchKind']="B";
		$viewParams=$this->Params;
        $rows=$this->stock_model->getStockPartDisposalList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->si_state;
		$viewParams['setting'] = $this->setting;


		$options = $this->Params;
		$options['rcnt'] = 0;
		$options['page'] = 1;
		$options['nogroup'] = 'Y';

		foreach($rows as $row) {
			$options['ds_pid'] = $row['ds_pid'];
			$itemlist[$row['pi_pid']] = $this->stock_model->getStockPartDisposalList($options);
		}

		$options2['rcnt'] = 0;
		$options2['page'] = 1;
		$pt_rows = $this->pcmanager_model->getPartsList($options2);
		foreach($pt_rows as $row) {
			$pt_data[$row['pt_pid']] = $row;
		}

		$viewParams['pt_data'] = $pt_data;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);



//print_r($itemlist);
		$viewParams['itemlist'] = $itemlist;

        $listHtml=view('stock/parts_disposal_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
	}

	public function parts_disposal_excel()
	{

		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;

        $this->Params['searchKind']="B";
		$viewParams=$this->Params;
        $rows=$this->stock_model->getStockPartDisposalList($this->Params);
		//debug($this->stock_model);
        unset($this->Params['page']);
        $totCnt=$this->stock_model->found_rows()["total"];

		$options = $this->Params;
		$options['rcnt'] = 0;
		$options['page'] = 1;
		$options['nogroup'] = 'Y';


		$options2['rcnt'] = 0;
		$options2['page'] = 1;
		$pt_rows = $this->pcmanager_model->getPartsList($options2);
		foreach($pt_rows as $row) {
			$pt_data[$row['pt_pid']] = $row;
		}

		$i = 0;
		foreach($rows as $row) {
			$options['pi_pid'] = $row['pi_pid'];
			$rows2 = $this->stock_model->getStockPartDisposalList($options);

			$category = $pt_cate[$row['pt_tc_pid1']]['tc_name'];
			if($row['pt_tc_pid2']) {
				$category .= " > ".$pt_cate[$row['pt_tc_pid2']]['tc_name'];
			}

			$mrows[$i] = $row['rowcnt'];
            $datas[$i]['no'] = $totCnt--;
			$datas[$i]['reg_date'] = substr($row['reg_date'],0,10);
			$datas[$i]['reg_id'] = $this->setting['manager'][$row['reg_id']]['mn_name'];
			$datas[$i]['ds_memo'] = $row['ds_memo'];



            foreach($rows2 as $row2) {
			$datas[$i]['pt_code'] = $pt_data[$row2['pt_pid']]['pt_code'];
			$datas[$i]['pt_name'] = $row2['pt_name'];
			$datas[$i]['di_qea'] = number_format($row['di_qea']);
			$datas[$i]['ds_sotre'] = $this->setting["code"]["Storage"][$row['ds_sotre']]["cd_name"];
			$datas[$i]['di_kind'] = $this->setting['code']['ASDis'][$row['di_kind']]["cd_name"];
        	$i++;
			}

        }
//print_r($datas);
//debug($datas); exit;
        $cells = array(
            'A' => array(15, 'no', 'No'),
            'C' => array(20, 'reg_date', '폐기일'),
            'D' => array(20, 'reg_id', '처리자'),
            'E' => array(20, 'as_num', 'AS접수번호'),
            'F' => array(20, 'ds_sotre', '창고'),
            'G' => array(20, 'category', '카테고리'),
            'H' => array(20, 'pt_name', '부품명'),
            'I' => array(20, 'di_qea', '수량'),
			'J' => array(20, 'di_kind', '사유'),
			'K' => array(20, 'ds_memo', '비고')
        );



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }


        $mkey = array('A','B','C','D','E','I','J','L');
        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
				if($mrows[$i-2] > 1 && (in_array($key, $mkey))) {
					$sheet->mergeCells($key.$i.":".$key.($i+$mrows[$i-2]-1));
				}
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }
        $filename = date('Ymd').'_'.get_cookie('pk_name').'_stock_part_request';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
	}

}