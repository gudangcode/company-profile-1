@php
  $admin = Auth::guard('admin')->user();
  if (!empty($admin->role)) {
    $permissions = $admin->role->permissions;
    $permissions = json_decode($permissions, true);
  }
@endphp

<div class="sidebar sidebar-style-2" data-background-color="dark2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
          @if (!empty(Auth::guard('admin')->user()->image))
            <img src="{{asset('assets/admin/img/propics/'.Auth::guard('admin')->user()->image)}}" alt="..." class="avatar-img rounded">
          @else
            <img src="{{asset('assets/admin/img/propics/blank_user.jpg')}}" alt="..." class="avatar-img rounded">
          @endif
        </div>
        <div class="info">
          <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
            <span>
              {{Auth::guard('admin')->user()->first_name}}
              @if (empty(Auth::guard('admin')->user()->role))
                <span class="user-level">Owner</span>
              @else
                <span class="user-level">{{Auth::guard('admin')->user()->role->name}}</span>
              @endif
              <span class="caret"></span>
            </span>
          </a>
          <div class="clearfix"></div>

          <div class="collapse in" id="collapseExample">
            <ul class="nav">
              <li>
                <a href="{{route('admin.editProfile')}}">
                  <span class="link-collapse">Edit Profile</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.changePass')}}">
                  <span class="link-collapse">Change Password</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.logout')}}">
                  <span class="link-collapse">Logout</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <ul class="nav nav-primary">

        @if (empty($admin->role) || (!empty($permissions) && in_array('Dashboard', $permissions)))
          {{-- Dashboard --}}
          <li class="nav-item @if(request()->path() == 'admin/dashboard') active @endif">
            <a href="{{route('admin.dashboard')}}">
              <i class="la flaticon-paint-palette"></i>
              <p>Dashboard</p>
            </a>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Basic Settings', $permissions)))
          {{-- Basic Settings --}}
          <li class="nav-item
          @if(request()->path() == 'admin/favicon') active
          @elseif(request()->path() == 'admin/logo') active
          @elseif(request()->path() == 'admin/homeversion') active
          @elseif(request()->path() == 'admin/basicinfo') active
          @elseif(request()->path() == 'admin/support') active
          @elseif(request()->path() == 'admin/social') active
          @elseif(request()->is('admin/social/*')) active
          @elseif(request()->path() == 'admin/breadcrumb') active
          @elseif(request()->path() == 'admin/heading') active
          @elseif(request()->path() == 'admin/script') active
          @elseif(request()->path() == 'admin/seo') active
          @endif">
            <a data-toggle="collapse" href="#basic">
              <i class="la flaticon-settings"></i>
              <p>Basic Settings</p>
              <span class="caret"></span>
            </a>
            <div class="collapse
            @if(request()->path() == 'admin/favicon') show
            @elseif(request()->path() == 'admin/logo') show
            @elseif(request()->path() == 'admin/homeversion') show
            @elseif(request()->path() == 'admin/basicinfo') show
            @elseif(request()->path() == 'admin/support') show
            @elseif(request()->path() == 'admin/social') show
            @elseif(request()->is('admin/social/*')) show
            @elseif(request()->path() == 'admin/breadcrumb') show
            @elseif(request()->path() == 'admin/heading') show
            @elseif(request()->path() == 'admin/script') show
            @elseif(request()->path() == 'admin/seo') show
            @endif" id="basic">
              <ul class="nav nav-collapse">
                <li class="@if(request()->path() == 'admin/favicon') active @endif">
                  <a href="{{route('admin.favicon')}}">
                    <span class="sub-item">Favicon</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/logo') active @endif">
                  <a href="{{route('admin.logo')}}">
                    <span class="sub-item">Logo</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/homeversion') active @endif">
                  <a href="{{route('admin.homeversion')}}">
                    <span class="sub-item">Home Versions</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/basicinfo') active @endif">
                  <a href="{{route('admin.basicinfo')}}">
                    <span class="sub-item">Basic Informations</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/support') active @endif">
                  <a href="{{route('admin.support')}}">
                    <span class="sub-item">Support Informations</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/social') active
                @elseif(request()->is('admin/social/*')) active @endif">
                  <a href="{{route('admin.social.index')}}">
                    <span class="sub-item">Social Links</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/breadcrumb') active @endif">
                  <a href="{{route('admin.breadcrumb')}}">
                    <span class="sub-item">Breadcrumb</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/heading') active @endif">
                  <a href="{{route('admin.heading')}}">
                    <span class="sub-item">Page Headings</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/script') active @endif">
                  <a href="{{route('admin.script')}}">
                    <span class="sub-item">Scripts</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/seo') active @endif">
                  <a href="{{route('admin.seo')}}">
                    <span class="sub-item">SEO Information</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Subscribers', $permissions)))
          {{-- Subscribers --}}
          <li class="nav-item
          @if(request()->path() == 'admin/subscribers') active
          @elseif(request()->path() == 'admin/mailsubscriber') active
          @endif">
            <a data-toggle="collapse" href="#subscribers">
              <i class="la flaticon-envelope"></i>
              <p>Subscribers</p>
              <span class="caret"></span>
            </a>
            <div class="collapse
            @if(request()->path() == 'admin/subscribers') show
            @elseif(request()->path() == 'admin/mailsubscriber') show
            @endif" id="subscribers">
              <ul class="nav nav-collapse">
                <li class="@if(request()->path() == 'admin/subscribers') active @endif">
                  <a href="{{route('admin.subscriber.index')}}">
                    <span class="sub-item">Subscribers</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/mailsubscriber') active @endif">
                  <a href="{{route('admin.mailsubscriber')}}">
                    <span class="sub-item">Mail to Subscribers</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Quote Management', $permissions)))
          {{-- Quotes --}}
          <li class="nav-item
          @if(request()->path() == 'admin/budgets') active
          @elseif(request()->path() == 'admin/quotes') active
          @endif">
            <a data-toggle="collapse" href="#quote">
              <i class="la flaticon-list"></i>
              <p>Quote Management</p>
              <span class="caret"></span>
            </a>
            <div class="collapse
            @if(request()->path() == 'admin/budgets') show
            @elseif(request()->path() == 'admin/quotes') show
            @endif" id="quote">
              <ul class="nav nav-collapse">
                <li class="@if(request()->path() == 'admin/budgets') active @endif">
                  <a href="{{route('admin.budget.index')}}">
                    <span class="sub-item">Budgets</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/quotes') active @endif">
                  <a href="{{route('admin.quote.index')}}">
                    <span class="sub-item">Quotes</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Home Page', $permissions)))
          {{-- Home Page --}}
          <li class="nav-item
          @if(request()->path() == 'admin/features') active
          @elseif(request()->path() == 'admin/introsection') active
          @elseif(request()->path() == 'admin/servicesection') active
          @elseif(request()->path() == 'admin/herosection/static') active
          @elseif(request()->path() == 'admin/herosection/video') active
          @elseif(request()->path() == 'admin/herosection/sliders') active
          @elseif(request()->is('admin/herosection/slider/*/edit')) active
          @elseif(request()->path() == 'admin/approach') active
          @elseif(request()->is('admin/approach/*/pointedit')) active
          @elseif(request()->path() == 'admin/statistics') active
          @elseif(request()->is('admin/statistics/*/edit')) active
          @elseif(request()->path() == 'admin/members') active
          @elseif(request()->is('admin/member/*/edit')) active
          @elseif(request()->is('admin/approach/*/pointedit')) active
          @elseif(request()->path() == 'admin/cta') active
          @elseif(request()->is('admin/feature/*/edit')) active
          @elseif(request()->path() == 'admin/testimonials') active
          @elseif(request()->is('admin/testimonial/*/edit')) active
          @elseif(request()->path() == 'admin/invitation') active
          @elseif(request()->path() == 'admin/partners') active
          @elseif(request()->is('admin/partner/*/edit')) active
          @elseif(request()->path() == 'admin/portfoliosection') active
          @elseif(request()->path() == 'admin/blogsection') active
          @elseif(request()->path() == 'admin/member/create') active
          @endif">
            <a data-toggle="collapse" href="#home">
              <i class="la flaticon-home"></i>
              <p>Home Page</p>
              <span class="caret"></span>
            </a>
            <div class="collapse
            @if(request()->path() == 'admin/features') show
            @elseif(request()->path() == 'admin/introsection') show
            @elseif(request()->path() == 'admin/servicesection') show
            @elseif(request()->path() == 'admin/herosection/static') show
            @elseif(request()->path() == 'admin/herosection/video') show
            @elseif(request()->path() == 'admin/herosection/sliders') show
            @elseif(request()->is('admin/herosection/slider/*/edit')) show
            @elseif(request()->path() == 'admin/approach') show
            @elseif(request()->is('admin/approach/*/pointedit')) show
            @elseif(request()->path() == 'admin/statistics') show
            @elseif(request()->is('admin/statistics/*/edit')) show
            @elseif(request()->path() == 'admin/members') show
            @elseif(request()->is('admin/member/*/edit')) show
            @elseif(request()->path() == 'admin/cta') show
            @elseif(request()->is('admin/feature/*/edit')) show
            @elseif(request()->path() == 'admin/testimonials') show
            @elseif(request()->is('admin/testimonial/*/edit')) show
            @elseif(request()->path() == 'admin/invitation') show
            @elseif(request()->path() == 'admin/partners') show
            @elseif(request()->is('admin/partner/*/edit')) show
            @elseif(request()->path() == 'admin/portfoliosection') show
            @elseif(request()->path() == 'admin/blogsection') show
            @elseif(request()->path() == 'admin/member/create') show
            @endif" id="home">
              <ul class="nav nav-collapse">
                <li class="
                @if(request()->path() == 'admin/herosection/static') selected
                @elseif(request()->path() == 'admin/herosection/video') selected
                @elseif(request()->path() == 'admin/herosection/sliders') selected
                @elseif(request()->is('admin/herosection/slider/*/edit')) selected
                @endif">
                  <a data-toggle="collapse" href="#herosection">
                    <span class="sub-item">Hero Section</span>
                    <span class="caret"></span>
                  </a>
                  <div class="collapse
                  @if(request()->path() == 'admin/herosection/static') show
                  @elseif(request()->path() == 'admin/herosection/video') show
                  @elseif(request()->path() == 'admin/herosection/sliders') show
                  @elseif(request()->is('admin/herosection/slider/*/edit')) show
                  @endif" id="herosection">
                    <ul class="nav nav-collapse subnav">
                      <li class="@if(request()->path() == 'admin/herosection/static') active @endif">
                        <a href="{{route('admin.herosection.static')}}">
                          <span class="sub-item">Static Version</span>
                        </a>
                      </li>
                      <li class="
                      @if(request()->path() == 'admin/herosection/sliders') active
                      @elseif(request()->is('admin/herosection/slider/*/edit')) active
                      @endif">
                        <a href="{{route('admin.slider.index')}}">
                          <span class="sub-item">Slider Version</span>
                        </a>
                      </li>
                      <li class="@if(request()->path() == 'admin/herosection/video') active @endif">
                        <a href="{{route('admin.herosection.video')}}">
                          <span class="sub-item">Video Version</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>

                <li class="
                @if(request()->path() == 'admin/features') active
                @elseif(request()->is('admin/feature/*/edit')) active
                @endif">
                  <a href="{{route('admin.feature.index')}}">
                    <span class="sub-item">Features</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/introsection') active @endif">
                  <a href="{{route('admin.introsection.index')}}">
                    <span class="sub-item">Intro Section</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/servicesection') active @endif">
                  <a href="{{route('admin.servicesection.index')}}">
                    <span class="sub-item">Service Section</span>
                  </a>
                </li>
                <li class="
                @if(request()->path() == 'admin/approach') active
                @elseif(request()->is('admin/approach/*/pointedit')) active
                @endif">
                  <a href="{{route('admin.approach.index')}}">
                    <span class="sub-item">Approach Section</span>
                  </a>
                </li>
                <li class="
                @if(request()->path() == 'admin/statistics') active
                @elseif(request()->is('admin/statistics/*/edit')) active
                @endif">
                  <a href="{{route('admin.statistics.index')}}">
                    <span class="sub-item">Statistics Section</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/cta') active @endif">
                  <a href="{{route('admin.cta.index')}}">
                    <span class="sub-item">Call to Action Section</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/portfoliosection') active @endif">
                  <a href="{{route('admin.portfoliosection.index')}}">
                    <span class="sub-item">Portfolio Section</span>
                  </a>
                </li>
                <li class="
                @if(request()->path() == 'admin/testimonials') active
                @elseif(request()->is('admin/testimonial/*/edit')) active
                @endif">
                  <a href="{{route('admin.testimonial.index')}}">
                    <span class="sub-item">Testimonials</span>
                  </a>
                </li>
                <li class="
                @if(request()->path() == 'admin/members') active
                @elseif(request()->is('admin/member/*/edit')) active
                @elseif(request()->path() == 'admin/member/create') active
                @endif">
                  <a href="{{route('admin.member.index')}}">
                    <span class="sub-item">Team Section</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/blogsection') active @endif">
                  <a href="{{route('admin.blogsection.index')}}">
                    <span class="sub-item">Blog Section</span>
                  </a>
                </li>
                <li class="
                @if(request()->path() == 'admin/partners') active
                @elseif(request()->is('admin/partner/*/edit')) active
                @endif">
                  <a href="{{route('admin.partner.index')}}">
                    <span class="sub-item">Partners</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Footer', $permissions)))
          {{-- Footer --}}
          <li class="nav-item
          @if(request()->path() == 'admin/footers') active
          @elseif(request()->path() == 'admin/ulinks') active
          @endif">
            <a data-toggle="collapse" href="#footer">
              <i class="la flaticon-layers"></i>
              <p>Footer</p>
              <span class="caret"></span>
            </a>
            <div class="collapse
            @if(request()->path() == 'admin/footers') show
            @elseif(request()->path() == 'admin/ulinks') show
            @endif" id="footer">
              <ul class="nav nav-collapse">
                <li class="@if(request()->path() == 'admin/footers') active @endif">
                  <a href="{{route('admin.footer.index')}}">
                    <span class="sub-item">Logo & Text</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/ulinks') active @endif">
                  <a href="{{route('admin.ulink.index')}}">
                    <span class="sub-item">Useful Links</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Pages', $permissions)))
          {{-- Dynamic Pages --}}
          <li class="nav-item
          @if(request()->path() == 'admin/page/create') active
          @elseif(request()->path() == 'admin/pages') active
          @elseif(request()->path() == 'admin/parentlink') active
          @elseif(request()->is('admin/page/*/edit')) active
          @endif">
            <a data-toggle="collapse" href="#pages">
              <i class="la flaticon-file"></i>
              <p>Pages</p>
              <span class="caret"></span>
            </a>
            <div class="collapse
            @if(request()->path() == 'admin/page/create') show
            @elseif(request()->path() == 'admin/pages') show
            @elseif(request()->path() == 'admin/parentlink') show
            @elseif(request()->is('admin/page/*/edit')) show
            @endif" id="pages">
              <ul class="nav nav-collapse">
                <li class="@if(request()->path() == 'admin/parentlink') active @endif">
                  <a href="{{route('admin.parentlink.index')}}">
                    <span class="sub-item">Parent Link</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/page/create') active @endif">
                  <a href="{{route('admin.page.create')}}">
                    <span class="sub-item">Create Page</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/pages') active @endif">
                  <a href="{{route('admin.page.index')}}">
                    <span class="sub-item">Pages</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Service Page', $permissions)))
          {{-- Service Page --}}
          <li class="nav-item
          @if(request()->path() == 'admin/scategorys') active
          @elseif(request()->is('admin/scategory/*/edit')) active
          @elseif(request()->path() == 'admin/services') active
          @elseif(request()->is('admin/service/*/edit')) active
          @endif">
            <a data-toggle="collapse" href="#service">
              <i class="la flaticon-customer-support"></i>
              <p>Service Page</p>
              <span class="caret"></span>
            </a>
            <div class="collapse
            @if(request()->path() == 'admin/scategorys') show
            @elseif(request()->is('admin/scategory/*/edit')) show
            @elseif(request()->path() == 'admin/services') show
            @elseif(request()->is('admin/service/*/edit')) show
            @endif" id="service">
              <ul class="nav nav-collapse">
                <li class="
                @if(request()->path() == 'admin/scategorys') active
                @elseif(request()->is('admin/scategory/*/edit')) active
                @endif">
                  <a href="{{route('admin.scategory.index')}}">
                    <span class="sub-item">Category</span>
                  </a>
                </li>
                <li class="
                @if(request()->path() == 'admin/services') active
                @elseif(request()->is('admin/service/*/edit')) active
                @endif">
                  <a href="{{route('admin.service.index')}}">
                    <span class="sub-item">Services</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Portfolio Management', $permissions)))
          {{-- Portfolio Management --}}
          <li class="nav-item
           @if(request()->path() == 'admin/portfolios') active
           @elseif(request()->path() == 'admin/portfolio/create') active
           @elseif(request()->is('admin/portfolio/*/edit')) active
           @endif">
            <a href="{{route('admin.portfolio.index')}}">
              <i class="la flaticon-imac"></i>
              <p>Portfolio Management</p>
            </a>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Gallery Management', $permissions)))
          {{-- Gallery Management --}}
          <li class="nav-item
           @if(request()->path() == 'admin/gallery') active
           @elseif(request()->path() == 'admin/gallery/create') active
           @elseif(request()->is('admin/gallery/*/edit')) active
           @endif">
            <a href="{{route('admin.gallery.index')}}">
              <i class="la flaticon-picture"></i>
              <p>Gallery Management</p>
            </a>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('FAQ Management', $permissions)))
          {{-- FAQ Management --}}
          <li class="nav-item
           @if(request()->path() == 'admin/faqs') active @endif">
            <a href="{{route('admin.faq.index')}}">
              <i class="la flaticon-round"></i>
              <p>FAQ Management</p>
            </a>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Blogs', $permissions)))
          {{-- Blogs --}}
          <li class="nav-item
          @if(request()->path() == 'admin/bcategorys') active
          @elseif(request()->path() == 'admin/blogs') active
          @elseif(request()->path() == 'admin/archives') active
          @elseif(request()->is('admin/blog/*/edit')) active
          @endif">
            <a data-toggle="collapse" href="#blog">
              <i class="la flaticon-chat-4"></i>
              <p>Blogs</p>
              <span class="caret"></span>
            </a>
            <div class="collapse
            @if(request()->path() == 'admin/bcategorys') show
            @elseif(request()->path() == 'admin/blogs') show
            @elseif(request()->path() == 'admin/archives') show
            @elseif(request()->is('admin/blog/*/edit')) show
            @endif" id="blog">
              <ul class="nav nav-collapse">
                <li class="@if(request()->path() == 'admin/bcategorys') active @endif">
                  <a href="{{route('admin.bcategory.index')}}">
                    <span class="sub-item">Category</span>
                  </a>
                </li>
                <li class="
                @if(request()->path() == 'admin/blogs') active
                @elseif(request()->is('admin/blog/*/edit')) active
                @endif">
                  <a href="{{route('admin.blog.index')}}">
                    <span class="sub-item">Blogs</span>
                  </a>
                </li>
                <li class="@if(request()->path() == 'admin/archives') active @endif">
                  <a href="{{route('admin.archive.index')}}">
                    <span class="sub-item">Archives</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Contact Page', $permissions)))
          {{-- Contact Page --}}
          <li class="nav-item
           @if(request()->path() == 'admin/contact') active @endif">
            <a href="{{route('admin.contact.index')}}">
              <i class="la flaticon-whatsapp"></i>
              <p>Contact Page</p>
            </a>
          </li>
        @endif




        @if (empty($admin->role) || (!empty($permissions) && in_array('Role Management', $permissions)))
          {{-- Role Management Page --}}
          <li class="nav-item
           @if(request()->path() == 'admin/roles') active
           @elseif(request()->is('admin/role/*/permissions/manage')) active
           @endif">
            <a href="{{route('admin.role.index')}}">
              <i class="la flaticon-multimedia-2"></i>
              <p>Role Management</p>
            </a>
          </li>
        @endif



        @if (empty($admin->role) || (!empty($permissions) && in_array('Users Management', $permissions)))
          {{-- Role Management Page --}}
          <li class="nav-item
           @if(request()->path() == 'admin/users') active
           @elseif(request()->is('admin/user/*/edit')) active
           @endif">
            <a href="{{route('admin.user.index')}}">
              <i class="la flaticon-user-5"></i>
              <p>Users Management</p>
            </a>
          </li>
        @endif


        @if (empty($admin->role) || (!empty($permissions) && in_array('Language Management', $permissions)))
        {{-- Language Management Page --}}
        <li class="nav-item
         @if(request()->path() == 'admin/languages') active
         @elseif(request()->is('admin/language/*/edit')) active
         @elseif(request()->is('admin/language/*/edit/keyword')) active
         @endif">
          <a href="{{route('admin.language.index')}}">
            <i class="la flaticon-chat-8"></i>
            <p>Language Management</p>
          </a>
        </li>
        @endif

      </ul>
    </div>
  </div>
</div>
