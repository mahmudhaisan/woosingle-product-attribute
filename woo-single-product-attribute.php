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
 * Text Domain: woospa
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


function woospa_scripts()
{
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css');
    wp_enqueue_script('script-name', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array(), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'woospa_scripts');


?>



<!-- html content starts -->
<div class="jumbotron">
    <div class="row w-100">
        <div class="col-md-3">
            <div class="card border-info mx-sm-1 p-3">
                <div class="text-info text-center mt-3">
                    <h4>Attribute Name</h4>
                </div>
                <div class="text-info text-center mt-2">
                    <ul>
                        <li>value</li>
                        <li>value</li>
                        <li>value</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info mx-sm-1 p-3">
                <div class="text-info text-center mt-3">
                    <h4>Attribute Name</h4>
                </div>
                <div class="text-info text-center mt-2">
                    <ul>
                        <li>value</li>
                        <li>value</li>
                        <li>value</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info mx-sm-1 p-3">
                <div class="text-info text-center mt-3">
                    <h4>Attribute Name</h4>
                </div>
                <div class="text-info text-center mt-2">
                    <ul>
                        <li>value</li>
                        <li>value</li>
                        <li>value</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info mx-sm-1 p-3">
                <div class="text-info text-center mt-3">
                    <h4>Attribute Name</h4>
                </div>
                <div class="text-info text-center mt-2">
                    <ul>
                        <li>value</li>
                        <li>value</li>
                        <li>value</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>