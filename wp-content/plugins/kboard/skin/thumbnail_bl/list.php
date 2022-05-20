<div id="kboard-thumbnail-list">
	<!-- 임시 -->
	<div>
		<ul>
			<li>게시판ID : <?php echo $board->id?></li>
			<!--<li><button onclick="return kboard_cross_link_more_view(this, '<?php echo $board->id?>')">더보기 테스트</button></li>-->
			<li><button onclick="return test(this, '<?php echo $board->id?>')">더보기 테스트</button></li>
		</ul>
		<div id="kboard-cross-link-list">
			<div class="kboard-list" style="border:1px solid #efefef;">
			</div> 
		</div>
	</div>
	<script>
		var page = 0;
		function test(obj, board_id){
			var keyword = jQuery('input[name=keyword]').val();
			var page_url = kboard_settings.ajax_url;
			var category1 = jQuery('input[name=kboard_cross_link_category1]').val();
			var category2 = jQuery('input[name=kboard_cross_link_category2]').val();
			page++;
			jQuery.get(page_url, {action:'kboard_ajax_list_more', board_id:board_id, pageid:page, keyword:keyword, category1:category1, category2:category2}, function(res){
				res = res.replace(/(^\s*)|(\s*$)/gi, "");				
				if(res){
					var rjson = JSON.parse(res);
					var rarr = rjson.data;
					for(var content : rarr){
						console.log(content)
					}
					console.log(rarr);
					//console.log(resJSON.data[0].uid);
					//console.log(echo esc_url($url->getDocumentURLWithUID($content->uid)))
					//jQuery('#kboard-cross-link-list .kboard-list').append(res);
					
				}
			}, 'text');

			return false;
		}		
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
					<!--
					<?php while($content = $list->hasNextNotice()):?>
					<tr class="kboard-list-notice<?php if($content->uid == kboard_uid()):?> kboard-list-selected<?php endif?>">
						<td class="kboard-list-uid"><?php echo __('Notice', 'kboard')?></td>
						<td class="kboard-list-thumbnail">
							<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">
							<?php if($content->getThumbnail(120, 90)):?><img src="<?php echo $content->getThumbnail(120, 90)?>" alt="<?php echo esc_attr($content->title)?>"><?php else:?><i class="icon-picture"></i><?php endif?>
							</a>
						</td>
						<td class="kboard-list-title">
							<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">
								<div class="kboard-thumbnail-cut-strings">
									<?php if($content->getThumbnail(96, 70)):?>
									<div class="kboard-mobile-contents">
										<img src="<?php echo $content->getThumbnail(96, 70)?>" alt="<?php echo esc_attr($content->title)?>" class="contents-thumbnail">
									</div>
									<?php endif?>
									<?php if($content->isNew()):?><span class="kboard-thumbnail-new-notify">New</span><?php endif?>
									<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
									<?php echo $content->title?>
									<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
								</div>
							</a>
							<div class="kboard-mobile-contents">
								<span class="contents-item kboard-user"><?php echo $content->getUserDisplay()?></span>
								<span class="contents-separator kboard-date">|</span>
								<span class="contents-item kboard-date"><?php echo $content->getDate()?></span>
								<span class="contents-separator kboard-vote">|</span>
								<span class="contents-item kboard-vote"><?php echo __('Votes', 'kboard')?> <?php echo $content->vote?></span>
								<span class="contents-separator kboard-view">|</span>
								<span class="contents-item kboard-view"><?php echo __('Views', 'kboard')?> <?php echo $content->view?></span>
							</div>
						</td>
						<td class="kboard-list-user"><?php echo $content->getUserDisplay()?></td>
						<td class="kboard-list-date"><?php echo $content->getDate()?></td>
						<td class="kboard-list-vote"><?php echo $content->vote?></td>
						<td class="kboard-list-view"><?php echo $content->view?></td>
					</tr>
					<?php endwhile?>
					-->
					<?php while($content = $list->hasNext()):?>
					<li class="grid-item <?php if($content->uid == kboard_uid()):?>kboard-list-selected<?php endif?>">
						
						<div class="bl_galley_list_img">
							<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">
							<div class="bl_galley_list_img_hover"></div>
							<?php if($content->getThumbnail(420, 320)):?><img src="<?php echo $content->getThumbnail(420, 320)?>" alt="<?php echo esc_attr($content->title)?>"><?php else:?><i class="icon-picture"></i><?php endif?>
							</a>
						</div>
						<div class="kboard-list-title bl_galley_list_title">
							<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">
								<div class="kboard-thumbnail-cut-strings ">
									<!--
									<?php if($content->getThumbnail(420, 320)):?>
									<div class="kboard-mobile-contents">
										<img src="<?php echo $content->getThumbnail(420, 320)?>" alt="<?php echo esc_attr($content->title)?>" class="contents-thumbnail">
									</div>
									<?php endif?>
									-->
		
									<!--
									<?php if($content->isNew()):?><span class="kboard-thumbnail-new-notify">New</span><?php endif?>
									
									<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
									<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
									-->
									<div class="bl_galley_list_title_text">
										<?php echo $content->title?> 
									</div>
									<!--
									<div class="bl_galley_list_title_hover">
										<span class="ion-ios-plus-empty"></span>
									</div>
									-->
								</div>
							</a>
						</div>
					</li>
					<?php $boardBuilder->builderReply($content->uid)?>
					<?php endwhile?>
				</ul>
		</div>
	</div>
	<!-- 리스트 끝 -->
	
	<!-- 페이징 시작 -->
	<div class="kboard-pagination">
		<ul class="kboard-pagination-pages">
			<?php echo kboard_pagination($list->page, $list->total, $list->rpp)?>
		</ul>
	</div>
	<!-- 페이징 끝 -->





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
	
	
	
	<?php if($board->contribution()):?>
	<div class="kboard-thumbnail-poweredby" style="opacity:0.0;">
		<a href="https://www.cosmosfarm.com/products/kboard" onclick="window.open(this.href);return false;" title="<?php echo __('KBoard is the best community software available for WordPress', 'kboard')?>">Powered by KBoard</a>
	</div>
	<?php endif?>
</div>
