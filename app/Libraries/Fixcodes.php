<?php
namespace App\Libraries;

class Fixcodes {
    // 거래처구분
    public $TraderKind=array(
        'A'=>'매출처'
        ,'B'=>'매입처'
        ,'C'=>'매입매출처'
        ,'D'=>'기타'
    );

    // 배송타입
    public $DeliveryType=array(
        'A'=>'택배'
        ,'B'=>'기사'
    );

    // 배송비설정
    public $DeliverySetting=array(
        'A'=>'기본배송비'
        ,'B'=>'개별배송비'
        ,'C'=>'직배송비'
        ,'D'=>'수량별 배송비'
    );
}