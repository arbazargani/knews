<script>
    $('.ajax-loading').hide();
    $('.t3-ajax-loading').hide();
</script>
@if(\Request::route()->getName() == 'tag.show')
    <script>
        !function (t) {
            var i = t(window);
            t.fn.visible = function (t, e, o) {
                if (!(this.length < 1)) {
                    var r = this.length > 1 ? this.eq(0) : this, n = r.get(0), f = i.width(), h = i.height(),
                        o = o ? o : "both", l = e === !0 ? n.offsetWidth * n.offsetHeight : !0;
                    if ("function" == typeof n.getBoundingClientRect) {
                        var g = n.getBoundingClientRect(), u = g.top >= 0 && g.top < h,
                            s = g.bottom > 0 && g.bottom <= h, c = g.left >= 0 && g.left < f,
                            a = g.right > 0 && g.right <= f, v = t ? u || s : u && s, b = t ? c || a : c && a;
                        if ("both" === o) return l && v && b;
                        if ("vertical" === o) return l && v;
                        if ("horizontal" === o) return l && b
                    } else {
                        var d = i.scrollTop(), p = d + h, w = i.scrollLeft(), m = w + f, y = r.offset(), z = y.top,
                            B = z + r.height(), C = y.left, R = C + r.width(), j = t === !0 ? B : z,
                            q = t === !0 ? z : B, H = t === !0 ? R : C, L = t === !0 ? C : R;
                        if ("both" === o) return !!l && p >= q && j >= d && m >= L && H >= w;
                        if ("vertical" === o) return !!l && p >= q && j >= d;
                        if ("horizontal" === o) return !!l && m >= L && H >= w
                    }
                }
            }
        }(jQuery);
        $.fn.isOnScreen = function () {

            var win = $(window);

            var viewport = {
                top: win.scrollTop(),
                left: win.scrollLeft()
            };
            viewport.right = viewport.left + win.width();
            viewport.bottom = viewport.top + win.height();

            var bounds = this.offset();
            bounds.right = bounds.left + this.outerWidth();
            bounds.bottom = bounds.top + this.outerHeight();

            return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

        };


        var SITEURL = "/tags/{{$tag->id}}/json/";
        var page = 0;
        var should_try_ajax = 1;
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() || $('#loader').isOnScreen()) { //if user scrolled from top to bottom of the page
                if (should_try_ajax) {
                    page++;
                    load_more(page);
                }
            }
        });

        function load_more(page) {
            $.ajax({
                url: SITEURL + page,
                type: "get",
                datatype: "html",
                beforeSend: function () {
                    $('.ajax-loading').show();
                }
            })
                .done(function (data) {
                    if (data.length == 0) {
                        console.log(data.length);
                        //notify user if nothing to load
                        $('.ajax-loading').html("");
                        should_try_ajax = 0;
                        return;
                    }
                    $('.ajax-loading').hide(); //hide loading animation once data is received
                    $("#results").append(data); //append data into #results element
                    //   page++;
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('No response from server');
                });
        }
    </script>
@endif

