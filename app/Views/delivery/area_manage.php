
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <div class="search_box">
                        <div class="box_row">
                            <span>기사</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="area_base();">기본지역등록</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->

                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="">
                            <thead>
                                <tr>
                                    <th class="mWt50">No.</th>
                                    <th>기사명</th>
                                    <th>부서/직책</th>
                                    <th>업무</th>
                                    <th class="mWt600">담당지역</th>
                                    <th class="mWt80">설정</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td>김기사</td>
                                    <td>배송팀/팀장</td>
                                    <td>배송, AS</td>
                                    <td class="txal">서울,서울시,서울특별시 > 강남구,강동구,강서구</td>
                                    <td><button type="button" class="small set_button" onclick="area_set();">설정</button></td>
                                </tr>
                                <?}?>
                            </tbody>
                        </table>
                    </div> <!-- table_wrap -->

					<div class="mResultTablePage mContentWrap" id="">
						<div class="pageFirstButton pageButton">
							<img src="../common/img/button_list_big1_first.png" class="" alt="처음으로" >
						</div>
						<div class="pagePrevButton pageButton">
							<img src="../common/img/button_list_big1_prev.png" alt="이전으로" >
						</div>
						<div class="pageNum"><span class="on">1</span><span>2</span></div>
						<div class="pageNextButton pageButton">
							<img src="../common/img/button_list_big1_next.png" alt="다음으로" >
						</div>
						<div class="pageLastButton pageButton">
							<img src="../common/img/button_list_big1_last.png" alt="마지막으로" >
						</div>
					</div> <!-- mResultTablePage -->
                </div> <!-- contents -->
            </section>


        <?
            include_once "pop_area_set.php"; // 지역설정
            include_once "pop_area_base.php"; // 기본지역등록
            include_once "pop_area_manage.php"; // 지역관리
        ?>

<script type="text/javascript">
    // 지역설정
    function area_set(){
        modal('pop_area_set');
    }

    // 기본지역등록
    function area_base(){
        modal('pop_area_base');
    }
</script>