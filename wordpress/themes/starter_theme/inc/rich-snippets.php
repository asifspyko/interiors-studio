<?php
  if( !function_exists('theme_rich_snippets')) { 
    function theme_rich_snippets() {
      // Local Business
      if(get_field('local_business_status', 'option')) {
        if(in_array(get_queried_object_id(), get_field('local_business_assign_to_the_following_pages', 'option'))) {
          echo '<script type="application/ld+json">';
          echo '{';
          echo '"@context": "https://schema.org"';
          echo ', "@type": "' . get_field('local_business_type', 'option') . '"';
          echo ', "name": "' . get_field('local_business_name', 'option') . '"';
          echo ', "image": "' . get_field('local_business_image', 'option') . '"';
          echo ', "url": "' . get_home_url() . '"';
          if(get_field('local_business_telephone', 'option')) {
            echo ', "telephone": "' . get_field('local_business_telephone', 'option') . '"';
          }
          if(get_field('local_business_price_range', 'option')) {
            echo ', "priceRange": "' . get_field('local_business_price_range', 'option') . '"';
          }
          if(get_field('local_business_address_locality', 'option') || get_field('local_business_address_region', 'option') || get_field('local_business_postal_code', 'option') || get_field('local_business_street_address', 'option')) {
            echo ', "address": {';
            echo '"@type": "PostalAddress"';
            if(get_field('local_business_street_address', 'option')) {
              echo ', "streetAddress": "' . get_field('local_business_street_address', 'option') . '"';
            }
            if(get_field('local_business_address_locality', 'option')) {
              echo ', "addressLocality": "' . get_field('local_business_address_locality', 'option') . '"';
            }
            if(get_field('local_business_address_region', 'option')) {
              echo ', "addressRegion": "' . get_field('local_business_address_region', 'option') . '"';
            }
            if(get_field('local_business_postal_code', 'option')) {
              echo ', "postalCode": "' . get_field('local_business_postal_code', 'option') . '"';
            }
            if(get_field('local_business_address_country', 'option')) {
              echo ', "addressCountry": "' . get_field('local_business_address_country', 'option') . '"';
            }
            echo '}';
          }
          if(get_field('geo_coordinates', 'option') && get_field('latitude', 'option') && get_field('longitude', 'option')) {
            echo ', "geo": {';
            echo '"@type": "GeoCoordinates"';
            if(get_field('latitude', 'option')) {
              echo ', "latitude": "' . get_field('latitude', 'option') . '"';
            }
            if(get_field('longitude', 'option')) {
              echo ', "longitude": "' . get_field('longitude', 'option') . '"';
            }
            echo '}';
          }
          $opening_hours_array = get_field('opening_hours', 'option');
          if($opening_hours_array) {
            echo ', "openingHoursSpecification": [';
            foreach($opening_hours_array as $key => $element) {
              if (!($key === array_key_first($opening_hours_array))) {
                echo ', ';
              }
              echo '{ "@type": "OpeningHoursSpecification", "dayOfWeek": "' . $element . '", "opens": "' . get_field($element . '_opening_hour', 'option') . '", "closes": "' . get_field($element . '_closing_hour', 'option') . '" }';
            }
            echo ']';
          }
          echo '}';
          echo '</script>';
        }
      }
    }
  }