function showmodal(callbackDetail){
	$("#modal-body").html(callbackDetail);
	$('#normalModal').modal({
		keyboard: true
	});
};
$(document).ready(function(){
	var normaloptions = {
		beforeSerialize:function(){
			$("[type=submit]").attr('disabled',true);
		},
		async:true,
		timeout:5000,
		success:function(data){
			showmodal(data.callback);
			if(data.jump){
				window.setTimeout(function(){
					if(data.jump){window.location.href=data.url;data.jump=false;}
					},data.jumptime
				);
			}
		},
		error:function(){
			showmodal("请求失败<br>这可能是多种原因造成的，请将此错误报告给<a href=\"/user?uid=0\">Tabing</a>");
		},
		complete:function(){
		    $("[type=submit]").attr('disabled',false);
		},
		dataType:'json'
	};
	$('#changesettingsform1').ajaxForm(normaloptions);
	$('#changesettingsform2').ajaxForm(normaloptions);
	$('#signinform').ajaxForm(normaloptions);
	$('#signupform').ajaxForm(normaloptions);
	$('#signoutform').ajaxForm(normaloptions);

	var writeoptions = {
		beforeSerialize:function(){
			$("[type=submit]").attr('disabled',true);
			var node=document.createTextNode(simplemde.value());
			var element = document.getElementById("MDE");
			element.appendChild(node);
		},
		success:function(data){
			showmodal(data.callback);
			if(data.jump){
				window.setTimeout(function(){
					if(data.jump){window.location.href=data.url;data.jump=false;}
					},data.jumptime
				);
			}
			$("[type=submit]").attr('disabled',false);
		},
		error:function(){
			showmodal("请求失败<br>这可能是多种原因造成的，请将此错误报告给<a href=\"/user?uid=0\">Tabing</a>");
			$("[type=submit]").attr('disabled',false);
		},
		dataType:'json'
	};
	$('#writeform').ajaxForm(writeoptions);
});
//跳转前动画
$(document).ready(function(){
	$("button").click(function(jumpevent){
		var jumpurl = $(this).attr("href");
		if(typeof jumpurl != "undefined" && jumpurl[0] != '#'){
			jumpevent.preventDefault();
			$("#loading").fadeIn("fast");
			window.setTimeout(function(){
				window.location.href=jumpurl,500
			});
		}
	});
	$("a").click(function(jumpevent){
		var jumpurl = $(this).attr("href");
		if(typeof jumpurl != "undefined" && jumpurl[0] != '#'){
			jumpevent.preventDefault();
			$("#loading").fadeIn("fast");
			window.setTimeout(function(){
				window.location.href=jumpurl,500
			});
		}
	});
});

