<?php
/*
 * =============================
 *  Breadcrumb Routes
 * =============================
 */

Breadcrumbs::register('admin.index', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('admin.index'));
});

/*
 * =============================
 *  Breadcrumb Routes for Dashboard
 * =============================
 */
Breadcrumbs::register('admin.index.dashboard', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Dashboard', route('admin.index'));
});

/*
 * =============================
 *  Breadcrumb Routes for Admin
 * =============================
 */

Breadcrumbs::register('profile.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Profile', route('admin.profile'));
});

Breadcrumbs::register('profile.change-password', function ($breadcrumbs) {
    $breadcrumbs->parent('profile.index');
    $breadcrumbs->push('Change Password', route('admin.change-password'));
});

/*
 * =============================
 *  Breadcrumb Routes for Settings
 * =============================
 */

Breadcrumbs::register('settings.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Settings', route('settings.index'));
});

Breadcrumbs::register('settings.create', function ($breadcrumbs) {
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push('Create', route('settings.create'));
});

Breadcrumbs::register('settings.edit', function ($breadcrumbs, $title, $id) {
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push($title);
    $breadcrumbs->push('Edit', route('settings.edit', $id));
});

/*
 * =============================
 *  Breadcrumb Routes for Users
 * =============================
 */

Breadcrumbs::register('users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Users', route('users.index'));
});

Breadcrumbs::register('users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push('Create', route('users.create'));
});

Breadcrumbs::register('users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users.index');
    $breadcrumbs->push($user->name);
    $breadcrumbs->push('Edit', route('users.edit', $user->id));
});


/*
 * =============================
 *  Breadcrumb Routes for Finders
 * =============================
 */

Breadcrumbs::register('finder.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Finder', route('finder.index'));
});

Breadcrumbs::register('finder.create', function ($breadcrumbs) {
    $breadcrumbs->parent('finder.index');
    $breadcrumbs->push('Create', route('finder.create'));
});

Breadcrumbs::register('finder.edit', function ($breadcrumbs, $finder) {
    $breadcrumbs->parent('finder.index');
    $breadcrumbs->push($finder->name);
    $breadcrumbs->push('Edit', route('finder.edit', $finder->id));
});

/*
 * =============================
 *  Breadcrumb Routes for Fillers
 * =============================
 */

Breadcrumbs::register('filler.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Fillers', route('filler.index'));
});

Breadcrumbs::register('filler.create', function ($breadcrumbs) {
    $breadcrumbs->parent('filler.index');
    $breadcrumbs->push('Create', route('filler.create'));
});

Breadcrumbs::register('filler.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('filler.index');
    $breadcrumbs->push($user->name);
    $breadcrumbs->push('Edit', route('filler.edit', $user->id));
});
Breadcrumbs::register('filler.show', function ($breadcrumbs, $filler) {
    $breadcrumbs->parent('filler.index');
    $breadcrumbs->push($filler->name);
    $breadcrumbs->push('Show', route('filler.show', $filler->id));
});

/*
 * =============================
 *  Breadcrumb Routes for Front End Menu
 * =============================
 */

Breadcrumbs::register('front-end-menu.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Front End Menu', route('front-end-menu.index'));
});

Breadcrumbs::register('front-end-menu.create', function ($breadcrumbs) {
    $breadcrumbs->parent('front-end-menu.index');
    $breadcrumbs->push('Create', route('front-end-menu.create'));
});

Breadcrumbs::register('front-end-menu.edit', function ($breadcrumbs, $menuType) {
    $breadcrumbs->parent('front-end-menu.index');
    $breadcrumbs->push($menuType->title.' '.ucfirst($menuType->position));
    $breadcrumbs->push('Edit', route('front-end-menu.edit', $menuType->id));
});


/*
 * =============================
 *  Breadcrumb Routes for Faq
 * =============================
 */
Breadcrumbs::register('faq.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('FAQ', route('faq.index'));
});

Breadcrumbs::register('faq.create', function ($breadcrumbs) {
    $breadcrumbs->parent('faq.index');
    $breadcrumbs->push('Create', route('faq.index'));
});

Breadcrumbs::register('faq.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('faq.index');
    $breadcrumbs->push('Edit', route('faq.index'));
});


