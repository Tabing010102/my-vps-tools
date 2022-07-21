<?php
    require_once("../site_info.php");
    $page_title = "主页";
    require_once($page_com_url["formnav"]);
?>
    
<!DOCTYPE html>
<html lang="en">
    
<?php
    require_once($page_com_url["head"]);
?>

<body data-spy="scroll" data-offset="300">

<?php
    require_once($page_com_url["nav"]);
    require_once($page_com_url["discuss_header"]);
?>

<div style="display:none;"><textarea></textarea></div>
<!-- Post Content -->
<article>
<div class="col-md-9">
    <div class="container">
        <div class="row">
            <div id="maintext" class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 post-container">
            <div class="author form-group">
    <div class="row">
        <div class="col-sm-6">
            <a href="/user?uid=1"><div class="author-name">MuZhou</div></a>
            <span class="author-identity">Theta前端负责人</span>
            <div class="author-description col-sm-12">不忘初心，毅然决然的前行着</div>
        </div>
        <div class="col-sm-6">
            <button class="btn btn-default">赞</button>
            <button class="btn btn-default">打赏</button>
            <button class="btn btn-default">关注</button>
            <div class="col-sm-12">以下内容  允许自由转载</div>
        </div>
    </div>
</div>
                <div id="content1" class="content" count="2"># 简介 

Vim 是从 vi 发展出来的一个文本编辑器，代码补完、编译及错误跳转等方便编程的功能特别丰富，在程序员中被广泛使用，和 Emacs 并列成为类 Unix 系统用户最喜欢的编辑器  

不过vim如何使用呢？</div>
<div class="author form-group">
<hr>
    <div class="row">
        <div class="col-sm-6">
            <a href=""><div class="author-name">Tabing</div></a>
            <span class="author-identity">Theta后端负责人</span>
            <div class="author-description col-sm-12">明天还是那个明天，你的未来还是你的未来</div>
        </div>
        <div class="col-sm-6">
            <button class="btn btn-default">赞</button>
            <button class="btn btn-default">打赏</button>
            <button class="btn btn-default">关注</button>
            <div class="col-sm-12">以下内容  由作者同意后转载</div>
        </div>
    </div>
</div>
<div id="content2" class="content"># 安装

## Linux

    ctrl-alt-t //讲道理会打开一个命令行终端
    sudo apt-get install vim

## Windows

1. 访问 [vim 官方网站](http://www.vim.org/)
2. 点击左侧 Download
3. 点击关键字 PC: MS-DOS and MS-Windows
4. 你会看到 gvim@@.exe (@@表示版本号，因为会不断更新所以没有加数字)
5. 下载安装即可

# 准备

## 安装g++

### Linux

(其实系统自带，可以跳过)  

    ctrl-alt-t
    sudo apt-get install g++
    
### Windows

1. 安装 MinGW 或 Dev-C++ (尝试 MinGW 的请自行探索，以下是 Dev-C++ 的步骤)
2. 在安装目录中寻找 bin 或 MinGW32/bin
3. 将上述目录加入系统环境变量 PATH 中(详细方法自行查阅网络)

## vim的配置文件

### 打开 vim

#### Linux

    ctrl-alt-t
    vim
    
#### Windows

双击桌面图标 gVim @@.exe (不要管另外两个)  

### 编写配置文件

注意，打开 vim 之后千万不要乱动键盘，因为现在键盘上的**大部分按键都是命令**  

现在，遵循刘汝佳精神，先按下面的步骤做，后面会详细说明他们的含义  

    :e $VIM/vimrc "请注意观察光标位置的变化

这时讲道理会提示打开了一个新文件  

    i //对，这是一个命令，注意观察光标和左下角的变化
    :set number //有没有发现这里的注释是双引号开头的?
    :set tabstop=4 //配置文件中的注释就是这样的
    :set shiftwidth=4 //请不要在等号前后加空格
    :set autoindent
    :set smartindent
    ESC //也可以按 ctrl-[
    :w //观察
    :q //观察</div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($page_com_url["toc"]);
?>

</article>

<?php
    require_once($page_com_url["footer"]);
    require_once($page_com_url["foot"]);
?>

</body>
</html>
