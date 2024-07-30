<?php 
  $wraperTag = (get_field('wraper_tag')) ? get_field('wraper_tag') : 'div';
  if(!$block_disabled): generateElementStyles('block', $id, 'wrap'); echo '</' . $wraperTag . '>'; endif; 
?>
