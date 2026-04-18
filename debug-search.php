<?php
require_once('wp-load.php');
$args = array(
    'post_type' => 'product',
    's' => '1-compar'
);
$query = new WP_Query($args);
echo "SQL REQUEST:\n";
echo $query->request . "\n\n";
echo "FOUND POSTS:\n";
foreach($query->posts as $post) {
    echo "- " . $post->post_title . "\n";
}
