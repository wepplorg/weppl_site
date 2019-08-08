
@extends('layouts.app')

@section('content')
   <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
         <div class="">
         	<span><label>Name</label>: {{$ngo->name}}</span><br/>
         	<span><label>Email</label>: {{$ngo->email}}</span><br/>
         	<span><label>Mobile Number</label>: {{$ngo->mobile_no}}</span><br/>
         	<span><label>State</label>: {{$ngo->ngo_profiles->states->state_name}}</span><br/>
            <span><label>City</label>: {{$ngo->ngo_profiles->cities->city_name}}</span><br/>
            <span><label>Address</label>: {{$ngo->ngo_profiles->address}}</span><br/>
            <span><label>Pincode</label>: {{$ngo->ngo_profiles->pincode}}</span><br/>
            <span><label>Decription</label>: {{$ngo->ngo_profiles->description}}</span><br/>
            <span><label>Logo</label>:<img src="{{ asset('storage/ngo/logo/'.$ngo->ngo_profiles->logo)}}"></span><br/>
            <span><label>Document</label>:<a href="{{ asset('storage/ngo/document/'.$ngo->ngo_profiles->document)}}" traget="_blank">View Document</a></span><br/>
            <form action="{{url('admin/ngo/'.$ngo->ngo_profiles->id)}}" method="POST">
            	 {{ csrf_field() }}
                    {{ method_field('PATCH') }}
            <span><label>Verification:</label>
                 @if($ngo->ngo_profiles->verify == 1)
                 <label class="radio-inline">
                   <input type="radio" value="1"  name="verify" checked required> Verified&nbsp;&nbsp;
                   <input type="radio" value="0"   name="verify" required> Not Verified
                 </label>
                 @else
                  <label class="radio-inline">
                   <input type="radio" value="1"  name="verify"  required> Verified&nbsp;&nbsp;
                   <input type="radio" value="0"  name="verify" checked required> Not Verified
                  </label>
                 @endif
            </span><br/>
             <span><label>Status:</label>
                 @if($ngo->ngo_profiles->status == 1)
                 <label class="radio-inline">
                   <input type="radio" value="1"  name="status" checked required> Requested&nbsp;&nbsp;
                   <input type="radio" value="2"   name="status" required> Approve&nbsp;&nbsp;&nbsp;&nbsp;
                   <input type="radio" value="3"   name="status" required> Reject
                 </label>
                 @elseif($ngo->ngo_profiles->status == 2)
                  <label class="radio-inline">
                   <input type="radio" value="1"  name="status"  required> Requested&nbsp;&nbsp;
                   <input type="radio" value="2"   name="status" checked required> Approved&nbsp;&nbsp;&nbsp;
                   <input type="radio" value="3"   name="status" required> Reject
                  </label>
                  @elseif($ngo->ngo_profiles->status == 3)
                  <label class="radio-inline">
                   <input type="radio" value="1"  name="status"  required> Requested&nbsp;&nbsp;
                   <input type="radio" value="2"   name="status"  required> Approve&nbsp;&nbsp;&nbsp;
                   <input type="radio" value="3"   name="status" checked required> Rejected
                  </label>
                 @endif
            </span>
            <input type="submit" class="btn btn-primary">
        </form>
         </div>
      </div>
    </div>
  </div>
@endsection