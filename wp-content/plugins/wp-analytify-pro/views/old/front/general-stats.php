<?php

// View of General Statistics

function pa_include_general( $current, $stats) {
?>
<div class="analytify_popup" id="general">
  <div class="analytify_popup_header">
    <h4><?php esc_html_e( 'General Statistics', 'wp-analytify'); ?></h4>
    <span class="analytify_popup_clsbtn">&times;</span>
  </div>
  <div class="analytify_popup_body">
    <div class="table-responsive">
      <table class="analytify_table analytify_table_hover">
        <tbody>
          <tr>
            <th><?php analytify_e( 'Sessions', 'wp-analytify'); ?></th>
            <td><?php echo number_format($stats->totalsForAllResults['ga:sessions']); ?></td>
          </tr>
          <tr>
            <th><?php analytify_e( 'Users', 'wp-analytify'); ?></th>
            <td><?php echo number_format($stats->totalsForAllResults['ga:users']); ?></td>
          </tr>
          <tr>
            <th style="min-width: 120px;"><?php analytify_e( 'Bounce rate', 'wp-analytify'); ?></th>
            <td>
              <?php
                  if ($stats->totalsForAllResults['ga:entrances'] <= 0) { ?>
                      0.00%
              <?php
                  }
                  else {
                        echo number_format(round(($stats->totalsForAllResults['ga:bounces'] / $stats->totalsForAllResults['ga:entrances']) * 100, 2), 2);
              ?>%
              <?php } ?>
            </td>
          </tr>
          <tr>
            <th style="min-width: 145px;"><?php analytify_e( 'Avg. time on site', 'wp-analytify' ); ?></th>
            <td>
              <?php
                  if ($stats->totalsForAllResults['ga:sessions'] <= 0) {
              ?>
                    00:00:00
              <?php
                  }
                  else {
                      echo $current->pa_pretty_time($stats->totalsForAllResults['ga:avgTimeOnPage']);
              ?>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <th style="min-width: 130px;"><?php esc_html_e( 'AVERAGE PAGES', 'wp-analytify-pro'); ?></th>
            <td>
                <?php
                    if ($stats->totalsForAllResults['ga:sessions'] <= 0) {
                  ?>
                  0.00
                  <?php
                    } //$stats->totalsForAllResults['ga:sessions'] <= 0
                    else {
                  ?>
                  <?php
                      echo number_format(round($stats->totalsForAllResults['ga:pageviews'] / $stats->totalsForAllResults['ga:sessions'], 2), 2);
                  ?>
                  <?php } ?>
            </td>
          </tr>
          <tr>
              <th style="min-width: 120px;"><?php analytify_e( 'Page views', 'wp-analytify'); ?></th>
              <td>
                <?php
                  if ($stats->totalsForAllResults['ga:pageviews'] <= 0) {
                ?>
                0
                <?php
                  } //$stats->totalsForAllResults['ga:sessions'] <= 0
                  else {
                ?>
                <?php
                    echo $current->wpa_number_format( $stats->totalsForAllResults['ga:pageviews'] );
                ?>
                <?php } ?>
              </td>
          </tr>
          <tr>
            <th style="min-width: 145px;"><?php esc_html_e( 'USER TYPE', 'wp-analytify-pro'); ?></th>
            <td>
               <?php
                  if (isset($stats->totalsForAllResults))
                  {
                    $returning = $stats->totalsForAllResults['ga:sessions'] - $stats->totalsForAllResults['ga:newUsers'];
                ?>
                 New  (<?php echo $stats->totalsForAllResults['ga:newUsers'];?>)
                 Returning (<?php echo $returning;?>)
                <?php
                }
              ?>
            </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="analytify_popup_footer">
    <span class="analytify_popup_info"></span> <?php esc_html_e( 'These are the general statistics of this page.', 'wp-analytify'); ?>
  </div>
</div>
<?php }
