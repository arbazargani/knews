<div class="tab-content">
    <div id="tab-comments" class="tab-pane active">
        <h2>@lang('custom.comments')</h2>
        <div class="form-group">
            <div id="comments" class="blog-comment-info">
                <div id="comment-list">
                    <? for($i = 0; $i < 3; $i++){ ?>
                    <div class="article-comment">
                        <div class="author">
                            <b>حامد رامشینی</b>
                        </div>
                        <div class="reply-message">
                            <a onclick="setArticleId(38);" style="cursor: pointer;">
                                پاسخ </a>
                        </div>
                        <div class="comment-date">
                            ۱۳۹۵/۰۸/۰۳, ۳:۳۱ عصر
                        </div>
                        <div class="text">
                            ی توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد
                            وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات
                        </div>
                    </div>
                    <? } ?>
                    <div class="form-group">
                        <div class="col-lg-6 col-sm-12 text-left"></div>
                    </div>
                    <script type="text/javascript">
                        function setArticleId(article_id) {
                            $("#blog-reply-id").val(article_id);
                            $("#reply-remove").css('display', 'inline');
                            $('html, body').animate({
                                'scrollTop': $('#review-title').offset().top - ($('#stuck').outerHeight() + 50)
                            }, 500);
                        }
                    </script>
                </div>
                <div id="comment-section"></div>
                <h2 id="review-title">
                    <span>نظر خود را ارسال کنید</span>
                    <div class="reply-cancel">
                                <span id="reply-remove" style="display:none; cursor: pointer;"
                                      onclick="removeCommentId();">
                                  انصراف از پاسخگویی </span>
                    </div>
                </h2>
                <input type="hidden" name="blog_article_reply_id" value="0" id="blog-reply-id">
                <div class="comment-left">
                    <div class="form-group">
                        <label for="comment-name">
                            <strong>نام و نام خانوادگی:</strong>
                        </label>
                        <input type="text" name="name" value="" id="comment-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment-text">
                            <strong>نظر:</strong>
                        </label>
                        <textarea name="text" class="" id="comment-text"></textarea>
                    </div>
                </div>
                <br>
                <div class="text-right">
                    <a id="button-comment" class="btn btn-info">
                        <span>ارسال نظر</span></a>
                </div>
            </div>
        </div>
    </div>
</div>