/*
 * =============================
 *  Breadcrumb Routes for Blogs
 * =============================
 */

Breadcrumbs::register('blog.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Blog', route('blog.index'));
});

Breadcrumbs::register('blog.create', function ($breadcrumbs) {
    $breadcrumbs->parent('blog.index');
    $breadcrumbs->push('Create', route('blog.create'));
});

Breadcrumbs::register('blog.edit', function ($breadcrumbs, $blog) {
    $breadcrumbs->parent('blog.index');
    $breadcrumbs->push($blog->title);
    $breadcrumbs->push('Edit', route('blog.edit', $blog->id));
});

Breadcrumbs::register('blog.show', function ($breadcrumbs, $blog) {
    $breadcrumbs->parent('blog.index');
    $breadcrumbs->push($blog->title);
    $breadcrumbs->push('Edit', route('blog.show', $blog->id));
});
/*
 * =======================================
 *  Breadcrumb Routes for Email Templates
 * =======================================
 */

Breadcrumbs::register('email-template.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Email Templates', route('email-template.index'));
});

Breadcrumbs::register('email-template.create', function ($breadcrumbs) {
    $breadcrumbs->parent('email-template.index');
    $breadcrumbs->push('Create', route('email-template.create'));
});

Breadcrumbs::register('email-template.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('email-template.index');
    $breadcrumbs->push('Edit', route('email-template.index'));
});

Breadcrumbs::register('email-template.show', function ($breadcrumbs) {
    $breadcrumbs->parent('email-template.index');
    $breadcrumbs->push('Show', route('email-template.index'));
});


/*
 * =============================
 *  Breadcrumb Routes for Filters
 * =============================
 */

Breadcrumbs::register('filter.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Filters', route('filter.index'));
});

/*
 * =============================
 *  Breadcrumb Routes for Testimonials
 * =============================
 */

Breadcrumbs::register('testimonials.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Testimonials', route('testimonials.index'));
});

Breadcrumbs::register('testimonials.create', function ($breadcrumbs) {
    $breadcrumbs->parent('testimonials.index');
    $breadcrumbs->push('Create', route('testimonials.create'));
});

Breadcrumbs::register('testimonials.edit', function ($breadcrumbs, $testimonials) {
    $breadcrumbs->parent('testimonials.index');
    $breadcrumbs->push($testimonials->name);
    $breadcrumbs->push('Edit', route('testimonials.edit', $testimonials->id));
});

Breadcrumbs::register('testimonials.show', function ($breadcrumbs, $testimonials) {
    $breadcrumbs->parent('testimonials.index');
    $breadcrumbs->push($testimonials->name);
    $breadcrumbs->push('Show', route('testimonials.show', $testimonials->id));
});

/*
 * =============================
 *  Breadcrumb Routes for CMS
 * =============================
 */

Breadcrumbs::register('cms.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Pages', route('cms.index'));
});

Breadcrumbs::register('cms.sections', function ($breadcrumbs, $page) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push("Pages", route('cms.index'));
    $breadcrumbs->push('Pages Sections', route('cms.sections', $page->id));
});

Breadcrumbs::register('cms.create', function ($breadcrumbs) {
    $breadcrumbs->parent('cms.index');
    $breadcrumbs->push('Create', route('cms.create'));
});

Breadcrumbs::register('cms.edit', function ($breadcrumbs, $page) {
    $breadcrumbs->parent('cms.index');
    $breadcrumbs->push($page->name);
    $breadcrumbs->push('Edit', route('cms.edit', $page->id));
});

/*
 * =============================
 *  Breadcrumb Routes for Quotation
 * =============================
 */
Breadcrumbs::register('quotation.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Quotation', route('quotation.index'));
});

Breadcrumbs::register('quotation.show', function ($breadcrumbs) {
    $breadcrumbs->parent('quotation.index');
    $breadcrumbs->push('Show');
});


Breadcrumbs::register('quotation.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('quotation.index');
    $breadcrumbs->push('Edit');
});

/*
 * =============================
 *  Breadcrumb Routes for Schedule
 * =============================
 */

Breadcrumbs::register('schedule-movement.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.index');
    $breadcrumbs->push('Schedule Movement', route('schedule-movement.index'));
});
