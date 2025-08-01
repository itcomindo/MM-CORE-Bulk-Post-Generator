<?php
if (! defined('ABSPATH')) exit;

function mmcbpg_register_acf_field_group()
{
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_mmbpg_seo_local_business',
        'title' => 'MM SEO Local Business',
        'fields' => array(
            array('key' => 'field_mmbpg_kota', 'label' => 'Kota', 'name' => 'seo_kota', 'type' => 'text', 'readonly' => 1),
            array('key' => 'field_mmbpg_provinsi', 'label' => 'Provinsi', 'name' => 'seo_provinsi', 'type' => 'text', 'readonly' => 1),
            array('key' => 'field_mmbpg_kodepos', 'label' => 'Kode Pos', 'name' => 'seo_kodepos', 'type' => 'text', 'readonly' => 1),
            array('key' => 'field_mmbpg_phone', 'label' => 'Nomor Telepon', 'name' => 'seo_lb_phone', 'type' => 'text', 'readonly' => 1),
            array('key' => 'field_mmbpg_alamat', 'label' => 'Alamat Lengkap', 'name' => 'seo_alamat', 'type' => 'textarea', 'readonly' => 1),
            array('key' => 'field_mmbpg_pricerange', 'label' => 'Price Range', 'name' => 'pricerange', 'type' => 'text', 'readonly' => 1),
            array('key' => 'field_mmbpg_review_tab', 'label' => 'Data Review', 'type' => 'tab'),
            array('key' => 'field_mmbpg_author_review_name', 'label' => 'Nama Author (Review)', 'name' => 'seo_author_review_name', 'type' => 'text', 'readonly' => 1),
            array('key' => 'field_mmbpg_author_rating', 'label' => 'Rating dari Author', 'name' => 'seo_author_rating', 'type' => 'number', 'readonly' => 1),
            array('key' => 'field_mmbpg_total_review', 'label' => 'Total Review', 'name' => 'seo_total_review', 'type' => 'number', 'readonly' => 1),
            array('key' => 'field_mmbpg_total_average_rating', 'label' => 'Total Rata-rata Rating', 'name' => 'seo_total_average_rating', 'type' => 'number', 'readonly' => 1),
        ),
        'location' => array(array(array('param' => 'post_type', 'operator' => '==', 'value' => 'post'))),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Field group untuk data SEO Local Business yang dibuat oleh MM Bulk Post Generator.',
    ));
}
add_action('acf/init', 'mmcbpg_register_acf_field_group');
