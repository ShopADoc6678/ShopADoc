<?php

$abdc_options = get_option('abdc_options', array());
$disable_admin_bar = !empty($abdc_options['disable_admin_bar']) ? $abdc_options['disable_admin_bar'] : '';
$disable_dashboard_access = !empty($abdc_options['disable_dashboard_access']) ? $abdc_options['disable_dashboard_access'] : '';
$dashboard_redirect_url = !empty($abdc_options['dashboard_redirect_url']) ? $abdc_options['dashboard_redirect_url'] : '';

$disable_admin_bar_roles = !empty($abdc_options['disable_admin_bar_roles']) ? $abdc_options['disable_admin_bar_roles'] : array();
$disable_dashboard_access_roles = !empty($abdc_options['disable_dashboard_access_roles']) ? $abdc_options['disable_dashboard_access_roles'] : array();

?>
<style>
    input[type='text'], textarea, select {
        width: 600px;
    }
</style>
<div class="wrap">

    <div id="icon-options-general" class="icon32"></div>
    <h2><?php _e('Admin Bar & Dashboard Control', 'admin-bar-dashboard-control'); ?></h2>
    <p><?php _e('Disable admin bar and control access to WordPress dashboard.', 'admin-bar-dashboard-control'); ?></p>

    <?php
    if (isset($_GET['settings-updated']) && ($_GET['settings-updated'])) {
        echo '<div id="message" class="updated notice is-dismissible"><p><strong>' . __('Settings saved', 'admin-bar-dashboard-control') . '</strong></p></div>';
    }
    ?>
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div class="meta-box-sortables ui-sortable">
                    <form method="post">
                        <div class="postbox">
                            <div title="<?php _e('Click to toggle', 'admin-bar-dashboard-control'); ?>" class="handlediv">
                                <br></div>
                            <h3 class="hndle"><span><?php _e('Admin Bar', 'admin-bar-dashboard-control'); ?></span></h3>

                            <div class="inside">
                                <table class="form-table">
                                    <tr>
                                        <th scope="row">
                                            <label for="disable-admin-bar"><?php _e('Disable Admin Bar', 'admin-bar-dashboard-control'); ?></label>
                                        </th>
                                        <td>
                                            <input id="disable_admin_bar" type="checkbox" name="abdc_options[disable_admin_bar]" value="yes" <?php checked($disable_admin_bar, 'yes') ?>>
                                            <p class="description">
                                                <?php _e('Check to disable admin bar.', 'admin-bar-dashboard-control'); ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="disable_admin_bar_roles"><?php _e('Admin Bar Control', 'admin-bar-dashboard-control'); ?></label>
                                        </th>
                                        <td>
                                            <?php foreach (get_editable_roles() as $role_key => $data) :
                                                if ($role_key == 'administrator') continue;
                                                ?>
                                                <label>
                                                    <input id="admin-bar-<?php echo $role_key; ?>" type="checkbox" name="abdc_options[disable_admin_bar_roles][]" value="<?php echo $role_key; ?>" <?php checked(in_array($role_key, $disable_admin_bar_roles)); ?>>
                                                    <?php echo $data['name']; ?></label><br/>
                                            <?php endforeach; ?>
                                            <p class="description">
                                                <?php _e('Select user roles admin bar will be disabled for. It will be disabled for everyone except admins if none is checked.', 'admin-bar-dashboard-control'); ?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                                <p>
                                    <?php wp_nonce_field('abc_settings_nonce'); ?>
                                    <input class="button-primary" type="submit" name="settings_submit" value="<?php _e('Save All Changes', 'admin-bar-dashboard-control'); ?>">
                                </p>
                            </div>
                        </div>

                        <div class="postbox">
                            <div title="<?php _e('Click to toggle', 'admin-bar-dashboard-control'); ?>" class="handlediv">
                                <br></div>
                            <h3 class="hndle">
                                <span><?php _e('Dashboard Access', 'admin-bar-dashboard-control'); ?></span></h3>

                            <div class="inside">
                                <table class="form-table">
                                    <tr>
                                        <th scope="row">
                                            <label for="disable_dashboard_access"><?php _e('Disable Dashboard Access', 'admin-bar-dashboard-control'); ?></label>
                                        </th>
                                        <td>
                                            <input id="disable_dashboard_access" type="checkbox" name="abdc_options[disable_dashboard_access]" value="yes" <?php checked($disable_dashboard_access, 'yes') ?>>
                                            <p class="description">
                                                <?php _e('Check to disable dashboard access for everyone.', 'admin-bar-dashboard-control'); ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="disable_dashboard_access_roles"><?php _e('Dashboard Access Control', 'admin-bar-dashboard-control'); ?></label>
                                        </th>
                                        <td>
                                            <?php foreach (get_editable_roles() as $role_key => $data) :
                                                if ($role_key == 'administrator') continue;
                                                ?>
                                                <label>
                                                    <input id="dashboard-access-<?php echo $role_key; ?>" type="checkbox" name="abdc_options[disable_dashboard_access_roles][]" value="<?php echo $role_key; ?>" <?php checked(in_array($role_key, $disable_dashboard_access_roles)); ?>>
                                                    <?php echo $data['name']; ?></label><br/>
                                            <?php endforeach; ?>
                                            <p class="description">
                                                <?php _e('Select user roles dashboard access will be disabled for. It will be disabled for everyone except admins if none is checked.', 'admin-bar-dashboard-control'); ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label for="dashboard_redirect_url"><?php _e('Dashboard Redirect URL', 'admin-bar-dashboard-control'); ?></label>
                                        </th>
                                        <td>
                                            <input id="dashboard_redirect_url" type="text" name="abdc_options[dashboard_redirect_url]" value="<?php echo $dashboard_redirect_url; ?>">
                                            <p class="description">
                                                <?php _e('Enter URL to redirect users to without dashboard access. If empty, users will be redirected to website homepage.', 'admin-bar-dashboard-control'); ?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                                <p>
                                    <?php wp_nonce_field('abc_settings_nonce'); ?>
                                    <input class="button-primary" type="submit" name="settings_submit" value="<?php _e('Save All Changes', 'admin-bar-dashboard-control'); ?>">
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="postbox-container-1" class="postbox-container">
                <div class="meta-box-sortables">
                    <div class="postbox">
                        <div class="handlediv"><br></div>
                        <h3 class="hndle" style="text-align: center;">
                            <span><?php _e('Developer', 'admin-bar-dashboard-control'); ?></span>
                        </h3>

                        <div class="inside">
                            <div style="text-align: center; margin: auto"><?php _e('Made with lots of love by', 'admin-bar-dashboard-control'); ?>
                                <br>
                                <a href="https://profilepress.net" target="_blank"><strong><?php _e('ProfilePress Team', 'admin-bar-dashboard-control'); ?></strong></a>
                            </div>
                        </div>
                    </div>
                    <div class="postbox">
                        <div class="handlediv"><br></div>
                        <h3 class="hndle" style="text-align: center;">
                            <span><?php _e('Support Plugin', 'admin-bar-dashboard-control'); ?></span>
                        </h3>

                        <div class="inside">
                            <div style="text-align: center; margin: auto">
                                <?php
                                // escape the URLs properly
                                $review_url = 'https://wordpress.org/support/view/plugin-reviews/admin-bar-dashboard-control';
                                $twitter_url = 'https://twitter.com/home?status=I%20love%20this%20WordPress%20plugin!%20https://wordpress.org/plugins/admin-bar-dashboard-control/';
                                ?>

                                <ul>
                                    <li><?php printf(wp_kses(__('Leave a positive review on the plugin\'s <a target="_blank" href="%s">WordPress listing</a>', 'admin-bar-dashboard-control'),
                                            array(
                                                'a' => array(
                                                    'href' => array(),
                                                    'target' => array('_blank'),
                                                ),
                                            )),
                                            esc_url($review_url)); ?></li>
                                    <li><?php printf(wp_kses(__('<a href="%s" target="_blank">Share your thoughts on Twitter</a>',
                                            'admin-bar-dashboard-control'),
                                            array(
                                                'a' => array(
                                                    'href' => array(),
                                                    'target' => array('_blank'),
                                                ),
                                            )),
                                            esc_url($twitter_url)); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="postbox" style="text-align: center">
                        <div class="handlediv"><br></div>
                        <h3 class="hndle ui-sortable-handle"><span>Check out ProfilePress Plugin</span></h3>

                        <div class="inside">
                            <p>A shortcode based WordPress form builder that makes building custom login, registration and password reset forms stupidly simple.</p>
                            <strong>Features</strong>
                            <ul>
                                <li>Unlimited front-end login forms</li>
                                <li>Unlimited front-end registration forms</li>
                                <li>Unlimited password reset forms.</li>
                                <li>Automatic login after registration.</li>
                                <li>Social Logins.</li>
                                <li>Custom user redirect users after login & logout</li>
                                <li>One-click widget creator.</li>
                                <li>And lots more.</li>
                                <li></li>
                            </ul>
                            <div>
                                <a href="https://profilepress.net/?utm_source=admin-bar-dash-plugin&utm_medium=crossell&utm_campaign=sidebar_ad" target="_blank">
                                    <button class="button-primary" type="button">Get Started Now!</button>
                                </a></div>
                        </div>
                    </div>

                    <div class="postbox" style="text-align: center">
                        <div class="handlediv"><br></div>
                        <h3 class="hndle ui-sortable-handle"><span>MailOptin WordPress Plugin</span></h3>

                        <div class="inside">
                            <p>Convert your website visitors into email subscribers, nurture & engage them with beautifully designed automated newsletters. All in WordPress.</p>
                            <div style="margin:10px 0">
                                <a href="https://mailoptin.io/pricing/?discount=10PERCENTOFF&utm_source=wp_dashboard&utm_medium=upgrade&utm_campaign=profilepress-sidebar-banner" target="_blank"><img width="250" src="https://i0.wp.com/mailoptin.io/wp-content/uploads/2016/01/mailoptin10off.jpg">
                                </a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>
</div>