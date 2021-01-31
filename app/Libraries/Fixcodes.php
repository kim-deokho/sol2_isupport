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

    // AS상태
    public $AsState=array(
        '01'=>'AS요청'
        ,'11'=>'기사배정'
        ,'21'=>'방문예정'
        ,'31'=>'처리중'
        ,'41'=>'처리완료'
    );

    //AS 처리완료 값
    public $AsResultState=array(
        '0320'=>'정상처리'
        ,'0316'=>'미처리'
        ,'0318'=>'재방문'
        ,'0317'=>'방문연기'
        ,'0315'=>'접수취소'
    );

    // 카드사
    public $CardCompany=array('삼성카드', '현대카드', 'BC카드');

    // 
    public $disposalReasonCode=array(
        '11'=>'파손'
        ,'99'=>'기타'
    );
}