<div class="item">
<?php
$option_name = "show_sorting";
$option_desc = "Show sorting options?";
$o = new wpdreamsYesNo($option_name, $option_desc, 
     wpdreams_setval_or_getoption($_so, $option_name, $_dk));
$params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
$option_name = "sortby_caption";
$option_desc = "Sort by caption";
$o = new wpdreamsText($option_name, $option_desc, 
     wpdreams_setval_or_getoption($_so, $option_name, $_dk));
$params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
$option_name = "show_title_sorting";
$option_desc = "Show title sorting option?";
$o = new wpdreamsYesNo($option_name, $option_desc, 
     wpdreams_setval_or_getoption($_so, $option_name, $_dk));
$params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
$option_name = "title_sorting_caption";
$option_desc = "Title sort button caption";
$o = new wpdreamsText($option_name, $option_desc, 
     wpdreams_setval_or_getoption($_so, $option_name, $_dk));
$params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
$option_name = "show_relevance_sorting";
$option_desc = "Show relevance sorting option?";
$o = new wpdreamsYesNo($option_name, $option_desc, 
     wpdreams_setval_or_getoption($_so, $option_name, $_dk));
$params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
$option_name = "relevance_sorting_caption";
$option_desc = "Relevance sort button caption";
$o = new wpdreamsText($option_name, $option_desc, 
     wpdreams_setval_or_getoption($_so, $option_name, $_dk));
$params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
  $option_name = "default_sorting";
  $option_desc = "Default sorting by";
  $o = new wpdreamsCustomSelect($option_name, $option_desc, array(
      'selects'=>wpdreams_setval_or_getoption($_so, $option_name.'_def', $_dk),
      'value'=>wpdreams_setval_or_getoption($_so, $option_name, $_dk)
  ));
  $params[$o->getName()] = $o->getData();
?>
</div>
<div class="item">
<?php
  $option_name = "default_sorting_order";
  $option_desc = "Default sorting order";
  $o = new wpdreamsCustomSelect($option_name, $option_desc, array(
      'selects'=>wpdreams_setval_or_getoption($_so, $option_name.'_def', $_dk),
      'value'=>wpdreams_setval_or_getoption($_so, $option_name, $_dk)
  ));
  $params[$o->getName()] = $o->getData();
?>
</div> 