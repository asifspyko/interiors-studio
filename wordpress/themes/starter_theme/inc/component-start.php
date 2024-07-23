<?php
  // Check if element is from Flexible Content field or Gutenberg block
  $mode = isset($block) ? 'block' : 'component';

  // Data setup
  if($mode == 'component') {
    $uniqueID = 'component-' . get_sub_field('settings_unique_id');
    $previewStatus = false;
  }
  elseif($mode == 'block') {
    $uniqueID = $block['id'];
    if( !empty($block['anchor']) ) { $uniqueID = $block['anchor']; }
    $previewStatus = $is_preview;
  }
?>
