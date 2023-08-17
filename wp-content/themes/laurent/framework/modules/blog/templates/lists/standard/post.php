<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="eltdf-post-content">
        <div class="eltdf-post-heading">
            <?php laurent_elated_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
        <div class="eltdf-post-text">
            <div class="eltdf-post-text-inner">
                <div class="eltdf-post-info-top">
                    <?php laurent_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                    <?php laurent_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php laurent_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    <?php
                    if(laurent_elated_options()->getOptionValue('show_tags_area_blog') === 'yes') {
                        laurent_elated_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params);
                    } ?>
                </div>
                <div class="eltdf-post-text-main">
                    <?php laurent_elated_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php laurent_elated_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                    <?php do_action('laurent_elated_action_single_link_pages'); ?>
                </div>
                <div class="eltdf-post-info-bottom clearfix">
                    <div class="eltdf-post-info-bottom-left">
                        <?php laurent_elated_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                        <?php if ( laurent_elated_options()->getOptionValue('show_comments_number_blog') === 'yes' ) {
                            laurent_elated_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params);
                        } ?>
                    </div>
                    <div class="eltdf-post-info-bottom-right">
                        <?php laurent_elated_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>