<?php
if (! defined('ABSPATH')) exit;

/**
 * Fungsi dasar untuk mengambil post meta untuk shortcode.
 * @param string $meta_key Key dari custom field.
 * @return string Nilai dari meta field.
 */
function mmcbpg_get_meta_shortcode($meta_key)
{
    $post_id = get_the_ID();
    if (! $post_id) {
        return '';
    }
    $value = get_post_meta($post_id, $meta_key, true);
    return esc_html($value);
}

// Shortcode untuk Judul Post
add_shortcode('judul_post', function () {
    $post_id = get_the_ID();
    return $post_id ? esc_html(get_the_title($post_id)) : '';
});

// Shortcode untuk data SEO Lokal
add_shortcode('kota', function () {
    return mmcbpg_get_meta_shortcode('seo_kota');
});
add_shortcode('provinsi', function () {
    return mmcbpg_get_meta_shortcode('seo_provinsi');
});
add_shortcode('kodepos', function () {
    return mmcbpg_get_meta_shortcode('seo_kodepos');
});
add_shortcode('nomor_telepon', function () {
    return mmcbpg_get_meta_shortcode('seo_lb_phone');
});
add_shortcode('alamat', function () {
    return mmcbpg_get_meta_shortcode('seo_alamat');
});

// Shortcode untuk data Review
add_shortcode('author_review_name', function () {
    return mmcbpg_get_meta_shortcode('seo_author_review_name');
});
add_shortcode('author_rating', function () {
    return mmcbpg_get_meta_shortcode('seo_author_rating');
});
add_shortcode('total_review', function () {
    return mmcbpg_get_meta_shortcode('seo_total_review');
});
add_shortcode('total_average_rating', function () {
    return mmcbpg_get_meta_shortcode('seo_total_average_rating');
});
add_shortcode('pricerange', function () {
    return mmcbpg_get_meta_shortcode('pricerange');
});
add_shortcode('judul', function () {
    return esc_html(get_the_title());
});
