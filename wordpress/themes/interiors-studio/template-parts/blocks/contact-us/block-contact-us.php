<?php
  $blockRootClasses = 'contact-block';

  if( !empty($block['align']) ) {
   $blockRootClasses .= ' align' . $block['align'];
  }

  require get_template_directory() . '/inc/block-start.php';
  if(!$block_disabled && empty( $block['data']['block_preview_img'])):

  if( !empty( $block['data']['block_preview_img'] ) ) echo '<img src="' . get_template_directory_uri() . '/assets/img/block-preview/' . $block['data']['block_preview_img'] . '" alt="">';
?>

<section class="contact-us">
  <div class="container-xl px-0">
    <div class="row g-0">
      <div class="col-lg-6">
        <div class="contact-us__form bg-secondary">
          <div class="contact-us__form__inner text-white">
            <div class="form-wrapper">
              <div class="title-block">
                <h2>Get in touch</h2>
              </div>
              <form action="">
                <div class="form-field mb-3">
                  <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="form-field mb-3">
                  <input type="text" class="form-control" placeholder="Email">
                </div>
                <div class="form-field mb-3">
                  <input type="text" class="form-control" placeholder="Subject">
                </div>
                <div class="form-field mb-3">
                  <textarea class="form-control" placeholder="Message"></textarea>
                </div>
                <div class="btn-wrapper">
                  <button type="submit" class="btn btn-outline-white">send message</button>
                </div>
              </form>
            </div>
            <div class="location-block text-white">
              <div class="icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 0 15 20" fill="none">
                  <path
                    d="M7.21129 0C5.29941 0.00218127 3.46645 0.762641 2.11455 2.11455C0.762641 3.46645 0.00218127 5.29941 0 7.21129C0 12.7259 6.21819 19.0069 6.48295 19.2717L7.21129 20L7.93963 19.2717C8.20439 19.0069 14.4226 12.7259 14.4226 7.21129C14.4204 5.29941 13.6599 3.46645 12.308 2.11455C10.9561 0.762641 9.12317 0.00218127 7.21129 0ZM7.21129 17.032C5.63614 15.2725 2.06037 10.8715 2.06037 7.21129C2.06037 5.84518 2.60305 4.53502 3.56904 3.56904C4.53502 2.60305 5.84518 2.06037 7.21129 2.06037C8.5774 2.06037 9.88756 2.60305 10.8535 3.56904C11.8195 4.53502 12.3622 5.84518 12.3622 7.21129C12.3622 10.8643 8.78438 15.2704 7.21129 17.032Z"
                    fill="#96C93D" />
                  <path
                    d="M7.21116 4.12074C6.59991 4.12074 6.00238 4.302 5.49414 4.6416C4.9859 4.98119 4.58978 5.46387 4.35586 6.02859C4.12194 6.59332 4.06074 7.21472 4.17999 7.81423C4.29924 8.41374 4.59359 8.96443 5.02581 9.39665C5.45803 9.82887 6.00871 10.1232 6.60822 10.2425C7.20773 10.3617 7.82914 10.3005 8.39386 10.0666C8.95859 9.83268 9.44127 9.43655 9.78086 8.92832C10.1205 8.42008 10.3017 7.82255 10.3017 7.2113C10.3017 6.39163 9.9761 5.60554 9.39651 5.02594C8.81692 4.44635 8.03083 4.12074 7.21116 4.12074ZM7.21116 8.24148C7.00741 8.24148 6.80823 8.18106 6.63882 8.06786C6.46941 7.95466 6.33737 7.79377 6.25939 7.60553C6.18142 7.41729 6.16102 7.21015 6.20077 7.01032C6.24052 6.81048 6.33864 6.62692 6.48271 6.48285C6.62678 6.33877 6.81035 6.24066 7.01018 6.20091C7.21002 6.16116 7.41715 6.18156 7.6054 6.25953C7.79364 6.3375 7.95453 6.46954 8.06773 6.63896C8.18093 6.80837 8.24134 7.00754 8.24134 7.2113C8.24134 7.48452 8.13281 7.74655 7.93961 7.93975C7.74641 8.13294 7.48438 8.24148 7.21116 8.24148Z"
                    fill="#96C93D" />
                </svg>
              </div>
              <div class="text-wrapper">
                <p>950 Joseph E. Lowery Boulevard NW, Suite 21, Atlanta, GA 30318</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="image-wrapper">
          <div class="image-ratio image-ratio--square">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/contact-form-image.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php
  endif;
  require get_template_directory() . '/inc/block-end.php';
?>
