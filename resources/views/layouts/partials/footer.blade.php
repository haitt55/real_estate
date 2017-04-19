<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
        <div class="row widget-footer">
            <div class="col-sm-6 footer-1">
                <section id="text-3" class="widget widget_text"><h3 class="widget-title">CAM KẾT BÁN HÀNG</h3>
                    {!! html_entity_decode($appSetting['commitment']) !!}
                </section>									</div>
            <div class="col-sm-6 footer-2">
                <section id="text-4" class="widget widget_text"><h3 class="widget-title">LIÊN HỆ PHÒNG BÁN HÀNG</h3>			
                <div class="textwidget" id ="info">
                    <li><span style="color: #ffffff;">THÔNG TIN LIÊN HỆ</span></li>
                    <span style="color: #ffffff;font-weight: bold;padding-left: 28px !important;padding: 10px 0px;">Tên công ty : {{ $appSetting['company'] }}</span><br>
                    <span style="color: #ffffff;font-weight: bold;padding-left: 28px !important;padding: 10px 0px;">Email : {{ $appSetting['email'] }}</span><br>
                    <span style="color: #ffffff;font-weight: bold;padding-left: 28px !important;padding: 10px 0px;">Hotline1 : {{ $appSetting['phone'] }}</span><br>
                    <span style="color: #ffffff;font-weight: bold;padding-left: 28px !important;padding: 10px 0px;">Hotline2 : {{ $appSetting['phone2'] }}</span><br>
                    <span style="color: #ffffff;font-weight: bold;padding-left: 28px !important;padding: 10px 0px;">Địa chỉ : {{ $appSetting['address'] }}</span><br>
                    <span></span>

				</div>
                </section>									
                </div>
            <!--<div class="col-sm-3 footer-3">
                                </div>
            <div class="col-sm-3 footer-4">
                                </div>-->
        </div>
    </div>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
</footer>