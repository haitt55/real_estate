<header id="masthead" class="site-header container-fluid" role="banner">
	<div class="row">
		<!-- .site-branding -->
		<nav
			class="navbar navbar-default menu-main navbar-static-top visible-lg"
			role="navigation">
			<div id="main-menu-desktop" class="menu-main-menu-container">
				<ul id="menu-main-menu" class="nav navbar-nav">
					<li class="logo"><a href="{{ route('mainProject.index') }}"> <img
							id="image_header" class="center-block img-responsive">
					</a></li>
					
					<li id="menu-item-sale" class="dropdown"><a>Sản phẩm
							đang bán</a>
						<ul class="dropdown-content">

						</ul></li>

					<li id="menu-item-tiendo"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-tiendo"><a
						href="{{ route('progress.index') }}">Tiến độ</a></li>
					<li id="menu-item-contact"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-contact"><a
						href="{{ route('contact.index') }}">Liên hệ</a></li>
					<li id="menu-item-new"
						class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-new"><a
						href="">Tin tức</a></li>
				</ul>
			</div>
		</nav>
		<!-- #main-menu-desktop -->
		<nav
			class="navbar navbar-default menu-main navbar-static-top hidden-lg"
			role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#main-menu-mobile">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
			</div>
			<div id="main-menu-mobile" class="collapse navbar-collapse">
				<ul id="menu-main-menu-1" class="nav navbar-nav">
					<li id="menu-item-5"
						class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-5">
						<a href="{{ route('mainProject.index') }}">Trang chủ</a>
					</li>
					<li id="menu-item-sale" class="dropdown"><a href="">Sản phẩm
							đang bán</a>
						<ul class="dropdown-content">
							
						</ul></li>

					<li id="menu-item-tiendo"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-tiendo"><a
						href="">Tiến độ</a></li>
					<li id="menu-item-contact"
						class="menu-item menu-item-type-post_type menu-item-object-page menu-item-contact"><a
						href="">Liên hệ</a></li>
					<li id="menu-item-new"
						class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-new"><a
						href="">Tin tức</a></li>
				</ul>
			</div>
		</nav>
		<!-- #main-menu-mobile -->
	</div>
</header>
<!-- #masthead -->