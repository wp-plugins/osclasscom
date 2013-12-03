<?php
/*
Plugin Name: Osclass job board
Plugin URI: http://osclass.com
Description: Embed your osclass job board inside your wordpress.
Version: 1.0
Text Domain: osclasscom
Author: Osclass team
Author URI: http://osclass.com
Tags: jobs, job, career, manager, vacancy, hiring, hire, listing, social, media, recruiting, recruitment, employer, application, board
License: GPLv2
*/

// admin menu entrie
add_action( 'admin_menu', 'osclasscom_custom_admin_page');

function osclasscom_custom_admin_page() {
    $page_hook_suffix = add_menu_page('Osclass job board', 'Osclass job board', 'administrator',
     'osclasscom/create.php', '', plugins_url('osclasscom/images/icon.png'));
}

function osclasscom_admin_scripts($hook) {
    if($hook!='osclasscom/create.php')
        return;
    /* Link our already registered script to a page */
    wp_enqueue_script(
            'osclasscom-jquery-validate', plugin_dir_url(__FILE__) . 'js/jquery.validate.min.js', array('jquery'), '1.10.0', true
    );
    wp_enqueue_script(
            'osclasscom_create', plugin_dir_url(__FILE__) . 'js/create.js', array('jquery', 'osclasscom-jquery-validate'), '1.10.0', true
    );
}
add_action( 'admin_enqueue_scripts', 'osclasscom_admin_scripts' );

/**
 * Called via ajax on lastest step of site creation.
 *
 * Subdomain name
 * Key binding
 */
function osclass_is_bind() {
    $array_osclasscom = get_option('osclasscom') ;
    if( isset($array_osclasscom) && $array_osclasscom!='' ) {
        return true;
    }
    return false;
}

add_action( 'before_delete_post', 'osclasscom_delete_post' );
function osclasscom_delete_post( $postid ){
    if( get_option('osclasscom_pageid') == $postid ) {
        delete_option( 'osclasscom_pageid' );
    }
}

// ajax
add_action('admin_footer', 'osclass_bind_javascript');
function osclass_bind_javascript() { ?>
    <script type="text/javascript" >

        function ajax_osclass(json) {
            var data = {
                action: 'create_bind',
                site: json.site_url,
                key: json.key
            }

            jQuery.post(ajaxurl, data, function(response) {
                if(response.success) {
                    /* redirect */
                    location.reload(true);
                } else {
                    /* error */
                }
            }, 'json');
        }
    </script>
    <?php
}

add_action('wp_ajax_create_bind', 'osclass_create_bind');
function osclass_create_bind() {
    $result = array('success' => false);

    // update api key
    $key = $_POST['key'];
    update_option('osclasscom_key', $key);

    // clean end slash
    $site = $_POST['site'];
    $site = preg_replace('/\/$/', '', $site);
    if($site!='') {
        $result['success']   = true;
        // force update
        update_option('osclasscom', $site);
    }

    // if there isn't a jobboard page, add a new page.
    if( get_option('osclasscom_pageid')=='' ) {
        $post = array(
            'post_content'   => '[osclasscom]',
            'post_name'      => 'jobs',
            'post_title'     => __('Jobs', 'osclasscom'),
            'post_status'    => 'publish',
            'post_type'      => 'page'
            );
        $page_id = wp_insert_post( $post, $wp_error );
        if($page_id > 0) {
            update_option('osclasscom_pageid', $page_id);
        }
    }

    echo json_encode($result);
    die();
}

// -----------------------------------------------------------------------------
if( !function_exists( 'osclasscom_get_the_excerpt' )) :
    function osclasscom_get_the_excerpt($text, $words = 55, $more = '[...]') {
            $aux = $text;
            if (!$excerpt = trim($text)) {
                $excerpt_length = apply_filters('excerpt_length', $words);
                $excerpt_more   = apply_filters('excerpt_more', ' ' . $more);

                $words = preg_split("/[\n\r\t ]+/", $excerpt, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
                if ( count($words) > $excerpt_length ) {
                    array_pop($words);
                    $excerpt = implode(' ', $words);
                    $excerpt = $excerpt . $excerpt_more;
                } else {
                    $excerpt = implode(' ', $words);
                }
                $aux = $excerpt;
            }
            return $aux;
        }
endif;

// -----------------------------------------------------------------------------

if ( ! function_exists( 'osclasscom_embed_shortcode' ) ) :

    function osclasscom_enqueue_script() {
        wp_enqueue_script( 'jquery' );
    }
    add_action( 'wp_enqueue_scripts', 'osclasscom_enqueue_script' );

    function osclasscom_embed_shortcode( $atts, $content = null ) {

        /**
         *
         * get rss feed from jobboard, show list of last vacancies.
         *
         */
        $urlFeed = get_option('osclasscom').'/search?sFeed=rss';
        $xmlstr = file_get_contents($urlFeed);

        $vacancies = new SimpleXMLElement($xmlstr);


            if(count($vacancies->channel->item) > 0) {
                foreach($vacancies->channel->item as $vacancy) {
                    $trimed_content = '';
                    if(function_exists('wp_trim_words')) {
                        $trimed_content = wp_trim_words( $vacancy->description,  25, '...' );
                    } else {
                        $trimed_content = osclasscom_get_the_excerpt($vacancy->description, 25, '[...]');
                    }
                    $newHtml .= '<h3 class="osclasscomJobListElementHeader">';
                    $newHtml .= '    <a href="'.$vacancy->link.'" title="'.$vacancy->title.'">'.$vacancy->title.'</a>';
                    $newHtml .= '</h3>';
                    $newHtml .= '<div><b>'.date('Y-m-d', strtotime($vacancy->pubDate)).'</b>  '.$trimed_content.'</div>';

                }
            } else {
                $newHtml .= '<h3>'.__('Currently no job vacancies available', 'osclasscom').'</h3>';
            }
            if(count($vacancies->channel->item) > 0) {
                $newHtml .= "<p style='float:right;'><a target='_blank' href='".$vacancies->channel->link."'>".__('View all offers','osclasscom')."</a></p>";
            }
            $newHtml .= "<p class='linkosclass'><a href='http://osclass.com'><img class='logoosclass' src='".plugins_url('osclasscom/images/osclass-wp.png')."'/></a></p>";

            return $newHtml;
    }
    add_shortcode( 'osclasscom', 'osclasscom_embed_shortcode' );


    function osclasscom_plugin_meta( $links, $file ) { // add 'Plugin page' and 'Donate' links to plugin meta row
        if ( strpos( $file, 'osclass-admin.php' ) !== false ) {
            $links = array_merge( $links, array( '<a href="http://osclass.com" target="_blank" title="Plugin page">' . __('Osclass jobboard') . '</a>' ) );
        }
        return $links;
    }
    add_filter( 'plugin_row_meta', 'osclasscom_plugin_meta', 10, 2 );

endif; // end of if(function_exists('osclasscom_embed_shortcode'))

// EOF
