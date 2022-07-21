<!-- Page Header -->
<header class="intro-header" style="background-image: url('<?php echo $web_com_url['img']; ?>blue.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1><?php echo $page_title;?></h1>
                    <!--hr class="small"-->
                    <?php if($user_identity_in_header != NULL) echo '<span class="author-identity">'.$user_identity_in_header.'</span>';?>
                </div>
            </div>
        </div>
    </div>
</header>
