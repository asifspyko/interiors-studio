<?php

function generateElementStyles($elementType, $id, $target) {
  $stylesShouldBeGenerated = false;
  $wrapStylesShouldBeGenerated = false;
  $mobileStyles = $smStyles = $mdStyles = $lgStyles = $xlStyles = $mobileWrapStyles = $smWrapStyles = $mdWrapStyles = $lgWrapStyles = $xlWrapStyles = '';

  // Block styles
  $mobileStylesStart = '#' . $id . ' { ';
  $smStylesStart = '@media (min-width: 768px) { #' . $id . ' { ';
  $mdStylesStart = '@media (min-width: 992px) { #' . $id . ' { ';
  $lgStylesStart = '@media (min-width: 1200px) { #' . $id . ' { ';
  $xlStylesStart = '@media (min-width: 1500px) { #' . $id . ' { ';

  // Wrap styles
  $mobileWrapStylesStart = '#' . $id . ' > .l-wrap { ';
  $smWrapStylesStart = '@media (min-width: 768px) { #' . $id . ' > .l-wrap { ';
  $mdWrapStylesStart = '@media (min-width: 992px) { #' . $id . ' > .l-wrap { ';
  $lgWrapStylesStart = '@media (min-width: 1200px) { #' . $id . ' > .l-wrap { ';
  $xlWrapStylesStart = '@media (min-width: 1500px) { #' . $id . ' > .l-wrap { ';

  // Basic variables setup
  $spacingArray = get_field('settings_spacing_rwd');
  $spacingMode = get_field('settings_spacing_mode');
  $id = $id;
  $mobileSpacingArray = get_field('settings_spacing_mobile');
  $smSpacingArray = get_field('settings_spacing_sm');
  $mdSpacingArray = get_field('settings_spacing_md');
  $lgSpacingArray = get_field('settings_spacing_lg');
  $xlSpacingArray = get_field('settings_spacing_xl');
  $maxWidthMode = get_field('settings_width_mode');
  $maxWidth = get_field('settings_width');
  $mobileMaxWidth = get_field('settings_width_mobile');
  $smMaxWidth = get_field('settings_width_sm');
  $mdMaxWidth = get_field('settings_width_md');
  $lgMaxWidth = get_field('settings_width_lg');
  $xlMaxWidth = get_field('settings_width_xl');
  $maxTextWidthMode = get_field('settings_textwidth_mode');
  $maxTextWidth = get_field('settings_textwidth');
  $mobileTextMaxWidth = get_field('settings_textwidth_mobile');
  $smTextMaxWidth = get_field('settings_textwidth_sm');
  $mdTextMaxWidth = get_field('settings_textwidth_md');
  $lgTextMaxWidth = get_field('settings_textwidth_lg');
  $xlTextMaxWidth = get_field('settings_textwidth_xl');
  $bgColor = get_field('settings_background_color');
  $settingsTextColorMode = get_field('settings_text_color_mode');
  $settingsCustomTextColor = get_field('settings_custom_text_color');

  // SPACING
  // Automatic spacing
  if(
    $spacingMode == 'simple' &&
    (
      (strlen( $spacingArray['margin_top'] ) != 0  && is_numeric($spacingArray['margin_top'])) ||
      (strlen( $spacingArray['margin_right'] ) != 0 && is_numeric($spacingArray['margin_right']))||
      (strlen( $spacingArray['margin_bottom'] ) != 0 && is_numeric($spacingArray['margin_bottom'])) ||
      (strlen( $spacingArray['margin_left'] ) != 0 && is_numeric($spacingArray['margin_left'])) ||
      (strlen( $spacingArray['padding_right'] ) != 0 && is_numeric($spacingArray['padding_right'])) ||
      (strlen( $spacingArray['padding_bottom'] ) != 0 && is_numeric($spacingArray['padding_bottom'])) ||
      (strlen( $spacingArray['padding_left'] ) != 0 && is_numeric($spacingArray['padding_left'])) ||
      (strlen( $spacingArray['padding_top'] ) != 0 && is_numeric($spacingArray['padding_top']))
    )
  ) {
    $stylesShouldBeGenerated = true;
    // Mobile styles
    if(strlen( $spacingArray['margin_top']) != 0 && is_numeric($spacingArray['margin_top'])) $mobileStyles .= 'margin-top: ' . $spacingArray['margin_top'] * 0.4 . 'px; ';
    if(strlen( $spacingArray['margin_right']) != 0 && is_numeric($spacingArray['margin_right'])) $mobileStyles .= 'margin-right: ' . $spacingArray['margin_right'] * 0.4 . 'px; ';
    if(strlen( $spacingArray['margin_bottom']) != 0 && is_numeric($spacingArray['margin_bottom'])) $mobileStyles .= 'margin-bottom: ' . $spacingArray['margin_bottom'] * 0.4 . 'px; ';
    if(strlen( $spacingArray['margin_left']) != 0 && is_numeric($spacingArray['margin_left'])) $mobileStyles .= 'margin-left: ' . $spacingArray['margin_left'] * 0.4 . 'px; ';
    if(strlen( $spacingArray['padding_top']) != 0 && is_numeric($spacingArray['padding_top'])) $mobileStyles .= 'padding-top: ' . $spacingArray['padding_top'] * 0.4 . 'px; ';
    if(strlen( $spacingArray['padding_right']) != 0 && is_numeric($spacingArray['padding_right'])) $mobileStyles .= 'padding-right: ' . $spacingArray['padding_right'] * 0.4 . 'px; ';
    if(strlen( $spacingArray['padding_bottom']) != 0 && is_numeric($spacingArray['padding_bottom'])) $mobileStyles .= 'padding-bottom: ' . $spacingArray['padding_bottom'] * 0.4 . 'px; ';
    if(strlen( $spacingArray['padding_left']) != 0 && is_numeric($spacingArray['padding_left'])) $mobileStyles .= 'padding-left: ' . $spacingArray['padding_left'] * 0.4 . 'px; ';

    // SM Styles
    if(strlen( $spacingArray['margin_top']) != 0 && is_numeric($spacingArray['margin_top'])) $smStyles .= 'margin-top: ' . $spacingArray['margin_top'] * 0.6 . 'px; ';
    if(strlen( $spacingArray['margin_right']) != 0 && is_numeric($spacingArray['margin_right'])) $smStyles .= 'margin-right: ' . $spacingArray['margin_right'] * 0.6 . 'px; ';
    if(strlen( $spacingArray['margin_bottom']) != 0 && is_numeric($spacingArray['margin_bottom'])) $smStyles .= 'margin-bottom: ' . $spacingArray['margin_bottom'] * 0.6 . 'px; ';
    if(strlen( $spacingArray['margin_left']) != 0 && is_numeric($spacingArray['margin_left'])) $smStyles .= 'margin-left: ' . $spacingArray['margin_left'] * 0.6 . 'px; ';
    if(strlen( $spacingArray['padding_top']) != 0 && is_numeric($spacingArray['padding_top'])) $smStyles .= 'padding-top: ' . $spacingArray['padding_top'] * 0.6 . 'px; ';
    if(strlen( $spacingArray['padding_right']) != 0 && is_numeric($spacingArray['padding_right'])) $smStyles .= 'padding-right: ' . $spacingArray['padding_right'] * 0.6 . 'px; ';
    if(strlen( $spacingArray['padding_bottom']) != 0 && is_numeric($spacingArray['padding_bottom'])) $smStyles .= 'padding-bottom: ' . $spacingArray['padding_bottom'] * 0.6 . 'px; ';
    if(strlen( $spacingArray['padding_left']) != 0 && is_numeric($spacingArray['padding_left'])) $smStyles .= 'padding-left: ' . $spacingArray['padding_left'] * 0.6 . 'px; ';

    // MD Styles
    if(strlen( $spacingArray['margin_top']) != 0 && is_numeric($spacingArray['margin_top'])) $mdStyles .= 'margin-top: ' . $spacingArray['margin_top'] * 0.8 . 'px; ';
    if(strlen( $spacingArray['margin_right']) != 0 && is_numeric($spacingArray['margin_right'])) $mdStyles .= 'margin-right: ' . $spacingArray['margin_right'] * 0.8 . 'px; ';
    if(strlen( $spacingArray['margin_bottom']) != 0 && is_numeric($spacingArray['margin_bottom'])) $mdStyles .= 'margin-bottom: ' . $spacingArray['margin_bottom'] * 0.8 . 'px; ';
    if(strlen( $spacingArray['margin_left']) != 0 && is_numeric($spacingArray['margin_left'])) $mdStyles .= 'margin-left: ' . $spacingArray['margin_left'] * 0.8 . 'px; ';
    if(strlen( $spacingArray['padding_top']) != 0 && is_numeric($spacingArray['padding_top'])) $mdStyles .= 'padding-top: ' . $spacingArray['padding_top'] * 0.8 . 'px; ';
    if(strlen( $spacingArray['padding_right']) != 0 && is_numeric($spacingArray['padding_right'])) $mdStyles .= 'padding-right: ' . $spacingArray['padding_right'] * 0.8 . 'px; ';
    if(strlen( $spacingArray['padding_bottom']) != 0 && is_numeric($spacingArray['padding_bottom'])) $mdStyles .= 'padding-bottom: ' . $spacingArray['padding_bottom'] * 0.8 . 'px; ';
    if(strlen( $spacingArray['padding_left']) != 0 && is_numeric($spacingArray['padding_left'])) $mdStyles .= 'padding-left: ' . $spacingArray['padding_left'] * 0.8 . 'px; ';

    // LG Styles
    if(strlen( $spacingArray['margin_top']) != 0 && is_numeric($spacingArray['margin_top'])) $lgStyles .= 'margin-top: ' . $spacingArray['margin_top'] * 0.9 . 'px; ';
    if(strlen( $spacingArray['margin_right']) != 0 && is_numeric($spacingArray['margin_right'])) $lgStyles .= 'margin-right: ' . $spacingArray['margin_right'] * 0.9 . 'px; ';
    if(strlen( $spacingArray['margin_bottom']) != 0 && is_numeric($spacingArray['margin_bottom'])) $lgStyles .= 'margin-bottom: ' . $spacingArray['margin_bottom'] * 0.9 . 'px; ';
    if(strlen( $spacingArray['margin_left']) != 0 && is_numeric($spacingArray['margin_left'])) $lgStyles .= 'margin-left: ' . $spacingArray['margin_left'] * 0.9 . 'px; ';
    if(strlen( $spacingArray['padding_top']) != 0 && is_numeric($spacingArray['padding_top'])) $lgStyles .= 'padding-top: ' . $spacingArray['padding_top'] * 0.9 . 'px; ';
    if(strlen( $spacingArray['padding_right']) != 0 && is_numeric($spacingArray['padding_right'])) $lgStyles .= 'padding-right: ' . $spacingArray['padding_right'] * 0.9 . 'px; ';
    if(strlen( $spacingArray['padding_bottom']) != 0 && is_numeric($spacingArray['padding_bottom'])) $lgStyles .= 'padding-bottom: ' . $spacingArray['padding_bottom'] * 0.9 . 'px; ';
    if(strlen( $spacingArray['padding_left']) != 0 && is_numeric($spacingArray['padding_left'])) $lgStyles .= 'padding-left: ' . $spacingArray['padding_left'] * 0.9 . 'px; ';

    // XL Styles
    if(strlen( $spacingArray['margin_top']) != 0 && is_numeric($spacingArray['margin_top'])) $xlStyles .= 'margin-top: ' . $spacingArray['margin_top'] . 'px; ';
    if(strlen( $spacingArray['margin_right']) != 0 && is_numeric($spacingArray['margin_right'])) $xlStyles .= 'margin-right: ' . $spacingArray['margin_right'] . 'px; ';
    if(strlen( $spacingArray['margin_bottom']) != 0 && is_numeric($spacingArray['margin_bottom'])) $xlStyles .= 'margin-bottom: ' . $spacingArray['margin_bottom'] . 'px; ';
    if(strlen( $spacingArray['margin_left']) != 0 && is_numeric($spacingArray['margin_left'])) $xlStyles .= 'margin-left: ' . $spacingArray['margin_left'] . 'px; ';
    if(strlen( $spacingArray['padding_top']) != 0 && is_numeric($spacingArray['padding_top'])) $xlStyles .= 'padding-top: ' . $spacingArray['padding_top'] . 'px; ';
    if(strlen( $spacingArray['padding_right']) != 0 && is_numeric($spacingArray['padding_right'])) $xlStyles .= 'padding-right: ' . $spacingArray['padding_right'] . 'px; ';
    if(strlen( $spacingArray['padding_bottom']) != 0 && is_numeric($spacingArray['padding_bottom'])) $xlStyles .= 'padding-bottom: ' . $spacingArray['padding_bottom'] . 'px; ';
    if(strlen( $spacingArray['padding_left']) != 0 && is_numeric($spacingArray['padding_left'])) $xlStyles .= 'padding-left: ' . $spacingArray['padding_left'] . 'px; ';
  }

  // Manual spacing
  if($spacingMode == 'advanced') {
    $stylesShouldBeGenerated = true;
    // Mobile styles
    if(strlen($mobileSpacingArray['margin_top']) != 0 && is_numeric($mobileSpacingArray['margin_top'])) $mobileStyles .= 'margin-top: ' . $mobileSpacingArray['margin_top'] . 'px; ';
    if(strlen($mobileSpacingArray['margin_right']) != 0 && is_numeric($mobileSpacingArray['margin_right'])) $mobileStyles .= 'margin-right: ' . $mobileSpacingArray['margin_right'] . 'px; ';
    if(strlen($mobileSpacingArray['margin_bottom']) != 0 && is_numeric($mobileSpacingArray['margin_bottom'])) $mobileStyles .= 'margin-bottom: ' . $mobileSpacingArray['margin_bottom'] . 'px; ';
    if(strlen($mobileSpacingArray['margin_left']) != 0 && is_numeric($mobileSpacingArray['margin_left'])) $mobileStyles .= 'margin-left: ' . $mobileSpacingArray['margin_left'] . 'px; ';
    if(strlen($mobileSpacingArray['padding_top']) != 0 && is_numeric($mobileSpacingArray['padding_top'])) $mobileStyles .= 'padding-top: ' . $mobileSpacingArray['padding_top'] . 'px; ';
    if(strlen($mobileSpacingArray['padding_right']) != 0 && is_numeric($mobileSpacingArray['padding_right'])) $mobileStyles .= 'padding-right: ' . $mobileSpacingArray['padding_right'] . 'px; ';
    if(strlen($mobileSpacingArray['padding_bottom']) != 0 && is_numeric($mobileSpacingArray['padding_bottom'])) $mobileStyles .= 'padding-bottom: ' . $mobileSpacingArray['padding_bottom'] . 'px; ';
    if(strlen($mobileSpacingArray['padding_left']) != 0 && is_numeric($mobileSpacingArray['padding_left'])) $mobileStyles .= 'padding-left: ' . $mobileSpacingArray['padding_left'] . 'px; ';

    // SM Styles
    if(strlen($smSpacingArray['margin_top']) != 0 && is_numeric($smSpacingArray['margin_top'])) $smStyles .= 'margin-top: ' . $smSpacingArray['margin_top'] . 'px; ';
    if(strlen($smSpacingArray['margin_right']) != 0 && is_numeric($smSpacingArray['margin_right'])) $smStyles .= 'margin-right: ' . $smSpacingArray['margin_right'] . 'px; ';
    if(strlen($smSpacingArray['margin_bottom']) != 0 && is_numeric($smSpacingArray['margin_bottom'])) $smStyles .= 'margin-bottom: ' . $smSpacingArray['margin_bottom'] . 'px; ';
    if(strlen($smSpacingArray['margin_left']) != 0 && is_numeric($smSpacingArray['margin_left'])) $smStyles .= 'margin-left: ' . $smSpacingArray['margin_left'] . 'px; ';
    if(strlen($smSpacingArray['padding_top']) != 0 && is_numeric($smSpacingArray['padding_top'])) $smStyles .= 'padding-top: ' . $smSpacingArray['padding_top'] . 'px; ';
    if(strlen($smSpacingArray['padding_right']) != 0 && is_numeric($smSpacingArray['padding_right'])) $smStyles .= 'padding-right: ' . $smSpacingArray['padding_right'] . 'px; ';
    if(strlen($smSpacingArray['padding_bottom']) != 0 && is_numeric($smSpacingArray['padding_bottom'])) $smStyles .= 'padding-bottom: ' . $smSpacingArray['padding_bottom'] . 'px; ';
    if(strlen($smSpacingArray['padding_left']) != 0 && is_numeric($smSpacingArray['padding_left'])) $smStyles .= 'padding-left: ' . $smSpacingArray['padding_left'] . 'px; ';

    // MD Styles
    if(strlen($mdSpacingArray['margin_top']) != 0 && is_numeric($mdSpacingArray['margin_top'])) $mdStyles .= 'margin-top: ' . $mdSpacingArray['margin_top'] . 'px; ';
    if(strlen($mdSpacingArray['margin_right']) != 0 && is_numeric($mdSpacingArray['margin_right'])) $mdStyles .= 'margin-right: ' . $mdSpacingArray['margin_right'] . 'px; ';
    if(strlen($mdSpacingArray['margin_bottom']) != 0 && is_numeric($mdSpacingArray['margin_bottom'])) $mdStyles .= 'margin-bottom: ' . $mdSpacingArray['margin_bottom'] . 'px; ';
    if(strlen($mdSpacingArray['margin_left']) != 0 && is_numeric($mdSpacingArray['margin_left'])) $mdStyles .= 'margin-left: ' . $mdSpacingArray['margin_left'] . 'px; ';
    if(strlen($mdSpacingArray['padding_top']) != 0 && is_numeric($mdSpacingArray['padding_top'])) $mdStyles .= 'padding-top: ' . $mdSpacingArray['padding_top'] . 'px; ';
    if(strlen($mdSpacingArray['padding_right']) != 0 && is_numeric($mdSpacingArray['padding_right'])) $mdStyles .= 'padding-right: ' . $mdSpacingArray['padding_right'] . 'px; ';
    if(strlen($mdSpacingArray['padding_bottom']) != 0 && is_numeric($mdSpacingArray['padding_bottom'])) $mdStyles .= 'padding-bottom: ' . $mdSpacingArray['padding_bottom'] . 'px; ';
    if(strlen($mdSpacingArray['padding_left']) != 0 && is_numeric($mdSpacingArray['padding_left'])) $mdStyles .= 'padding-left: ' . $mdSpacingArray['padding_left'] . 'px; ';

    // LG Styles
    if(strlen($lgSpacingArray['margin_top']) != 0 && is_numeric($lgSpacingArray['margin_top'])) $lgStyles .= 'margin-top: ' . $lgSpacingArray['margin_top'] . 'px; ';
    if(strlen($lgSpacingArray['margin_right']) != 0 && is_numeric($lgSpacingArray['margin_right'])) $lgStyles .= 'margin-right: ' . $lgSpacingArray['margin_right'] . 'px; ';
    if(strlen($lgSpacingArray['margin_bottom']) != 0 && is_numeric($lgSpacingArray['margin_bottom'])) $lgStyles .= 'margin-bottom: ' . $lgSpacingArray['margin_bottom'] . 'px; ';
    if(strlen($lgSpacingArray['margin_left']) != 0 && is_numeric($lgSpacingArray['margin_left'])) $lgStyles .= 'margin-left: ' . $lgSpacingArray['margin_left'] . 'px; ';
    if(strlen($lgSpacingArray['padding_top']) != 0 && is_numeric($lgSpacingArray['padding_top'])) $lgStyles .= 'padding-top: ' . $lgSpacingArray['padding_top'] . 'px; ';
    if(strlen($lgSpacingArray['padding_right']) != 0 && is_numeric($lgSpacingArray['padding_right'])) $lgStyles .= 'padding-right: ' . $lgSpacingArray['padding_right'] . 'px; ';
    if(strlen($lgSpacingArray['padding_bottom']) != 0 && is_numeric($lgSpacingArray['padding_bottom'])) $lgStyles .= 'padding-bottom: ' . $lgSpacingArray['padding_bottom'] . 'px; ';
    if(strlen($lgSpacingArray['padding_left']) != 0 && is_numeric($lgSpacingArray['padding_left'])) $lgStyles .= 'padding-left: ' . $lgSpacingArray['padding_left'] . 'px; ';

    // XL Styles
    if(strlen($xlSpacingArray['margin_top']) != 0 && is_numeric($xlSpacingArray['margin_top'])) $xlStyles .= 'margin-top: ' . $xlSpacingArray['margin_top'] . 'px; ';
    if(strlen($xlSpacingArray['margin_right']) != 0 && is_numeric($xlSpacingArray['margin_right'])) $xlStyles .= 'margin-right: ' . $xlSpacingArray['margin_right'] . 'px; ';
    if(strlen($xlSpacingArray['margin_bottom']) != 0 && is_numeric($xlSpacingArray['margin_bottom'])) $xlStyles .= 'margin-bottom: ' . $xlSpacingArray['margin_bottom'] . 'px; ';
    if(strlen($xlSpacingArray['margin_left']) != 0 && is_numeric($xlSpacingArray['margin_left'])) $xlStyles .= 'margin-left: ' . $xlSpacingArray['margin_left'] . 'px; ';
    if(strlen($xlSpacingArray['padding_top']) != 0 && is_numeric($xlSpacingArray['padding_top'])) $xlStyles .= 'padding-top: ' . $xlSpacingArray['padding_top'] . 'px; ';
    if(strlen($xlSpacingArray['padding_right']) != 0 && is_numeric($xlSpacingArray['padding_right'])) $xlStyles .= 'padding-right: ' . $xlSpacingArray['padding_right'] . 'px; ';
    if(strlen($xlSpacingArray['padding_bottom']) != 0 && is_numeric($xlSpacingArray['padding_bottom'])) $xlStyles .= 'padding-bottom: ' . $xlSpacingArray['padding_bottom'] . 'px; ';
    if(strlen($xlSpacingArray['padding_left']) != 0 && is_numeric($xlSpacingArray['padding_left'])) $xlStyles .= 'padding-left: ' . $xlSpacingArray['padding_left'] . 'px; ';
  }

  // CONTENT WIDTH
  if($maxWidthMode == 'simple') {
    if($maxWidth) {
      if($target == 'self') {
        $stylesShouldBeGenerated = true;
        $mobileStyles .= 'max-width: ' . $maxWidth . 'px; margin-left: auto; margin-right: auto; ';
      }
      elseif($target == 'wrap') {
        $wrapStylesShouldBeGenerated = true;
        $mobileWrapStyles .= 'max-width: ' . $maxWidth . 'px; ';
      }
    }
  }

  if($maxWidthMode == 'advanced') {
    if($target == 'self' && (!empty($mobileMaxWidth) || !empty($smMaxWidth) || !empty($mdMaxWidth) || !empty($lgMaxWidth) || !empty($xlMaxWidth))) {
      $stylesShouldBeGenerated = true;
      if(!empty($mobileMaxWidth)) $mobileStyles .= 'max-width: ' . $mobileMaxWidth . 'px; ';
      if(!empty($smMaxWidth)) $smStyles .= 'max-width: ' . $smMaxWidth . 'px; ';
      if(!empty($mdMaxWidth)) $mdStyles .= 'max-width: ' . $mdMaxWidth . 'px; ';
      if(!empty($lgMaxWidth)) $lgStyles .= 'max-width: ' . $lgMaxWidth . 'px; ';
      if(!empty($xlMaxWidth)) $xlStyles .= 'max-width: ' . $xlMaxWidth . 'px; ';
    }
    elseif($target == 'wrap' && (!empty($mobileMaxWidth) || !empty($smMaxWidth) || !empty($mdMaxWidth) || !empty($lgMaxWidth) || !empty($xlMaxWidth))) {
      $wrapStylesShouldBeGenerated = true;
      if(!empty($mobileMaxWidth)) $mobileWrapStyles .= 'max-width: ' . $mobileMaxWidth . 'px; ';
      if(!empty($smMaxWidth)) $smWrapStyles .= 'max-width: ' . $smMaxWidth . 'px; ';
      if(!empty($mdMaxWidth)) $mdWrapStyles .= 'max-width: ' . $mdMaxWidth . 'px; ';
      if(!empty($lgMaxWidth)) $lgWrapStyles .= 'max-width: ' . $lgMaxWidth . 'px; ';
      if(!empty($xlMaxWidth)) $xlWrapStyles .= 'max-width: ' . $xlMaxWidth . 'px; ';
    }
  }

  // BACKGROUND COLOR
  if(!empty($bgColor)) { $stylesShouldBeGenerated = true; $mobileStyles .= 'background-color: '. $bgColor . '; '; }

  // CUSTOM TEXT COLOR
  if($settingsTextColorMode == 'custom' && !empty($settingsCustomTextColor)): $stylesShouldBeGenerated = true; $mobileStyles .= 'color: ' . $settingsCustomTextColor . '; '; endif;

  // TEXT MAX WIDTH (should be called last)
  if($maxTextWidthMode == 'simple') {
    if($maxTextWidth) {
      if($target == 'self') {
        $stylesShouldBeGenerated = true;
        $mobileStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $maxTextWidth . 'px;';
      }
      elseif($target == 'wrap') {
        $wrapStylesShouldBeGenerated = true;
        $mobileWrapStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $maxTextWidth . 'px;';
      }
    }
  }

  if($maxTextWidthMode == 'advanced') {
    if($target == 'self' && (!empty($mobileTextMaxWidth) || !empty($smTextMaxWidth) || !empty($mdTextMaxWidth) || !empty($lgTextMaxWidth) || !empty($xlTextMaxWidth))) {
      $stylesShouldBeGenerated = true;
      if(!empty($mobileTextMaxWidth)) $mobileStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $mobileTextMaxWidth . 'px; ';
      if(!empty($smTextMaxWidth)) $smStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $smTextMaxWidth . 'px; ';
      if(!empty($mdTextMaxWidth)) $mdStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $mdTextMaxWidth . 'px; ';
      if(!empty($lgTextMaxWidth)) $lgStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $lgTextMaxWidth . 'px; ';
      if(!empty($xlTextMaxWidth)) $xlStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $xlTextMaxWidth . 'px; ';
    }
    elseif($target == 'wrap' && (!empty($mobileTextMaxWidth) || !empty($smTextMaxWidth) || !empty($mdTextMaxWidth) || !empty($lgTextMaxWidth) || !empty($xlTextMaxWidth))) {
      $wrapStylesShouldBeGenerated = true;
      if(!empty($mobileTextMaxWidth)) $mobileWrapStyles .= '} #' . $id . ' .text-max-width .target-' . $target . '  { max-width: ' . $mobileTextMaxWidth . 'px; ';
      if(!empty($smTextMaxWidth)) $smWrapStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $smTextMaxWidth . 'px; ';
      if(!empty($mdTextMaxWidth)) $mdWrapStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $mdTextMaxWidth . 'px; ';
      if(!empty($lgTextMaxWidth)) $lgWrapStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $lgTextMaxWidth . 'px; ';
      if(!empty($xlTextMaxWidth)) $xlWrapStyles .= '} #' . $id . ' .text-max-width { max-width: ' . $xlTextMaxWidth . 'px; ';
    }
  }

  $mobileStylesEnd = ' } ';
  $smStylesEnd = ' }} ';
  $mdStylesEnd = ' }} ';
  $lgStylesEnd = ' }} ';
  $xlStylesEnd = ' }} ';

  $mobileWrapStylesEnd = ' } ';
  $smWrapStylesEnd = ' }} ';
  $mdWrapStylesEnd = ' }} ';
  $lgWrapStylesEnd = ' }} ';
  $xlWrapStylesEnd = ' }} ';

  if($stylesShouldBeGenerated || $wrapStylesShouldBeGenerated) {
    echo '<style>';
  }

  if($stylesShouldBeGenerated) {
    if(!empty($mobileStyles)) echo $mobileStylesStart . $mobileStyles . $mobileStylesEnd;
    if(!empty($smStyles)) echo $smStylesStart . $smStyles . $smStylesEnd;
    if(!empty($mdStyles)) echo $mdStylesStart . $mdStyles . $mdStylesEnd;
    if(!empty($lgStyles)) echo $lgStylesStart . $lgStyles . $lgStylesEnd;
    if(!empty($xlStyles)) echo $xlStylesStart . $xlStyles . $xlStylesEnd;
  }

  if($wrapStylesShouldBeGenerated) {
    if(!empty($mobileWrapStyles)) echo $mobileWrapStylesStart . $mobileWrapStyles . $mobileWrapStylesEnd;
    if(!empty($smWrapStyles)) echo $smWrapStylesStart . $smWrapStyles . $smWrapStylesEnd;
    if(!empty($mdWrapStyles)) echo $mdWrapStylesStart . $mdWrapStyles . $mdWrapStylesEnd;
    if(!empty($lgWrapStyles)) echo $lgWrapStylesStart . $lgWrapStyles . $lgWrapStylesEnd;
    if(!empty($xlWrapStyles)) echo $xlWrapStylesStart . $xlWrapStyles . $xlWrapStylesEnd;
  }

  if($stylesShouldBeGenerated || $wrapStylesShouldBeGenerated) {
    echo '</style>';
  }

}

