<?php

function build_query_with_page($opt, $page){
	$opt['page'] = $page;
	return http_build_query($opt);
}

?>

<?php if ($page_total > 1): ?>
<div class="pagination">
	<?php if($current_page > 1): 
		$opt['page'] = 1;
	?>
	<a href="/search?<?=http_build_query($opt)?>" class="prev_page" rel="prev <?=$current_page==2?'start':''?>"><</a>
	<?php endif; ?>
	<a href="/search?<?=http_build_query($opt)?>" rel="<?=$i>$current_page?'next"> 2</a>
	<?php for($i = 2; $i <= $page_total; $i++): 
			if($i == $current_page):	
	?>
	<span class="current"><?=$i?></span>
	<?php else: ?>
	<a href="/search?<?=http_build_query($opt)?>" rel="<?=$i>$current_page?'next"> 2</a>
	<?php endif; endfor; ?>

	<?php if($current_page < $page_total): 
		$opt['page'] = $current_page + 1;
	?>
	<a href="/search?<?=http_build_query($opt)?>" class="next_page" rel="next <?=$current_page==$page_total-1?'start':''?>">></a>
	<?php endif; ?>
</div>
<?php endif; ?>