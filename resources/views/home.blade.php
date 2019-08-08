@extends('layouts.users') @section('content')

<div class="container">
    <div class="feature-sec">
        <h2 class="text-center">FEATURED CAUSE'S</h2>
    </div>

    <div class="row categories_title-sec">
        <div class="col-12 col-md-3 col-lg-5">
            <h3>Categories</h3>
        </div>
        <div class="col-md-9 col-lg-7">
            <ul class="right_navs">
                @foreach($features as $feature)
                <li>
                    <a  href="{{url('beneficiary_feature_filters/'.$feature->id)}}" >{{$feature->name}}</a>
                </li>
                @endforeach
                <li>
                    <a href="{{url('beneficiary_feature_filters/'."all")}}">All</a>
                </li>
            </ul>
        </div>
    </div>
    <!--row-->
    <div class="row">
        <div class="col-md-3">
            <ul class="list-group tab_left_pills">
                @foreach($categories as $category)
                <li class="list-group-item">
                  <a   href="{{url('beneficiary_category_filters/'.$category->id)}}">{{$category->name}}</a> 
               </li>
                @endforeach
                <li class="list-group-item active">
                   <a href="{{url('beneficiary_category_filters/'."all")}}">All</a>
                </li>
            </ul>
        </div>

        <div class="col-md-9">
            <div class="row feature_card_sec">
               
                @foreach($stories as $story)
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                           
                            <img src="{{$story->images->image}}" class="card_img" width="100%"  />
                            <div>
                                <h5 class="text-center short_discription">{{$story->title}}</h5>
                                <p class="text-center">{{$story->users->name}}</p>
                            </div>
                            <!--<div class="row justify-content-md-center share_sec">
                                <button type="button" class="btn btn-secondary  share_btn share_button"><span><i class="fab fa-whatsapp share_icon"></i></span>Share</button>
                                <a href="{{Share::page(url('beneficiary_detail/'.$story->id))->facebook()}}"  class="btn btn-secondary  share_btn"><i class="fa fa-facebook share_icon" aria-hidden="true"></i>Share</a>
                                <button type="button" class="btn btn-secondary btn-md  share_btn"><i class="fab fa-youtube share_icon"></i>Share</button>
                            </div>-->
                            <div id="social-links" class="row justify-content-md-center share_sec">
                               <a href="https://www.facebook.com/sharer/sharer.php?u={{url('beneficiary_detail/'.$story->id)}}" class="fb_social-button btn btn-primary" id="">
                               <i class="fa fa-facebook" aria-hidden="true"></i>Share
                               </a>
                               <a href="https://wa.me/?text={{url('beneficiary_detail/'.$story->id)}}" class="whatsapp_social-button btn btn-success" id=""><span class="fa fa-whatsapp"></span>Share</a>
                             </div>
                            <!--row-->

                            <div class="progress_sec">
                                
                                <span class="left-text">{{$story->goal_amount}}</span><span class="right-text">67%</span>
                                <div class="clearfix"></div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width:67%">
                                    </div>
                                </div>
                            </div>
                            <!--progress_sec-->
                            <div class="row donate_btn_sec">
                                <div class="col-lg-12">
                                    <a href="{{url('beneficiary_detail/'.$story->slug)}}" class="btn btn-sm warning-btn">DONATE NOW</a>
                                    <span class="location-sec"><i class="fa fa-map-marker location_icon" aria-hidden="true"></i><a href="#" class="location_text">Location</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--card-->
                </div>
                @endforeach

                <!--col-lg-4-->
               <!-- <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="img/img_2.jpg" class="img-responsive" width="100%" />
                            <div class="card_content">
                                <h5 class="text-center">Dummy text of the</h5>
                                <p class="text-center">By Rajendra Pilai</p>
                            </div>
                            <div class="row justify-content-md-center share_sec">
                                <button type="button" class="btn btn-secondary  share_btn share_button"><span><i class="fab fa-whatsapp share_icon"></i></span>Share</button>
                                <button type="button" class="btn btn-secondary  share_btn"><i class="fa fa-facebook share_icon" aria-hidden="true"></i>Share</button>
                                <button type="button" class="btn btn-secondary btn-md  share_btn"><i class="fab fa-youtube share_icon"></i>Share</button>
                            </div>
                            

                            <div class="progress_sec">
                                <span class="left-text"><i class="fa fa-inr" aria-hidden="true"></i>1.00 Lakh*</span><span class="right-text">67%</span>
                                <div class="clearfix"></div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width:67%">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row donate_btn_sec">
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-sm warning-btn">DONATE NOW</button>
                                    <span class="location-sec"><i class="fa fa-map-marker location_icon" aria-hidden="true"></i><a href="#" class="location_text">Location</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>-->
                <!--col-lg-4-->
                <!--<div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="img/img_3.jpg" class="img-responsive" width="100%" />
                            <div class="card_content">
                                <h5 class="text-center">Dummy text of the</h5>
                                <p class="text-center">By Rajendra Pilai</p>
                            </div>
                            <div class="row justify-content-md-center share_sec">
                                <button type="button" class="btn btn-secondary  share_btn share_button"><span><i class="fab fa-whatsapp share_icon"></i></span>Share</button>
                                <button type="button" class="btn btn-secondary  share_btn"><i class="fa fa-facebook share_icon" aria-hidden="true"></i>Share</button>
                                <button type="button" class="btn btn-secondary btn-md  share_btn"><i class="fab fa-youtube share_icon"></i>Share</button>
                            </div>
                            

                            <div class="progress_sec">
                                <span class="left-text"><i class="fa fa-inr" aria-hidden="true"></i>1.00 Lakh*</span><span class="right-text">67%</span>
                                <div class="clearfix"></div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width:67%">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row donate_btn_sec">
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-sm warning-btn">DONATE NOW</button>
                                    <span class="location-sec"><i class="fa fa-map-marker location_icon" aria-hidden="true"></i><a href="#" class="location_text">Location</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>-->
                <!--col-lg-4-->
                <!--        </div>
                         <div class="row"> -->
                <!--<div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="img/img_1.jpg" class="img-responsive" width="100%" />
                            <div class="card_content">
                                <h5 class="text-center">Dummy text of the</h5>
                                <p class="text-center">By Rajendra Pilai</p>
                            </div>
                            <div class="row justify-content-md-center share_sec">
                                <button type="button" class="btn btn-secondary  share_btn share_button"><span><i class="fab fa-whatsapp share_icon"></i></span>Share</button>
                                <button type="button" class="btn btn-secondary  share_btn"><i class="fa fa-facebook share_icon" aria-hidden="true"></i>Share</button>
                                <button type="button" class="btn btn-secondary btn-md  share_btn"><i class="fab fa-youtube share_icon"></i>Share</button>
                            </div>
                            

                            <div class="progress_sec">
                                <span class="left-text"><i class="fa fa-inr" aria-hidden="true"></i>1.00 Lakh*</span><span class="right-text">67%</span>
                                <div class="clearfix"></div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width:67%">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row donate_btn_sec">
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-sm warning-btn">DONATE NOW</button>
                                    <span class="location-sec"><i class="fa fa-map-marker location_icon" aria-hidden="true"></i><a href="#" class="location_text">Location</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>-->
                <!--col-lg-4-->
               <!-- <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="img/11_img.jpg" class="img-responsive" width="100%" />
                            <div class="card_content">
                                <h5 class="text-center">Dummy text of the</h5>
                                <p class="text-center">By Rajendra Pilai</p>
                            </div>
                            <div class="row justify-content-md-center share_sec">
                                <button type="button" class="btn btn-secondary  share_btn share_button"><span><i class="fab fa-whatsapp share_icon"></i></span>Share</button>
                                <button type="button" class="btn btn-secondary  share_btn"><i class="fa fa-facebook share_icon" aria-hidden="true"></i>Share</button>
                                <button type="button" class="btn btn-secondary btn-md  share_btn"><i class="fab fa-youtube share_icon"></i>Share</button>
                            </div>
                            
                            <div class="progress_sec">
                                <span class="left-text"><i class="fa fa-inr" aria-hidden="true"></i>1.00 Lakh*</span><span class="right-text">67%</span>
                                <div class="clearfix"></div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width:67%">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row donate_btn_sec">
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-sm warning-btn">DONATE NOW</button>
                                    <span class="location-sec"><i class="fa fa-map-marker location_icon" aria-hidden="true"></i><a href="#" class="location_text">Location</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>-->
                <!--col-lg-4-->
                <!--<div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="img/22_img.jpg" class="img-responsive" width="100%" />
                            <div class="card_content">
                                <h5 class="text-center">Dummy text of the</h5>
                                <p class="text-center">By Rajendra Pilai</p>
                            </div>
                            <div class="row justify-content-md-center share_sec">
                                <button type="button" class="btn btn-secondary  share_btn share_button"><span><i class="fab fa-whatsapp share_icon"></i></span>Share</button>
                                <button type="button" class="btn btn-secondary  share_btn"><i class="fa fa-facebook share_icon" aria-hidden="true"></i>Share</button>
                                <button type="button" class="btn btn-secondary btn-md  share_btn"><i class="fab fa-youtube share_icon"></i>Share</button>
                            </div>
                            

                            <div class="progress_sec">
                                <span class="left-text"><i class="fa fa-inr" aria-hidden="true"></i>1.00 Lakh*</span><span class="right-text">67%</span>
                                <div class="clearfix"></div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width:67%">
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row donate_btn_sec">
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-sm warning-btn">DONATE NOW</button>
                                    <span class="location-sec"><i class="fa fa-map-marker location_icon" aria-hidden="true"></i><a href="#" class="location_text">Location</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>-->
                <!--col-lg-4-->
            </div>
            <!--row-->
        </div>
        <!--col-lg-9-->
    </div>
    <!--row-->

    <div class="row justify-content-end">
        <!--  <div class="col-md-10"></div>
               <div class="col-md-2"> -->
        
            {{ $stories->links('vendor.pagination.bootstrap-4') }}
           
       
        <!--  </div> -->
    </div>

    <!--   <h5 class="text-center fund-title">MONTHLY GIVING HELPS YOU COMMIT TO LONG TERM CHANGE</h5>
                 <div class="row fund_categories_sec">
               <div class="col-sm-4 col-md-4 ">
                  <div class="row fund_content">
                     <div class="col-md-2 col-lg-1"></div>
                     <div class="col-md-2 col-lg-2">
                        <i class="fas fa-wallet wallet-icon"></i>
                      </div>
                  <div class="col-lg-3 fundd-sec">
                     <h2>1,234Crore+</h2>
                     <h4>RAISED</h4>
                  </div>
                   </div>
               </div>
              <div class="col-sm-4 col-md-4 ">
                   <div class="row fund_content">
                     <div class="col-md-2 col-lg-1"></div>
                  <div class="col-md-2 col-lg-2">
                     <i class="fas fa-handshake fa-rotate-90 hand_icon" aria-hidden="true"></i>
                  </div>
                  <div class="col-lg-3 fundd-sec">
                     <h2>1,23,000+</h2>
                     <h4>SUPPORTERS</h4>
                  </div>
               </div>
               </div>
               <div class="col-sm-4 col-md-4 ">
                   <div class="row fund_content">
                  <div class="col-md-2 col-lg-1"></div>
                  <div class="col-12 col-md-2 col-lg-2">
                     <i class="fa fa-users user-icon" aria-hidden="true"></i>
                  </div>
                  <div class="col-12 col-lg-3 fund-sec">
                     <h2>12,000+</h2>
                     <h4>FUNDRAISER</h4>
                  </div>
               </div>
               </div>
               </div> -->
</div>
<!--container-->
@endsection
@endsection
