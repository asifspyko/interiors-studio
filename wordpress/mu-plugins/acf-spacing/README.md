# ACF Spacing

Adds a field to configure spacing - margin and padding.

![ACF Spacing Field Screenshot](/assets/images/acf-pro-section-styles-field.png?raw=true)

### Description

Allows you to set defaults for margin, border size, border color, border style, padding, background color, and background style on creation. Creates controls to configure:

* Margin
* Padding

### Usage

Using `get_field( 'your_field_name' )` will return an array of values:

```
Array
(
    [margin_top] => 10px
    [margin_right] => 10px
    [margin_bottom] => 10px
    [margin_left] => 10px
    [padding_top] => 10px
    [padding_right] => 10px
    [padding_bottom] => 10px
    [padding_left] => 10px
    [padding] => 10px 10px 10px 10px
    [margin] => 10px 10px 10px 10px
)
```

### Compatibility

This ACF field type is compatible with:
* ACF 5

### Installation

1. Copy the plugin folder into your `wp-content/plugins` folder
2. Activate the plugin via the plugins admin page
3. Create a new field via ACF and select the Section Styles type
4. Please refer to the description for more info regarding the field type settings

### Changelog
Please see `readme.txt` for changelog
