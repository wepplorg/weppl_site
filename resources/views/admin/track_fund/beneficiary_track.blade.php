@extends('layouts.super_admin_layout')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<?php use App\Models\Payment; ?>
  <main class="main">
  	  <ol class="breadcrumb">
          <li class="breadcrumb-item">Admin</li>
          <li class="breadcrumb-item">
            <a href="#">{{$user->name}}</a>
          </li>
          <li class="breadcrumb-item active">Track Fundraise</li>
          <!-- Breadcrumb Menu-->
          <!--<li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="#">
                <i class="icon-speech"></i>
              </a>
              <a class="btn" href="./">
                <i class="icon-graph"></i>  Dashboard</a>
              <a class="btn" href="#">
                <i class="icon-settings"></i>  Settings</a>
            </div>
          </li>-->
        </ol>
        <div class="container-fluid">
        	<div class="animated-fadeIn">
           <div class="well well-sm"><marquee><p style="font-size: 12pt">Total Amount raised <b>{{moneyFormat($total_amount,'INR')}}</b></p></marquee></div>
        		<div class="row">
        			@if(Session::has('message'))
                <div class="row">
                  <div class="col-md-10">
                       <p class="alert alert-info">{{ Session::get('message') }}</p>
                     </div>
                   </div>
                    @endif
        			<div class="col-md-12">
                <div class="row justify-content-md-end user_btn_sec">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#download_modal">Download CSV</button>
                 </div>
            		 <table class="table table-striped table-bordered ngo_users_table ngo_users_table" style="width:100%" id="categories">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NGO Name</th>
                                        <th>Beneficiary Name</th>
                                        <th>Title</th> 
                                        <th>Goal Amount</th>
                                        <th>Total Raised Amount</th>
                                        <th>No.of Supporters</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                     @foreach($beneficiaries as $beneficiary)
                                      <?php $raised_amount = Payment::where('beneficiary_id','=',$beneficiary->id)->where('payment_status','=','Success')->sum('amount');?>
                                       <tr>
                                          <td>{{$i++}}</td>
                                          <td>{{$user->name}}</td>
                                          <td>{{$beneficiary->ngo_users->name}}</td>
                                          <td>{{$beneficiary->title}}</td>
                                          <td>{{moneyFormat($beneficiary->goal_amount,'INR')}}</td>
                                          <td>{{ moneyFormat($raised_amount,'INR')}}</td>
                                          <td>{{ count($beneficiary->payments)}}</td>
                                          <td><a href="{{url('admin/track_fund_details/'.$beneficiary->id)}}" class="btn btn-info btn-sm">View Details</a></td>
                                       </tr>
                                     @endforeach  
                                </tbody>
                   </table>
        			</div>
        		</div>
        	</div>
        </div>

        <!-- Download CSV modal -->
        <!-- Modal -->
          <div id="download_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Download CSV</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form action="{{url('admin/download_csv_fund')}}" method="POST">
                     {{ csrf_field()}}
                     <input type="hidden" name="id" value="{{$id}}">
                     <div class="form-group">
                       <label>From Date</label>
                       <input type="date" name="from_date" required class="form-control">
                     </div>
                     <div class="form-group">
                       <label>To Date</label>
                       <input type="date" name="to_date" required class="form-control">
                     </div>
                     <div class="form-group">
                       <input type="submit" class="btn btn-info" value="Download">
                     </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
  </main>
  
@endsection