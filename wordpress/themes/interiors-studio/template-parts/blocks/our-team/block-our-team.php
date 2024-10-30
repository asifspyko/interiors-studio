<?php
$blockRootClasses = 'team-block';

if (!empty($block['align'])) {
    $blockRootClasses .= ' align' . $block['align'];
}

require get_template_directory() . '/inc/block-start.php';
if (!$block_disabled && empty($block['data']['block_preview_img'])):

    if (!empty($block['data']['block_preview_img']))
        echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';

    ?>
    <?php if (have_rows('members')): ?>
        <section class="our-team bg-light">
            <div class="container">
                <div class="our-team-inner">
                    <div class="row">
                        <?php
                        while (have_rows('members')) {
                            the_row();
                            echo '<div class="col-lg-4 col-12 col-md-6"><div class="member_block">';

                            if ($image = get_sub_field('member_image')) {
                                echo '<div class="member-image"><div class="image-ratio">';
                                echo wp_get_attachment_image($image, 'full', false, ['class' => 'full']);
                                echo ' </div></div>';
                            }

                            $name = get_sub_field('name');
                            $designation = get_sub_field('designation');
                            $content = get_sub_field('content');

                            if ($name || $designation || $content) {
                                echo '<div class="member_content_inner">';
                                if ($name) {
                                    echo '<div class="member_name"><h2>' . $name . '</h2></div>';
                                }
                                if ($designation) {
                                    echo '<div class="member-desitanation"><h5>' . $designation . '</h5></div>';
                                }
                                if ($content) {
                                    echo '<div class="member_description"><p>' . $content . '</p></div>';
                                }
                                echo '</div>';
                            }

                            echo '</div></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    endif;
endif;
require get_template_directory() . '/inc/block-end.php';
?>