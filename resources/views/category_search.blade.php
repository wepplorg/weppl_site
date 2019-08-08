@extends('layouts.users')
@section('content')
<?php use App\Models\Payment; ?>
<div class="container-fluid">
    <div class="feature-sec">
     <h2 class="text-center "><b>Be a changemaker. Contribute. Involve. Engage</b></h2>
        <h3 class="text-center explore_cause"><b>Explore Causes</b></h3>
    </div>

    <div class="row categories_title-sec">
       <div class="col-12 col-sm-4 col-md-3 col-lg-2">
            <h5><b>Categories:</b></h5>
             <div class="row">
            <ul class="left_nav_dropdown">
               <li class="nav-item">
                 <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Categories</a>
                  <div class="dropdown-menu">
                   @foreach($categories as $category)

                    <a class="dropdown-item" href="#">{{$category->name}}</a>
                     @endforeach
                    <a class="dropdown-item" href="#">All</a> 
                  </div>
              </li>
            </ul>

             <ul class="list-group tab_left_pills">
                @foreach($categories as $category)
                @if($category->slug == $id)
                <li class="list-group-item active">
                 <a href="{{url('beneficiary_category_filters/'.$category->slug)}}"  >{{$category->name}}</a>
                 </li> 
                @else
                <li class="list-group-item">
                 <a  href="{{url('beneficiary_category_filters/'.$category->slug)}}">{{$category->name}}</a> 
                 </li>
                @endif
                @endforeach
                @if($id == "all")
                 <li class="list-group-item active">
                    <a  href="{{url('beneficiary_category_filters/'."all")}}" >All</a>
                 </li>
                 @else
                  <li class="list-group-item ">
                    <a  href="{{url('beneficiary_category_filters/'."all")}}" >All</a>
                 </li>
                 @endif
            </ul>
          </div>
        </div>
        <div class="col-12 col-sm-8 col-md-9 col-lg-10 right_sec">
            <div class="row justify-content-end search_sec">
             <ul class="right_navs">
               <li>
                    <a  href="{{url('beneficiary_feature_filters/'."trending")}}">Trending</a>
                </li>
              
                <li>
                    <a href="{{url('beneficiary_feature_filters/'."all")}}">All</a>
                </li>
            </ul>
             <div class="row search_row_sec">
                <form class="form-inline" action="{{url('search_result')}}" method="GET">
                  <div class="col-9 col-md-8">
                    <input id="search" name="title" type="text" class="form-control search_sec_input" required placeholder="Search" />
                   </div>
                   <div class="col-3 col-md-2">
                    <button class="btn btn-outline-success btn-md" type="submit"><i class="fa fa-search"></i></button>
                  </div>
                </form>
                </div>
            
          </div>
             <div class="row feature_card_sec" id="post-data">
                 @if(count($stories)>0)
                   @include('stories')
                 @else
                  <div class="col-md-2"></div>
                  <div class="col-md-8 no_results_sec">
                       <p class="text-center">Sorry,We couldn't find any results!</p>
                  </div>
                  <div class="col-md-2"></div>
                 @endif
            </div>
            <!--row-->
            
        </div>
    </div>
    <!--row-->
   <div class="clearfix"></div>

    <!--<div class="row justify-content-end"  style="margin-right: 1.5rem">
            {{ $stories->links('vendor.pagination.bootstrap-4') }}
    </div>-->
     <div class="ajax-load text-center p-5 loading_more_sec" style="display:none">
  <p><img src="http://demo.itsolutionstuff.com/plugin/loader.gif">Loading More Stories</p>
</div>
</div>
<!--container-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  var page = 1;
  $(window).scroll(function() {
      if($(window).scrollTop() + $(window).height() >= $(document).height()) {
          page++;
          loadMoreData(page);
      }
  });


  function loadMoreData(page){
    $.ajax(
          {
              url: '?page=' + page,
              type: "get",
              beforeSend: function()
              {
                  $('.ajax-load').show();
              }
          })
          .done(function(data)
          {
              if(data.html.length == ""){
                 var message ='<p><b>'+'No More results found'+'</b></p>';
                  $('.ajax-load').html(message);
                  return;
              }
              $('.ajax-load').hide();
              $("#post-data").append(data.html);
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {
                alert('server not responding...');
          });
  }
  
  $(document).ready(function() {
    $( "#search" ).autocomplete({
 
        source: function(request, response) {
            $.ajax({
            url: "{{url('live_search')}}",
            data: {
                    term : request.term
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                    //console.log(obj.city_name);
                    return obj.title;
               }); 
 
               response(resp);
            }
        });
    },
    minLength: 1
 });
});
</script>
@endsection