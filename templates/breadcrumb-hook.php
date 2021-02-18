<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

//
//add_action('post_grid_container', 'post_grid_search_form', 5);
//
//function post_grid_search_form($args){
//
//    $post_grid_settings = get_option('post_grid_settings');
//
//    $grid_id = $args['grid_id'];
//    $post_grid_options = $args['options'];
//
//    $font_aw_version = isset($post_grid_settings['font_aw_version']) ? $post_grid_settings['font_aw_version'] : 'v_5';
//
//
//    $nav_top_search = isset($post_grid_options['nav_top']['search']) ? $post_grid_options['nav_top']['search'] : 'no';
//    $grid_type = isset($post_grid_options['grid_type']) ? $post_grid_options['grid_type'] : 'grid';
//
//    //if($nav_top_search !='yes') return;
//
//
//    if($font_aw_version == 'v_5'){
//        $nav_top_search_icon = '<i class="fas fa-search"></i>';
//    }elseif($font_aw_version == 'v_4'){
//        $nav_top_search_icon = '<i class="fa fa-search"></i>';
//    }
//
//    $nav_top_search_placeholder = isset($post_grid_options['nav_top']['search_placeholder']) ? $post_grid_options['nav_top']['search_placeholder'] : __('Start typing', 'post-grid');
//    $nav_top_search_icon = isset($post_grid_options['nav_top']['search_icon']) ? $post_grid_options['nav_top']['search_icon'] : $nav_top_search_icon;
//
//
//    $keyword = isset($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : '';
//    wp_enqueue_style('post-grid-search');
//
//    //echo '<pre>'.var_export($_SERVER, true).'</pre>';
//
//    $page_url = '';
//
//    ?>
<!--    <div class="post-grid-search">-->
<!--        <form action="#--><?php ////echo $page_url; ?><!--" method="get">-->
<!--            --><?php
//
//            do_action('post_grid_search', $args);
//
//            ?>
<!--            <div class="field-wrap submit">-->
<!--                <div class="field-input">-->
<!--                    --><?php //wp_nonce_field( 'nonce_post_grid_search' ); ?>
<!--                    <input type="submit" class=""  placeholder="" value="Submit">-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!---->
<!---->
<!---->
<!---->
<!--    </div>-->
<!---->
<!---->
<!---->
<!---->
<!--    --><?php
//
//
//
//}





// Process form data and post query

function breadcrumb_tags_custom($tags){

    $tags['job']['front_text'] = array('name' => __('Front text','breadcrumb'));
    $tags['job']['home'] = array('name' => __('Home','breadcrumb'));
    $tags['job']['post_title'] = array('name' => __('Job title','breadcrumb'));
    $tags['job']['post_author'] = array('name' => __('Job author','breadcrumb'));
    $tags['job']['job_category'] = array('name' => __('Job category','breadcrumb'));
    $tags['job']['job_tag'] = array('name' => __('Job tag','breadcrumb'));
    $tags['job']['post_date'] = array('name' => __('Job date','breadcrumb'));
    $tags['job']['post_month'] = array('name' => __('Job month','breadcrumb'));
    $tags['job']['post_year'] = array('name' => __('Job year','breadcrumb'));
    $tags['job']['post_id'] = array('name' => __('Job ID','breadcrumb'));

    return $tags;
}

add_filter('breadcrumb_tags','breadcrumb_tags_custom', 90);





add_action('breadcrumb_tag_options_job_category', 'breadcrumb_tag_options_job_category');

function breadcrumb_tag_options_job_category($parameters){
    $settings_tabs_field = new settings_tabs_field();
    $input_name = isset($parameters['input_name']) ? $parameters['input_name'] : '{input_name}'



    ?>
    <div class="item">
        <div class="element-title header ">
            <span class="remove" onclick="jQuery(this).parent().parent().remove()"><i class="fas fa-times"></i></span>
            <span class="sort"><i class="fas fa-sort"></i></span>

            <span class="expand"><?php echo __('Job category','breadcrumb'); ?></span>
        </div>
        <div class="element-options options">

            <?php

            $prefix_text = '';
            $args = array(
                'id'		=> 'prefix_text',
                'parent' => $input_name.'[job_category]',
                'title'		=> __('Prefix text','breadcrumb'),
                'details'	=> __('Add prefix text.','breadcrumb'),
                'type'		=> 'text',
                'value'		=> $prefix_text,
                'default'		=> '',
            );

            $settings_tabs_field->generate_field($args);

            ?>

        </div>
    </div>
    <?php

}


add_filter('breadcrumb_permalink_job_category', 'breadcrumb_permalink_job_category');

function breadcrumb_permalink_job_category($breadcrumb_items){


    return array(
        'link'=> '#',
        'title' => 'Category title',
    );

}


add_filter('breadcrumb_singular_job', 'breadcrumb_singular_job');

function breadcrumb_singular_job($array_list1){

    $breadcrumb_text = __('You are here','breadcrumb');

    global $post;
    $breadcrumb_url_hash= '';

    $array_list[] = array(
        'link'=> '#',
        'title' => $breadcrumb_text,
    );
    $array_list[] = array(
        'link'=> '#',
        'title' => get_post_type(),
    );

    $array_list[] = array(
        'link'=>!empty($breadcrumb_url_hash) ? $breadcrumb_url_hash : get_permalink($post->ID),
        'title' => get_the_title($post->ID),
    );

    //echo '<pre>';

    //echo var_export($array_list, true);

    //echo '</pre>';
    return $array_list;

}

