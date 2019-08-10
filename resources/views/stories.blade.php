 <?php  use App\Models\Payment;?>
                @if(count($stories)>0)
                @foreach($stories as $story)
                 <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 fund_card">
                    <a href="{{url('beneficiary_detail/'.$story->slug)}}" class="fund_card_link">
                      <div class="card welcome_card">
                         <div class="image_sec">
                            <img src="{{$story->images->image}}" alt="RDH" width="100%" height="100%" class="fund_card_img"/>
                          </div>

                           <div class="feature_content_sec">
                              <p class="feature_categories_title">{{$story->title}}</p>
                              <p>by {{$story->users->name}}</p>
                              <p class="short_discription_categories">{{$story->summary}}</p>
                               <div class="row justify-content-end">
                             <a href="{{url('beneficiary_detail/'.$story->slug)}}" class="read-more-link">Read More ></a>
                           </div>
                           </div>
                          
                            <!-- <div class="progress_sec welcome_progress">
                                <div class="text">
                                  <?php $raised_amount = Payment::where('beneficiary_id','=',$story->id)->where('payment_status','=',"Success")->sum('amount'); 
                                        $count_people = Payment::where('beneficiary_id','=',$story->id)->where('payment_status','=','Success')->groupBy('user_id')->get();
                                      if($raised_amount){
                                         $percentage = ($raised_amount/$story->goal_amount)*100; 
                                       }else{
                                           $percentage=0;
                                       }  
                                  ?>  
                                <span class="left-text">{{moneyFormat($raised_amount, 'INR')}}</span>
                                <span>Raised</span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="max-width:{{$percentage}}%">
                                    </div>
                                </div>
                                <div class="support_sec">
                                     <?php $date = Carbon\Carbon::parse($story->end_date);
                                          $current= $date->diffInDays();?>
                                     <span class="days_categories">{{$current}} days left</span>
                                     <span class="vl"></span>
                                    <span class="support_categories">{{count($count_people)}} supporters</span>
                                </div>
                            </div> -->

                        </div>
                      </a>
                    </div>
                @endforeach
                @else
                
                @endif

