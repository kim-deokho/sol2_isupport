<table class="ltable_1" id="">
	<thead>
		<tr>
			<th class="mWt200">품명</th>
			<th class="mWt80">입고단가</th>
		</tr>
	</thead>
	<tbody id="p_list">
		<?foreach($rows as $row){?>
		<tr>
			<td><?=$row["pd_name"]?></td>
			<td><?=$row["pd_in_price"]?></td>
		</tr>
		<?}?>
	</tbody>
</table>