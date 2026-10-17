@extends('v_layouts.app')

@section('content')
<!-- HEADER -->
<header>
	<!-- top Header -->
	<div id="top-header">
		<div class="container">
			<div class="pull-left">
				<span>Welcome to E-shop!</span>
			</div>
			<div class="pull-right">
				<ul class="header-top-links">
					<li><a href="#">Store</a></li>
					<li><a href="#">Newsletter</a></li>
					<li><a href="#">FAQ</a></li>
					<li class="dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">ENG <i class="fa fa-caret-down"></i></a>
						<ul class="custom-menu">
							<li><a href="#">English (ENG)</a></li>
							<li><a href="#">Russian (Ru)</a></li>
							<li><a href="#">French (FR)</a></li>
							<li><a href="#">Spanish (Es)</a></li>
						</ul>
					</li>
					<li class="dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">USD <i class="fa fa-caret-down"></i></a>
						<ul class="custom-menu">
							<li><a href="#">USD ($)</a></li>
							<li><a href="#">EUR (€)</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /top Header -->

	<!-- header -->
	<div id="header">
		<div class="container">
			<div class="pull-left">
				<!-- Logo -->
				<div class="header-logo">
					<a class="logo" href="#">
						<img src="{{ asset('frontend/img/logo.png') }}" alt="">
					</a>
				</div>
				<!-- /Logo -->

				<!-- Search -->
				<div class="header-search">
					<form>
						<input class="input search-input" type="text" placeholder="Enter your keyword">
						<select class="input search-categories">
							<option value="0">All Categories</option>
							<option value="1">Category 01</option>
							<option value="1">Category 02</option>
						</select>
						<button class="search-btn"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<!-- /Search -->
			</div>
			<div class="pull-right">
				<ul class="header-btns">
					<!-- Account -->
					<li class="header-account dropdown default-dropdown">
						<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
							<div class="header-btns-icon">
								<i class="fa fa-user-o"></i>
							</div>
							<strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
						</div>
						<a href="{{ route('backend.login') }}" class="text-uppercase">Login</a> / <a href="{{ route('backend.login') }}" class="text-uppercase">Join</a>
						<ul class="custom-menu">
							<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
							<li><a href="#"><i class="fa fa-heart-o"></i> My Wishlist</a></li>
							<li><a href="#"><i class="fa fa-exchange"></i> Compare</a></li>
							<li><a href="#"><i class="fa fa-check"></i> Checkout</a></li>
							<li><a href="{{ route('backend.login') }}"><i class="fa fa-unlock-alt"></i> Login</a></li>
							<li><a href="{{ route('backend.login') }}"><i class="fa fa-user-plus"></i> Create An Account</a></li>
						</ul>
					</li>
					<!-- /Account -->

					<!-- Cart -->
					<li class="header-cart dropdown default-dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							<div class="header-btns-icon">
								<i class="fa fa-shopping-cart"></i>
								<span class="qty">3</span>
							</div>
							<strong class="text-uppercase">My Cart:</strong>
							<br>
							<span>35.20$</span>
						</a>
						<div class="custom-menu">
							<div id="shopping-cart">
								<div class="shopping-cart-list">
									<div class="product product-widget">
										<div class="product-thumb">
											<img src="{{ asset('frontend/img/thumb-product01.jpg') }}" alt="">
										</div>
										<div class="product-body">
											<h3 class="product-price">$32.50 <span class="qty">x3</span></h3>
											<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
										</div>
										<button class="cancel-btn"><i class="fa fa-trash"></i></button>
									</div>
									<div class="product product-widget">
										<div class="product-thumb">
											<img src="{{ asset('frontend/img/thumb-product01.jpg') }}" alt="">
										</div>
										<div class="product-body">
											<h3 class="product-price">$32.50 <span class="qty">x3</span></h3>
											<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
										</div>
										<button class="cancel-btn"><i class="fa fa-trash"></i></button>
									</div>
								</div>
								<div class="shopping-cart-btns">
									<button class="main-btn">View Cart</button>
									<button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button>
								</div>
							</div>
						</div>
					</li>
					<!-- /Cart -->

					<!-- Mobile nav toggle-->
					<li class="nav-toggle">
						<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
					</li>
					<!-- / Mobile nav toggle -->
				</ul>
			</div>
		</div>
		<!-- header -->
	</div>
	<!-- container -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<div id="navigation">
	<!-- container -->
	<div class="container">
		<div id="responsive-nav">
			<!-- category nav -->
			<div class="category-nav">
				<span class="category-header">Categories <i class="fa fa-list"></i></span>
				<ul class="category-list">
					@php
					$kategori = DB::table('kategori')->orderBy('nama_kategori', 'asc')->get();
					@endphp
					@foreach ($kategori as $row_kat)
					<li><a href="{{ route('produk.kategori', $row_kat->id) }}">{{ $row_kat->nama_kategori }}</a></li>
					@endforeach
				</ul>
			</div>
			<!-- /category nav -->

			<!-- menu nav -->
			<div class="menu-nav">
				<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
				<ul class="menu-list">
					<li><a href="{{ route('beranda') }}">Home</a></li>
					<li><a href="#">Shop</a></li>
					<li><a href="#">Sales</a></li>
				</ul>
			</div>
			<!-- menu nav -->
		</div>
	</div>
	<!-- /container -->
