<!DOCTYPE html>
<html lang="fa">
<head>
	<title>کنترل پنل رستوران یاب | {{ $title }}</title>
	{{ HTML::script('/assets/dashboard/js/jquery-1.8.3.min.js') }}
{{--	{{ HTML::script('/assets/scripts/jquery-1.11.0.min.js') }}--}}
    {{ HTML::script('/assets/dashboard/js/plugin/jquery-ui.js') }}
    {{ HTML::script('/assets/dashboard/js/plugin/jquery.slimscroll.min.js') }}
    {{ HTML::script('/assets/dashboard/js/plugin/jquery.tipsy.js') }}
    {{ HTML::script('/assets/dashboard/js/plugin/jquery.cookie.js') }}
    {{ HTML::script('/assets/dashboard/js/plugin/jquery.uniform.js') }}
    {{ HTML::script('/assets/dashboard/js/main.js') }}
    <!-- CKEditor -->
    {{ HTML::script('/assets/dashboard/ckeditor/ckeditor.js') }}
    
    {{ HTML::style('/assets/dashboard/css/main.css') }}
	{{ HTML::style('/assets/dashboard/fonts/icomoon.css') }}
	{{ HTML::style('/assets/dashboard/css/tipsy.css') }}

    <link rel="icon" href="{{asset('/assets/dashboard/img/favicon.png')}}" />

</head>
<body>
<header>
    <div class="row">
    	<div id="top">
    		<a href="{{URL::route('admin')}}" class="panel">کنترل پنل مدیریت سایت</a>
    		<ul class="menu">
    	    	<li class="dashboard">
    	        	<a href="{{ URL::route('admin') }}">صفحه اصلی مدیریت</a>
    			</li>
    	        <li class="setting">
    	        	<a href="{{URL::route('admin.settings.index')}}">تنظیمات سایت</a>
    			</li>
    	        <li class="site">
    	        	<a href="{{URL::route('home')}}">نمایش سایت</a>
    			</li>
    	        <li class="logout">
    	        	<a href="{{ URL::route('signout') }}">خروج</a>
    	        </li>
            </ul>
    	</div>
    </div>
</header>

