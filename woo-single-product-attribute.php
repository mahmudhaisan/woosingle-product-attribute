<?php

/**
 * Plugin Name: Woo Single Product Attribute
 * Plugin URI: http://mahmudhaisan.com/
 * Description: Woo Single Product Attribute
 * Version: 1.0.0
 * Author: Mahmud haisan
 * Author URI: http://mahmudhaisan.com/
 * Developer: Mahmud Haisan
 * Developer URI: http://mahmudhaisan.com/
 * Text Domain: woo-single-product-attribute
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('woocommerce_after_single_product_summary', 'wooattr_add');


function wooattr_add()
{
    require_once('main.php');
    // declaring $product
    global $product;

    //get current category
    $current_categories = $product->get_categories();
    echo ($current_categories);

    // getting attributes and looping all available attribute
    $attributes = $product->get_attributes();
    foreach ($attributes as $attribute) :
        $attribute_name = $attribute->get_taxonomy(); // The taxonomy slug name
        $attribute_terms = $attribute->get_terms(); // The terms
        $attribute_slugs = $attribute->get_slugs(); // The term slugs
        $attribute_data = $attribute->get_data();

        // testing pre-formatted output
        echo '<pre>';
        echo 'data';
        print_r($attribute_data); //

        $attribute_name_get = ($attribute_data['name']);
        $attr_prefix_remove = explode('pa_', $attribute_name_get); //
        echo $attr_prefix_remove;
        echo 'attr';

        echo 'slugs';
        print_r($attribute_slugs);
        // echo 'name ';
        // print_r($attribute_name, ' ');

        // echo 'terms ';
        // print_r($attribute_terms);
        echo '</pre>';
    endforeach;
}
