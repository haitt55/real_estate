@extends('layouts.master')
@section('title', $currentProject->page_title ? $currentProject->page_title : 'Dự án')
@section('page_title', $currentProject->page_title ? $currentProject->page_title : 'Dự án')
@section('twitter_title', $currentProject->page_title ? $currentProject->page_title : 'Dự án')
@section('home-slider')
    <div id="home-slider">
        <!-- MasterSlider -->
        <div id="p_masterslider" class="master-slider-parent msl ms-parent-id-1" style="max-width:100%;">
            <!-- MasterSlider Main -->
            <div id="masterslider" class="master-slider ms-skin-default">
                <div class="ms-slide" data-delay="3" data-fill-mode="fill">
                    <img src="wp-content/plugins/master-slider/public/assets/css/blank.gif" alt="" title=""
                         data-src="wp-content/uploads/2017/02/a-vui-choi-trong-du-an.png"/>
                    <div class="ms-thumb">
                        <div class="ms-tab-context">
                            <div class=&quot;ms-tab-context&quot;></div>
                        </div>
                    </div>
                </div>
                <div class="ms-slide" data-delay="3" data-fill-mode="fill">
                    <img src="wp-content/plugins/master-slider/public/assets/css/blank.gif" alt="" title=""
                         data-src="wp-content/uploads/2017/02/vi-tri-cocobay-ocean-spa-resort2.png"/>
                    <div class="ms-thumb">
                        <div class="ms-tab-context">
                            <div class=&quot;ms-tab-context&quot;></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MasterSlider Main -->
        </div>
        <!-- END MasterSlider -->
        <script>
            (function ($) {
                "use strict";
                $(function () {
                    var masterslider_0cf6 = new MasterSlider();
                    // slider controls
                    masterslider_0cf6.control('arrows', {autohide: true, overVideo: true});
                    masterslider_0cf6.control('bullets', {
                        autohide: true,
                        overVideo: true,
                        dir: 'h',
                        align: 'bottom',
                        margin: 10
                    });
                    // slider setup
                    masterslider_0cf6.setup("masterslider", {
                        width: 1170,
                        height: 400,
                        minHeight: 400,
                        space: 0,
                        start: 1,
                        grabCursor: true,
                        swipe: true,
                        mouse: true,
                        layout: "boxed",
                        wheel: false,
                        autoplay: false,
                        instantStartLayers: false,
                        loop: false,
                        shuffle: false,
                        preload: 0,
                        heightLimit: true,
                        autoHeight: true,
                        smoothHeight: true,
                        endPause: false,
                        overPause: true,
                        fillMode: "fill",
                        centerControls: true,
                        startOnAppear: false,
                        layersMode: "center",
                        hideLayers: false,
                        fullscreenMargin: 0,
                        speed: 20,
                        dir: "h",
                        parallaxMode: 'swipe',
                        view: "basic"
                    });
                    window.masterslider_instances = window.masterslider_instances || [];
                    window.masterslider_instances.push(masterslider_0cf6);
                });
            })(jQuery);
        </script>
    </div>
@endsection
@section('title-inpage', $currentProject->project_name ? $currentProject->project_name : 'Dự án')
@section('content')
    <section class="kc-elm kc-css-460016 kc_row">
        <div class="kc-row-container  kc-container">
            <div class="kc-wrap-columns">
                <div class="kc-elm kc-css-143807 kc_col-sm-12 kc_column kc_col-sm-12">
                    <div class="kc-col-container">
                        <div id=" " class="kc-elm kc-css-244480 kc_row kc_row_inner">
                            <div class="kc-elm kc-css-950286 kc_col-sm-12 kc_column_inner kc_col-sm-12">
                                <div class="kc_wrapper kc-col-inner-container">
                                    <div class="kc-elm kc-css-293419 kc_text_block">
                                        <div class="post-content box mark-links entry-content">
                                            {!! $currentProject->description !!}
                                            <h4 style="text-align: center;"><img class="aligncenter"
                                                                                 src="wp-content/uploads/2017/02/dich-vu-tai-du-an.png"
                                                                                 alt="" width="599" height="325"/></h4>
                                            <h3 style="text-align: center;"><span style="color: #0000ff;"><strong>Liên hệ ngay Hotline PKD Cocobay Ban Condotel Coco Ocean – Spa Resort để được tư vấn và hỗ trợ :</strong></span>
                                            </h3>
                                            <ul>
                                                <li>
                                                    <h3>
                                                        <span style="color: #ff0000;"><strong>☏</strong></span><strong><span
                                                                    style="color: #ff0000;"> Gọi ngay Hotline để được tư vấn 24/7<br/>
</span></strong></h3>
                                                </li>
                                                <li>
                                                    <h3><strong><span style="color: #ff0000;">Goị : 0979 98 1313<br/>
</span></strong></h3>
                                                </li>
                                                <li>
                                                    <h3><strong><span style="color: #ff0000;">Gọi : 0941 757 333<br/>
</span></strong></h3>
                                                </li>
                                            </ul>
                                            <div><a href="tel:0904866999"><img class="aligncenter"
                                                                               src="../lh4.googleusercontent.com/-5_I3z5TCEbw/WCPeKz2U7eI/AAAAAAAAALk/HXbWGkelhP0AAWL1AjcbV6WpMMbLRSQ9gCLcB/s1600/1hotlinelol.gif"
                                                                               alt="" width="251" height="90"
                                                                               border="0"/></a></div>
                                            <h3>Xem Thêm >>> <a
                                                        href="index.php/mat-bang-can-ho-coco-ocean-spa-resort/index.html"><strong>MẶT
                                                        BĂNG CHI TIẾT CĂN HỘ</strong></a></h3>
                                            <h3>Xem Thêm >>> <a href="index.php/vi-tri-cocobay-da-nang/index.html">VỊ
                                                    TRÍ DỰ ÁN</a></h3>
                                            <h3>Xem Thêm >>> <a
                                                        href="index.php/tien-ich-du-an-cocobay-da-nang/index.html">TIỆN
                                                    ÍCH DỰ ÁN</a></h3>
                                            <h3>Xem Thêm >>>  <a href="index.php/gia-ban/index.html">CHÍNH SÁCH BÁN
                                                    HÀNG</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
