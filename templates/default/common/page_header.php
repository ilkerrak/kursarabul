<?php debug_backtrace() || die ("Direct access not permitted"); ?>
<header class="page-header">
    <div class="container">
      <div class="row">
            <div class="col-md-8">
            <?php
                    if($article_id == 0){
                        $page_title = $page['title'];
                        $page_subtitle = $page['subtitle'];
                        $page_name = $page['name']; ?>
                        
                        <?php
                    }
                    ?>
                    <?php
                    foreach($breadcrumbs as $id_parent){
                        if(isset($pages[$id_parent])){
                            $parent = $pages[$id_parent]; ?>
                            <a href="<?php echo DOCBASE.$parent['alias']; ?>" title="<?php echo $parent['title']; ?>"><?php echo $parent['name']; ?></a>
                            <?php
                        }
                    }
                    if($article_id > 0){ ?>
                        <a href="<?php echo DOCBASE.$page['alias']; ?>" title="<?php echo $page['title']; ?>"><?php echo $page['name']; ?></a>
                        <?php
                    } ?>
                    <!--  section  end-->
                    <div class="breadcrumbs-fs fl-wrap">
                        <div class="container">
                            

                            <div class="breadcrumbs fl-wrap"><a href="<?php echo DOCBASE.trim(LANG_ALIAS, "/"); ?>" title="<?php echo $homepage['title']; ?>"><?php echo $homepage['name']; ?></a><a href="<?php echo DOCBASE.$page['alias']; ?>"><?php echo $page_name; ?></a></div>
                        </div>
                    </div>
        </div>
    </div>
</header>
