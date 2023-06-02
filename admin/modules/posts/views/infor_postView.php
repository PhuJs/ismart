<?php
get_header();
$id = isset($_GET['id']) ? $_GET['id'] : 1;
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right bg-light">
            <div class="w-75 mx-auto bg-white p-5">
                <div class="mt-2 mb-1">
                    <h4 class="h2 mb-1" style="font-weight:700;"><?php echo $posts['post_title'] ?></h4>
                    <p class="text-info pl-2"><span class=""><?php echo date("d/m/Y", $posts['time']); ?></span> | <span><?php echo $posts['author']; ?></span></p>
                    <hr>
                    <p class="h5" style="font-weight:600;">
                         <?php echo $posts['post_description']; ?>
                    </p>
                </div>
                <div class="section mt-2">
                   <?php echo $posts['post_content']; ?>
                </div>
                <div class="mt-3">
                    <a href="?mod=posts&controller=index&action=<?php echo $action; ?>&id=<?php echo $map; ?>" class="btn btn-primary fl-right">Trở lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>