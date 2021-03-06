<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="icon" href="{{ asset('/panel/assets/images/favicon.png') }}">
<title>日本、暮らしの道具店</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/bootstrap4/bootstrap.min.css') }}"> --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="{{ asset('/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/plugins/slick-1.8.0/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/stripe.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://js.stripe.com/v3/"></script>
</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('/frontend/images/phone.png') }}" alt=""></div>{{ $site->phone_one }}</div>
					<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{ asset('/frontend/images/mail.png') }}" alt=""></div><a href="mailto:{{ $site->email }}">{{ $site->email }}</a></div>
						<div class="top_bar_content ml-auto">

							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										@if ($language === 'japanese')
											<a href="{{ route('language.english') }}">English<i class="fas fa-chevron-down"></i></a>
										@else
											<a href="{{ route('language.japanese') }}">日本語<i class="fas fa-chevron-down"></i></a>
										@endif

									</li>
								</ul>
							</div>

							<div class="top_bar_user">
								@guest
									<div><a href="{{ route('login') }}"><div class="user_icon"><img src="{{ asset('/frontend/images/user.svg') }}" alt=""></div> 新規登録/ログイン</a></div>
								@else
									<ul class="standard_dropdown top_bar_dropdown">
										<li>
										<a href="{{ route('home') }}"><div class="user_icon"><img src="{{ asset('/frontend/images/user.svg') }}" alt=""></div>プロフィール<i class="fas fa-chevron-down"></i></a>
											<ul>
												<li><a href="{{ route('user.wishlist') }}">ほしい物リスト</a></li>
												@if (Cart::content()->isNotEmpty())
													<li><a href="{{ route('checkout.product') }}">購入する</a></li>
												@endif
												<li><a href="{{ route('order_history.lists') }}">注文履歴</a></li>
												<li><a href="{{ route('user.logout') }}">ログアウト</a></li>
											</ul>
										</li>
									</ul>
								@endguest
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
						<div class="logo"><a href="{{ url('/') }}"><img src="{{ asset('/frontend/images/home-logo.png') }}" alt=""></a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
								<form action="{{ route('search.item') }}" class="header_search_form clearfix" method="POST">
										@csrf
										<input type="search" class="header_search_input" placeholder="商品・記事を検索" name="keyword" value="{{ $keyword ?? '' }}">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list" style="display: none;">
												<span class="custom_dropdown_placeholder clc"></span>
												<ul class="custom_list clc"></ul>
											</div>
											<label for="search_product" style="margin-right: 5px;">
												<input type="radio" name="mode" id="search_product" value="product_name" style="margin-right: 5px;" checked>商品名
											</label>
											<label for="search_article" style="margin-right: 5px;">
												<input type="radio" name="mode" id="search_article" value="article" style="margin-right: 5px;" {{ $search_article ?? '' }}>記事
											</label>
										</div>
										<button type="submit" class="header_search_button trans_300" value=""><img src="{{ asset('/frontend/images/search.png') }}" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<!-- Wishlist -->
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="{{ asset('/frontend/images/heart.png') }}" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="{{ route('user.wishlist') }}">ほしい物リスト</a></div>
									<div class="wishlist_count">{{ $wish_lists->count() }}</div>
								</div>
							</div>
							<!-- Cart -->
							<div class="cart">
								<div class="d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<img src="{{ asset('/frontend/images/cart.png') }}" alt="">
									<div class="cart_count"><span>{{  Cart::count() }}</span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="{{ route('show.cart') }}">カート</a></div>
										<div class="cart_price">{{ number_format(Cart::subtotal()) }}円</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->


	<!-- Characteristics -->

	@yield('content')
	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="#">{{ $site->company_name }}</a></div>
						</div>
						<div class="footer_title">日本の暮らしを伝えたい</div>
						<div class="footer_phone">{{ $site->phone_two }}</div>
						<div class="footer_contact_text">
							<p>{{ $site->company_address }}</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="{{ $site->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="{{ $site->twitter }}"><i class="fab fa-twitter"></i></a></li>
								<li><a href="{{ $site->youtube }}"><i class="fab fa-youtube"></i></a></li>
								<li><a href="{{ $site->instagram }}"><i class="fab fa-google"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-2 offset-lg-4">
					<div class="footer_column">
						<div class="footer_title">クラシテルについて</div>
						<ul class="footer_list">
							<li><a href="#">ご利用ガイド</a></li>
							<li><a href="#">お問い合わせ</a></li>
							<li><a href="#">採用情報</a></li>
							<li><a href="#">定期購読について</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">プライバシーと利用規約</div>
						<ul class="footer_list">
							<li><a href="#">広告掲載について</a></li>
							<li><a href="#">運営会社</a></li>
							<li><a href="#">特定商取引法に基づく表記</a></li>
							<li><a href="#">ご利用規約</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">

					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content">
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> Kurashiteru All rights reserved.
						</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="{{ asset('/frontend/images/logos_1.png') }}" alt=""></a></li>
								<li><a href="#"><img src="{{ asset('/frontend/images/logos_2.png') }}" alt=""></a></li>
								<li><a href="#"><img src="{{ asset('/frontend/images/logos_3.png') }}" alt=""></a></li>
								<li><a href="#"><img src="{{ asset('/frontend/images/logos_4.png') }}" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('/frontend/js/jquery-3.3.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
{{-- <script src="{{ asset('/frontend/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('/frontend/styles/bootstrap4/bootstrap.min.js') }}"></script> --}}
<script src="{{ asset('/frontend/plugins/greensock/TweenMax.min.js') }}"></script>
<script src="{{ asset('/frontend/plugins/greensock/TimelineMax.min.js') }}"></script>
<script src="{{ asset('/frontend/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
<script src="{{ asset('/frontend/plugins/greensock/animation.gsap.min.js') }}"></script>
<script src="{{ asset('/frontend/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('/frontend/plugins/slick-1.8.0/slick.js') }}"></script>
<script src="{{ asset('/frontend/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('/frontend/js/custom.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{-- <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

{{-- <script src="{{ asset('/frontend/js/product_custom.js') }}"></script> --}}

<script>
	@if (Session::has('message'))
		var type = "{{ Session::get('alert-type', 'info') }}"
			switch(type) {
				case 'info':
				toastr.info(" {{ Session::get('message') }} ");
				break;

				case 'success':
				toastr.success(" {{ Session::get('message') }} ");
				break;

				case 'warning':
				toastr.warning(" {{ Session::get('message') }} ");
				break;

				case 'error':
				toastr.error(" {{ Session::get('message') }} ");
				break;
			}
	@endif
</script>

<script>
	// $(document).on("click", "#return", function(e){
	// 		e.preventDefault();
	// 		var link = $(this).attr("href");
	// 		swal({
	// 			title: "本当に返品しますか？",
	// 			icon: "warning",
	// 			buttons: ["いいえ", 'はい'],
	// 			dangerMode: true,
	// 		})
	// 		.then((willDelete) => {
	// 			if (willDelete) {
	// 				window.location.href = link;
	// 			} else {
	// 				swal("キャンセルしました。");
	// 			}
	// 		});
	// 	});

	$("#return").on("click", function(e){
		e.preventDefault();
		var link = $(this).attr("href");
		Swal.fire({
			title: '本当に返品しますか？',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'はい',
			cancelButtonText: 'いいえ'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = link;
			} else {
				Swal.fire(
					'キャンセルしました。'
				)
			}
		});
	});
	$("#delete_comment").on("click", function(e){
		e.preventDefault();
		var link = $(this).attr("href");
		Swal.fire({
			title: '本当に削除しますか？',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'はい',
			cancelButtonText: 'いいえ'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = link;
			} else {
				Swal.fire(
					'キャンセルしました。'
				)
			}
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.addWishList').on('click', function() {
			var id = $(this).data('id');
			if (id) {
				$.ajax({
					url: " {{ url('add/wishlist') }}/" + id,
					type: "GET",
					dataType: "JSON",
					success: function(data) {
						const Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true,
							onOpen: (toast) => {
								toast.addEventListener('mouseenter', Swal.stopTimer)
								toast.addEventListener('mouseleave', Swal.resumeTimer)
							}
						});

						Toast.fire({
							icon: data.type,
							title: data.message
						});
					},
				});
			} else {
				$(".product_fav").removeClass("active");
				alert('追加できませんでした');
			}
		});
	});
</script>

</body>
</html>
