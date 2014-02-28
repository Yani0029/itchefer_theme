<?php

/**
 * @file
 * Theme implementation to show forum legend.
 *
 */
?>

<div class="forum-list-icon-legend clearfix">
  <div class="forum-list-legend-item">
    <span class="new_post">
      <i class="icon-folder-open"></i> 
      <?php print t('New posts'); ?>
    </span>
  </div>

  <div class="forum-list-legend-item">
    <span class="default_post">
      <i class="icon-folder-open-alt"></i>
      <?php print t('No new posts'); ?>
    </span>
  </div>
</div>
