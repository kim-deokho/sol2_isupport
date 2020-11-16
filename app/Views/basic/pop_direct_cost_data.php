<table class="ltable_1" id="">
	<thead>
		<tr>
			<th>명칭</th>
			<th class="mWt100">기준수량</th>
			<th class="mWt150">금액</th>
			<th class="mWt150">관리</th>
		</tr>
	</thead>
	<tbody id="">
		<?
		if(count($rows) > 0) {
		foreach($rows as $d_row) {
		?>
		<tr>
			<td><?=$d_row['dc_name']?></td>
			<td><?=$d_row['dc_delivery_charge_cnt']?></td>
			<td><?=number_format($d_row['dc_delivery_charge'])?></td>
			<td>
				<button type="button" class="small set_button" onclick="mod_dcharge('<?=$d_row['dc_pid']?>','<?=$d_row['dc_name']?>','<?=$d_row['dc_delivery_charge_cnt']?>','<?=$d_row['dc_delivery_charge']?>')">수정</button>
				<button type="button" class="small bt_red" onclick="confirmBox('삭제 하시겠습니까?', del_dcharge, '<?=$d_row['dc_pid']?>')">삭제</button>
			</td>
		</tr>
		<?}}?>
	</tbody>
</table>