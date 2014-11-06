<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

if (!class_exists('wpdreams_related_content')) {
    /**
     * Class wpdreams_related_content
     */
    class wpdreams_related_content {

        private $posts = array();
        private $postRef = null;

        function __construct($args = array()) {

            $default_args = array(
                "postRef" => null,
                "rppId" => 0,
                "preview" => false,
                "fulltextEnabled" => 1,
                "fulltextIndexed" => 0,
                "count" => 10,
                "exclusiveLookup" => 0, //look only in title vs. title, content vs content etc..
                "lookInTitle" => 1,
                "lookInContent" => 1,
                "lookInExcerpt" => 1,
                "lookInCustomFields" => array(),
                "titleRelevance" => 10,
                "contentRelevance" => 9,
                "excerptRelevance" => 8,
                "customFieldRelevance" => 5,
                "keywordMinLength" => 3,
                "keywordMinOccurrences" => 2,
                "keywordMaxCount" => 10,
                "keywordUseRes" => 1,
                "keywordResFile" => "",
                "returnPosts" => 1,
                "returnPages" => 1,
                "returnCustomposttypes" => null,
                "contentLength" => 120,
                "stripShortcodes" => 0,
                "runShortcodes" => 1,
                "stripHTML" => 1,
                "stripHTMLExclude" => "<a><b><span>",
                "advTitleField" => "{titlefield}",
                "advContentField" => "{contentfield}",
                "advAuthorField" => "{authorfield}",
                "advDateField" => "{datefield}",
                "fillOnLess" => 'nothing', //'nothing', "random", "custom", "following"
                "fillOnNo" => 'nothing', //'nothing', "random", "custom", "following"
                "override" => 0,
                "defaultContent" => null, // array of content
                "overrideContent" => null, // array of content from post editor
                "imageSettings" => null, //array(..)
                "excludeCategories" => array(),
                "excludeTerms" => array(),
                "excludeByID" => ""
            );

            $args = wp_parse_args($args, $default_args);

            $this->extract($args);
        }

        function extract($args) {
            foreach ($args as $key => $arg) {
                $this->$key = (isset($arg) ? $arg : NULL);
            }
        }

        function getRelatedPosts() {
            if ($this->preview)
                return $this->previewResults();
            if ($this->fulltextEnabled)
                return $this->fulltextRelated();
            else
                return $this->simpleRelated();
        }

        function previewResults() {
            global $wpdb;
            $querystr = "
    		SELECT
          $wpdb->posts.post_title as title,
          $wpdb->posts.ID as id,
          $wpdb->posts.post_date as date,
          $wpdb->posts.post_content as content,
          $wpdb->posts.post_excerpt as excerpt,
          $wpdb->users.user_nicename as author,
          $wpdb->posts.post_type as post_type,
          GROUP_CONCAT(DISTINCT $wpdb->terms.term_id) as terms,
          (FLOOR(RAND() * (100 - 1 + 1)) + 1) as relevance
    		FROM $wpdb->posts
        LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID
        LEFT JOIN $wpdb->users ON $wpdb->users.ID = $wpdb->posts.post_author
        LEFT JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
        LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
        LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
        WHERE
           $wpdb->posts.post_status = 'publish'
           AND ($wpdb->posts.post_type = 'post' OR $wpdb->posts.post_type = 'page')
        GROUP BY $wpdb->posts.ID
        ORDER BY relevance DESC, " . $wpdb->posts . ".post_date DESC
        LIMIT 10";

            $this->posts = $wpdb->get_results($querystr, OBJECT);
            $this->postProcess();
            return $this->posts;
        }

        function simpleRelated() {
            global $wpdb;

            $post = $this->postRef;

            // If no post reference is found, then exit
            if ($post == null || empty($post)) return null;

            // ---------------------------- Check for cache -------------------------
            if ($this->cacheEnabled) {
                $cached = rppCache::getCached($this->rppId, $post);
                if ($cached != false && $cached != '')
                    return $cached;
            }
            // ----------------------------------------------------------------------

            $like = '';
            $post_types = '';
            $term_query = '';
            $parts = array();
            $relevance_parts = array();
            $types = array('dummy_notting');

            // ---------------------------- Gather types ---------------------------
            if ($this->returnPosts == 1)
                $types[] = "post";
            if ($this->returnPages == 1)
                $types[] = "page";
            if (count($this->returnCustomposttypes) > 0)
                $types = array_merge($types, $this->returnCustomposttypes);
            if (count($types) < 1) {
                return null;
            } else {
                $words = implode('|', $types);
                $post_types = "($wpdb->posts.post_type REGEXP '$words')";
            }
            // ---------------------------------------------------------------------

            if ($this->override) {
                $this->fill($post_types, true);
                $this->postProcess();
                return $this->posts;
            }

            // ------------------------------ Title query ---------------------------
            if ($this->lookInTitle && $post->post_title != '') {
                $title_keywords = $this->extract_keywords(array(
                    'str' => $post->post_title,
                    'minWordLen' => 3,
                    'minWordOccurrences' => 1,
                    'asArray' => true,
                    'maxWords' => 3,
                    'restrict' => ($this->keywordUseRes == 1 ? true : false),
                    'resStr' => ($this->keywordResFile != '' ? $this->keywordResFile : "resctricted.txt")
                ));
                if (count($title_keywords)>0) {
                  $words = implode('|', $title_keywords);
                  $parts[] = "(lower($wpdb->posts.post_title) REGEXP '$words')";
                  if ($this->exclusiveLookup != 1) {
                      if ($this->lookInContent)
                          $parts[] = "(lower($wpdb->posts.post_content) REGEXP '$words')";
                      if ($this->lookInExcerpt)
                          $parts[] = "(lower($wpdb->posts.post_excerpt) REGEXP '$words')";
                  }
                  $relevance_parts[] = "(case when
            (lower($wpdb->posts.post_title) REGEXP '$words') 
             then $this->titleRelevance else 0 end)";
                }
            }
            // ---------------------------------------------------------------------

            // ------------------------ Content query ------------------------------
            if ($this->lookInContent && $post->post_content != '') {
                $content_keywords = $this->extract_keywords(array(
                    'str' => $post->post_content,
                    'minWordLen' => $this->keywordMinLength,
                    'minWordOccurrences' => $this->keywordMinOccurrences,
                    'asArray' => true,
                    'maxWords' => $this->keywordMaxCount,
                    'restrict' => ($this->keywordUseRes == 1 ? true : false),
                    'resStr' => $this->keywordResFile
                ));
                if (count($content_keywords)>0) {
                  $words = implode('|', $content_keywords);
                  $parts[] = "(lower($wpdb->posts.post_content) REGEXP '$words')";
                  if ($this->exclusiveLookup != 1) {
                      if ($this->lookInTitle)
                          $parts[] = "(lower($wpdb->posts.post_title) REGEXP '$words')";
                      if ($this->lookInExcerpt)
                          $parts[] = "(lower($wpdb->posts.post_excerpt) REGEXP '$words')";
                  }
                  $relevance_parts[] = "(case when
            (lower($wpdb->posts.post_content) REGEXP '$words') 
             then $this->contentRelevance else 0 end)";
                }
            }
            // ---------------------------------------------------------------------

            // ---------------------- Excerpt query --------------------------------
            if ($this->lookInExcerpt && $post->post_excerpt != '') {
                $excerpt_keywords = $this->extract_keywords(array(
                    'str' => $post->post_excerpt,
                    'minWordLen' => $this->keywordMinLength,
                    'minWordOccurrences' => $this->keywordMinOccurrences,
                    'asArray' => true,
                    'maxWords' => $this->keywordMaxCount,
                    'restrict' => ($this->keywordUseRes == 1 ? true : false),
                    'resStr' => $this->keywordResFile
                ));
                if (count($excerpt_keywords)>0) {
                  $words = implode('|', $excerpt_keywords);
                  $parts[] = "(lower($wpdb->posts.post_excerpt) REGEXP '$words')";
                  if ($this->exclusiveLookup != 1) {
                      if ($this->lookInTitle)
                          $parts[] = "(lower($wpdb->posts.post_title) REGEXP '$words')";
                      if ($this->lookInContent)
                          $parts[] = "(lower($wpdb->posts.post_content) REGEXP '$words')";
                  }
                  $relevance_parts[] = "(case when
            (lower($wpdb->posts.post_excerpt) REGEXP '$words') 
             then $this->excerptRelevance else 0 end)";
                }
            }
            // ---------------------------------------------------------------------

            /**
             *  -------------------- Custom field query ---------------------------
             *  Only works one-way:
             *  - custom field data can be searched only by custom field data keywords
             *  - title/content/excerpt can be searched by custom field data keywords
             *  - custom field data CAN'T be searched by title/content/excerpt kw-s
             */
            if (is_array($this->lookInCustomFields) && count($this->lookInCustomFields) > 0) {
                foreach ($this->lookInCustomFields as $cfield) {
                    $val = get_post_meta($post->ID, $cfield, true);
                    if ($val == null || $val == "") continue;
                    if (is_array($val) || is_object($val))
                        $val = serialize($val);
                    $cfield_keywords = $this->extract_keywords(array(
                        'str' => $val,
                        'minWordLen' => $this->keywordMinLength,
                        'minWordOccurrences' => $this->keywordMinOccurrences,
                        'asArray' => true,
                        'maxWords' => $this->keywordMaxCount,
                        'restrict' => ($this->keywordUseRes == 1 ? true : false),
                        'resStr' => $this->keywordResFile
                    ));
                    if (count($cfield_keywords)>0) {
                      $words = implode('|', $cfield_keywords);
                      $parts[] = "($wpdb->postmeta.meta_key='$cfield' AND
                       lower($wpdb->postmeta.meta_value) REGEXP '$words')";
                      if ($this->exclusiveLookup != 1) {
                          if ($this->lookInTitle)
                              $parts[] = "(lower($wpdb->posts.post_title) REGEXP '$words')";
                          if ($this->lookInContent)
                              $parts[] = "(lower($wpdb->posts.post_content) REGEXP '$words')";
                      }
                    }
                }
                if ($words != null && $words != "")
                  $relevance_parts[] = "(case when
            (lower($wpdb->postmeta.meta_value) REGEXP '$words') 
             then $this->customFieldRelevance else 0 end)";
            }
            // ---------------------------------------------------------------------

            // ---------------- Exclude categories/taxonomies ----------------------
            if ($this->excludeCategories == null || $this->excludeCategories == "")
                $this->excludeCategories = array();
            if ($this->excludeTerms == null || $this->excludeTerms == "")
                $this->excludeTerms = array();
            $all_terms = array();
            $all_terms = array_merge($this->excludeCategories, $this->excludeTerms);
            if (count($all_terms) > 0) {
                $words = implode(',', $all_terms);
                $term_query = "($wpdb->term_taxonomy.term_id NOT IN ($words)
          AND $wpdb->terms.term_id NOT IN ($words)
         ) AND ";
            }
            // ---------------------------------------------------------------------
            
            // -------------------------- Exclude by ID ----------------------------
            $exclude_ids = "-99";
            if ($this->excludeByID != '')
              $exclude_ids = $this->excludeByID;  
            // ---------------------------------------------------------------------

            $like = implode(' OR ', $parts);
            if ($like == "")
                $like = "(1)";
            else {
                $like = "($like)";
            }

            $relevance = implode(' + ', $relevance_parts);
            if ($relevance == "")
                $relevance = "(1)";
            else {
                $relevance = "($relevance)";
            }

            $querystr = "
    		SELECT 
          $wpdb->posts.post_title as title,
          $wpdb->posts.ID as id,
          $wpdb->posts.post_date as date,
          $wpdb->posts.post_content as content,
          $wpdb->posts.post_excerpt as excerpt,
          $wpdb->users.user_nicename as author, 
          $wpdb->posts.post_type as post_type,
          GROUP_CONCAT(DISTINCT $wpdb->terms.term_id) as terms,
          $relevance as relevance
    		FROM $wpdb->posts
        LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID
        LEFT JOIN $wpdb->users ON $wpdb->users.ID = $wpdb->posts.post_author
        LEFT JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
        LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
        LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
        WHERE 
          $term_query
          ($wpdb->posts.ID <> $post->ID) AND
          $post_types AND
          $wpdb->posts.ID NOT IN ($exclude_ids) AND 
          ($wpdb->posts.post_status = 'publish') AND
          $like  
        GROUP BY $wpdb->posts.ID
    		ORDER BY relevance DESC, " . $wpdb->posts . ".post_date DESC
    		LIMIT $this->count";

            //var_dump($querystr); die();
            $this->posts = $wpdb->get_results($querystr, OBJECT);
            $this->fill($post_types);
            $this->postProcess();
            if ($this->cacheEnabled) {
                rppCache::setCached($this->rppId, $post, $this->posts, $this->cacheTimeout);
            }
            return $this->posts;
        }

        function fulltextRelated() {
            global $wpdb;
            $post = $this->postRef;

            // If no post reference is found, then exit
            if ($post == null || empty($post)) return null;

            $like = '';
            $post_types = '';
            $term_query = '';
            $parts = array();
            $relevance_parts = array();
            $types = array('dummy_notting');

            // ---------------------------- Check for cache -------------------------
            if ($this->cacheEnabled) {
                $cached = rppCache::getCached($this->rppId, $post);
                if ($cached != false && $cached != '')
                    return $cached;
            }
            // ----------------------------------------------------------------------

            // ---------------------------- Gather types ---------------------------
            if ($this->returnPosts == 1)
                $types[] = "post";
            if ($this->returnPages == 1)
                $types[] = "page";
            if (count($this->returnCustomposttypes) > 0)
                $types = array_merge($types, $this->returnCustomposttypes);
            if (count($types) < 1) {
                return null;
            } else {
                $words = implode('|', $types);
                $post_types = "($wpdb->posts.post_type REGEXP '$words')";
            }
            // ----------------------------------------------------------------------

            if ($this->override) {
                $this->fill($post_types, true);
                $this->postProcess();
                return $this->posts;
            }

            if ($this->fulltextIndexed != 1) {
                $boolean = " IN BOOLEAN MODE";
            } else {
                $boolean = "";
            }

            // ------------------------------ Title query ---------------------------
            if ($this->lookInTitle && $post->post_title != '') {
                $title_keywords = $this->extract_keywords(array(
                    'str' => $post->post_title,
                    'minWordLen' => 3,
                    'minWordOccurrences' => 1,
                    'asArray' => true,
                    'maxWords' => 3,
                    'restrict' => ($this->keywordUseRes == 1 ? true : false),
                    'resStr' => ($this->keywordResFile != '' ? $this->keywordResFile : "resctricted.txt")
                ));
                if (count($title_keywords)>0) {
                  $words = implode(' ', $title_keywords);
                  //$o = new StdClass();
                  $parts = array_merge($parts, $this->createFulltextPart($words, $post));
                  if ($words != "")
                      $relevance_parts[] = "
              MATCH(" . $wpdb->posts . ".post_title) AGAINST ('$words'$boolean)";
                }
            }

            // ---------------------------------------------------------------------

            // ------------------------ Content query ------------------------------
            if ($this->lookInContent && $post->post_content != '') {
                $content_keywords = $this->extract_keywords(array(
                    'str' => $post->post_content,
                    'minWordLen' => $this->keywordMinLength,
                    'minWordOccurrences' => $this->keywordMinOccurrences,
                    'asArray' => true,
                    'maxWords' => $this->keywordMaxCount,
                    'restrict' => ($this->keywordUseRes == 1 ? true : false),
                    'resStr' => $this->keywordResFile
                ));
                if (count($title_keywords)>0) {
                  $words = implode(' ', $content_keywords);
                  $parts = array_merge($parts, $this->createFulltextPart($words, $post));
                  if ($words != "")
                      $relevance_parts[] = "
              MATCH(" . $wpdb->posts . ".post_content) AGAINST ('$words'$boolean)";
                }
            }
            // ---------------------------------------------------------------------

            // ---------------------- Excerpt query --------------------------------
            if ($this->lookInExcerpt && $post->post_excerpt != '') {
                $excerpt_keywords = $this->extract_keywords(array(
                    'str' => $post->post_excerpt,
                    'minWordLen' => $this->keywordMinLength,
                    'minWordOccurrences' => $this->keywordMinOccurrences,
                    'asArray' => true,
                    'maxWords' => $this->keywordMaxCount,
                    'restrict' => ($this->keywordUseRes == 1 ? true : false),
                    'resStr' => $this->keywordResFile
                ));
                if (count($excerpt_keywords)>0) {
                  $words = implode(' ', $excerpt_keywords);
                  $parts = array_merge($parts, $this->createFulltextPart($words, $post));
                  if ($words != "")
                      $relevance_parts[] = "
              MATCH(" . $wpdb->posts . ".post_excerpt) AGAINST ('$words'$boolean)";
                }
            }
            // ---------------------------------------------------------------------

            /**
             *  -------------------- Custom field query ---------------------------
             *  Only works one-way:
             *  - custom field data can be searched only by custom field data keywords
             *  - title/content/excerpt can be searched by custom field data keywords
             *  - custom field data CAN'T be searched by title/content/excerpt kw-s
             */
            if (is_array($this->lookInCustomFields) && count($this->lookInCustomFields) > 0) {
                foreach ($this->lookInCustomFields as $cfield) {
                    $val = get_post_meta($post->ID, $cfield, true);
                    if ($val == null || $val == "") continue;
                    if (is_array($val) || is_object($val))
                        $val = serialize($val);
                    $cfield_keywords = $this->extract_keywords(array(
                        'str' => $val,
                        'minWordLen' => $this->keywordMinLength,
                        'minWordOccurrences' => $this->keywordMinOccurrences,
                        'asArray' => true,
                        'maxWords' => $this->keywordMaxCount,
                        'restrict' => ($this->keywordUseRes == 1 ? true : false),
                        'resStr' => $this->keywordResFile
                    ));
                    if (count($cfield_keywords)>0) {
                      $words = implode('|', $cfield_keywords);
                      $parts[] = "($wpdb->postmeta.meta_key='$cfield' AND
                       lower($wpdb->postmeta.meta_value) REGEXP '$words')";
                      if ($this->exclusiveLookup != 1) {
                          if ($this->lookInTitle)
                              $parts[] = "(lower($wpdb->posts.post_title) REGEXP '$words')";
                          if ($this->lookInContent)
                              $parts[] = "(lower($wpdb->posts.post_content) REGEXP '$words')";
                      }
                    }
                }
                $relevance_parts[] = "(case when
          (lower($wpdb->postmeta.meta_value) REGEXP '$words') 
           then $this->customFieldRelevance else 0 end)";
            }
            // ---------------------------------------------------------------------

            // ---------------- Exclude categories/taxonomies ----------------------
            if ($this->excludeCategories == null || $this->excludeCategories == "")
                $this->excludeCategories = array();
            if ($this->excludeTerms == null || $this->excludeTerms == "")
                $this->excludeTerms = array();
            $all_terms = array();
            $all_terms = array_merge($this->excludeCategories, $this->excludeTerms);
            if (count($all_terms) > 0) {
                $words = implode(',', $all_terms);
                $term_query = "($wpdb->term_taxonomy.term_id NOT IN ($words)
          AND $wpdb->terms.term_id NOT IN ($words)
         ) AND ";
            }
            // ---------------------------------------------------------------------
            
            // -------------------------- Exclude by ID ----------------------------
            $exclude_ids = "-99";
            if ($this->excludeByID != '')
              $exclude_ids = $this->excludeByID;  
            // ---------------------------------------------------------------------

            $like = implode(' OR ', $parts);
            if ($like == "")
                $like = "(1)";
            else {
                $like = "($like)";
            }

            $relevance = implode(' + ', $relevance_parts);
            if ($relevance == "")
                $relevance = "(1)";
            else {
                $relevance = "($relevance)";
            }

            $querystr = "
    		SELECT 
          $wpdb->posts.post_title as title,
          $wpdb->posts.ID as id,
          $wpdb->posts.post_date as date,
          $wpdb->posts.post_content as content,
          $wpdb->posts.post_excerpt as excerpt,
          $wpdb->users.user_nicename as author, 
          $wpdb->posts.post_type as post_type,
          GROUP_CONCAT(DISTINCT $wpdb->terms.term_id) as terms,
          $relevance as relevance
    		FROM $wpdb->posts
        LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID
        LEFT JOIN $wpdb->users ON $wpdb->users.ID = $wpdb->posts.post_author
        LEFT JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
        LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
        LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
        WHERE
          $term_query
          ($wpdb->posts.ID <> $post->ID) AND
          $post_types AND
          $wpdb->posts.ID NOT IN ($exclude_ids) AND 
          ($wpdb->posts.post_status = 'publish') AND
          $like
        GROUP BY $wpdb->posts.ID
    		ORDER BY relevance DESC, " . $wpdb->posts . ".post_date DESC
    		LIMIT $this->count";

            //var_dump($querystr); die();
            $this->posts = $wpdb->get_results($querystr, OBJECT);
            $this->fill($post_types);
            $this->postProcess();
            if ($this->cacheEnabled) {
                rppCache::setCached($this->rppId, $post, $this->posts, $this->cacheTimeout);
            }
            return $this->posts;
        }

        function fill($post_types, $override = false) {
            global $wpdb;
            $post = $this->postRef;
            
            $order = "";
            $where = "";

            if ($override || count($this->posts) == 0) {
                if ($override)
                    $op = $this->overrideWith;
                else
                    $op = $this->fillOnNo;
                switch ($op) {
                    case "nothing":
                        break;
                    case "random":
                        $order = " ORDER BY RAND() ";
                        break;
                    case "following":
                        $where = " ($wpdb->posts.ID>$post->ID) ";
                        $order = " ORDER BY $wpdb->posts.ID ASC ";
                        break;
                    case "custom":
                        $need = $this->count - count($this->posts);
                        $ids = array();
                        $i = 1;
                        foreach ($this->defaultContent as $item) {
                            if ($need == 0) break;
                            if (isset($item->id)) {
                                $this->posts[] = $this->queryOneItem($item->id);
                            } else {
                                $new = new stdClass();
                                $new->title = $item->title;
                                $new->content = $item->content;
                                $new->url = $item->url;        
                                $new->image = $item->imgurl;
                                $new->author = isset($item->author) ? $item->author : "";
                                $new->date = isset($item->date) ? $item->date : "";
                                $new->relevance = 1000 - $i;
                                $this->posts[] = $new;
                                $i++;
                            }
                            $need--;
                        }
                        return;
                        break;
                }
            } else if (count($this->posts) < $this->count) {
                $used_ids = array();
                foreach ($this->posts as $_post) {
                    $used_ids[] = (int)$_post->id;
                }
                switch ($this->fillOnLess) {
                    case "nothing":
                        break;
                    case "random":
                        $order = " ORDER BY RAND() ";
                        break;
                    case "following":
                        $where = " ($wpdb->posts.ID>$post->ID) ";
                        $order = " ORDER BY $wpdb->posts.ID ASC ";
                        break;
                    case "custom":
                        $need = $this->count - count($this->posts);
                        $ids = array();
                        $i = 1;
                        if (!is_array($this->defaultContent)) break;
                        foreach ($this->defaultContent as $item) {
                            if ($need == 0) break;
                            if (isset($item->id)) {
                                if (in_array((int)$item->id, $used_ids)) continue;
                                $this->posts[] = $this->queryOneItem($item->id);
                            } else {
                                $new = new stdClass();
                                $new->title = $item->title;
                                $new->content = $item->content;
                                $new->url = $item->url;
                                $new->image = $item->imgurl;
                                $new->author = isset($item->author) ? $item->author : "";
                                $new->date = isset($item->date) ? $item->date : "";
                                $new->post_type = "post";
                                $new->relevance =  1000 - $i;
                                //var_dump($new->image);die();
                                $this->posts[] = $new;
                                $i++;
                            }
                            $need--;
                        }
                        return;
                        break;
                }
            }

            if ($where == "" && $order == "") return;
            if ($where == "") $where = "(1)";
            
            $the_count = $this->count - count($this->posts);
            
            $exclude_ids = "-99";
            foreach($this->posts as $pp) {
               $exclude_ids .= ",".$pp->id;
            }
            if ($this->excludeByID != '')
              $exclude_ids .= ",".$this->excludeByID;  
            $querystr = "
    		SELECT 
          $wpdb->posts.post_title as title,
          $wpdb->posts.ID as id,
          $wpdb->posts.post_date as date,
          $wpdb->posts.post_content as content,
          $wpdb->posts.post_excerpt as excerpt,
          $wpdb->users.user_nicename as author, 
          $wpdb->posts.post_type as post_type,
          GROUP_CONCAT(DISTINCT $wpdb->terms.term_id) as terms
    		FROM $wpdb->posts
        LEFT JOIN $wpdb->users ON $wpdb->users.ID = $wpdb->posts.post_author
        LEFT JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
        LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
        LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
        WHERE 
          ($wpdb->posts.ID <> $post->ID) AND
          $post_types AND       
          $wpdb->posts.ID NOT IN ($exclude_ids) AND 
          ($wpdb->posts.post_status = 'publish') AND
          $where
        GROUP BY $wpdb->posts.ID
    		  $order
    		LIMIT $the_count";

            if (!$override)
                $this->posts = array_merge($this->posts, $wpdb->get_results($querystr, OBJECT));
            else
                $this->posts = $wpdb->get_results($querystr, OBJECT);
        }

        function queryOneItem($id) {
            global $wpdb;
            $querystr = "
    		SELECT 
          $wpdb->posts.post_title as title,
          $wpdb->posts.ID as id,
          $wpdb->posts.post_date as date,
          $wpdb->posts.post_content as content,
          $wpdb->posts.post_excerpt as excerpt,
          $wpdb->users.user_nicename as author, 
          $wpdb->posts.post_type as post_type,
          GROUP_CONCAT(DISTINCT $wpdb->terms.term_id) as terms
    		FROM $wpdb->posts
        LEFT JOIN $wpdb->users ON $wpdb->users.ID = $wpdb->posts.post_author
        LEFT JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
        LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
        LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
        WHERE 
          $wpdb->posts.ID = $id 
    		LIMIT 1";
            return $wpdb->get_row($querystr, OBJECT);
        }

        function queryMultipleById($ids) {
            global $wpdb;
            //if (!is_array($ids) || count($ids)<1) return false;
            //$_ids = implode(',', $ids);
            $querystr = "
    		SELECT 
          $wpdb->posts.post_title as title,
          $wpdb->posts.ID as id,
          $wpdb->posts.post_date as date,
          $wpdb->posts.post_content as content,
          $wpdb->posts.post_excerpt as excerpt,
          $wpdb->users.user_nicename as author, 
          $wpdb->posts.post_type as post_type,
          GROUP_CONCAT(DISTINCT $wpdb->terms.term_id) as terms
    		FROM $wpdb->posts
        LEFT JOIN $wpdb->users ON $wpdb->users.ID = $wpdb->posts.post_author
        LEFT JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
        LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
        LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
        WHERE 
          $wpdb->posts.ID IN ($ids) 
    		LIMIT 1";
            return $wpdb->get_results($querystr, OBJECT);
        }

        function createFulltextPart($words, $post) {
            global $wpdb;
            $parts = array();
            if ($words == "") return $parts;
            if ($this->exclusiveLookup == 1) {
                if ($this->fulltextIndexed) {
                    $boolean_mode = "";
                } else {
                    $boolean_mode = " IN BOOLEAN MODE";
                }
                if ($this->lookInTitle && $post->post_title != '')
                    $parts[] = "MATCH(" . $wpdb->posts . ".post_title) AGAINST ('$words'$boolean_mode)";
                if ($this->lookInContent && $post->post_content != '')
                    $parts[] = "MATCH(" . $wpdb->posts . ".post_content) AGAINST ('$words'$boolean_mode)";
                if ($this->lookInExcerpt && $post->post_excerpt != '')
                    $parts[] = "MATCH(" . $wpdb->posts . ".post_excerpt) AGAINST ('$words'$boolean_mode)";
            } else {
                $boolean_mode = "";
                if ($this->fulltextIndexed != 1) {
                    $boolean_mode = " IN BOOLEAN MODE";
                }
                $index_name = '';
                $index_parts = array();
                if ($this->lookInTitle && $post->post_title != '')
                    $index_parts[] = $wpdb->posts . '.post_title';
                if ($this->lookInContent && $post->post_content != '')
                    $index_parts[] = $wpdb->posts . '.post_content';
                if ($this->lookInExcerpt && $post->post_excerpt != '')
                    $index_parts[] = $wpdb->posts . '.post_excerpt';
                $index_name = implode(',', $index_parts);
                $parts[] = "MATCH($index_name) AGAINST ('$words'$boolean_mode)";
            }
            return $parts;
        }

        function postProcess() {
            if ($this->posts != NULL) {
                foreach ($this->posts as $key => $post) {

                    $this->post[$key] = apply_filters('rpp_item_before_postprocessing', $post);

                    // -------------------------  URL --------------------------------
                    if (!isset($this->posts[$key]->url) && isset($this->posts[$key]->id))
                        $this->posts[$key]->url = get_permalink($this->posts[$key]->id);
                    // ---------------------------------------------------------------

                    // -------------------------  Relevance --------------------------
                    if (!isset($this->posts[$key]->relevance))
                        $this->posts[$key]->relevance = 1;
                    // ---------------------------------------------------------------

                    // -------------------------  Terms ------------------------------
                    if (!isset($this->posts[$key]->terms))
                        $this->posts[$key]->terms = "";
                    // ---------------------------------------------------------------

                    // -------------------------  Terms ------------------------------
                    if (!isset($this->posts[$key]->post_type))
                        $this->posts[$key]->post_type = "";
                    // ---------------------------------------------------------------

                    // ----------------------  Image  --------------------------------
                    // Iterate through 5 image sources and break if image had been found
                    if (is_multisite()) {
                      $home_url = network_home_url();
                    } else {
                      $home_url = site_url();
                    }
                    if ($this->imageSettings['show_images'] != 0) {
                        if ($this->imageSettings['use_timthumb'] == 0) {
                            $im = $this->getCachedImage($post);
                            if ($im != '')
                                $this->posts[$key]->image = $im;
                        } else {
                            $im = $this->getTimThumbImage($this->post[$key]);
                            if ($im != '' && strpos($im, "mshots/v1") === false)
                                $this->posts[$key]->image = $home_url.'/wp-content/plugins/related-posts-lite/includes/timthumb.php' . '?ct='.$this->imageSettings['image_transparency'].'&cc=' . str_replace('#', '', wpdreams_rgb2hex($this->imageSettings['image_bg_color'])) . '&q=95&w=' . $this->imageSettings['image_width'] . '&h=' . $this->imageSettings['image_height'] . '&src=' . rawurlencode($im);
                            else
                                $this->posts[$key]->image = $im;
                        }
                    }
                    //$this->posts[$key]->image = plugins_url('/related-posts-lite/includes/timthumb.php').'?cc=FFFFFF&ct=0&q=95&w=120&h=120&src='.rawurlencode($im);
                    // ---------------------------------------------------------------


                    // ----------------------  Title  --------------------------------
                    switch ($this->titleField) {
                        case 0:
                            break;
                        case 1:
                            $this->posts[$key]->title = $this->posts[$key]->excerpt;
                            break;
                        case 2:
                            $this->posts[$key]->title = $this->posts[$key]->content;
                            break;
                        default:
                            $this->posts[$key]->title = get_post_meta($post->ID, $this->titleField, true);
                            break;
                    }
                    
                    if (isset($post->id))                    
                      $this->posts[$key]->title = 
                        $this->adv_content_field($this->posts[$key]->title, "titlefield", $this->advTitleField, $post->id);
                    
                    if ($this->runTitleFilter) {
                        $this->posts[$key]->title =
                            apply_filters('the_title', $this->posts[$key]->title);
                    }
                    // ---------------------------------------------------------------

                    // ---------------------- Content --------------------------------
                    switch ($this->contentField) {
                        case 0:
                            $this->posts[$key]->content = $this->posts[$key]->title;
                            break;
                        case 1:
                            $this->posts[$key]->content = $this->posts[$key]->excerpt;
                            break;
                        case 2:
                            break;
                        default:
                            $this->posts[$key]->content = get_post_meta($post->ID, $this->contentField, true);
                            break;
                    }
                    $_content = $this->posts[$key]->content;
                    
                    if (isset($post->id)) 
                      $_content = 
                        $this->adv_content_field($_content, "contentfield", $this->advContentField, $post->id);

                    // Removes the inner shortcodes! Very important!
                    $_content = wpdreams_strip_shortcode('wpdreams_rpp', $_content);

                    if ($this->stripShortcodes || $this->runShortcodes != 1) {
                        $_content = strip_shortcodes($_content);
                    }
                    if ($this->runContentFilter) {
                        // Removes the before/after hooks from the content.
                        remove_filter('the_content', 'wpdreams_rpp_add_below_content', 10);
                        remove_filter('the_content', 'wpdreams_rpp_add_above_content', 10);
                        $_content = apply_filters('the_content', $_content);
                        add_filter('the_content', 'wpdreams_rpp_add_below_content', 10, 1);
                        add_filter('the_content', 'wpdreams_rpp_add_above_content', 10, 1);
                    }

                    $_content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $_content);
                    $_content = $this->substrAtWord($_content, $this->contentLength);
                    if ($this->stripHTML) {
                        $_content = strip_tags($_content, $this->stripHTMLExclude);
                    }

                    $this->posts[$key]->content = $_content;
                    // ---------------------------------------------------------------
                    $this->post[$key] = apply_filters('rpp_item_after_postprocessing', $post);
                    
                    // ------------------------- Date --------------------------------
                    if (isset($post->id)) 
                      $this->posts[$key]->date = 
                        $this->adv_content_field($this->posts[$key]->date, "datefield", $this->advDateField, $post->id);
                    // ---------------------------------------------------------------
                    
                    // ------------------------- User --------------------------------
                    if (isset($post->id)) 
                      $this->posts[$key]->author = 
                        $this->adv_content_field($this->posts[$key]->author, "authorfield", $this->advAuthorField, $post->id);
                    // ---------------------------------------------------------------
                }
            }
        }


        /**
         * Fetches an image with the imageCache class
         */
        function getCachedImage($post) {
            if ($post->image == null) {
                $i = 1;
                $im = "";
                for ($i == 1; $i < 6; $i++) {
                    switch ($this->imageSettings['image_source' . $i]) {
                        case "featured":
                            $__im = wp_get_attachment_url(get_post_thumbnail_id($post->id));
                            if ($__im != "") {
                                $img = new wpdreamsImageCache(
                                    $__im, "post" . $post->id,
                                    RPL_PATH . DIRECTORY_SEPARATOR . "cache" . DIRECTORY_SEPARATOR,
                                    $this->imageSettings['image_width'], $this->imageSettings['image_height'],
                                    -1, $this->imageSettings['image_bg_color']
                                );
                                $_im = $img->get_image();
                                if ($_im != '') {
                                    $im = plugins_url('/related-posts-lite/cache/' . $_im);
                                }
                            }
                            break;
                        case "content":
                            $img = new wpdreamsImageCache(
                                $post->content, "post" . $post->id,
                                RPL_PATH . DIRECTORY_SEPARATOR . "cache" . DIRECTORY_SEPARATOR,
                                $this->imageSettings['image_width'], $this->imageSettings['image_height'],
                                1, $this->imageSettings['image_bg_color']
                            );
                            $_im = $img->get_image();
                            if ($_im != '') {
                                $im = plugins_url('/related-posts-lite/cache/' . $_im);
                            }
                            break;
                        case "excerpt":
                            $img = new wpdreamsImageCache(
                                $post->excerpt, "post" . $post->id,
                                RPL_PATH . DIRECTORY_SEPARATOR . "cache" . DIRECTORY_SEPARATOR,
                                $this->imageSettings['image_width'], $this->imageSettings['image_height'],
                                1, $this->imageSettings['image_bg_color']
                            );
                            $_im = $img->get_image();
                            if ($_im != '') {
                                $im = plugins_url('/related-posts-lite/cache/' . $_im);
                            }
                            break;
                        case "screenshot":
                            $im = 'http://s.wordpress.com/mshots/v1/' . urlencode(get_permalink($post->id)) .
                                '?w=' . $this->imageSettings['image_width'] . '&h=' . $this->imageSettings['image_height'];
                            break;
                        case "custom":
                            if ($this->imageSettings['image_custom_field'] != "") {
                                $val = get_post_meta($post->id, $this->imageSettings['image_custom_field'], true);
                                if ($val != null && $val != "")
                                    $im = $val;
                            }
                            break;
                        case "default":
                            if ($this->imageSettings['image_default'] != "")
                                $im = $this->imageSettings['image_default'];
                            break;
                        default:
                            $im = "";
                            break;
                    }
                    if ($im != null && $im != '') break;
                }
                return $im;
            } else {
                return $post->image;
            }
        }

        /**
         * Fetches an image for thimthumb class
         */
        function getTimThumbImage($post) {
            if (!isset($post->image) || $post->image == null) {
            $home_url = network_home_url();
            $home_url = home_url();
                if (!isset($post->id)) return "";
                $i = 1;
                $im = "";
                for ($i == 1; $i < 6; $i++) {
                    switch ($this->imageSettings['image_source' . $i]) {
                        case "featured":
                            $im = wp_get_attachment_url(get_post_thumbnail_id($post->id));
                            if (is_multisite())
                              $im = str_replace(home_url(), network_home_url(), $im);
                            break;
                        case "content":
                            $im = wpdreams_get_image_from_content($post->content, 1);
                            if (is_multisite())
                              $im = str_replace(home_url(), network_home_url(), $im); 
                            break;
                        case "excerpt":
                            $im = wpdreams_get_image_from_content($post->excerpt, 1);
                            if (is_multisite())
                              $im = str_replace(home_url(), network_home_url(), $im);
                            break;
                        case "screenshot":
                            $im = 'http://s.wordpress.com/mshots/v1/' . urlencode(get_permalink($post->id)) .
                                '?w=' . $this->imageSettings['image_width'] . '&h=' . $this->imageSettings['image_height'];
                            break;
                        case "custom":
                            if ($this->imageSettings['image_custom_field'] != "") {
                                $val = get_post_meta($post->id, $this->imageSettings['image_custom_field'], true);
                                if ($val != null && $val != "")
                                    $im = $val;
                            }
                            break;
                        case "default":
                            if ($this->imageSettings['image_default'] != "")
                                $im = $this->imageSettings['image_default'];
                            break;
                        default:
                            $im = "";
                            break;
                    }
                    if ($im != null && $im != '') break;
                }
                return $im;
            } else {
                return $post->image;
            }
        }

        /**
         * Extract the keywords from a string
         * Uses: wpdreams_keyword_count_sort(..)
         */

        function extract_keywords($args) {

            $default_args = array(
                'str' => '',
                'minWordLen' => 3,
                'minWordOccurrences' => 2,
                'asArray' => true,
                'maxWords' => 10,
                'restrict' => false,
                'resStr' => ''
            );

            $args = wp_parse_args($args, $default_args);

            extract($args, EXTR_SKIP);

            // Trim if the string is super long
            $maxStrLen = 30000;
            $blogCharset = get_bloginfo('charset');
            $charset = $blogCharset !== '' ? $blogCharset : 'UTF-8';
            if (mb_strlen($str, $charset) > $maxStrLen) {
                $str = mb_substr($str, 0, $length, $charset);
            } 

            $str = $this->html2txt($str);

            $str = str_replace(array(".", ",", "$", "\\", "/", "{", "^", "}","?", "!", ";", "(", ")", ":", "[", "]"), " ", $str);
            $str = str_replace(array("\n", "\r", "  "), " ", $str);
            strtolower($str);
            
            //$str = preg_replace('/[^\p{L}0-9 ]/', ' ', $str);
            $str = str_replace("\xEF\xBB\xBF",'',$str); 

            $str = trim(preg_replace('/\s+/', ' ', $str));

            $words = explode(' ', $str);

            if ($resStr != '') {
                $fpath = RPL_PATH . DIRECTORY_SEPARATOR . $resStr;
                if (file_exists($fpath)) {
                    $resStr = file_get_contents($fpath);
                }
            }

            // Only compare to common words if $restrict is set to false
            // Tags are returned based on any word in text
            // If we don't restrict tag usage, we'll remove common words from array
            if ($restrict !== false && $resStr !== false) {
                //Full list of common words in the downloadable code
                //$commonWords = array('a','able','about','above','abroad','according');
                $commonWords = explode(' ', $resStr);
                $words = array_udiff($words, $commonWords, 'strcasecmp');
            }

            // Restrict Keywords based on values in the $allowedWords array
            // Use if you want to limit available tags
            /*if ($restrict == true) {
              $allowedWords =  array('engine','boeing','electrical','pneumatic','ice');
              $words = array_uintersect($words, $allowedWords,'strcasecmp');
            }*/

            $keywords = array();

            while (($c_word = array_shift($words)) !== null) {
                if (strlen($c_word) < $minWordLen) continue;

                $c_word = strtolower($c_word);
                if (array_key_exists($c_word, $keywords)) $keywords[$c_word][1]++;
                else $keywords[$c_word] = array($c_word, 1);
            }
            usort($keywords, 'wpdreams_keyword_count_sort');

            $final_keywords = array();
            foreach ($keywords as $keyword_det) {
                if ($keyword_det[1] < $minWordOccurrences) break;
                array_push($final_keywords, $keyword_det[0]);
            }
            $final_keywords = array_slice($final_keywords, 0, $maxWords);
            $return = $asArray ? $final_keywords : implode(', ', $final_keywords);

            $return = apply_filters('rpp_keywords', $return);

            return $return;
        }

        function substrAtWord($text, $length) {
            if (strlen($text) <= $length) return $text;
            $blogCharset = get_bloginfo('charset');
            $charset = $blogCharset !== '' ? $blogCharset : 'UTF-8';
            $s = mb_substr($text, 0, $length, $charset);
            return mb_substr($s, 0, strrpos($s, ' '), $charset);
        }
        
        
        // ex.: "asdfg", "contentfield", "{custom_post_type} - {contentfield}", 10
        function adv_content_field($content, $def_field, $new_field, $id) {
           global $search;
           if ($new_field=='') return $content;
           preg_match_all( "/{(.*?)}/", $new_field, $matches);
           if (isset($matches[0]) && isset($matches[1]) && is_array($matches[1])) {
              foreach ($matches[1] as $field) {
                if ($field == $def_field) {
                  $new_field = str_replace("{".$def_field."}", $content, $new_field);
                } else {
                  $val = get_post_meta($id, $field, true);
                  $new_field = str_replace('{'.$field.'}', $val, $new_field);
                }
              }
           }
           return $new_field;
        } 

        function html2txt($document) {
            $search = array('@<script[^>]*?>.*?</script>@si', // Strip out javascript
                '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
                '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
                '@<![\s\S]*?--[ \t\n\r]*>@' // Strip multi-line comments including CDATA
            );
            $text = preg_replace($search, '', $document);
            return $text;
        }
        
        


    }
}
?>