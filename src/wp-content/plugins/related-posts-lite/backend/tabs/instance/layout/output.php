<div class="item">
  <?php
  $option_name = "title_text";
  $option_desc = "Title text";
  $o = new wpdreamsText($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>
<div class="item">
  <?php
  $option_name = "show_under_content";
  $option_desc = "Show the plugin under content?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
  <p class='descMsg'>It will show the plugin abelow the content automatically
  if enabled.</p>
</div>

<div class="item">
  <?php
  $option_name = "show_above_content";
  $option_desc = "Show the plugin above content?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
  <p class='descMsg'>It will show the plugin above the content automatically
  if enabled.</p>
</div>

<div class="item">
  <?php
  $option_name = "show_on_single";
  $option_desc = "Show on single content pages?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>

<div class="item">
  <?php
  $option_name = "show_on_home";
  $option_desc = "Show on the home page?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>

<div class="item">
  <?php
  $option_name = "show_on_archive";
  $option_desc = "Show on archive pages?";
  $o = new wpdreamsYesNo($option_name, $option_desc, 
       wpdreams_setval_or_getoption($_so, $option_name, $_dk));
  $params[$o->getName()] = $o->getData();
  ?>
</div>

