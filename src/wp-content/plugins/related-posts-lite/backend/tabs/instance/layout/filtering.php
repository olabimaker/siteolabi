<p class='infoMsg'>These options affect only the frontend layout of the plugin. To exclude items/categories/post types go to the <b>Advanced Options</b> tab.</p>
<div class="item">
<?php
  $option_name = "show_filters";
  $option_desc = "Show the filters?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
  $option_name = "filterby_caption";
  $option_desc = "Filter caption";
  $o = new wpdreamsText($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
  $option_name = "show_posttype_filter";
  $option_desc = "Show the post type filter?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
  $option_name = "posttype_filter_caption";
  $option_desc = "Post type filter caption";
  $o = new wpdreamsText($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
    <?php
    $option_name = "combine_filters";
    $option_desc = "Combine the filters?";
    $o = new wpdreamsYesNo($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
    <p class="descMsg">The post type and the category filter will be combined with an "AND" logic.</p>
</div>
<div class="item">
<?php
  $option_name = "show_post_types";
  $option_desc = "Show the following post types";
  $o = new wpdreamsCustomPostTypesEditable($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
?>
</div>

<div class="item">
<?php
  $option_name = "show_category_filter";
  $option_desc = "Show the category filter?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
  $option_name = "category_filter_caption";
  $option_desc = "Category filter caption";
  $o = new wpdreamsText($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
    <?php
    $option_name = "hide_uncategorized";
    $option_desc = "Hide the uncategorized category?";
    $o = new wpdreamsYesNo($option_name, $option_desc,
        wpdreams_setval_or_getoption($_so, $option_name, $_dk));
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
<?php
  $option_name = "category_exclude";
  $option_desc = "Exclude the following categories";
  $o = new wpdreamsCategories($option_name, $option_desc,
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
    <?php
    $option_name = "taxonomy_include";
    $option_desc = "Include the following taxonomies";
    $o = new wpdreamsCustomTaxonomyTerm($option_name, $option_desc,
        array("value" => wpdreams_setval_or_getoption($_so, $option_name, $_dk),
              "type"  => "include")
        );
    $params[$o->getName()] = $o->getData();
    $params['selected-'.$o->getName()] = $o->getSelected();
    ?>
</div>