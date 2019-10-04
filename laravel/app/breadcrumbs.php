<?php
// Admin
Breadcrumbs::register('admin', function($breadcrumbs) {
    $breadcrumbs->push('مدیریت', route('admin'));
});

// News
Breadcrumbs::register('admin.news.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('اخبار', route('admin.news.index'));
});
Breadcrumbs::register('admin.news.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.news.index');
    $breadcrumbs->push('ویرایش', route('admin.news.edit'));
});
Breadcrumbs::register('admin.news.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.news.index');
    $breadcrumbs->push('ایجاد خبر', route('admin.news.create'));
});

// Pages
Breadcrumbs::register('admin.pages.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('صفحات', route('admin.pages.index'));
});
Breadcrumbs::register('admin.pages.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push('ایجاد', route('admin.pages.create'));
});
Breadcrumbs::register('admin.pages.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push('ویرایش', route('admin.pages.edit'));
});
// Pages Content
Breadcrumbs::register('admin.pages.{pageId}.content.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push('محتوا', route('admin.pages.{pageId}.content.index'));
});
Breadcrumbs::register('admin.pages.{pageId}.content.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push('ویرایش', route('admin.pages.{pageId}.content.edit'));
});
Breadcrumbs::register('admin.pages.{pageId}.content.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push('ایجاد', route('admin.pages.{pageId}.content.create'));
});

// Places
Breadcrumbs::register('admin.places.index', function($breadcrumbs) {
	$breadcrumbs->parent('admin');
    $breadcrumbs->push('اماکن', route('admin.places.index'));
});
Breadcrumbs::register('admin.places.create', function($breadcrumbs) {
	$breadcrumbs->parent('admin.places.index');
    $breadcrumbs->push('اضافه کردن', route('admin.places.create'));
});
Breadcrumbs::register('admin.places.edit', function($breadcrumbs) {
	$breadcrumbs->parent('admin.places.index');
    $breadcrumbs->push('ویرایش', route('admin.places.edit'));
});
Breadcrumbs::register('admin.places.details', function($breadcrumbs) {
	$breadcrumbs->parent('admin.places.index');
    $breadcrumbs->push('جزئیات', route('admin.places.details'));
});
Breadcrumbs::register('admin.places.pictures', function($breadcrumbs) {
	$breadcrumbs->parent('admin.places.index');
    $breadcrumbs->push('تصاویر', route('admin.places.pictures'));
});
Breadcrumbs::register('admin.places.fields', function($breadcrumbs) {
	$breadcrumbs->parent('admin.places.index');
    $breadcrumbs->push('فیلدها', route('admin.places.fields'));
});
Breadcrumbs::register('admin.places.menu', function($breadcrumbs) {
	$breadcrumbs->parent('admin.places.index');
    $breadcrumbs->push('منو', route('admin.places.menu'));
});
Breadcrumbs::register('admin.places.menu.edit', function($breadcrumbs) {
	$breadcrumbs->parent('admin.places.index');
    $breadcrumbs->push('منو', route('admin.places.menu.edit'));
});

// Users
Breadcrumbs::register('admin.users.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('کاربرها', route('admin.users.index'));
});
// User Place Registration
Breadcrumbs::register('admin.users.place_registration', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('تقاضای ثبت رستوران', route('admin.users.place_registration'));
});

// Definitions
Breadcrumbs::register('admin.definitions.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('تعاریف اولیه', route('admin.definitions.index'));
});
Breadcrumbs::register('admin.definitions.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.definitions.index');
    $breadcrumbs->push('ویرایش', route('admin.definitions.edit'));
});
// Definitions Values
Breadcrumbs::register('admin.definitions.values.show', function($breadcrumbs) {
	$breadcrumbs->parent('admin.definitions.index');
    $breadcrumbs->push('مقادیر', route('admin.definitions.values.show'));
});
// Categories
Breadcrumbs::register('admin.categories.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('دسته‌ها', route('admin.categories.index'));
});
Breadcrumbs::register('admin.categories.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.categories.index');
    $breadcrumbs->push('ویرایش', route('admin.categories.edit'));
});
// Fields
Breadcrumbs::register('admin.fields.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('فیلدها', route('admin.fields.index'));
});
Breadcrumbs::register('admin.fields.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.fields.index');
    $breadcrumbs->push('ویرایش', route('admin.fields.edit'));
});

// Settings
Breadcrumbs::register('admin.settings.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('تنظیمات', route('admin.settings.index'));
});
// Menu
Breadcrumbs::register('admin.menu.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('منو', route('admin.menu.index'));
});
Breadcrumbs::register('admin.menu.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.menu.index');
    $breadcrumbs->push('ویرایش', route('admin.menu.edit'));
});