if(document.getElementById("MDE")){
var simplemde = new SimpleMDE({
	element: document.getElementById("MDE"),
	autoDownloadFontAwesome: false,
	spellChecker:false,
	insertTexts: {
	    image: ["![](http://", ")"],
	    link: ["[](http://", ")"],
	    table: ["\n| 项目一", " | 项目二 | 项目三 |\n| --- | --- | --- |\n| 内容一 | 内容二 | 内容三 |\n"],
        unorderedList: ["\n- ", "\n"],
	    horizontalRule: ["\n***\n\n", ""],
	},
	toolbar: [{
		name: "bold",
		action: SimpleMDE.toggleBold,
		className: "fa fa-bold",
		title: "粗体",
	},
	{
		name: "italic",
		action: SimpleMDE.toggleItalic,
		className: "fa fa-italic",
		title: "斜体",
	},
	{
		name: "strikethrough",
		action: SimpleMDE.toggleStrikethrough,
		className: "fa fa-strikethrough",
		title: "删除线",
	},
	{
		name: "heading",
		action: SimpleMDE.toggleHeadingSmaller,
		className: "fa fa-header",
		title: "标题",
	},
	{
		name: "code",
		action: SimpleMDE.toggleCodeBlock,
		className: "fa fa-code",
		title: "代码",
	},
	{
		name: "quote",
		action: SimpleMDE.toggleBlockquote,
		className: "fa fa-quote-left",
		title: "引用",
	},
	{
		name: "unordered-list",
		action: SimpleMDE.toggleUnorderedList,
		className: "fa fa-list-ul",
		title: "无序列表",
	},
	{
		name: "link",
		action: SimpleMDE.drawLink,
		className: "fa fa-link",
		title: "链接",
	},
	{
		name: "image",
		action: SimpleMDE.drawImage,
		className: "fa fa-picture-o",
		title: "网络图片",
	},
	{
		name: "table",
		action: SimpleMDE.drawTable,
		className: "fa fa-table",
		title: "表格",
	},
	{
		name: "horizontal-rule",
		action: SimpleMDE.drawHorizontalRule,
		className: "fa fa-minus",
		title: "分割线",
	},
	{
		name: "preview",
		action: SimpleMDE.togglePreview,
		className: "fa fa-eye no-disable",
		title: "预览",
	},
	{
		name: "side-by-side",
		action: SimpleMDE.toggleSideBySide,
		className: "fa fa-columns no-disable no-mobile",
		title: "双栏对比",
	},
	{
		name: "fullscreen",
		action: SimpleMDE. 	toggleFullScreen,
		className: "fa fa-arrows-alt no-disable no-mobile",
		title: "全屏",
	},
	"|", // Separator
	],
});
simplemde.value("本网站使用Markdown编辑文本，这是一个简单的说明。\n请您先点击上面工具栏中的`预览`按钮，它应该是一个双栏图标。点击后全屏显示本文本框\n如果你已经很了解markdown的语法，直接删除这些内容并开始您的创作。\n\n**粗体**\n*斜体*\n~~删除线~~\n\n标题\n# 大标题（注意空格）\n## 中等标题\n### 小标题\n#### 更小的\n\n列表\n\n* 通用列表项\n* 通用列表项\n* 通用列表项\n\n\n1. 编号列表项\n2. 编号列表项\n3. 编号列表项\n\n链接\n\n[要显示的文本](http://www.example.com)\n\n引用\n> 这是一个引用。\n> 它可以跨多行！\n\n表格\n\n|第1列|第2列|第3列|\n|--------|--------|--------|\n|约翰|Doe|男|\n|玛丽|史密斯|女性|\n\n\n不对齐列...\n\n|第1列|第2栏|第3栏|\n|--------|--------|--------|\n|约翰|Doe|男|\n|玛丽|史密斯|女性|\n\n显示代码\n\n\tvar example = \"hello！\";\n\n跨越多行...\n\n```\nvar example = \"hello!\";\nalert(\"0\");\n```\n");
};
//ajax加载登录日志
$(window).scroll(function(){
	if ($(window).scrollTop() + $(window).height() == $(document).height()) {
		if(typeof ended == "undefined")ended = false;
		if(typeof log_list_on_send == "undefined")log_list_on_send = false;
		if($("#signinlog").hasClass("active") && (!ended)){
			if(!log_list_on_send && !ended){
				log_list_on_send = true;
				count = $("#signinlog").attr("count");
				$("#undateNoticeContext").html("正在加载");
				$.ajax({
					type:"POST",
					dataType:"text",
					url:$("#signinlog").attr("url"),
					data:{"page_cnt":count},
					success:function(newhtml){
						if(newhtml == ""){
							ended = true;
							$("#undateNoticeContext").html("已到底");
						}else{
							oldhtml = $("#signinloglist").html();
							$("#signinloglist").html(oldhtml + newhtml);
							$("#signinlog").attr("count",++count);
							$("#undateNoticeContext").html("滑动到页面底端继续加载后面的内容");
						}
					}
				});
				log_list_on_send = false;
			}
		};
	};
});
//ajax加载文章列表
$(window).scroll(function(){
	if ($(window).scrollTop() + $(window).height() == $(document).height()) {
		if(typeof ended == "undefined")ended = false;
		if(typeof log_list_on_send == "undefined")log_list_on_send = false;
		if(document.getElementById("articlelist")){
		if(!log_list_on_send && !ended){
			log_list_on_send = true;
			count = $("#articlelist").attr("count");
			$("#undateNoticeContext").html("正在加载");
			var uid = $("#userid").attr("uid");
			$.ajax({
				type:"POST",
				dataType:"text",
				url:$("#articlelist").attr("url"),
				data:{
				    "page_cnt":count,
				    "uid":uid,
				    },
				success:function(newhtml){
					if(newhtml == ""){
						ended = true;
						$("#undateNoticeContext").html("已到底");
					}else{
						oldhtml = $("#articlelist").html();
						$("#articlelist").html(oldhtml + newhtml);
						count++;
						$("#articlelist").attr("count",count);
						$("#undateNoticeContext").html("滑动到页面底端继续加载后面的内容");
					}
				}
			});
			log_list_on_send = false;
		}
		}
	};
});
//discuss页面处理
if(document.getElementById("content1")){
    var simplemde = new SimpleMDE({
    autoDownloadFontAwesome: false,
        spellChecker:false,
    });
    var content_num = 1;
    while(document.getElementById("content"+content_num)){
        markdowntext = $("#content"+content_num).html();
        htmltext = simplemde.markdown(markdowntext);
        $("#content"+content_num).html(htmltext);
        content_num++;
    };
    function count(){
        if(typeof i == "undefined")i = 1;
        return "head"+i++;
    };
    $(".content :header").attr("id",count);
    anchors.options = {
        visible: 'hover',
        placement: 'left',
        /*icon: '#'*/
    };
    anchors.add().remove('.intro-header h1').remove('.subheading');
    hljs.initHighlightingOnLoad();
    $('pre code').each(function(){
        texts = $(this).text().replace(/&(?!#?[a-zA-Z0-9]+;)/g, '&amp;')
        .replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/'/g, '&#39;').replace(/"/g, '&quot;')
        $(this).html(texts);
    });
}




smoothScroll.init({
	easing: 'easeInOutCubic',
});
$("#loading").fadeOut("slow");
