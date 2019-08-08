@extends('layouts.super_admin_layout')

@section('content')
<?php 
use App\Models\Payment;
use App\Models\Beneficiary;
 ?>
 <main class="main">
   <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage  Fundraise
        </li>
        <li class="breadcrumb-item">Track Details</li>
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
      <div class="animated fadeIn">
      	@if(Session::has('message'))
                <div class="row">
                  <div class="col-md-12">
                    <div class="alert alert-success" id="success-alert">
                      <button type="button" class="close" data-dismiss="alert">x</button>
                      <strong>{{ Session::get('message') }}</strong> 
                    </div>
                  </div>
                 </div>
            @endif
        <div class="row justify-content-center">
         	
         <div class="col-md-12">
            <div class="row justify-content-end">
              
          </div>
        
             <table class="table table-striped table-bordered " style="width:100%" id="categories">
               <thead>
                 <tr>
                   <th>No</th>
                   <th>Ngo Name</th>
                   <th>Total Raised Amount</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
               	  <?php $i=1;?>
                  @foreach($ngos as $ngo)
                   
                    <?php 
                     $beneficiary_id = Beneficiary::where('ngo_id','=',$ngo->id)->pluck('id');
                    $raised_amount = Payment::whereIN('beneficiary_id',$beneficiary_id)->where('payment_status','=','Success')->sum('amount');?>
                    <tr>
                       <td>{{$i++}}</td>
                       <td>{{$ngo->name}}</td>
                      
                       <td>{{ moneyFormat($raised_amount,'INR')}}</td>
                      
                       <td><a href="{{url('admin/beneficiary_track/'.$ngo->id)}}" class="btn btn-info btn-sm">View Details</a></td>
                      </td>
                    </tr>
                    
                  @endforeach
               </tbody>
             </table>
           </div>
         </div>
      </div>
    </div>
 </main>
@endsection