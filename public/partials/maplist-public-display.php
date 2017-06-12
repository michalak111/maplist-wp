<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://dzonym.pl
 * @since      1.0.0
 *
 * @package    Maplist
 * @subpackage Maplist/public/partials
 */
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH4lERbBgrvHYWJZoDy_vgptl6dX8_ydQ"></script>
<?php
$locations = new WP_Query(array(
    'post_type' => 'maplist'
));

$area = get_terms(
    array(
        'taxonomy' =>'area'
    )
);
?>
<div class="maplist-locations">
    <section class="ml-map">
        <div id="ml-gmap"></div>
        <button class="ml-btn ml-gotolist">Pokaż liste</button>
    </section>
    <section class="ml-location-list">
        <div class="ml-search-locations-wrapper">
            <label for="ml-search-locations">Search:</label>
            <input type="text" class="ml-search-locations" id="ml-search-locations">
        </div>
        <nav class="ml-location-select">
            <label for="ml-location-region">Filter:</label>
            <select id="ml-location-region">
                <option value="All">All</option>
                <?php foreach ($area as $single_area): ?>
                    <option value="<?php echo $single_area->name; ?>"><?php echo $single_area->name; ?></option>
                <?php endforeach; ?>
            </select>
        </nav>
        <ol class="ml-locations">
            <?php while($locations->have_posts()) : $locations->the_post(); ?>
                <?php
                    $location = $locations->post;
                    $loc_lat = get_post_meta($location->ID,'_maplist_lat', true);
                    $loc_lng = get_post_meta($location->ID,'_maplist_lng', true);
                    $loc_cat = get_the_terms($location->ID, 'area')[0]->name;
                    $loc_address = get_post_meta($location->ID,'_maplist_address', true);
                    $loc_desc = get_post_meta($location->ID,'_maplist_description', true);
                    $loc_gallery = get_post_meta($location->ID,'_maplist_gallery', true);
                ?>
                <li class="ml-entry-location" data-lat="<?php echo $loc_lat; ?>" data-lng="<?php echo $loc_lng; ?>" data-place="<?php the_title(); ?>" data-cat="<?php echo $loc_cat; ?>">
                    <h2 class="ml-entry-name"><?php the_title(); ?> - <?php echo $loc_cat; ?></h2>
                    <button class="ml-btn ml-show-location-details"></button>
                    <div class="ml-entry-more-details">
                        <p class="ml-entry-address"><?php echo $loc_address ;?></p>
                        <p class="ml-entry-description">
                            <?php echo $loc_desc; ?>
                        </p>
                        <?php if(!empty($loc_gallery)): ?>
                            <div class="ml-entry-gallery" data-featherlight-gallery data-featherlight-filter="a">
                                <?php foreach ($loc_gallery as $image_id => $image_url) : ?>
                                    <?php  echo wp_get_attachment_link( $image_id, 'thumb'); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); wp_reset_query();?>
        </ol>
    </section>
</div>