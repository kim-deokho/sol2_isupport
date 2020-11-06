<table class="ltable_1 t_effect_1" id="">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th>상담일시</th>
			<th>인/아웃</th>
			<th>상담종류</th>
			<th class="mWt300">상담내용</th>
			<th>고객코드</th>
			<th>이름</th>
			<th>전화</th>
			<th>처리상태</th>
			<th>상담자</th>
			<th>녹취</th>
		</tr>
	</thead>
	<tbody id="">
		<?for($i=20;$i>0;$i--){?>
		<tr>
			<td><?=$i?></td>
			<td>2020-02-02 21:22:33</td>
			<td>아웃</td>
			<td>주문문의</td>
			<td>상담내용</td>
			<td>443433</td>
			<td>홍길동</td>
			<td>010-1234-2345</td>
			<td>처리중</td>
			<td>김상담</td>
			<td><button type="button" class="small set_button" onclick="">듣기</button></td>
		</tr>
		<?}?>
	</tbody>
</table>