<script>
    !function (t) {
        var i = t(window);
        t.fn.visible = function (t, e, o) {
            if (!(this.length < 1)) {
                var r = this.length > 1 ? this.eq(0) : this, n = r.get(0), f = i.width(), h = i.height(),
                    o = o ? o : "both", l = e === !0 ? n.offsetWidth * n.offsetHeight : !0;
                if ("function" == typeof n.getBoundingClientRect) {
                    var g = n.getBoundingClientRect(), u = g.top >= 0 && g.top < h,
                        s = g.bottom > 0 && g.bottom <= h, c = g.left >= 0 && g.left < f,
                        a = g.right > 0 && g.right <= f, v = t ? u || s : u && s, b = t ? c || a : c && a;
                    if ("both" === o) return l && v && b;
                    if ("vertical" === o) return l && v;
                    if ("horizontal" === o) return l && b
                } else {
                    var d = i.scrollTop(), p = d + h, w = i.scrollLeft(), m = w + f, y = r.offset(), z = y.top,
                        B = z + r.height(), C = y.left, R = C + r.width(), j = t === !0 ? B : z,
                        q = t === !0 ? z : B, H = t === !0 ? R : C, L = t === !0 ? C : R;
                    if ("both" === o) return !!l && p >= q && j >= d && m >= L && H >= w;
                    if ("vertical" === o) return !!l && p >= q && j >= d;
                    if ("horizontal" === o) return !!l && m >= L && H >= w
                }
            }
        }
    }(jQuery);
    $.fn.isOnScreen = function () {

        var win = $(window);

        var viewport = {
            top: win.scrollTop(),
            left: win.scrollLeft()
        };
        viewport.right = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();

        var bounds = this.offset();
        bounds.right = bounds.left + this.outerWidth();
        bounds.bottom = bounds.top + this.outerHeight();

        return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

    };


    var T3URL = "/json/titr3/";
    var t3page = 0;
    var t3_should_try_ajax = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() || $('#t3_loader').isOnScreen()) { //if user scrolled from top to bottom of the page
            if (t3_should_try_ajax) {
                t3page++;
                t3_load_more(t3page);
            }
        }
    });

    function t3_load_more(page) {
        $.ajax({
            url: T3URL + page,
            type: "get",
            datatype: "html",
            beforeSend: function () {
                $('.t3_ajax-loading').show();
            }
        })
            .done(function (data) {
                if (data.length == 0) {
                    console.log(data.length);
                    //notify user if nothing to load
                    $('.t3_ajax-loading').html("");
                    t3_should_try_ajax = 0;
                    return;
                }
                $('.t3_ajax-loading').hide(); //hide loading animation once data is received
                $("#t3_results").append(data); //append data into #results element
                //   page++;
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('No response from server');
            });
    }
</script>

@if(\Request::route()->getName() == 'archive.month')
    <script>
        !function (t) {
            var i = t(window);
            t.fn.visible = function (t, e, o) {
                if (!(this.length < 1)) {
                    var r = this.length > 1 ? this.eq(0) : this, n = r.get(0), f = i.width(), h = i.height(),
                        o = o ? o : "both", l = e === !0 ? n.offsetWidth * n.offsetHeight : !0;
                    if ("function" == typeof n.getBoundingClientRect) {
                        var g = n.getBoundingClientRect(), u = g.top >= 0 && g.top < h,
                            s = g.bottom > 0 && g.bottom <= h, c = g.left >= 0 && g.left < f,
                            a = g.right > 0 && g.right <= f, v = t ? u || s : u && s, b = t ? c || a : c && a;
                        if ("both" === o) return l && v && b;
                        if ("vertical" === o) return l && v;
                        if ("horizontal" === o) return l && b
                    } else {
                        var d = i.scrollTop(), p = d + h, w = i.scrollLeft(), m = w + f, y = r.offset(), z = y.top,
                            B = z + r.height(), C = y.left, R = C + r.width(), j = t === !0 ? B : z,
                            q = t === !0 ? z : B, H = t === !0 ? R : C, L = t === !0 ? C : R;
                        if ("both" === o) return !!l && p >= q && j >= d && m >= L && H >= w;
                        if ("vertical" === o) return !!l && p >= q && j >= d;
                        if ("horizontal" === o) return !!l && m >= L && H >= w
                    }
                }
            }
        }(jQuery);
        $.fn.isOnScreen = function () {

            var win = $(window);

            var viewport = {
                top: win.scrollTop(),
                left: win.scrollLeft()
            };
            viewport.right = viewport.left + win.width();
            viewport.bottom = viewport.top + win.height();

            var bounds = this.offset();
            bounds.right = bounds.left + this.outerWidth();
            bounds.bottom = bounds.top + this.outerHeight();

            return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

        };


        var archiveURL = "/json/archive/{{$month}}/";
        var archivepage = 0;
        var archive_should_try_ajax = 1;
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() || $('#archive_loader').isOnScreen()) { //if user scrolled from top to bottom of the page
                if (archive_should_try_ajax) {
                    archivepage++;
                    t3_load_more(archivepage);
                }
            }
        });

        function t3_load_more(page) {
            $.ajax({
                url: archiveURL + page,
                type: "get",
                datatype: "html",
                beforeSend: function () {
                    $('.archive_ajax-loading').show();
                }
            })
                .done(function (data) {
                    if (data.length == 0) {
                        console.log(data.length);
                        //notify user if nothing to load
                        $('.archive_ajax-loading').html("");
                        archive_should_try_ajax = 0;
                        return;
                    }
                    $('.archive_ajax-loading').hide(); //hide loading animation once data is received
                    $("#archive_results").append(data); //append data into #results element
                    //   page++;
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('No response from server');
                });
        }
    </script>

@endif