function generateElementTags($is_preview){
  $tags = '';
  $bgImage = get_field('settings_background_image');
  $animEnabled = get_field('settings_enable_animations');
  $animType = get_field('settings_animation_type');
  $animEasing = get_field('settings_easing');
  $animDuration = get_field('settings_duration');
  $animDelay = get_field('settings_delay');
  $animOffset = get_field('settings_offset');
  $groupName = get_field('settings_group_name');

  if(isset($is_preview) && $is_preview == true && !empty($bgImage)) $tags .= ' style="background-image: url(' . $bgImage . ');" ';
  if(!(isset($is_preview) && $is_preview == true) && !empty($bgImage)) $tags .= ' data-bg="' . $bgImage . '" ';

  if($animEnabled) {
    $tags .= ' data-aos="' . $animType . '" data-aos-easing="'. $animEasing .'" data-aos-duration="'. $animDuration .'" data-aos-delay="'. $animDelay .'" data-aos-offset="'. $animOffset .'" ';
  }
  if(!empty($groupName)) $tags .= ' data-mh="' . $groupName . '" ';
  echo $tags;
}

function generateElementClasses($is_preview){
  $classes = '';

  $bgImage = get_field('settings_background_image');
  $bgPosition = get_field('settings_background_position');
  $bgRepeat = get_field('settings_background_repeat');
  $bgSize = get_field('settings_background_size');
  $bgAttachment = get_field('settings_background_attachment');
  $visibility = get_field('settings_visibility');
  $settingsTextColorMode = get_field('settings_text_color_mode');
  $settingsDefaultTextColor = get_field('settings_default_text_color');
  $textAlignMode = get_field('settings_textalign_mode');
  $textAlign = get_field('settings_textalign');
  $textAlignMobile = get_field('settings_textalign_mobile');
  $textAlignSM = get_field('settings_textalign_sm');
  $textAlignMD = get_field('settings_textalign_md');
  $textAlignLG = get_field('settings_textalign_lg');
  $textAlignXL = get_field('settings_textalign_xl');

  if(!(isset($is_preview) && $is_preview == true) && !empty($bgImage)) $classes .= ' lazyload';

  if(!empty($bgImage)) $classes .=
    ' bg-' . $bgPosition .
    ' bg-' . $bgRepeat .
    ' bg-' . $bgSize .
    ' bg-' . $bgAttachment . ' '
  ;

  if(!empty($settingsTextColorMode) && $settingsTextColorMode == 'predefined' && !empty($settingsDefaultTextColor)) $classes .= ' text-' . $settingsDefaultTextColor;

  if(!empty($visibility)) {
    if(in_array('mobile', $visibility)) $classes .= ' hidden';
    if(in_array('sm', $visibility)) $classes .= ' sm:hidden'; else $classes .= ' sm:block';
    if(in_array('md', $visibility)) $classes .= ' md:hidden'; else $classes .= ' md:block';
    if(in_array('lg', $visibility)) $classes .= ' lg:hidden'; else $classes .= ' lg:block';
    if(in_array('xl', $visibility)) $classes .= ' xl:hidden'; else $classes .= ' xl:block';
  }

  // Text align
  if($textAlignMode == 'simple') $classes .= 'text-' . $textAlign;
  if($textAlignMode == 'advanced') $classes .= 'text-' . $textAlignMobile . ' sm:text-' . $textAlignSM . ' md:text-' . $textAlignMD . ' lg:text-' . $textAlignLG . ' xl:text-' . $textAlignXL;

  echo $classes . ' ';
}
