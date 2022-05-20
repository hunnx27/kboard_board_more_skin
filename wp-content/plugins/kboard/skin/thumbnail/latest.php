<div id="kboard-thumbnail-latest" class="mf_gal_wrap">
	<div class="mf_gal_table">
		<!--
		<ul>
			<li>
				<th class="kboard-latest-title"><?php echo __('Title', 'kboard')?></th>
				<th class="kboard-latest-date"><?php echo __('Date', 'kboard')?></th>
			</li>
		</ul>
		-->
		<ul>
			<?php while($content = $list->hasNext()):?>
			<li>
				<div class="mf_thumbnail">
					<a href="<?php echo esc_url($url->getDocumentURLWithUID($content->uid))?>">
						<?php if($content->getThumbnail(120, 90)):?><img src="<?php echo $content->getThumbnail(300, 300)?>" alt="<?php echo esc_attr($content->title)?>"><?php else:?><i class="icon-picture"></i><?php endif?>
					</a>
				</div>
				<div class="kboard-latest-title">
					<a href="<?php echo $url->getDocumentURLWithUID($content->uid)?>">
						<div class="kboard-thumbnail-cut-strings">
							<?php if($content->isNew()):?><span class="kboard-thumbnail-new-notify">N</span><?php endif?>
							<?php if($content->secret):?><img src="<?php echo $skin_path?>/images/icon-lock.png" alt="<?php echo __('Secret', 'kboard')?>"><?php endif?>
							<?php echo $content->title?>
							<span class="kboard-comments-count"><?php echo $content->getCommentsCount()?></span>
						</div>
					</a>
				</div>
				<div class="kboard-latest-date"><?php echo $content->getDate()?></div>
			</li>
			<?php endwhile?>
			</ul>
	</div>
</div>
<style>
.mf_gal_wrap *{
	margin:0;
	padding:0;
	box-sizing:border-box;

}
.mf_gal_wrap ul{
	padding:0;
}
.mf_gal_wrap ul::after{
	content:'';
	display:block;
	clear:both;
}
.mf_gal_wrap ul li{
	width:24%;
	margin-right:1.33333%;
	float:left;
	list-style:none;
	padding:0;
}
.mf_gal_wrap ul li:nth-child(4){
	margin-right:0;
}
.mf_gal_wrap ul li .mf_thumbnail a{
	display:block;
	width:100%;
}
.mf_gal_wrap ul li .mf_thumbnail a img{
	width:100%;
	max-width:100%;
}
.mf_gal_wrap ul li .kboard-latest-title{
	padding-top:16px;
}
.mf_gal_wrap ul li .kboard-latest-title a{
	width:100%;
	display:block;
	font-size:16px;
	font-weight:600;
}
#main_tab .oceanwp-row .span_1_of_4{
	width:24%;
	margin-right:1.33333%;
	padding:0 1.625rem;
}
#main_tab .oceanwp-row .span_1_of_4:last-child{
	margin-right:0;
}
@media (max-width:1024px){
	.mf_gal_wrap ul{
		padding:0 2.08%;
	}
	.mf_gal_wrap ul li{
		width:24%;
		margin-right:1.33333%;
		padding:0;
	}
	
	.mf_gal_wrap ul li .kboard-latest-title{
		padding-top:1.6vw;
	}
	.mf_gal_wrap ul li .kboard-latest-title a{
		font-size:1.6vw;
	}
	#main_tab .oceanwp-row .span_1_of_4{
		width:32%;
		margin-right:2%;
		padding:0 1.6vw;
	}
}
@media (max-width:767px){
	.mf_gal_wrap ul{
		padding:0 4.4%;
	}
	.mf_gal_wrap ul li{
		width:49%;
		margin-right:2%;
		padding:0;
		margin-bottom:3vw;
	}
	.mf_gal_wrap ul li:nth-child(2){
		margin-right:0;
	}
	.mf_gal_wrap ul li:nth-child(4){
		margin-right:0;
	}
	.mf_gal_wrap ul li .kboard-latest-title{
		padding-top:3vw;
	}
	.mf_gal_wrap ul li .kboard-latest-title a{
		font-size:3vw;
	}
	#main_tab .oceanwp-row .span_1_of_4{
		width:49% !important;
		margin-right:2%;
		padding:0 3vw;
	}
}

</style>