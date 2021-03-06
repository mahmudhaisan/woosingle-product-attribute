<?php

/**
 * Plugin Name: Woo Single Product Attribute
 * Plugin URI: http://mahmudhaisan.com/
 * Description: Woo Single Product Attribute
 * Version: 1.2.0
 * Author: Mahmud haisan
 * Author URI: http://mahmudhaisan.com/
 * Developer: Mahmud Haisan
 * Developer URI: http://mahmudhaisan.com/
 * Text Domain: woospa195attr
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

//adding stylesheets and scripts
function woospa195attr_scripts()
{
    wp_enqueue_style('bootstrap-min', plugin_dir_url(__FILE__) . 'css/bootstrap-min.css');
    wp_enqueue_style('custom', plugin_dir_url(__FILE__) . 'css/style.css');
    // wp_enqueue_style('fontawesome', plugin_dir_url(__FILE__) . 'css/fontawesome.css');
    wp_enqueue_script('bootstrap-min', plugin_dir_url(__FILE__) . 'js/bootstrap-min.js', array(), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'woospa195attr_scripts');


//woo attribut function
function woospa195attr_add()
{
    // declaring global $product
    global $product;

    //getting products categories
    $cats = get_the_terms($product->get_ID(), 'product_cat');

    //getting products parent category id
    foreach ($cats as $cat) {
        $parent_cat_id = $cat->term_id;
        // $parent_cat_id = $cat->parent;
    }

    // show all thing in a specific category
    if ($parent_cat_id == 307) {

        // getting attributes and looping all available attribute
        $attributes = $product->get_attributes();

        // printing html elements before loop 
        echo '<div class="container">';
        echo '<div class="row">';

        //for each loop starts to get all attribute      
        foreach ($attributes as $attribute) {
            $attribute_terms = $attribute->get_terms();
            $attribute_data = $attribute->get_data();

            // getting attribue name 
            $attribute_name_get = ($attribute_data['name']);
            $attr_prefix_remove = explode('pa_', $attribute_name_get);

            $arr_attr_with_hyphens_zero = $attr_prefix_remove[0];
            $arr_attr_with_hyphens_one = $attr_prefix_remove[1];

            $final_attr_zero = str_replace('-', ' ', $arr_attr_with_hyphens_zero);
            $final_attr_one = str_replace('-', ' ', $arr_attr_with_hyphens_one);



            //checking whether 0 index is available or not
            if (isset($arr_attr_with_hyphens_zero)) {
                // 0 index showing the empty array if there it not find pa_ to explode
                $attr_with_explode = ucwords($final_attr_zero);
            }

            //checking whether 1 index is available or not
            if (isset($arr_attr_with_hyphens_one)) {
                // 1 index showing the output after explode pa_ from db
                $attr_with_explode = ucwords($final_attr_one);
            }

            echo '<div class="col-md-6 mb-3 padding-right">'; ?>
            <div>
                <div class="row bg-info border-around">
                    <div class="col-md-6 p-3">

                        <div class="mb-2">
                            <h4 class="text-white h5 font-weight-bold text-center">
                                <?php

                                if (!empty($attr_without_explode)) {
                                    echo $attr_without_explode;
                                } else {
                                    echo $attr_with_explode;
                                }

                                ?></h4>
                        </div>
                    </div>

                    <div class="col-md-6 bg-dark value-padding border-padding-right p-3">
                        <!-- <div class="text-info attr-title h3 font-weight-bold">
                            <?php
                            if (!empty($attr_without_explode)) {
                                echo $attr_without_explode;
                            } else {
                                echo $attr_with_explode;
                            }
                            ?>
                        </div> -->

                        <div class="">

                            <?php
                            // adding (array) before foreach array to handle null values                    
                            foreach ((array) $attribute_terms as $value) {
                            ?>
                                <ul class="m-0 list-unstyled">
                                    <li class="li-items text-white h5 text-center"> <?php echo ucfirst($value->name); ?> </li>
                                </ul>
                            <?php } ?>
                        </div>

                    </div>

                </div>

            </div>


            </div>
        <?php } ?>

        </div>
        </div>
<?php


    }
}


add_action('woocommerce_after_single_product_summary', 'woospa195attr_add', 6);

?>