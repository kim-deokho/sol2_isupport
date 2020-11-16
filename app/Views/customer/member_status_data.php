<table class="ltable_1" id="" style="width:250%">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th>고객코드</th>
			<th>고객명</th>
			<th>가입일</th>
			<th>최종주문일</th>
			<th>최종통화일</th>
			<th>최종통화구분</th>
			<th>회원등급</th>
			<th>회원구분</th>
			<th>담당자</th>
			<th>주문건수</th>
			<th>결제금액</th>
			<th>입금금액</th>
			<th>미수금</th>
			<th>적립금</th>
			<th>상품권</th>
			<th>예치금</th>
			<th>가입경로</th>
			<th>이메일</th>
			<th>생년월일</th>
			<th>수신동의</th>
			<th>전화1</th>
			<th>전화2</th>
			<th>우편번호</th>
			<th>주소1</th>
			<th>주소2</th>
			<th>탈퇴여부</th>
		</tr>
	</thead>
	<?///class="tr_inactive"?>
	<tbody id="">
<?
    if($totCnt>0) {
        foreach($rows as $row) {
			$tmp = explode('|', $row['mb_last_tel']);

			$agree  = array();
			if($row['mb_info_agree'] == 'Y') {
				$agree[] = '개인정보';
			}

			if($row['mb_sms_agree'] == 'Y') {
				$agree[] = '문자';
			}

			if($row['mb_email_agree'] == 'Y') {
				$agree[] = '이메일';
			}

			if($row['mb_tel_agree'] == 'Y') {
				$agree[] = '전화';
			}

			$bigo = '';
			if($row['mb_dormant'] == 'Y') {
				$bigo = '휴면('.$row['mb_dormant_date'].')';
			}

			if($row['mb_withdrawal'] == 'Y') {
				$bigo = '탈퇴('.$row['mb_withdrawal_date'].')';
			}

            echo '<tr onclick="view_mb(\''.$row['mb_pid'].'\')">';
            echo '  <td>'.$num--.'</td>';
            echo '  <td>'.$row['mb_code'].'</td>';
			echo '  <td>'.$row['mb_name'].'</td>';
			echo '  <td>'.substr($row['reg_date'],0,10).'</td>';
			echo '  <td>'.substr($row['mb_last_order_date'],0,10).'</td>';
			echo '  <td>'.substr($tmp['0'],0,10).'</td>';
            echo '  <td>'.$setting['code']['Counkind2'][$tmp[1]]['cd_name'].'</td>';
            echo '  <td>'.$row['ml_pid'].'</td>';
			echo '  <td>'.($row['mb_kind'] == 'A' ? '일반':'기업').'</td>';
			echo '  <td>'.$row['dam_name'].'</td>';
            echo '  <td>'.number_format($row['mb_order_cnt']).'</td>';
			echo '  <td>'.number_format($row['mb_order_price']).'</td>';
			echo '  <td>'.number_format($row['mb_account_price']).'</td>';
			echo '  <td>'.number_format($row['mb_order_price']-$row['mb_account_price']).'</td>';
			echo '  <td>'.number_format($row['mb_point']).'</td>';
			echo '  <td>'.number_format($row['mb_gift']).'</td>';
			echo '  <td>'.number_format($row['mb_deposit']).'</td>';
			echo '  <td>'.$setting['code']['Inroot'][$row['mb_in_root']]['cd_name'].'</td>';
			echo '  <td>'.$row['mb_email'].'</td>';
			echo '  <td>'.$row['mb_birthday'].'</td>';
            echo '  <td>'.implode(',',$agree).'</td>';
			echo '  <td>'.$row['mb_tel1'].'</td>';
			echo '  <td>'.$row['mb_tel2'].'</td>';
            echo '  <td>'.$row['mb_post'].'</td>';
			echo '  <td>'.$row['mb_addr'].'</td>';
			echo '  <td>'.$row['mb_addr2'].'</td>';
			echo '  <td>'.$bigo.'</td>';
            echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>


	</tbody>
</table>