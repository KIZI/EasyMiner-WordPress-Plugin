<?php
/*
Template Name: Single EasyMiner Report
*/

$post = get_post();

get_header();
?>
<div style="text-align: center">
    <h1 class="title"><?php echo $post->post_title; ?></h1>
    <div>
        <?php echo $post->post_content; ?>
    </div>
    <!--- BUĎ SE TA TRANSFORMACE BUDE ODEHRÁVAT TADY,
    NEBO SE ZAVOLÁ OBJEKT, KTERÝ TU TRANSFORMACI UDĚLÁ -->
</div>
<?php
get_footer();