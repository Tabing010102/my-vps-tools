<div class="col-md-3 scrollspy" role="navigation">
    <nav id="issuelist" class="nav hidden-xs hidden-sm affix" data-spy="affix" data-offset-top="380" data-toggle="toc">
        <ol class="nav">
            <li class="nav"><a href="#head0" data-scroll>测试0</a></li>
            <li class="nav"><a href="#head1" data-scroll>测试1</a></li>
            <li class="nav"><a href="#head2" data-scroll>测试2</a></li>
            <li class="nav"><a href="#head3" data-scroll>测试3</a></li>
            <li class="nav"><a href="#head4" data-scroll>测试4</a></li>
            <li class="nav"><a href="#head5" data-scroll>测试5</a></li>
            <li class="nav"><a href="#head6" data-scroll>测试6</a></li>
            <li class="nav"><a href="#head7" data-scroll>测试7</a></li>
            <li class="nav"><a href="#head8" data-scroll>测试8</a></li>
            <li class="nav"><a href="#head9" data-scroll>测试9</a></li>
        </ol>
        <!-- end of main navigation -->
    </nav>
    <nav id="toc" class="nav hidden-xs hidden-sm affix" data-spy="affix" data-offset-top="380" data-toggle="toc">
        <ul class="toc"></ul>
        <!-- end of main navigation -->
    </nav>
    <div id="issuelist">
            <div class="issue">
                <div class="issueTitle"><a href="#head2" data-scroll>测试文本</a></div>
                <button type="button" class="btn btn-default" aria-label="Right Align" style="float:right">
                    <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                </button>
                <button type="button" class="btn btn-default" aria-label="Right Align" style="float:right">
                    <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                </button>
                <button type="button" class="btn btn-default" aria-label="Right Align" style="float:right">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
                <hr />
                <div class="issueCommentList">
                    <div class="issueComment">
                        <form class="author form-group">
                                    <a href="<?php echo $web_url; ?>/user?uid=1"><div class="author-name">MuZhou</div></a>
                                    <span class="author-identity">Theta前端负责人</span>
                                    <button class="btn btn-default btn-sm">打赏</button>
                        </form>
                        <p class="issueContent">测试文本</p>
                        <p class="issueContentTime">2017-01-01</p>
                    </div>
                    <div class="issueComment">
                        <form class="author form-group">
                                    <a href="<?php echo $web_url; ?>/user?uid=1"><div class="author-name">MuZhou</div></a>
                                    <span class="author-identity">Theta前端负责人</span>
                                    <button class="btn btn-default btn-sm">打赏</button>
                        </form>
                        <p class="issueContent">测试文本</p>
                        <p class="issueContentTime">2017-01-01</p>
                    </div>
                    <div class="issueComment">
                        <form class="author form-group">
                            <a href="<?php echo $web_url; ?>/user?uid=1"><div class="author-name">MuZhou</div></a>
                            <span class="author-identity">Theta前端负责人</span>
                            <button class="btn btn-default btn-sm">打赏</button>
                        </form>
                        <p class="issueContent">测试文本</p>
                        <p class="issueContentTime">2017-01-01</p>
                    </div>
                    <div class="issueComment">
                        <form class="author form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="<?php echo $web_url; ?>/user?uid=1"><div class="author-name">MuZhou</div></a>
                                    <span class="author-identity">Theta前端负责人</span>
                                    <button class="btn btn-default btn-sm">打赏</button>
                                </div>
                            </div>
                        </form>
                        <p class="issueContent">测试文本</p>
                        <p class="issueContentTime">2017-01-01</p>
                    </div>
                    <hr/>
                    <div class="addComment">
                        <form class="form-group input-group">
                            <input type="text" class="form-control" name="comment" id="inputComment" placeholder="添加评论">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">提交</button>
                            </span>
                        </form>
                </div>
            </div>
    </div>
</div>
