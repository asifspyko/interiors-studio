<?php
/**
  * @param   array $block The block data including all properties and settings.
  * @param   bool $is_preview True when editing in the back-end.
  * @param   int $post_id The post being edited.
  */

  // Create id attribute allowing for custom "anchor" value.
  $id = $block['id'];
  if( !empty($block['anchor']) ) { $id = $block['anchor']; }

  // Create class attribute allowing for custom "className"
  $className = 'l-block';
  if( !empty($block['className']) ) { $className .= ' ' . $block['className']; }

  // Block status
  $block_disabled = (get_field('settings_status') === false) ? true : false;
  if(isset($is_preview) && $is_preview == true) { $block_disabled = false; $className .= ' is-admin'; } 
  
  // Wraper tag
  $wraperTag = (get_field('wraper_tag')) ? get_field('wraper_tag') : 'div';
  ?>

  <?php if((!$block_disabled)): ?>
    <<?php echo $wraperTag; ?> id="<?php echo esc_attr($id); ?>" class="<?php echo $blockRootClasses; generateElementClasses($is_preview); echo esc_attr($className); ?>" <?php generateElementTags($is_preview); ?>>
  <?php endif; ?>

  <?php if( !empty( $block['data']['block_preview_img'] ) ): ?>
    <img src="<?php echo get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img']; ?>" alt="">
  <?php endif; ?>
