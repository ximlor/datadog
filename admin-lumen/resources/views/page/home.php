<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <title>  </title>
</head>

<body>
    <section class='weibo-top-content'>
        <div class="pc-logo-fixed">
            <div class="pc-logo-relative">
                <aside class='pc-logo'>
@if ($test_environment == 'development')
                    <img src="http://10.13.130.60/toutiao/h5/img/ewm_1x.png">
    @else
                    <img src="//h5.sinaimg.cn/toutiao/h5/{{ $rev_manifest_arr['img_ewm_1x_png'] }}">
@endif
                    <span class="pc-desc">
看更多精彩文章扫描下载客户端
                    </span>
                </aside>
            </div>
        </div>
        <header class='hd'>
            <div class="navbar layout-box">
                <a class='backbtn'>返回</a>
                <h1 class='page-title box-col' id="{{ $target }}">微博头条</h1>
                <a class='thr-line' data-action='fold'>返回</a>
            </div>
            <div class='navbar-detail hid'>
                <a data-action='source' href="{{ $article['original_url'] }}">查看原网页</a>
                <a data-action='feedbackpro' href="http://m.weibo.cn/pubs/weibo/feedback?mid={{ $article['mid'] }}&oid={{ $article['oid'] }}">反馈问题</a>
            </div>
        </header>
        <article class="main">
            <header class="header">
                <h1 class="tit" mid="{{ $article['mid'] }}" uid="{{ $article['uid'] }}" object_id="{{ $article['oid'] }}" id="main-title">{{ $article['title'] }}</h1>
                <p class="info">
                    <span class="from">{{ $article['source'] }}</span>
                    <time class="time">{{ $article['time'] }}</time>
                </p>
            </header>
            <!--
            <aside class="flagshare share share-weibo" id="gotomain">
                <a href="javascript:;" data-action="weibo" class="item-weibo">
                    <span>分享到微博</span><i></i>
                </a>
            </aside>
-->
            <section class="content">
@foreach ($content as $value)
    @if (isset($value['pic']))
                    <p class="img-wrapper" data-action="img" data-width="{{ $value['pic']['wm700']['width'] }}" data-height="{{ $value['pic']['wm700']['height'] }}">
                        <img src="{{ $value['pic']['wm700']['des_url'] }}">
                    </p>
@elseif (isset($value['videos']))
<video src="{{ $value['videos']['video_url'] }}" poster="{{ $value['videos']['img_url'] }}" style="max-width: 100%;" controls="controls"></video>
@else
                    <p>
                        {{ $value['text'] }}
                    </p>
@endif

                @if (!empty($value['text_with_url']['text']) && !empty($value['text_with_url']['url']))
                    <p>
                        <a href="{{ $value['text_with_url']['url'] }}" target="_self">
                            {{ $value['text_with_url']['text'] }}
                        </a>
                    </p>
@endif

                @if (!empty($value['pic_with_url']['pic']) && !empty($value['pic_with_url']['url']))
                    <p class="img-wrapper" data-action="img" data-width="{{ $value['pic_with_url']['pic']['wm700']['width'] }}" data-height="{{ $value['pic_with_url']['pic']['wm700']['height'] }}">
                        <a href="{{ $value['pic_with_url']['url'] }}" target="_self">
                            <img src="{{ $value['pic_with_url']['pic']['wm700']['des_url'] }}">
                        </a>
                    </p>
@endif

              @endforeach
            </section>
            <!--
            <aside class="flagshare share share-weibo" id="gotomain">
                <a href="javascript:;" data-action="weibo" class="item-weibo">
                    <span>分享到微博</span><i></i>
                </a>
            </aside>
