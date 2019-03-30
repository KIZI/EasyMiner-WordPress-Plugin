<?php

namespace EasyMiner_Integration;

use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

class REST
{
    function __construct() {
        add_action('rest_api_init', array($this, 'register_routes'));
    }

    public function register_routes() {
       // wp_die();
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
                'permission_callback' => function () {
                    //return current_user_can('create_posts');
                    return true;
                }
            )
        );
    }

    public function getReportsCallback() {
        $data = array();
        $posts = get_posts(
            array(
                'post_type' => 'easyminer-report',
                'post_status' => 'publish',
            )
        );
        if (!empty($posts)) {
            foreach ($posts as $post) {
               $report_title = $post->post_title;
               $permalink = get_permalink($post->ID);
               $miner_id = get_post_meta($post->ID, 'miner_id');
               $task_id = get_post_meta($post->ID, 'task_id');
                $ar = array(
                    'report_title' => $report_title,
                    'report_permalink' => $permalink,
                    'miner_id' => $miner_id,
                    'task_id' => $task_id,
                );
                $data[] = $ar;
            }
        }
        $response = new WP_REST_Response($data);
        return $response;
    }

    public function createReportCallback(WP_REST_Request $request) {
        $id = wp_insert_post(array(
            'post_title' => $request['report_title'],
            'post_content' => $request['report_content'],
            'post_status' => 'publish',
            'post_type' => 'easyminer-report',
        ), false);
        update_post_meta($id, 'miner_id', $request['miner_id']);
        update_post_meta($id, 'task_id', $request['task_id']);
        $url = get_permalink($id);
        $result = array(
            'status' => 'OK',
            'url' => $url
        );
        $response = new WP_REST_Response($result);
        //$response->header( 'Location', $url );
        // v jsnu co vrátím bude adresa
        return $response;
    }
}