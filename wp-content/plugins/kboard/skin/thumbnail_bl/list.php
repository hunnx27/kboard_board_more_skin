<div id="kboard-thumbnail-list">
	<!-- 임시 -->
	<div>
		<ul>
			<li><button class="kboard-cross-link-button-small" onclick="return list_more(this, '<?php echo $board->id?>')">더 보기</button></li>
			<li><input type="text" name="kboard_cross_link_page"></li>
		</ul>
		<div id="kboard-cross-link-list">
			<div class="kboard-list" style="border:1px solid #efefef;">
			</div> 
		</div>
	</div>
	<script>
		var page = 0;
		function list_more(obj, board_id){
			var keyword = jQuery('input[name=keyword]').val();
			var page_url = kboard_settings.ajax_url;
			//var page_url = "/";
			var page = jQuery('input[name=kboard_cross_link_page]').val();
			var category1 = jQuery('input[name=kboard_cross_link_category1]').val();
			var category2 = jQuery('input[name=kboard_cross_link_category2]').val();
			var setuprpp = '<?php echo $board->page_rpp ?>';
			page++;
			jQuery.get(page_url, {action:'kboard_ajax_list_more', board_id:board_id, pageid:page, keyword:keyword, category1:category1, category2:category2, rpp:setuprpp}, function(data){
				data = data.replace(/(^\s*)|(\s*$)/gi, "");				
				if(data){
					jQuery('.kboard-list.bl_galley ul.grid-container').append(data);
					jQuery('input[name=kboard_cross_link_page]').val(page);
				}
				else{
					alert('더 이상 표시 할 데이터가 없습니다.');
				}
			}, 'text');

			return false;
		}
		jQuery(document).ready(function(){ 
			list_more(null, '<?php echo $board->id?>');
		});
		
	</script>

	<!-- 게시판 정보 시작 -->
	<div class="kboard-list-header">
		<?php if(!$board->isPrivate()):?>
			<div class="kboard-total-count">
				<?php echo __('Total', 'kboard')?> <?php echo number_format($board->getListTotal())?>
			</div>
		<?php endif?>
		
		<div class="kboard-sort">
			<form id="kboard-sort-form-<?php echo $board->id?>" method="get" action="<?php echo esc_url($url->toString())?>">
				<?php echo $url->set('pageid', '1')->set('category1', '')->set('category2', '')->set('target', '')->set('keyword', '')->set('mod', 'list')->set('kboard_list_sort_remember', $board->id)->toInput()?>
				
				<select name="kboard_list_sort" onchange="jQuery('#kboard-sort-form-<?php echo $board->id?>').submit();">
					<option value="newest"<?php if($list->getSorting() == 'newest'):?> selected<?php endif?>><?php echo __('Newest', 'kboard')?></option>
					<option value="best"<?php if($list->getSorting() == 'best'):?> selected<?php endif?>><?php echo __('Best', 'kboard')?></option>
					<option value="viewed"<?php if($list->getSorting() == 'viewed'):?> selected<?php endif?>><?php echo __('Viewed', 'kboard')?></option>
					<option value="updated"<?php if($list->getSorting() == 'updated'):?> selected<?php endif?>><?php echo __('Updated', 'kboard')?></option>
				</select>
			</form>
		</div>
	</div>
	<!-- 게시판 정보 끝 -->

	<!-- 검색폼 시작 -->
		<div class="kboard-search">
		<form id="kboard-search-form-<?php echo $board->id?>" method="get" action="<?php echo esc_url($url->toString())?>">
			<?php echo $url->set('pageid', '1')->set('target', '')->set('keyword', '')->set('mod', 'list')->toInput()?>
			
			<select name="target">
				<option value=""><?php echo __('All', 'kboard')?></option>
				<option value="title"<?php if(kboard_target() == 'title'):?> selected<?php endif?>><?php echo __('Title', 'kboard')?></option>
				<option value="content"<?php if(kboard_target() == 'content'):?> selected<?php endif?>><?php echo __('Content', 'kboard')?></option>
				<option value="member_display"<?php if(kboard_target() == 'member_display'):?> selected<?php endif?>><?php echo __('Author', 'kboard')?></option>
			</select>
			<input type="text" name="keyword" value="<?php echo esc_attr(kboard_keyword())?>">
			<button type="submit" class="kboard-thumbnail-button-small"><?php echo __('Search', 'kboard')?></button>
		</form>
	</div>
	<!-- 검색폼 끝 -->
	
	<!-- 카테고리 시작 -->
	<?php
	if($board->use_category == 'yes'){
		if($board->isTreeCategoryActive()){
			$category_type = 'tree-select';
		}
		else{
			$category_type = 'default';
		}
		$category_type = apply_filters('kboard_skin_category_type', $category_type, $board, $boardBuilder);
		echo $skin->load($board->skin, "list-category-{$category_type}.php", $vars);
	}
	?>
	<!-- 카테고리 끝 -->
	
	<?php if($board->isWriter()):?>
	<!-- 버튼 시작 -->
	<div class="kboard-control">
		<a href="<?php echo esc_url($url->getContentEditor())?>" class="kboard-thumbnail-button-small"><?php echo __('New', 'kboard')?></a>
	</div>
	<!-- 버튼 끝 -->
	<?php endif?>

	<!-- 리스트 시작 -->
	<div class="kboard-list bl_galley">
		<div class="bl_galley_list">
				<ul class="grid-container">
				</ul>
		</div>
	</div>
	<!-- 리스트 끝 -->

<!--
<?php echo print_r($content) ?>
<br/>
<br/>
<br/>

<?php echo var_dump($board) ?>
-->
<!--
<input type="hidden" name="kboard_cross_link_page" value="1">
<input type="hidden" name="kboard_cross_link_category1" value="">
<input type="hidden" name="kboard_cross_link_category2" value="">
<input type="hidden" name="kboard_cross_link_current_page" value="">
<input type="hidden" name="kboard_cross_link_latest_board_url" value="<?php echo esc_url($url->getBoardList())?>">
<div class="kboard-pagination">
	<button class="kboard-cross-link-button-small" onclick="return kboard_cross_link_more_view(this, <?php echo $board->id?>)" title="더 보기">더 보기</button>
</div>
-->
	
	
	<?php if($board->contribution()):?>
	<div class="kboard-thumbnail-poweredby" style="opacity:0.0;">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
	</div>
	<?php endif?>
</div>
