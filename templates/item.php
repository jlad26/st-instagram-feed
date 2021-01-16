<?php
/**
 * Smash Balloon Instagram Feed Item Template
 * Adds an image, link, and other data for each post in the feed
 *
 * @version 2.5 Instagram Feed by Smash Balloon
 *
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$item = st_sbi_parse_item( $post, $settings, $offset, $icon_type, $resized_images );

?>
<div class="sbi_item sbi_type_<?php echo esc_attr( $item->media_type ); ?><?php echo esc_attr( $item->classes ); ?>" id="sbi_<?php echo esc_html( $item->post_id ); ?>" data-date="<?php echo esc_html( $item->timestamp ); ?>">
    <?php if ( 'carousel' == $item->media_type ) {
        if ( isset( $post['children']['data'] ) && is_array( $post['children']['data'] ) ) {
            echo '<div class="sbi_photo_wrap">';
            foreach ( $post['children']['data'] as $key => $child ) {
                $display = 0 === $key ? true : false;
                $child_item = st_sbi_parse_item( $child, $settings, $offset, $icon_type, $resized_images );
                if ( 'video' == $child_item->media_type ) {
                    st_sbi_render_video_html( $child_item, $display );
                } else {
                    $icon_html = $display ? SB_Instagram_Display_Elements::get_icon( 'carousel', $item->icon_type ) : '';
                    st_sbi_render_image_html( $child_item, $display, $icon_html );
                }
            }
            echo '</div>';
        }
    } elseif ( 'video' == $item->media_type ) {
        echo '<div class="sbi_photo_wrap">';
        st_sbi_render_video_html( $item );
        echo '</div>';
    } else {
        st_sbi_render_image_html( $item );
    }
    ?>
    <div class="sbi-caption"><?php esc_html_e( $item->caption ); ?></div>
</div>