<div class="container">
    <section> 
        <div id="content">
        	<div class="pageTitle">
            	{{ $title }}
            </div>          
            <div class="pageNavigation">
                {{ Breadcrumbs::render() }} 
            </div>
            <div class="data">
                @include('admin.layouts.messages')
                @yield('content')
            </div>
        </div>
        <div id="sidebar">
            <div class="profile">
                <span class="right picture">
                    <img src="{{asset('/assets/dashboard/img/user.jpg')}}" alt="تصویر کاربر" />
                </span>
                <span class="right user">
                    <strong>{{Auth::user()->username}}</strong> ، خوش آمدید.
                    <br />
                    {{Auth::user()->email}}
                    <hr />
                    <span class="lastlogin">
                        <p>
            آخرین ورود: <strong> {{jDate::forge(Auth::user()->last_login)->format('%d %B %y');}}</strong>
                        </p>
                    </span>
                </span>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <a href="{{ URL::route('admin') }}">
                            <img src="{{asset('/assets/dashboard/img/icons/dashboard/dashboard.png')}}" alt="داشبورد" />
                            داشبورد
                        </a>
                    </li>
                    <li id="sidebar_menu_news">
                        <a href="#">
                            <img src="{{asset('/assets/dashboard/img/icons/news/news_main.png')}}" alt="اخبار" />
                            اخبار
                        </a>
                        <!-- Submenu -->
                        <ul>
                            <li>
                                <a href="{{URL::route('admin.news.index')}}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-list.png')}}" alt="لیست اخبار" />
                                    لیست اخبار
                                </a>
                            </li>
                            <li>
                                <a href="{{URL::route('admin.news.create')}}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-add.png')}}" alt="اضافه کردن خبر" />
                                    اضافه کردن خبر
                                </a>
                            </li>
                        </ul>
                        <!-- /Submenu -->
                    </li>
                    <li id="sidebar_menu_pages">
                        <a href="#">
                            <img src="{{asset('/assets/dashboard/img/icons/pages/pages_main.png')}}" alt="صفحه ساز" />
                            صفحه ساز
                        </a>
                        <!-- Submenu -->
                        <ul>
                            <li>
                                <a href="{{URL::route('admin.pages.index')}}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-list.png')}}" alt="لیست صفحات" />
                                    لیست صفحات
                                </a>
                            </li>
                            <li>
                                <a href="{{URL::route('admin.pages.create')}}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-add.png')}}" alt="اضافه کردن صفحه" />
                                    اضافه کردن صفحه
                                </a>
                            </li>
                        </ul>
                        <!-- /Submenu -->
                    </li>
                    <li id="sidebar_menu_places">
                        <a href="#">
                            <img src="{{asset('/assets/dashboard/img/icons/places/places_main.png')}}" alt="اماکن" />
                            اماکن
                        </a>
                        <!-- Submenu -->
                        <ul>
                            <li>
                                <a href="{{ URL::route('admin.places.index') }}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-list.png')}}" alt="لیست" />
                                    لیست اماکن
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.places.create') }}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-add.png')}}" alt="اضافه کردن" />
                                    اضافه کردن مکان
                                </a>
                            </li>
                        </ul>
                        <!-- /Submenu -->
                    </li>
                    <li id="sidebar_menu_users">
                        <a href="#">
                            <img src="{{asset('/assets/dashboard/img/icons/users/users_main.png')}}" alt="کاربران" />
                            کاربران
                        </a>
                         <!-- Submenu -->
                        <ul>
                            <li>
                                <a href="{{URL::route('admin.users.index')}}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-list.png')}}" alt="مدیریت کاربران" />
                                    مدیریت کاربران
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.users.place_registration') }}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-add.png')}}" alt="تقاضای ثبت مکان" />
                                    تقاضای ثبت رستوران
                                </a>
                            </li>
                        </ul>
                        <!-- /Submenu -->
                    </li>
                    <li id="sidebar_menu_definitions">
                        <a href="#">
                            <img src="{{asset('/assets/dashboard/img/icons/supplier/supplier_main.png')}}" alt="تعاریف" />
                            تعاریف
                        </a>
                        <!-- Submenu -->
                        <ul>
                            <li>
                                <a href="{{URL::route('admin.definitions.index')}}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-list.png')}}" alt="تعاریف اولیه" />
                                    تعاریف اولیه
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="{{URL::route('admin.categories.index')}}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-list.png')}}" alt="دسته ها" />
                                    دسته ها
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="{{URL::route('admin.fields.index')}}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-list.png')}}" alt="فیلدها" />
                                    فیلدها
                                </a>
                            </li>
                        </ul>
                        <!-- /Submenu -->
                    </li>
                    <li id="sidebar_menu_settings">
                        <a href="#">
                            <img src="{{asset('/assets/dashboard/img/icons/settings/settings_main.png')}}" alt="تنظیمات" />
                            تنظیمات
                        </a>
                         <!-- Submenu -->
                        <ul>
                            <li>
                                <a href="{{URL::route('admin.settings.index')}}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-list.png')}}" alt="تنظیمات عمومی" />
                                    تنظیمات عمومی
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="{{URL::route('admin.menu.index')}}">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-list.png')}}" alt="منوزساز" />
                                    منوساز
                                </a>
                            </li>
                        </ul>
                         <ul>
                            <li>
                                <a href="#">
                                    <img src="{{asset('/assets/dashboard/img/icons/icon-list.png')}}" alt="پروفایل" />
                                    پروفایل
                                </a>
                            </li>
                        </ul>
                        <!-- /Submenu -->
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <footer></footer>
</div>
</body>
</html>