-->
            <aside class="btn-group">
                <a class="item"></a>
                <a class="icon">
                    <i class='comment' data-action='comment'></i>
                    <span>评论</span>
                </a>
                <a class="item"></a>
                <a class="icon">
                  <i class='good  {{ !empty($articleLiked) ? "good-select" : "'" }}' data-action='good'></i>
                  <span>{{ !empty($articleLiked) ? "已" : "" }}赞</span>
                </a>
                <a class="item"></a>
            </aside>
        </article>
        @if (count($relatedArticles) > 0)
        <section class="related-post">
            <h1 class="tit">相关文章</h1>
            <ul id="J-post-list" class="list">
              @foreach ($relatedArticles as $value)
                @if (isset($value['image_240']) && count($value['image_240']) == 3)
                <li class="item active" data-action="post">
                    <a href="{{ $value['article_url'] }}" target="_self">
                        <section class="content">
                            <p class="link">{{ $value['title'] }}</p>
                            <div class="pic-list">
                              @foreach ($value['image_240'] as $key => $val)
                                <aside class="pic-wrapper">
                                    <img src="{{ $val['des_url'] }}" alt="">
                                </aside>
                              @endforeach
                            </div>
                            <footer class="footer">
                                <span class="from">{{ $value['source'] }}</span><span class="comment"><i></i>{{ $value['comments_count'] }}</span>
                            </footer>
                        </section>
                    </a>
                </li>
                @elseif (isset($value['image_240']) && count($value['image_240']) == 1)
                  <li class="item" data-action="post">
                    <aside class="pic-wrapper">
                        <img src="{{ $value['image_240'][0]['des_url'] }}" alt="">
                    </aside>
                    <a href="{{ $http_host }}/article/{{ $value['oid'] }}" target="_self">
                        <section class="content">
                            <p class="link ">{{ $value['title'] }}</p>
                            <footer class="footer">
                                <span class="from">{{ $value['source'] }}</span><span class="comment"><i></i>{{ $value['comments_count'] }}</span>
                            </footer>
                        </section>
                    </a>
                </li>
                @else
              <li class="item" data-action="post">
                    <a href="{{ $http_host }}/article/{{ $value['oid'] }}" target="_self">
                        <section class="content">
                            <p class="link">{{ $value['title'] }}</p>
                            <footer class="footer">
                                <span class="from">{{ $value['source'] }}</span><span class="comment"><i></i>{{ $value['comments_count'] }}</span>
                            </footer>
                        </section>
                    </a>
                </li>
                @endif
              @endforeach
            </ul>
        </section>
        <div class='border'></div>
        @endif

        @if (count($ArticleActivities) != 0)
          <section class="special-comment special-comment-flag">
            <h1 class="tit tit-size" id="gotocomment">
              {{ !empty($is_vip_activities) ? "热门评论" : "评论" }}
              <span id = 'comment-count'>{{ $comments_count }}</span>
            </h1>
            <ul id="J-comment-list" class="list">
                <!-- <div class="empty" data-action="empty">访问出现异常，点击屏幕重新加载</div> -->
                @foreach ($ArticleActivities as $value)
                <li class="layout-box item @if ($value['user']['verified'] && $value['user']['verified_type']==0) orange_v @endif" data-action="replycomment" id="J-del">
                    <input type="hidden" id="{{ $value['user']['uid'] }}" name="uid">
                    <aside class="avatar-wrapper">
                        <img src="{{ $value['user']['profile_image_url'] }}" alt="">
                    </aside>
                    <section class="content box-col">
                        <p class="username">{{ $value['user']['screen_name'] }}</p>
                        <p class="txt">
                            {{ $value['text'] }}
                        </p>
                        <footer class="footer">
                            <time class="time">{{ $value['created_at'] }}</time>
                            <p class="action">
                                <a href="javascript:;" id="J-liked" class="btn zan {{ !empty($value['liked']) ? "like" : "" }}" data-action="like" type="{{ $value['type'] }}">
                                  {{ $value['counts']['attitudes_count'] > 0 ? $value['counts']['attitudes_count'] : 0}}
                                </a>
                                <a href="javascript:;" class="btn comment" mid="{{ $value['w_id'] }}"></a>
                            </p>
                        </footer>
                    </section>
                </li>
                @endforeach
            </ul>
            <span id="J-comment-more" class="more" data-action="more">打开微博头条客户端，查看大V热评</span>
        </section>
        @else
        <section class="special-comment-flag"></section>
        @endif
        <div class='border'></div>

        <section class="related-post">
            <h1 class="tit">头条要闻</h1>
            <ul id="J-post-list" class="list">
              @foreach ($appExclusive as $value)
                @if (isset($value['image_240']) && count($value['image_240']) == 3)
              <li class="item" data-action="unique" id="article_unique">
                    <a href="javascript:void(0);" >
                        <section class="content">
                            <p class="link unique">{{ $value['title'] }}</p>
                            <div class="pic-list">
                              @foreach ($value['image_240'] as $key => $val)
                                <aside class="pic-wrapper">
                                    <img src="{{ $val['des_url'] }}" alt="">
                                </aside>
                              @endforeach
                            </div>
                            <footer class="footer">
                                <span class="from">{{ $value['source'] }}</span><span class="comment"><i></i>{{ $value['comments_count'] }}</span>
                            </footer>
                        </section>
                    </a>
                </li>
                @elseif (isset($value['image_240']) && count($value['image_240']) == 1)
                 <li class="item" data-action="unique" id="article_unique">
                    <aside class="pic-wrapper">
                        <img src="{{ $value['image_240'][0]['des_url'] }}" alt="">
                    </aside>
                    <a href="javascript:void(0);" >
                        <section class="content">
                            <p class="link unique">{{ $value['title'] }}</p>
                            <footer class="footer">
                                <span class="from">{{ $value['source'] }}</span><span class="comment"><i></i>{{ $value['comments_count'] }}</span>
                            </footer>
                        </section>
                    </a>
                </li>
                @else
              <li class="item" data-action="unique" id="article_unique">
                    <a href="javascript:void(0);" >
                        <section class="content">
                            <p class="link unique">{{ $value['title'] }}</p>
                            <footer class="footer">
                                <span class="from">{{ $value['source'] }}</span><span class="comment"><i></i>{{ $value['comments_count'] }}</span>
                            </footer>
                        </section>
                    </a>
                </li>
                @endif
              @endforeach

              @foreach ($spotArticles as $value)
                @if (isset($value['image_240']) && count($value['image_240']) == 3)
                  <li class="item active" data-action="post">
                    <a href="{{ $http_host }}/article/{{ $value['oid'] }}" target="_self">
                        <section class="content">
                            <p class="link">{{ $value['title'] }}</p>
                            <div class="pic-list">
                              @foreach ($value['image_240'] as $key => $val)
                                <aside class="pic-wrapper">
                                    <img src="{{ $val['des_url'] }}" alt="">
                                </aside>
                              @endforeach
                            </div>
                            <footer class="footer">
                                <span class="from">{{ $value['source'] }}</span><span class="comment"><i></i>{{ $value['comments_count'] }}</span>
                            </footer>
                        </section>
                    </a>
                </li>
                @elseif (isset($value['image_240']) && count($value['image_240']) == 1)
                  <li class="item" data-action="post">
                    <aside class="pic-wrapper">
                        <img src="{{ $value['image_240'][0]['des_url'] }}" alt="">
                    </aside>
                    <a href="{{ $http_host }}/article/{{ $value['oid'] }}" target="_self">
                        <section class="content">
                            <p class="link ">{{ $value['title'] }}</p>
                            <footer class="footer">
                                <span class="from">{{ $value['source'] }}</span><span class="comment"><i></i>{{ $value['comments_count'] }}</span>
                            </footer>
                        </section>
                    </a>
                </li>
                @else
                  <li class="item" data-action="post">
                    <a href="{{ $http_host }}/article/{{ $value['oid'] }}" target="_self">
                        <section class="content">
                            <p class="link">{{ $value['title'] }}</p>
                            <footer class="footer">
                                <span class="from">{{ $value['source'] }}</span><span class="comment"><i></i>{{ $value['comments_count'] }}</span>
                            </footer>
                        </section>
                    </a>
                </li>
                @endif
              @endforeach
            </ul>
            <span id="J-comment-more" class="more" data-action="more">用微博头条客户端看，体验更流畅</span>
        </section>
        <div class='border'></div>
        <!-- 分享图标 -->
        <a class='sharetag hid'><i data-action='cancel-share'></i></a>
    </section>
    <!-- 遮罩层-->
    <div id="J_overlay" data-action="cancel" class='hid'></div>
    <!-- 发布器-->
    <div class='upload hid'>
        <div class='sub-header clearfix'>
            <a data-action='cancel' class='item upload-cancel'>取消</a>
            <span class='item text-c'>发评论</span>
            <a class='item upload-send' data-action='send' type="reply">发送</a>
        </div>
        <textarea class='J-comment' placeholder="写评论..."></textarea>
        <footer class='J-Content-footer'>
            <label class='text-l'>
                <input type="checkbox" name="type" value="1" checked>同时转发到我的微博
            </label>
            <span class='text-r count'>140</span>
        </footer>
    </div>
    <!-- 分享图标 -->
    <a class='sharetag hid'><i data-action='cancel-share'></i></a>
    <!-- 回调界面 -->
    <div class='alert hid'></div>

</body>
    @if ($test_environment == 'development')
    <script type="text/javascript" src="http://10.13.130.60/toutiao/h5/js/Tools.js?t={{ $t }}"></script>
    <script type="text/javascript" src="http://10.13.130.60/toutiao/h5/js/PCArticle.js?t={{ $t }}"></script>
@else
    <script type="text/javascript" src="//h5.sinaimg.cn/toutiao/h5/{{ $rev_manifest_arr['js_Tools_js'] }}"></script>
    <script type="text/javascript" src="//h5.sinaimg.cn/toutiao/h5/{{ $rev_manifest_arr['js_PCArticle_js'] }}"></script>
@endif
</html>
