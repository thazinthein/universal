 <div class="nav" id="tabs">
                    <?php
                    $args = array(
                        'number' => $number,
                        'orderby' => $orderby,
                        'order' => $order,
                        'hide_empty' => $hide_empty,
                        'include' => $ids
                    );
 
                    $product_categories = get_terms('product_cat', $args);
                    ?>
                    <ul>
                      
 
                        <?php
                            $i = 0;
                                foreach ($product_categories as $cat) {
                                    ?>
                                    <li>
         
         
                                        <a id="<?php echo $cat->slug; ?>"
                                           class="product-<?php echo $cat->slug; ?><?php if ($i == 0) {
                                               echo " active";
                                           } ?>"
                                           data-name="<?php echo $cat->name; ?>"
                                           href="#"><?php echo $cat->name; ?></a>
                                    </li>
                                    <?php
                                    $i++;
                                }
                        ?>
                    </ul>
                </div>

<div class="product_content" id="tabs_container">
                <?php
                $i = 0;
                foreach ($product_categories as $cat) {
                    ?>
                    <div class="each_cat<?php if ($i == 0) {
                        echo " active";
                    } ?>" id="product-<?php echo $cat->slug; ?>">
                        <?php
                        echo do_shortcode('[product_category category="' . $cat->name . '" per_page="12" columns="4" orderby="date" order="desc"]');
                        ?></div>
                    <?php $i++;
                } ?>
 
                <?php //echo do_shortcode('[recent_products per_page="8" columns="4" orderby="date" order="desc"]'); ?>
            </div>