</div>
<!-- /NAVIGATION -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<aside id="aside" class="col-md-3">
				<!-- category nav -->
				<div class="category-nav show-on-click open">
					<span class="category-header">Categories <i class="fa fa-list"></i></span>
					<ul class="category-list">
						@foreach ($kategori as $row_kat)
						<li><a href="{{ route('produk.kategori', $row_kat->id) }}">{{ $row_kat->nama_kategori }}</a></li>
						@endforeach
					</ul>
				</div>
				<!-- /category nav -->
			</aside>
			<!-- /ASIDE -->

			<!-- MAIN -->
			<div id="main" class="col-md-9">
				<!-- home wrap -->
				<div class="home-wrap">
					<!-- home slick -->
					<div id="home-slick">
						<!-- banner -->
						<div class="banner banner-1">
							<img src="{{ asset('frontend/banner/banner01.jpg') }}" alt="">
							<div class="banner-caption">
								<h2 class="banner-title primary-color">KHAS MAKANAN<br>INDONESIA</h2>
								<h2 class="banner-subtitle white-color">JAJANAN<br>TRADISIONAL</h2>
								<button class="primary-btn">PESAN SEKARANG</button>
							</div>
						</div>
						<!-- /banner -->

						<!-- banner -->
						<div class="banner banner-1">
							<img src="{{ asset('frontend/banner/banner01.jpg') }}" alt="">
							<div class="banner-caption">
								<h2 class="banner-title primary-color">KHAS MAKANAN<br>INDONESIA</h2>
								<h2 class="banner-subtitle white-color">JAJANAN<br>TRADISIONAL</h2>
								<button class="primary-btn">PESAN SEKARANG</button>
							</div>
						</div>
						<!-- /banner -->

						<!-- banner -->
						<div class="banner banner-1">
							<img src="{{ asset('frontend/banner/banner03.jpg') }}" alt="">
							<div class="banner-caption">
								<h2 class="banner-title primary-color">KHAS MAKANAN<br>INDONESIA</h2>
								<h2 class="banner-subtitle white-color">JAJANAN<br>TRADISIONAL</h2>
								<button class="primary-btn">PESAN SEKARANG</button>
							</div>
						</div>
						<!-- /banner -->
					</div>
					<!-- /home slick -->
				</div>
				<!-- /home wrap -->

				<!-- STORE -->
				<div id="store">
					<!-- row -->
					<div class="row">
						@foreach ($produk as $row)
						<!-- Product Single -->
						<div class="col-md-4 col-sm-6 col-xs-6">
							<div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<span>Kategori</span>
										<span class="sale">{{ $row->kategori->nama_kategori }}</span>
									</div>
									<a href="{{ route('produk.detail', $row->id) }}">
										<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detail Produk</button>
									</a>
									<img src="{{ asset('storage/img-produk/thumb_md_' . $row->foto) }}" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-price">Rp. {{ number_format($row->harga, 0, ',', '.') }} <span class="product-old-price">{{ $row->kategori->nama_kategori }}</span></h3>
									<h2 class="product-name"><a href="{{ route('produk.detail', $row->id) }}">{{ $row->nama_produk }}</a></h2>
									<div class="product-btns">
										<a href="{{ route('produk.detail', $row->id) }}" title="Detail Produk">
											<button class="main-btn icon-btn"><i class="fa fa-search-plus"></i></button>
										</a>
										<form action="#" method="post" style="display: inline-block;" title="Pesan Ke Aplikasi">
											@csrf
											<button type="submit" class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Pesan</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- /Product Single -->
						@endforeach
						<div class="clearfix visible-md visible-lg visible-sm visible-xs"></div>
					</div>
					<!-- /row -->
				</div>
				<!-- /STORE -->
			</div>
			<!-- /MAIN -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<!-- FOOTER -->
<footer id="footer" class="section section-grey">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- footer widget -->
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="footer">
					<!-- footer logo -->
					<div class="footer-logo">
						<a class="logo" href="#">
							<img src="{{ asset('frontend/img/logo.png') }}" alt="">
						</a>
					</div>
					<!-- /footer logo -->

					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>

					<!-- footer social -->
					<ul class="footer-social">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
					</ul>
					<!-- /footer social -->
				</div>
			</div>
			<!-- /footer widget -->

			<!-- footer widget -->
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="footer">
					<h3 class="footer-header">My Account</h3>
					<ul class="list-links">
						<li><a href="#">My Account</a></li>
						<li><a href="#">My Wishlist</a></li>
						<li><a href="#">Compare</a></li>
						<li><a href="#">Checkout</a></li>
						<li><a href="#">Login</a></li>
					</ul>
				</div>
			</div>
			<!-- /footer widget -->

			<div class="clearfix visible-sm visible-xs"></div>

			<!-- footer widget -->
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="footer">
					<h3 class="footer-header">Customer Service</h3>
					<ul class="list-links">
						<li><a href="#">About Us</a></li>
						<li><a href="#">Shiping & Return</a></li>
						<li><a href="#">Shiping Guide</a></li>
						<li><a href="#">FAQ</a></li>
					</ul>
				</div>
			</div>
			<!-- /footer widget -->

			<!-- footer subscribe -->
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="footer">
					<h3 class="footer-header">Stay Connected</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
					<form>
						<div class="form-group">
							<input class="input" placeholder="Enter Email Address">
						</div>
						<button class="primary-btn">Join Newslatter</button>
					</form>
				</div>
			</div>
			<!-- /footer subscribe -->
		</div>
		<!-- /row -->
		<hr>
		<!-- row -->
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<!-- footer copyright -->
				<div class="footer-copyright">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;<script>
						document.write(new Date().getFullYear());
					</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</div>
				<!-- /footer copyright -->
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</footer>
<!-- /FOOTER -->
@endsection