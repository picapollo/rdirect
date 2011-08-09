<table cellspacing="0" id="calendar_table">
<tbody>
    <tr>
        <th>일</th>
        <th>월</th>
        <th>화</th>
        <th>수</th>
        <th>목</th>
        <th>금</th>
        <th>토</th>
    </tr>
    <?php foreach($cal as $k => $i)
	{
		if( ! ($k % 7)){
			$day_type = "weekend";
			$tr_open = '<tr>';
			$tr_close = '';
		}
		else if ( ! (($k+1)%7)){
			$day_type = "weekend";
			$tr_open = '';
			$tr_close = '</tr>';
		}
		else
		{
			$day_type = "real_day";
			$tr_open = '';
			$tr_close = '';
		}		
		
		if($i->disabled)
		{
			$isa = 'in_the_past';
			$price = '';
		}
		else if($i->isa)
		{
			$isa = 'available';
			$price = "<br/><div id=\"day_extra_$k\" class=\"extra\">".CURRENT_CURRENCY_SYMBOL." $i->price</div>";
		}
		else
		{
			$isa = 'unavailable';
			$price = '';
		}
		
		echo "$tr_open\n<td id=\"day_$k\" class=\"$day_type $isa\">\n";
		echo "<span class=\"dom\">{$i->d}</span>\n$price\n</td>\n$tr_close";
	}
?>
</tbody></table>
