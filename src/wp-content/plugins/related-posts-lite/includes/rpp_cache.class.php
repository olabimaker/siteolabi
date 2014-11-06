<?php
class rppCache {
  public static function getCached($rpp_id, $post) {
    $data = get_transient( "rpp_id_".$rpp_id );
    if ($data != false && is_array($data) && isset($data['post_'.$post->ID])) {
      return $data['post_'.$post->ID];
    } else {
      return false;
    }  
  }
  
  public static function setCached($rpp_id, $post, $posts, $timeout) {
    if (!is_array($posts) || count($posts)<1) return false;
    $data = get_transient( "rpp_id_".$rpp_id );
    $data['post_'.$post->ID] = $posts;
    set_transient( "rpp_id_".$rpp_id, $data, (int)$timeout );
  }
  
  public static function clearCache($rpp_id) {
    delete_transient( "rpp_id_".$rpp_id );
  }
  
  public static function purgeCache() {
    $_rpp_instances = get_option('rpp_instances');
    if (is_array($_rpp_instances)) {
      foreach ($_rpp_instances as $id => $instance) {
        delete_transient( "rpp_id_".$id );    
      }
    }
  }
}
?>