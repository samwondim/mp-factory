<?php
use PHPUnit\Framework\TestCase;

class TestPostQueue extends TestCase{
    public function test_add_post_to_queue() {
        
        $response = wp_remote_post(
            rest_url('post-queue/v1/add-post'),
            [
                'body' => json_encode(['post_data' => 'Sample test post data']),
                'headers' => ['Content-type' => 'application/json'],
            ]
            );
        $this.assert(200 == wp_remote_retrieve_response_code($response));
        

        // $this->assert('Post added to the queue.' == wp_remote_retrieve_body($response));
    }
}