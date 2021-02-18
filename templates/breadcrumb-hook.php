<?php
if ( ! defined('ABSPATH')) exit;  // if direct access




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

