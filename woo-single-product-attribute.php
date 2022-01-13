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
    // declaring global $product
    global $product;

    //getting products categories
    $cats = get_the_terms($product->get_ID(), 'product_cat');

    //getting products parent category id
    foreach ($cats as $cat) {
        $paren_cat_id = $cat->parent;
    }

    // show all thing in a specific category
    if ($paren_cat_id == 307) {

        // getting attributes and looping all available attribute
        $attributes = $product->get_attributes();

        // printing html elements before loop 
        echo '<div class="jumbotron">';
        echo '<div class="row w-100">';

        //for each loop starts to get all attribute      
        foreach ($attributes as $attribute) {
            $attribute_terms = $attribute->get_terms();
            $attribute_data = $attribute->get_data();

            // getting attribue name 
            $attribute_name_get = ($attribute_data['name']);
            $attr_prefix_remove = explode('pa_', $attribute_name_get);


            //checking whether 0 index is available or not
            if (isset($attr_prefix_remove[0])) {
                // 0 index showing the empty array if there it not find pa_ to explode
                $attr_with_explode = ucfirst($attr_prefix_remove[0]);
            }

            //checking whether 1 index is available or not
            if (isset($attr_prefix_remove[1])) {
                // 1 index showing the output after explode pa_ from db
                $attr_with_explode = ucfirst($attr_prefix_remove[1]);
            }

            echo '<div class="col-md-3">'; ?>

            <div class="card border-info mx-sm-1 p-3">
                <div class="text-info text-center mt-3">
                    <h4><?php

                        if (!empty($attr_without_explode)) {
                            echo $attr_without_explode;
                        } else {
                            echo $attr_with_explode;
                        }
                        ?>
                    </h4>
                </div>
                <div class="text-info text-center mt-2">

                    <?php
                    // adding (array) before foreach array to handle null values                    
                    foreach ((array) $attribute_terms as $value) {
                    ?>
                        <ul>
                            <?php echo $value->name; ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>

            </div>
        <?php } ?>

        </div>
        </div>
<?php

    }
}


add_action('woocommerce_after_single_product_summary', 'wooattr_add');

?>