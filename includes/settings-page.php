<div class="wrap">
    <h1><?php _e('MM Core Bulk Post Generator Settings', 'mm-core-bulk-post-generator'); ?></h1>
    <p><?php _e('These settings control the default behavior for posts created by the MM Bulk Post Generator plugin.', 'mm-core-bulk-post-generator'); ?></p>

    <form method="post" action="options.php">
        <?php
        settings_fields('mmcbpg_settings_group');
        do_settings_sections('mm-core-bulk-post-generator');
        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php _e('Default Settings', 'mm-core-bulk-post-generator'); ?></th>
                <td>
                    <fieldset>
                        <label>
                            <input type="checkbox" name="mmcbpg_activate_schema_default" value="1" <?php checked(get_option('mmcbpg_activate_schema_default', true), 1); ?> />
                            <?php _e('Activate Local Business Schema by default for new posts', 'mm-core-bulk-post-generator'); ?>
                        </label>
                        <br />
                        <label>
                            <input type="checkbox" name="mmcbpg_disable_comments_default" value="1" <?php checked(get_option('mmcbpg_disable_comments_default', true), 1); ?> />
                            <?php _e('Disable comments by default for new posts', 'mm-core-bulk-post-generator'); ?>
                        </label>
                    </fieldset>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>