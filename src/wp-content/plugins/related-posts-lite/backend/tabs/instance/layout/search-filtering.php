
<div class="item">
  <?php
  $option_name = "enable_search_filter";
  $option_desc = "Enable the search filter?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>
<div class="item">
  <?php
  $option_name = "show_search_filter";
  $option_desc = "Show the search filter by default?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>
<div class="item">
  <?php
  $option_name = "show_search_switch";
  $option_desc = "Show the search switch button?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>
<div class="item">
  <?php
  $option_name = "search_exact_matches_only";
  $option_desc = "Filter by exact matches only?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>
<div class="item">
  <?php
  $option_name = "search_default_text";
  $option_desc = "Default search text";
  $o = new wpdreamsText($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>
