<?
if(count($rows)>0) {
    foreach($rows as $row) {
        $pay_kind_text='';
        if($row['aa_pay_kind']=='Y') {
            $pay_kind_text='<i>유상 '.number_format($row['aa_total_price']).'</i>';
            if($row['aa_payment_yn']!='Y') $pay_kind_text .= ' <i class="fce41">[미결제]</i>';
        }
        else if($row['aa_pay_kind']=='N') $pay_kind_text='<i>무상</i>';

        echo '<li onclick="detailForm(\''.$row['ma_pid'].'\')">';
        echo '    <div>예정일 : '.dateFormat('Y-m-d', $row['aa_visit_date']).' &#124; 처리일 : '.dateFormat('Y-m-d', $row['aa_result_date']).'</div>';
        echo '    <div>'.$row['ma_cut_name'].'('.$row['ma_cut_tel'].') '.$pay_kind_text.'</div>';
        echo '    <div>'.$row['ca_addr'].' '.$row['ca_addr2'].'</div>';
        echo '</li>';
    }
}
else echo '<li class="no_data">내역이 존재하지 않습니다.</li>';
?>