<label><input type="checkbox" <?php checked( $track_bots, '1' ); ?> value="1" name="<?php echo $this->plugin->options_slug; ?>[track-bots]" /></label>
<p class="description"><?php _e( 'Activate to also count impressions and clicks for crawlers, bots and empty user agents', 'advanced-ads-tracking' ); ?></p>
