<?php

namespace EasyMiner_Integration;

defined( 'ABSPATH' ) or die;

use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use WP_Error;

class REST
{
    function __construct() {
        add_action('rest_api_init', array($this, 'register_routes'));

    }

    public function register_routes() {
        register_rest_route(
            'EasyMiner-WordPress-Plugin/v1',
            'getReports',
            array(
                'methods' => WP_REST_Server::READABLE, //GET
                'callback' => array($this, 'getReportsCallback')
            )
        );
        register_rest_route(
            'EasyMiner-WordPress-Plugin/v1',
            'createReport',
            array(
                'methods' => WP_REST_Server::CREATABLE, //POST
                'callback' => array($this, 'createReportCallback'),
                'args' => array(
                    'report_title'=> array(
                        'validate_callback' => function($param, $request, $key) {
                            //return is_numeric( $param );
                            return true;
                        },
                        'required' => true,
                    ),
                    'report_content' => array(
                        'required' => true,
                    ),
                    'miner_id' => array(
                        'required' => true,
                    ),
                    'task_id' => array(
                        'required' => true,
                    ),
                ),
               /* 'permission_callback' => function () {
                    //return current_user_can('create_posts');
                    return true;
                }*/
            )
        );
    }

    public function getReportsCallback() {
        $data = [];
        $posts = get_posts(
            ['post_type' => 'easyminer-report',
             'post_status' => 'publish',
             'numberposts'=>-1]
        );
        if (!empty($posts)) {
            foreach ($posts as $post) {
               $ar = array(
                    'report_title' => $post->post_title,
                    'report_permalink' => get_permalink($post->ID),
                    'miner_id' => get_post_meta($post->ID, 'miner_id', true),
                    'task_id' => get_post_meta($post->ID, 'task_id', true),
               );
               $data[] = $ar;
            }
        }
        return new WP_REST_Response($data);
    }

    public function createReportCallback(WP_REST_Request $request) {
        $r = wp_insert_post(array(
            'post_title' => $request['report_title'],
            'post_content' => $request['report_content'],
            'post_status' => 'publish',
            'post_type' => 'easyminer-report',
        ), true);
        if ($r instanceof WP_Error) return $r;
        update_post_meta($r, 'miner_id', $request['miner_id']);
        update_post_meta($r, 'task_id', $request['task_id']);
        $url = get_permalink($r);
        $result = array(
            'status' => 'OK',
            'url' => $url
        );
	    return new WP_REST_Response($result);
    }
}
