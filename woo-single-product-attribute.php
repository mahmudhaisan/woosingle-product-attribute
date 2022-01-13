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

//adding stylesheets and scripts
function woospa_scripts()
{
    wp_enqueue_style('bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css');
    wp_enqueue_script('script-name', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array(), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'woospa_scripts');
//woo attribut function
function wooattr_add()
{
    require_once('main.php');
    // declaring $product
    global $product;
    //get current category
    $current_categories = $product->get_categories();
    echo ($current_categories);

    echo "<pre>";
    $cats = get_the_terms($product->ID, 'product_cat');

    //getting products parent category id
    foreach ($cats as $cat) {
        echo $cat->parent . ' ';
        break;
    }

    print_r($cats);
    echo "</pre>";

    // getting attributes and looping all available attribute
    $attributes = $product->get_attributes();
    //for each loop starts        
    echo '<div class="jumbotron">';
    echo '<div class="row w-100">';

    foreach ($attributes as $attribute) {
        $attribute_name = $attribute->get_taxonomy();
        $attribute_terms = $attribute->get_terms();
        $attribute_slugs = $attribute->get_slugs();
        $attribute_data = $attribute->get_data();

        $attribute_name_get = ($attribute_data['name']);
        $attr_prefix_remove = explode('pa_', $attribute_name_get);
        $attr_after_explode = $attr_prefix_remove[1];
        echo '<div class="col-md-3">'; ?>

        <div class="card border-info mx-sm-1 p-3">
            <div class="text-info text-center mt-3">
                <h4><?php echo ($attr_after_explode); ?></h4>
            </div>
            <div class="text-info text-center mt-2">
                <?php
                foreach ($attribute_terms as $value) { ?>
                    <ul>
                        <?php echo $value->name; ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
        </div>
    <?php
    } ?>
    </div>
    </div>
<?php
}
add_action('woocommerce_after_single_product_summary', 'wooattr_add');
?>