<?php
/**
 * Plugin Name: Ensure admin user isn't deleted
 * Description: Ensure the admin user (wp-thewolfhoundexperiencecom), isn't deleted
 * Version: 1.0
 */

add_action(
    'delete_user',
    function ($id) {
        $user = get_user_by('id', $id);
        if (! $user->has_prop('user_login')) {
            return;
        }

        $login = $user->get('user_login');
        if ($login === 'wp-thewolfhoundexperiencecom') {
            die('You can\'t delete the admin user "wp-thewolfhoundexperiencecom", it is needed for the WordPress tools.');
        }
    }
);
