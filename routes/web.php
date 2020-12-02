<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Author   : Nyoman Adi Yudana
| github   : https://github.com/devadiyudana
| website  : https://adiyudana.com
| phone    : +62 813 7784 3910
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', function() {})->name('login');

/*=======================================================
******************** Front Routes **********************
=======================================================*/

Route::group(['middleware' => 'setlang'], function() {
  Route::get('/', 'Front\FrontendController@index')->name('front.index');
  Route::get('/services', 'Front\FrontendController@services')->name('front.services');
  Route::get('/service/{slug}', 'Front\FrontendController@servicedetails')->name('front.servicedetails');
  Route::get('/portfolios', 'Front\FrontendController@portfolios')->name('front.portfolios');
  Route::get('/portfolio/{slug}', 'Front\FrontendController@portfoliodetails')->name('front.portfoliodetails');
  Route::get('/blogs', 'Front\FrontendController@blogs')->name('front.blogs');
  Route::get('/blog-details/{slug}', 'Front\FrontendController@blogdetails')->name('front.blogdetails');
  Route::get('/contact', 'Front\FrontendController@contact')->name('front.contact');
  Route::post('/sendmail', 'Front\FrontendController@sendmail')->name('front.sendmail');
  Route::post('/subscribe', 'Front\FrontendController@subscribe')->name('front.subscribe');
  Route::get('/quote', 'Front\FrontendController@quote')->name('front.quote');
  Route::post('/sendquote', 'Front\FrontendController@sendquote')->name('front.sendquote');
  Route::get('/team', 'Front\FrontendController@team')->name('front.team');
  Route::get('/gallery', 'Front\FrontendController@gallery')->name('front.gallery');
  Route::get('/faq', 'Front\FrontendController@faq')->name('front.faq');
  // Dynamic Page Routes
  Route::get('/{slug}/page', 'Front\FrontendController@dynamicPage')->name('front.dynamicPage');
  Route::get('/changelanguage/{lang}', 'Front\FrontendController@changeLanguage')->name('changeLanguage');
});





