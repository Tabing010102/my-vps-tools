<div id="loading" style="z-index:2">
	<div id="loading-center">
		<div id="loading-center-absolute">
			<div id="object"></div>
		</div>
	</div>
</div>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $web_url; ?>/"><?php echo $site_name?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        	<form id="search-bar" class="navbar-form navbar-left">
        		<div class="form-group input-group">
        		<input type="text" class="form-control" placeholder="输入你感兴趣的内容">
        		<span class="input-group-btn">
        			<button class="btn btn-default" type="button">搜索</button>
      			</span>
        		</div>
        		<!--button type="submit" class="btn btn-default">Submit</button-->
      		</form>
            <ul class="nav navbar-nav navbar-right">
				<?php
					foreach($page_navlist as $name => $url){
						echo '<li><a href="'.$url.'">'.$name.'</a></li>';
					}
				?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- 模态框（Modal） -->
<div class="modal fade" id="normalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<div class="modal-title" id="myModalLabel">提示</div></div>
			<div id="modal-body" class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
