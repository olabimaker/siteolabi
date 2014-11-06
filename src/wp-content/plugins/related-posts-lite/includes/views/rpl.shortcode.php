<div style='width:auto;' id="relatedpostslite_<?php self::$instanceCount; ?>"
     class='rpl rpl_slick'>
<div class='rpl_container'>


<?php if (isset($options["title_text"]) && $options["title_text"] != ""): ?>
    <legend><?php echo $options["title_text"]; ?></legend>
<?php endif; ?>

<div class='rpl_wrapper'>
    <?php $i = 1; ?>
    <?php $current = 1; ?>
    <?php foreach ($rpl_related_posts as $rpl_post): ?>

        <div num=<?php echo $i; ?>
             post_type='<?php echo $rpl_post->post_type; ?>'
             class='rpl_item rpl_visible<?php echo($current == $i ? ' current' : ''); ?>'>


            <div class='rpl_inner'>

                <?php if (isset($rpl_post->image) && $rpl_post->image != ""): ?>
                    <div class='rpl_img'>
                        <img src='<?php echo $rpl_post->image; ?>'/>
                    </div>
                <?php endif; ?>


                <p class='rpl_title'>
                    <a href='<?php echo $rpl_post->url; ?>'>
                        <?php echo $rpl_post->title; ?>
                        <span class="overlap"></span>
                    </a>
                </p>

                <?php if (!empty($rpl_post->content)): ?>
                    <?php if (
                        ($options['show_content'] == 3) ||
                        ($options['show_content'] == 1 && empty($rpl_post->image))
                    ):
                        ?>
                        <div class="rpl_content">
                            <?php echo $rpl_post->content; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($options['show_date'] && isset($rpl_post->date)): ?>
                    <div class="rpl_date">
                        <?php
                        $timestamp = strtotime($rpl_post->date);
                        if ($timestamp !== false && !empty($options['date_format']))
                            echo date($options['date_format'], $timestamp);
                        ?>
                    </div>
                <?php endif; ?>
                <?php if ($options['show_author'] && isset($rpl_post->author)): ?>
                    <div class="rpl_author">
                        <?php echo $rpl_post->author; ?>
                    </div>
                <?php endif; ?>
                <p class='rpl_relevance rpl_hidden'><?php echo $rpl_post->relevance ?></p>
                <div class='rpl_last'></div>
            </div>

        </div>

        <?php $i++; ?>
    <?php endforeach; ?>

</div>

<nav>

    <a class="rpl_prev" href="#">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"

                     width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">

        <polygon id="arrow-25-icon" points="142.332,104.886 197.48,50 402.5,256 197.48,462 142.332,407.113 292.727,256 "/>

        </svg>
    </a>

    <a class="rpl_next" href="#">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"

             width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">

        <polygon id="arrow-25-icon" points="142.332,104.886 197.48,50 402.5,256 197.48,462 142.332,407.113 292.727,256 "/>

        </svg>
    </a>

    <?php if ($options['autoplay'] == 1 && $options['autoplay_show_indicator']==1): ?>
        <input type="text" value="0" data-exactval="0" class="rpl_progress" data-skin="tron" data-width="32" data-height="32"
               data-displayPrevious=true data-fgColor="#cccccc"
               data-thickness=".4" data-displayInput=false>
    <?php endif; ?>

</nav>


</div>
</div>