/*=======================================================
******************** Admin Routes **********************
=======================================================*/

Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
  Route::get('/', 'Admin\LoginController@login')->name('admin.login');
  Route::post('/login', 'Admin\LoginController@authenticate')->name('admin.auth');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin', 'checkstatus']], function () {

  // Admin logout Route
  Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');

  Route::group(['middleware' => 'checkpermission:Dashboard'], function() {
    // Admin Dashboard Routes
    Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('admin.dashboard');
  });


  // Admin Profile Routes
  Route::get('/changePassword', 'Admin\ProfileController@changePass')->name('admin.changePass');
  Route::post('/profile/updatePassword', 'Admin\ProfileController@updatePassword')->name('admin.updatePassword');
  Route::get('/profile/edit', 'Admin\ProfileController@editProfile')->name('admin.editProfile');
  Route::post('/propic/update', 'Admin\ProfileController@updatePropic')->name('admin.propic.update');
	Route::post('/profile/update', 'Admin\ProfileController@updateProfile')->name('admin.updateProfile');


  Route::group(['middleware' => 'checkpermission:Basic Settings'], function() {
    // Admin Favicon Routes
    Route::get('/favicon', 'Admin\BasicController@favicon')->name('admin.favicon');
    Route::post('/favicon/post', 'Admin\BasicController@updatefav')->name('admin.favicon.update');


    // Admin Logo Routes
    Route::get('/logo', 'Admin\BasicController@logo')->name('admin.logo');
    Route::post('/logo/post', 'Admin\BasicController@updatelogo')->name('admin.logo.update');


    // Admin Home Version Setting Routes
    Route::get('/homeversion', 'Admin\BasicController@homeversion')->name('admin.homeversion');
    Route::post('/homeversion/post', 'Admin\BasicController@updatehomeversion')->name('admin.homeversion.update');


    // Admin Basic Information Routes
    Route::get('/basicinfo', 'Admin\BasicController@basicinfo')->name('admin.basicinfo');
    Route::post('/basicinfo/post', 'Admin\BasicController@updatebasicinfo')->name('admin.basicinfo.update');


    // Admin Support Routes
    Route::get('/support', 'Admin\BasicController@support')->name('admin.support');
    Route::post('/support/post', 'Admin\BasicController@updatesupport')->name('admin.support.update');

    // Admin Breadcrumb Routes
    Route::get('/breadcrumb', 'Admin\BasicController@breadcrumb')->name('admin.breadcrumb');
    Route::post('/breadcrumb/update', 'Admin\BasicController@updatebreadcrumb')->name('admin.breadcrumb.update');


    // Admin Page Heading Routes
    Route::get('/heading', 'Admin\BasicController@heading')->name('admin.heading');
    Route::post('/heading/update', 'Admin\BasicController@updateheading')->name('admin.heading.update');


    // Admin Scripts Routes
    Route::get('/script', 'Admin\BasicController@script')->name('admin.script');
    Route::post('/script/update', 'Admin\BasicController@updatescript')->name('admin.script.update');

    // Admin Social Routes
    Route::get('/social', 'Admin\SocialController@index')->name('admin.social.index');
    Route::post('/social/store', 'Admin\SocialController@store')->name('admin.social.store');
    Route::get('/social/{id}/edit', 'Admin\SocialController@edit')->name('admin.social.edit');
    Route::post('/social/update', 'Admin\SocialController@update')->name('admin.social.update');
    Route::post('/social/delete', 'Admin\SocialController@delete')->name('admin.social.delete');

    // Admin SEO Information Routes
    Route::get('/seo', 'Admin\BasicController@seo')->name('admin.seo');
    Route::post('/seo/update', 'Admin\BasicController@updateseo')->name('admin.seo.update');
  });




  Route::group(['middleware' => 'checkpermission:Subscribers'], function() {
    // Admin Subscriber Routes
    Route::get('/subscribers', 'Admin\SubscriberController@index')->name('admin.subscriber.index');
    Route::get('/mailsubscriber', 'Admin\SubscriberController@mailsubscriber')->name('admin.mailsubscriber');
    Route::post('/subscribers/sendmail', 'Admin\SubscriberController@subscsendmail')->name('admin.subscribers.sendmail');
  });


  Route::group(['middleware' => 'checkpermission:Home Page'], function() {
    // Admin Hero Section (Static Version) Routes
    Route::get('/herosection/static', 'Admin\HerosectionController@static')->name('admin.herosection.static');
    Route::post('/herosection/upload', 'Admin\HerosectionController@upload')->name('admin.herosection.upload');
    Route::post('/herosection/update', 'Admin\HerosectionController@update')->name('admin.herosection.update');


    // Admin Hero Section (Slider Version) Routes
    Route::get('/herosection/sliders', 'Admin\SliderController@index')->name('admin.slider.index');
    Route::post('/herosection/slider/store', 'Admin\SliderController@store')->name('admin.slider.store');
    Route::post('/herosection/slider/upload', 'Admin\SliderController@upload')->name('admin.slider.upload');
    Route::get('/herosection/slider/{id}/edit', 'Admin\SliderController@edit')->name('admin.slider.edit');
    Route::post('/herosection/slider/update', 'Admin\SliderController@update')->name('admin.slider.update');
    Route::post('/herosection/slider/{id}/uploadUpdate', 'Admin\SliderController@uploadUpdate')->name('admin.slider.uploadUpdate');
    Route::post('/herosection/slider/delete', 'Admin\SliderController@delete')->name('admin.slider.delete');


    // Admin Hero Section (Video Version) Routes
    Route::get('/herosection/video', 'Admin\HerosectionController@video')->name('admin.herosection.video');
    Route::post('/herosection/video/update', 'Admin\HerosectionController@videoupdate')->name('admin.herosection.video.update');


    // Admin Hero Section (Parallax Version) Routes
    Route::get('/herosection/parallax', 'Admin\HerosectionController@parallax')->name('admin.herosection.parallax');
    Route::post('/herosection/parallax/update', 'Admin\HerosectionController@parallaxupdate')->name('admin.herosection.parallax.update');



    // Admin Partner Routes
    Route::get('/partners', 'Admin\PartnerController@index')->name('admin.partner.index');
    Route::post('/partner/store', 'Admin\PartnerController@store')->name('admin.partner.store');
    Route::post('/partner/upload', 'Admin\PartnerController@upload')->name('admin.partner.upload');
    Route::get('/partner/{id}/edit', 'Admin\PartnerController@edit')->name('admin.partner.edit');
    Route::post('/partner/update', 'Admin\PartnerController@update')->name('admin.partner.update');
    Route::post('/partner/{id}/uploadUpdate', 'Admin\PartnerController@uploadUpdate')->name('admin.partner.uploadUpdate');
    Route::post('/partner/delete', 'Admin\PartnerController@delete')->name('admin.partner.delete');



    // Admin Feature Routes
    Route::get('/features', 'Admin\FeatureController@index')->name('admin.feature.index');
    Route::post('/feature/store', 'Admin\FeatureController@store')->name('admin.feature.store');
    Route::get('/feature/{id}/edit', 'Admin\FeatureController@edit')->name('admin.feature.edit');
    Route::post('/feature/update', 'Admin\FeatureController@update')->name('admin.feature.update');
    Route::post('/feature/delete', 'Admin\FeatureController@delete')->name('admin.feature.delete');

    // Admin Intro Section Routes
    Route::get('/introsection', 'Admin\IntrosectionController@index')->name('admin.introsection.index');
    Route::post('/introsection/upload', 'Admin\IntrosectionController@upload')->name('admin.introsection.upload');
    Route::post('/introsection/update', 'Admin\IntrosectionController@update')->name('admin.introsection.update');

    // Admin Service Section Routes
    Route::get('/servicesection', 'Admin\ServicesectionController@index')->name('admin.servicesection.index');
    Route::post('/servicesection/update', 'Admin\ServicesectionController@update')->name('admin.servicesection.update');

    // Admin Approach Section Routes
    Route::get('/approach', 'Admin\ApproachController@index')->name('admin.approach.index');
    Route::post('/approach/store', 'Admin\ApproachController@store')->name('admin.approach.point.store');
    Route::get('/approach/{id}/pointedit', 'Admin\ApproachController@pointedit')->name('admin.approach.point.edit');
    Route::post('/approach/update', 'Admin\ApproachController@update')->name('admin.approach.update');
    Route::post('/approach/pointupdate', 'Admin\ApproachController@pointupdate')->name('admin.approach.point.update');
    Route::post('/approach/pointdelete', 'Admin\ApproachController@pointdelete')->name('admin.approach.pointdelete');


    // Admin Statistic Section Routes
    Route::get('/statistics', 'Admin\StatisticsController@index')->name('admin.statistics.index');
    Route::post('/statistics/store', 'Admin\StatisticsController@store')->name('admin.statistics.store');
    Route::get('/statistics/{id}/edit', 'Admin\StatisticsController@edit')->name('admin.statistics.edit');
    Route::post('/statistics/update', 'Admin\StatisticsController@update')->name('admin.statistics.update');
    Route::post('/statistics/delete', 'Admin\StatisticsController@delete')->name('admin.statistics.delete');


    // Admin Call to Action Section Routes
    Route::get('/cta', 'Admin\CtaController@index')->name('admin.cta.index');
    Route::post('/cta/upload', 'Admin\CtaController@upload')->name('admin.cta.upload');
    Route::post('/cta/update', 'Admin\CtaController@update')->name('admin.cta.update');

    // Admin Portfolio Section Routes
    Route::get('/portfoliosection', 'Admin\PortfoliosectionController@index')->name('admin.portfoliosection.index');
    Route::post('/portfoliosection/update', 'Admin\PortfoliosectionController@update')->name('admin.portfoliosection.update');

    // Admin Testimonial Routes
    Route::get('/testimonials', 'Admin\TestimonialController@index')->name('admin.testimonial.index');
    Route::get('/testimonial/create', 'Admin\TestimonialController@create')->name('admin.testimonial.create');
    Route::post('/testimonial/upload', 'Admin\TestimonialController@upload')->name('admin.testimonial.upload');
    Route::post('/testimonial/store', 'Admin\TestimonialController@store')->name('admin.testimonial.store');
    Route::get('/testimonial/{id}/edit', 'Admin\TestimonialController@edit')->name('admin.testimonial.edit');
    Route::post('/testimonial/update', 'Admin\TestimonialController@update')->name('admin.testimonial.update');
    Route::post('/testimonial/{id}/uploadUpdate', 'Admin\TestimonialController@uploadUpdate')->name('admin.testimonial.uploadUpdate');
    Route::post('/testimonial/delete', 'Admin\TestimonialController@delete')->name('admin.testimonial.delete');
    Route::post('/testimonialtext/update', 'Admin\TestimonialController@textupdate')->name('admin.testimonialtext.update');

    // Admin Blog Section Routes
    Route::get('/blogsection', 'Admin\BlogsectionController@index')->name('admin.blogsection.index');
    Route::post('/blogsection/upload', 'Admin\BlogsectionController@upload')->name('admin.blogsection.upload');
    Route::post('/blogsection/update', 'Admin\BlogsectionController@update')->name('admin.blogsection.update');

    // Admin Partner Routes
    Route::get('/partners', 'Admin\PartnerController@index')->name('admin.partner.index');
    Route::post('/partner/store', 'Admin\PartnerController@store')->name('admin.partner.store');
    Route::post('/partner/upload', 'Admin\PartnerController@upload')->name('admin.partner.upload');
    Route::get('/partner/{id}/edit', 'Admin\PartnerController@edit')->name('admin.partner.edit');
    Route::post('/partner/update', 'Admin\PartnerController@update')->name('admin.partner.update');
    Route::post('/partner/{id}/uploadUpdate', 'Admin\PartnerController@uploadUpdate')->name('admin.partner.uploadUpdate');
    Route::post('/partner/delete', 'Admin\PartnerController@delete')->name('admin.partner.delete');

    // Admin Member Routes
    Route::get('/members', 'Admin\MemberController@index')->name('admin.member.index');
    Route::post('/team/upload', 'Admin\MemberController@teamUpload')->name('admin.team.upload');
    Route::post('/member/upload', 'Admin\MemberController@upload')->name('admin.member.upload');
    Route::get('/member/create', 'Admin\MemberController@create')->name('admin.member.create');
    Route::post('/member/store', 'Admin\MemberController@store')->name('admin.member.store');
    Route::get('/member/{id}/edit', 'Admin\MemberController@edit')->name('admin.member.edit');
    Route::post('/member/update', 'Admin\MemberController@update')->name('admin.member.update');
    Route::post('/member/{id}/uploadUpdate', 'Admin\MemberController@uploadUpdate')->name('admin.member.uploadUpdate');
    Route::post('/member/delete', 'Admin\MemberController@delete')->name('admin.member.delete');
    Route::post('/teamtext/update', 'Admin\MemberController@textupdate')->name('admin.teamtext.update');
  });



  // Admin FAQ Routes
  Route::get('/faqs', 'Admin\FaqController@index')->name('admin.faq.index');
  Route::get('/faq/create', 'Admin\FaqController@create')->name('admin.faq.create');
  Route::post('/faq/store', 'Admin\FaqController@store')->name('admin.faq.store');
  Route::get('/faq/{id}/edit', 'Admin\FaqController@edit')->name('admin.faq.edit');
  Route::post('/faq/update', 'Admin\FaqController@update')->name('admin.faq.update');
  Route::post('/faq/delete', 'Admin\FaqController@delete')->name('admin.faq.delete');



  Route::group(['middleware' => 'checkpermission:Pages'], function() {
    // Menu Manager Routes
    Route::get('/pages', 'Admin\PageController@index')->name('admin.page.index');
    Route::get('/page/create', 'Admin\PageController@create')->name('admin.page.create');
    Route::post('/page/store', 'Admin\PageController@store')->name('admin.page.store');
    Route::get('/page/{menuID}/edit', 'Admin\PageController@edit')->name('admin.page.edit');
    Route::post('/page/update', 'Admin\PageController@update')->name('admin.page.update');
    Route::post('/page/delete', 'Admin\PageController@delete')->name('admin.page.delete');
    Route::get('/parentlink', 'Admin\PageController@parentlink')->name('admin.parentlink.index');
    Route::post('/parentlink/update', 'Admin\PageController@updateParentLink')->name('admin.parentlink.update');
  });



  Route::group(['middleware' => 'checkpermission:Footer'], function() {
    // Admin Footer Logo Text Routes
    Route::get('/footers', 'Admin\FooterController@index')->name('admin.footer.index');
    Route::post('/footer/upload', 'Admin\FooterController@upload')->name('admin.footer.upload');
    Route::post('/footer/update', 'Admin\FooterController@update')->name('admin.footer.update');



    // Admin Ulink Routes
    Route::get('/ulinks', 'Admin\UlinkController@index')->name('admin.ulink.index');
    Route::get('/ulink/create', 'Admin\UlinkController@create')->name('admin.ulink.create');
    Route::post('/ulink/store', 'Admin\UlinkController@store')->name('admin.ulink.store');
    Route::get('/ulink/{id}/edit', 'Admin\UlinkController@edit')->name('admin.ulink.edit');
    Route::post('/ulink/update', 'Admin\UlinkController@update')->name('admin.ulink.update');
    Route::post('/ulink/delete', 'Admin\UlinkController@delete')->name('admin.ulink.delete');
  });




  Route::group(['middleware' => 'checkpermission:Service Page'], function() {
    // Admin Service Category Routes
    Route::get('/scategorys', 'Admin\ScategoryController@index')->name('admin.scategory.index');
    Route::post('/scategory/upload', 'Admin\ScategoryController@upload')->name('admin.scategory.upload');
    Route::post('/scategory/store', 'Admin\ScategoryController@store')->name('admin.scategory.store');
    Route::get('/scategory/{id}/edit', 'Admin\ScategoryController@edit')->name('admin.scategory.edit');
    Route::post('/scategory/update', 'Admin\ScategoryController@update')->name('admin.scategory.update');
    Route::post('/scategory/{id}/uploadUpdate', 'Admin\ScategoryController@uploadUpdate')->name('admin.scategory.uploadUpdate');
    Route::post('/scategory/delete', 'Admin\ScategoryController@delete')->name('admin.scategory.delete');

    // Admin Services Routes
    Route::get('/services', 'Admin\ServiceController@index')->name('admin.service.index');
    Route::post('/service/upload', 'Admin\ServiceController@upload')->name('admin.service.upload');
    Route::post('/service/{id}/uploadUpdate', 'Admin\ServiceController@uploadUpdate')->name('admin.service.uploadUpdate');
    Route::post('/service/store', 'Admin\ServiceController@store')->name('admin.service.store');
    Route::get('/service/{id}/edit', 'Admin\ServiceController@edit')->name('admin.service.edit');
    Route::post('/service/update', 'Admin\ServiceController@update')->name('admin.service.update');
    Route::post('/service/delete', 'Admin\ServiceController@delete')->name('admin.service.delete');
    Route::get('service/{id}/getsubcats', 'Admin\ServiceController@getsubcats')->name('admin.service.getsubcats');
  });



  Route::group(['middleware' => 'checkpermission:Portfolio Management'], function() {
    // Admin Portfolio Routes
    Route::get('/portfolios', 'Admin\PortfolioController@index')->name('admin.portfolio.index');
    Route::get('/portfolio/create', 'Admin\PortfolioController@create')->name('admin.portfolio.create');
    Route::post('/portfolio/sliderstore', 'Admin\PortfolioController@sliderstore')->name('admin.portfolio.sliderstore');
    Route::post('/portfolio/sliderrmv', 'Admin\PortfolioController@sliderrmv')->name('admin.portfolio.sliderrmv');
    Route::post('/portfolio/upload', 'Admin\PortfolioController@upload')->name('admin.portfolio.upload');
    Route::post('/portfolio/store', 'Admin\PortfolioController@store')->name('admin.portfolio.store');
    Route::get('/portfolio/{id}/edit', 'Admin\PortfolioController@edit')->name('admin.portfolio.edit');
    Route::get('/portfolio/{id}/images', 'Admin\PortfolioController@images')->name('admin.portfolio.images');
    Route::post('/portfolio/sliderupdate', 'Admin\PortfolioController@sliderupdate')->name('admin.portfolio.sliderupdate');
    Route::post('/portfolio/{id}/uploadUpdate', 'Admin\PortfolioController@uploadUpdate')->name('admin.portfolio.uploadUpdate');
    Route::post('/portfolio/update', 'Admin\PortfolioController@update')->name('admin.portfolio.update');
    Route::post('/portfolio/delete', 'Admin\PortfolioController@delete')->name('admin.portfolio.delete');
    Route::get('portfolio/{id}/getsubcats', 'Admin\PortfolioController@getsubcats')->name('admin.portfolio.getsubcats');
  });



  Route::group(['middleware' => 'checkpermission:Gallery Management'], function() {
    // Admin Gallery Routes
    Route::get('/gallery', 'Admin\GalleryController@index')->name('admin.gallery.index');
    Route::post('/gallery/upload', 'Admin\GalleryController@upload')->name('admin.gallery.upload');
    Route::post('/gallery/store', 'Admin\GalleryController@store')->name('admin.gallery.store');
    Route::get('/gallery/{id}/edit', 'Admin\GalleryController@edit')->name('admin.gallery.edit');
    Route::post('/gallery/update', 'Admin\GalleryController@update')->name('admin.gallery.update');
    Route::post('/gallery/{id}/uploadUpdate', 'Admin\GalleryController@uploadUpdate')->name('admin.gallery.uploadUpdate');
    Route::post('/gallery/delete', 'Admin\GalleryController@delete')->name('admin.gallery.delete');
  });


  Route::group(['middleware' => 'checkpermission:Blogs'], function() {
    // Admin Blog Category Routes
    Route::get('/bcategorys', 'Admin\BcategoryController@index')->name('admin.bcategory.index');
    Route::post('/bcategory/store', 'Admin\BcategoryController@store')->name('admin.bcategory.store');
    Route::post('/bcategory/update', 'Admin\BcategoryController@update')->name('admin.bcategory.update');
    Route::post('/bcategory/delete', 'Admin\BcategoryController@delete')->name('admin.bcategory.delete');



    // Admin Blog Routes
    Route::get('/blogs', 'Admin\BlogController@index')->name('admin.blog.index');
    Route::post('/blog/upload', 'Admin\BlogController@upload')->name('admin.blog.upload');
    Route::post('/blog/store', 'Admin\BlogController@store')->name('admin.blog.store');
    Route::get('/blog/{id}/edit', 'Admin\BlogController@edit')->name('admin.blog.edit');
    Route::post('/blog/update', 'Admin\BlogController@update')->name('admin.blog.update');
    Route::post('/blog/{id}/uploadUpdate', 'Admin\BlogController@uploadUpdate')->name('admin.blog.uploadUpdate');
    Route::post('/blog/delete', 'Admin\BlogController@delete')->name('admin.blog.delete');


    // Admin Blog Archive Routes
    Route::get('/archives', 'Admin\ArchiveController@index')->name('admin.archive.index');
    Route::post('/archive/store', 'Admin\ArchiveController@store')->name('admin.archive.store');
    Route::post('/archive/update', 'Admin\ArchiveController@update')->name('admin.archive.update');
    Route::post('/archive/delete', 'Admin\ArchiveController@delete')->name('admin.archive.delete');
  });



  Route::group(['middleware' => 'checkpermission:Contact Page'], function() {
    // Admin Contact Routes
    Route::get('/contact', 'Admin\ContactController@index')->name('admin.contact.index');
    Route::post('/contact/post', 'Admin\ContactController@update')->name('admin.contact.update');
  });



  Route::group(['middleware' => 'checkpermission:Quote Management'], function() {
    // Admin Budget Routes
    Route::get('/budgets', 'Admin\BudgetController@index')->name('admin.budget.index');
    Route::post('/budget/store', 'Admin\BudgetController@store')->name('admin.budget.store');
    Route::post('/budget/update', 'Admin\BudgetController@update')->name('admin.budget.update');
    Route::post('/budget/delete', 'Admin\BudgetController@delete')->name('admin.budget.delete');

    // Admin Quote Routes
    Route::get('/quotes', 'Admin\QuoteController@index')->name('admin.quote.index');
  });



  Route::group(['middleware' => 'checkpermission:Role Management'], function() {
    // Admin Roles Routes
    Route::get('/roles', 'Admin\RoleController@index')->name('admin.role.index');
    Route::post('/role/store', 'Admin\RoleController@store')->name('admin.role.store');
    Route::post('/role/update', 'Admin\RoleController@update')->name('admin.role.update');
    Route::post('/role/delete', 'Admin\RoleController@delete')->name('admin.role.delete');
    Route::get('role/{id}/permissions/manage', 'Admin\RoleController@managePermissions')->name('admin.role.permissions.manage');
    Route::post('role/permissions/update', 'Admin\RoleController@updatePermissions')->name('admin.role.permissions.update');
  });



  Route::group(['middleware' => 'checkpermission:Users Management'], function() {
    // Admin Users Routes
    Route::get('/users', 'Admin\UserController@index')->name('admin.user.index');
    Route::post('/user/upload', 'Admin\UserController@upload')->name('admin.user.upload');
    Route::post('/user/store', 'Admin\UserController@store')->name('admin.user.store');
    Route::get('/user/{id}/edit', 'Admin\UserController@edit')->name('admin.user.edit');
    Route::post('/user/update', 'Admin\UserController@update')->name('admin.user.update');
    Route::post('/user/{id}/uploadUpdate', 'Admin\UserController@uploadUpdate')->name('admin.user.uploadUpdate');
    Route::post('/user/delete', 'Admin\UserController@delete')->name('admin.user.delete');
  });


  Route::group(['middleware' => 'checkpermission:Language Management'], function() {
    // Admin Language Routes
    Route::get('/languages', 'Admin\LanguageController@index')->name('admin.language.index');
    Route::get('/language/{id}/edit', 'Admin\LanguageController@edit')->name('admin.language.edit');
    Route::get('/language/{id}/edit/keyword', 'Admin\LanguageController@editKeyword')->name('admin.language.editKeyword');
    Route::post('/language/store', 'Admin\LanguageController@store')->name('admin.language.store');
    Route::post('/language/upload', 'Admin\LanguageController@upload')->name('admin.language.upload');
    Route::post('/language/{id}/uploadUpdate', 'Admin\LanguageController@uploadUpdate')->name('admin.language.uploadUpdate');
    Route::post('/language/{id}/default', 'Admin\LanguageController@default')->name('admin.language.default');
    Route::post('/language/{id}/delete', 'Admin\LanguageController@delete')->name('admin.language.delete');
    Route::post('/language/update', 'Admin\LanguageController@update')->name('admin.language.update');
    Route::post('/language/{id}/update/keyword', 'Admin\LanguageController@updateKeyword')->name('admin.language.updateKeyword');
  });
});
