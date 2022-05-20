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