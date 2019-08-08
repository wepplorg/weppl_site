<nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
             <!-- <a class="nav-link" href="index.html">
                <i class="nav-icon icon-speedometer"></i> Dashboard
                <span class="badge badge-primary">NEW</span>
              </a>-->
            </li>
           <!-- <li class="nav-title">Theme</li>
            <li class="nav-item">
              <a class="nav-link" href="colors.html">
                <i class="nav-icon icon-drop"></i> Donors</a>
            </li>-->
            <li class="nav-item">
              <!--<a class="nav-link" href="typography.html">
                <i class="nav-icon icon-pencil"></i> Typography</a>-->
            </li>
            <!--<li class="nav-title">Components</li>-->
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                <i class="nav-icon icon-user"></i> Profile</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('ngo/profile/general')}}">
                    <i class="nav-icon icon-puzzle"></i> General</a>
                </li>
                <li class="nav-item">
                 
                </li>
                <li class="nav-item">
                  @if(Auth::user()->ngo_profiles)
                  <a class="nav-link" href="{{url('ngo/profile/documents')}}">
                    <i class="nav-icon icon-puzzle"></i> Documents</a>
                    @else
                    <a class="nav-link disable">
                    <i class="nav-icon icon-puzzle"></i> Documents</a>
                    @endif
                </li>
                <!--<li class="nav-item">
                  <a class="nav-link" href="base/collapse.html">
                    <i class="nav-icon icon-puzzle"></i> Collapse</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/forms.html">
                    <i class="nav-icon icon-puzzle"></i> Forms</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/jumbotron.html">
                    <i class="nav-icon icon-puzzle"></i> Jumbotron</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/list-group.html">
                    <i class="nav-icon icon-puzzle"></i> List group</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/navs.html">
                    <i class="nav-icon icon-puzzle"></i> Navs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/pagination.html">
                    <i class="nav-icon icon-puzzle"></i> Pagination</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/popovers.html">
                    <i class="nav-icon icon-puzzle"></i> Popovers</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/progress.html">
                    <i class="nav-icon icon-puzzle"></i> Progress</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/scrollspy.html">
                    <i class="nav-icon icon-puzzle"></i> Scrollspy</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/switches.html">
                    <i class="nav-icon icon-puzzle"></i> Switches</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/tables.html">
                    <i class="nav-icon icon-puzzle"></i> Tables</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/tabs.html">
                    <i class="nav-icon icon-puzzle"></i> Tabs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="base/tooltips.html">
                    <i class="nav-icon icon-puzzle"></i> Tooltips</a>
                </li>-->
              </ul>
            </li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="javascript:void(0)">
                <i class="nav-icon icon-cursor"></i> Beneficiary Manage</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  @if(Auth::user()->ngo_profiles)
                   @if(Auth::user()->ngo_profiles->status == 2)
                    <a class="nav-link" href="{{url('ngo/users')}}">
                    <i class="nav-icon icon-cursor"></i>Beneficiaries</a>
                    @else
                     <a class="nav-link disable" href="#">
                     <i class="nav-icon icon-cursor"></i>Beneficiaries</a>
                     @endif
                     @endif
                </li>
                @if(Auth::user()->ngo_profiles)
                @if(Auth::user()->ngo_profiles->status == 2)
                <li class="nav-item">
                  <a class="nav-link" href="{{url('ngo/track_rasied_amount')}}">
                    <i class="nav-icon icon-cursor"></i>Manage Fundraise</a>
                </li>
                @else
                  <li class="nav-item">
                  <a class="nav-link disable" href="#">
                    <i class="nav-icon icon-cursor"></i>Manage Fundraise</a>
                </li>
                @endif
                @endif
                <!--<li class="nav-item">
                  <a class="nav-link" href="buttons/brand-buttons.html">
                    <i class="nav-icon icon-cursor"></i> Brand Buttons</a>
                </li>-->
                <li class="nav-item">
                   @if(Auth::user()->ngo_profiles)
                   @if(Auth::user()->ngo_profiles->status == 2)
                    <a class="nav-link" href="{{url('ngo/beneficiary')}}">
                    <i class="nav-icon icon-cursor"></i> Beneficiary</a>
                    @else
                    <a class="nav-link disable" href="#">
                    <i class="nav-icon icon-cursor"></i>Beneficiary</a>
                    @endif
                    @endif
                </li>
                
              </ul>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link" href="{{url('admin/category')}}">
                <i class="nav-icon icon-pie-chart"></i>Manage Category</a>
            </li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-star"></i> Icons</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link" href="icons/coreui-icons.html">
                    <i class="nav-icon icon-star"></i> CoreUI Icons
                    <span class="badge badge-success">NEW</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="icons/flags.html">
                    <i class="nav-icon icon-star"></i> Flags</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="icons/font-awesome.html">
                    <i class="nav-icon icon-star"></i> Font Awesome
                    <span class="badge badge-secondary">4.7</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="icons/simple-line-icons.html">
                    <i class="nav-icon icon-star"></i> Simple Line Icons</a>
                </li>
              </ul>
            </li>-->
            <!--<li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-bell"></i> Notifications</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link" href="notifications/alerts.html">
                    <i class="nav-icon icon-bell"></i> Alerts</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="notifications/badge.html">
                    <i class="nav-icon icon-bell"></i> Badge</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="notifications/modals.html">
                    <i class="nav-icon icon-bell"></i> Modals</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="widgets.html">
                <i class="nav-icon icon-calculator"></i> Widgets
                <span class="badge badge-primary">NEW</span>
              </a>
            </li>
            <li class="divider"></li>
            <li class="nav-title">Extras</li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
                <i class="nav-icon icon-star"></i> Pages</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link" href="login.html" target="_top">
                    <i class="nav-icon icon-star"></i> Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="register.html" target="_top">
                    <i class="nav-icon icon-star"></i> Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="404.html" target="_top">
                    <i class="nav-icon icon-star"></i> Error 404</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="500.html" target="_top">
                    <i class="nav-icon icon-star"></i> Error 500</a>
                </li>
              </ul>
            </li>
            <li class="nav-item mt-auto">
              <a class="nav-link nav-link-success" href="https://coreui.io" target="_top">
                <i class="nav-icon icon-cloud-download"></i> Download CoreUI</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-danger" href="https://coreui.io/pro/" target="_top">
                <i class="nav-icon icon-layers"></i> Try CoreUI
                <strong>PRO</strong>
              </a>
            </li>-->
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>