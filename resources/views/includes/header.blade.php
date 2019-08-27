  <nav class="navbar navbar-expand-lg bg-default navbar-default">
    <div class="container-fluid" id="div">
          <a class="navbar-brand" href="https://shop.weppl.org"> <!-- {{url('/')}} -->
            <img src="{{ asset('img/Logo.png')}}" class="logo header_logo" alt="logo"/>
          </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
     
   <div class="collapse navbar-collapse" id="navbar-collapse">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="https://weppl.org" target="_blank">Weppl Shop</a>
    </li> 
    <li class="nav-item">
        <a class="nav-link" href="{{url('beneficiary_lists')}}">Browse causes</a>
    </li>
     <li class="nav-item">
        <a class="nav-link" href="{{url('works')}}">How it Works?</a>
    </li>
    <li class="nav-item"><a class="nav-link" target="_blank" href="https://weppl.org/blogs/blogs">Weppl Blog</a></li>
  </ul>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
         @guest
         <a class="nav-link" href="{{route('register')}}">Register to Fundraise</a>
         @else
          
          @endif
        </li>
        @guest
         <li class="nav-item">
          <a class="nav-link" href="{{route('login')}}">Sign In</a>
        </li>
        @else
          @if(Auth::user()->hasRole('admin'))
            <li class="nav-item">
              <a class="nav-link dashboard_link" href="{{url('admin/dashboard')}}" >Dashboard</a>
            </li>
          @elseif(Auth::user()->hasRole('ngo'))
            <li class="nav-item">
              <a class="nav-link dashboard_link" href="{{url('ngo/dashboard')}}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link dashboard_link" href="{{url('donor_dashboard')}}">Dashboard</a>
            </li>
          @endif
          <li class="nav-item">
             <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            @if(Auth::user()->image) 
               <img class="img-avatar" src="{{Auth::user()->image}}" alt="image" width="40" height="40">
            @else 
             <img class="img-avatar" src="https://d1vdjc70h9nzd9.cloudfront.net/media/ngo/869000/869486/image/14be89f8754dd21d77fa967d66b9f320885672ad.jpg" alt="image" width="40" height="40">
             @endif
              {{Auth::user()->name}}</a>
            <div class="dropdown-menu work_dropdown_show">
               <a class="dropdown-item" href="{{url('profile')}}">View Profile</a>  
               <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
            </div>
          </li>
        @endif
      </ul>
 </div><!--collapsibleNavbar-->
 </div>
   
</nav>
