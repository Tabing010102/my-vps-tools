<!--script>
if(document.getElementById("toc")){
/* async load function */
    function async(u, c) {
      var d = document, t = 'script',
          o = d.createElement(t),
          s = d.getElementsByTagName(t)[0];
      o.src = u;
      if (c) { o.addEventListener('load', function (e) { c(null, e); }, false); }
      s.parentNode.insertBefore(o, s);
    }
/* anchor-js, Doc:http://bryanbraun.github.io/anchorjs/ */
    async("https://cdn.bootcss.com/anchor-js/1.1.1/anchor.min.js",function(){
        anchors.options = {
          visible: 'hover',
          placement: 'right',
          /*icon: '#'*/
        };
        anchors.add().remove('.intro-header h1').remove('.subheading');
    })
/* Highlight.js */
    async("https://cdn.bootcss.com/highlight.js/9.7.0/highlight.min.js",function(){
        hljs.initHighlightingOnLoad();
    })
}
</script-->

<!-- markdowneditor -->
<script src="<?php echo $web_url; ?>/js/simplemde.min.js"></script>

<script src="<?php echo $web_url; ?>/js/anchor.min.js"></script>
<script src="<?php echo $web_url; ?>/js/highlight.min.js"></script>

<!-- jQuery form -->
<script src="<?php echo $web_url; ?>/js/jquery.form.min.js "></script>

<script src="<?php echo $web_url; ?>/js/backtop.js"></script>

<!-- toc -->
<script src="<?php echo $web_url; ?>/js/toc.js "></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#toc').toc();
}); </script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $web_url; ?>/js/bootstrap.min.js "></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo $web_url; ?>/js/clean-blog.js "></script>

<!-- smooth-scroll -->
<script src="<?php echo $web_url; ?>/js/smooth-scroll.min.js "></script>

<script src="<?php echo $web_url; ?>/js/theta.js"></script>

<!-- canvas-nest -->
<!--script type="text/javascript" opacity="0.7" count="100" src="/js/canvas-nest.min.js "></script-->
