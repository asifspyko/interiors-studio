<?php 
  $wraperTag = (get_field('wraper_tag')) ? get_field('wraper_tag') : 'div';
  if(!$block_disabled): echo '</' . $wraperTag . '>'; generateElementStyles('block', $id, 'self'); endif; 
?>
