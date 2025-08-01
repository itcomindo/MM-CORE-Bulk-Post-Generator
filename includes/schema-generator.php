<?php
if (! defined('ABSPATH')) exit;

/**
 * Menambahkan Meta Box ke halaman editor post.
 */
function mmcbpg_add_schema_meta_box()
{
    add_meta_box(
        'mmcbpg_schema_metabox',                 // ID Meta Box
        'MM SEO Local Business Schema',          // Judul Meta Box
        'mmcbpg_render_schema_meta_box',         // Fungsi callback untuk render
        'post',                                  // Tipe post
        'side',                                  // Konteks (normal, side, advanced)
        'high'                                   // Prioritas
    );
}
add_action('add_meta_boxes', 'mmcbpg_add_schema_meta_box');

/**
 * Merender konten Meta Box.
 * @param WP_Post $post Objek post saat ini.
 */
function mmcbpg_render_schema_meta_box($post)
{
    wp_nonce_field('mmcbpg_save_schema_meta_box_data', 'mmcbpg_schema_meta_box_nonce');
    $value = get_post_meta($post->ID, '_mmbpg_activate_schema', true);

    echo '<label for="mmcbpg_activate_schema_field">';
    echo '<input type="checkbox" id="mmcbpg_activate_schema_field" name="mmcbpg_activate_schema_field" value="yes" ' . checked($value, 'yes', false) . ' />';
    _e(' Aktifkan Schema Markup', 'mm-core-bulk-post-generator');
    echo '</label>';
    echo '<p class="description">' . __('Jika dicentang, schema Local Business akan ditambahkan ke post ini.', 'mm-core-bulk-post-generator') . '</p>';
}

/**
 * Menyimpan data dari Meta Box saat post disimpan.
 * @param int $post_id ID dari post yang disimpan.
 */
function mmcbpg_save_schema_meta_box_data($post_id)
{
    if (! isset($_POST['mmcbpg_schema_meta_box_nonce']) || ! wp_verify_nonce($_POST['mmcbpg_schema_meta_box_nonce'], 'mmcbpg_save_schema_meta_box_data')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (! current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['mmcbpg_activate_schema_field'])) {
        update_post_meta($post_id, '_mmbpg_activate_schema', 'yes');
    } else {
        delete_post_meta($post_id, '_mmbpg_activate_schema');
    }
}
add_action('save_post', 'mmcbpg_save_schema_meta_box_data');

/**
 * Menyuntikkan JSON-LD Schema ke <head> jika diaktifkan.
 */
function mmcbpg_inject_schema_in_head()
{
    if (! is_singular('post')) {
        return;
    }

    $post_id = get_the_ID();
    if ('yes' !== get_post_meta($post_id, '_mmbpg_activate_schema', true)) {
        return;
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => get_the_title($post_id),
        'image' => get_the_post_thumbnail_url($post_id, 'full'),
        'url' => get_permalink($post_id),
        'telephone' => get_post_meta($post_id, 'seo_lb_phone', true),
        'priceRange' => get_post_meta($post_id, 'pricerange', true),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => get_post_meta($post_id, 'seo_alamat', true),
            'addressLocality' => get_post_meta($post_id, 'seo_kota', true),
            'addressRegion' => get_post_meta($post_id, 'seo_provinsi', true),
            'postalCode' => get_post_meta($post_id, 'seo_kodepos', true),
            'addressCountry' => 'ID'
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => get_post_meta($post_id, 'seo_total_average_rating', true),
            'reviewCount' => get_post_meta($post_id, 'seo_total_review', true)
        ],
        'review' => [
            '@type' => 'Review',
            'author' => [
                '@type' => 'Person',
                'name' => get_post_meta($post_id, 'seo_author_review_name', true)
            ],
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => get_post_meta($post_id, 'seo_author_rating', true),
                'bestRating' => '5'
            ],
            'reviewBody' => 'Layanan yang sangat memuaskan dan profesional. Sangat direkomendasikan!'
        ]
    ];

    // Filter array untuk menghapus entri yang kosong
    $schema = array_filter($schema, function ($value) {
        return !empty($value);
    });

    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'mmcbpg_inject_schema_in_head');
