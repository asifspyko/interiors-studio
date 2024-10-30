<?php

// Generate phone number link from string
function generatePhoneLink($number) {
    $link = str_replace(')', '', str_replace('(', '', str_replace('-', '', str_replace(' ', '', $number))));
    echo $link;
}

function noProtocol($link) {
    $link = str_replace('https://', '', str_replace('http://', '', $link));
    echo $link;
}

// Excerpt with limit
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      }
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
}

function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      }
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]>', $content);
      return $content;
}

function slugify($text) {

  // Replace German characters
  $text = str_replace('Ä', 'ae', $text);
  $text = str_replace('ä', 'ae', $text);
  $text = str_replace('Ö', 'oe', $text);
  $text = str_replace('ö', 'oe', $text);
  $text = str_replace('Ü', 'ue', $text);
  $text = str_replace('ü', 'ue', $text);
  $text = str_replace('ẞ', 'ss', $text);
  $text = str_replace('ß', 'ss', $text);

  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function format_phone( $string ) {
  $phone = preg_replace("/[^+0-9]/", "", $string);
  return $phone;
}