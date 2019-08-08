@extends('layouts.super_admin_layout')

@section('content')
<main class="main">
    <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">
            <a href="#">NGO</a>
          </li>
          <li class="breadcrumb-item active">Beneficiary</li>
          <!-- Breadcrumb Menu-->
          <li class="breadcrumb-menu d-md-down-none">
            <div class="btn-group" role="group" aria-label="Button group">
              <a class="btn" href="">
                
              </a>
              <a  href="{{url('admin/beneficiary')}}">
                Back</a>
              <!--<a class="btn" href="#">
                <i class="icon-settings"></i>  Settings</a>-->
            </div>
          </li>
        </ol>
        
<div class="container-fluid">
    <div class="animated fadeIn">
    <div class="row">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">View Beneficiary</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ url('admin/beneficiary/'.$beneficiary->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                         {{ method_field('PATCH') }}
                         <input type="hidden" name="ngo_id" value="{{$beneficiary->ngo_id}}">
                        
                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select name="category_id" class="form-control" required>
                                    <option value="">Choose Category</option>
                                    @foreach($categories as $category)
                                      @if($category->id == $beneficiary->category_id)
                                       <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                      @else
                                       <option value="{{$category->id}}">{{$category->name}}</option>
                                      @endif
                                    @endforeach
                                </select>
                                
                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <!-- <div class="form-group{{ $errors->has('feature_id') ? ' has-error' : '' }}">
                            <label for="feature_id" class="col-md-4 control-label">Feature</label>

                            <div class="col-md-6">
                                <select name="feature_id" class="form-control" required>
                                    <option value="">Choose Feature</option>
                                    
                                </select>
                                
                                @if ($errors->has('feature_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('feature_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->
                        <div class="form-group{{ $errors->has('beneficiary_name') ? ' has-error' : '' }}">
                            <label for="beneficiary_name" class="col-md-4 control-label">Choose Beneficiary Name</label>

                            <div class="col-md-6">
                                <input type="text" name="" value="{{$beneficiary->ngo_users->name}}" disabled class="form-control">
                                <input type="hidden" name="ngo_user_id" value="{{$beneficiary->ngo_users->id}}">
                                @if ($errors->has('beneficiary_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('beneficiary_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="age" class="col-md-4 control-label">Age </label>

                            <div class="col-md-6">
                                <input id="age" type="text" class="form-control" name="age" required value="{{$ngo_user->age}}">

                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" id="title" type="text" class="form-control" name="title" value="{{ $beneficiary->title }}" required autofocus maxlength="70">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                                <span class="help-block">
                                    <strong id="remainingTC"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Location of Beneficiary</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" value="{{ $beneficiary->location }}" required>

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('campaign_duration') ? ' has-error' : '' }}">
                            <label for="campaign_duration" class="col-md-4 control-label ">Campaign Duration (in days)</label>

                            <div class="col-md-6">
                                <input id="campaign_duration" type="number" class="form-control"  placeholder="Enter no. of days" name="campaign_duration" value="{{ $no_of_days }}" required>
                             
                                @if ($errors->has('campaign_duration'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('campaign_duration') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <!--<div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label for="end_date" class="col-md-4 control-label">End Date</label>

                            <div class="col-md-6">
                                <input id="end_date" type="date" class="form-control" name="end_date"  value="{{$beneficiary->end_date}}" required>

                                @if ($errors->has('end_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->

                       
                       
                         <!--<div class="form-group{{ $errors->has('account_ifsc_code') ? ' has-error' : '' }}">
                            <label for="account_ifsc_code" class="col-md-4 control-label">IFSC Code</label>

                            <div class="col-md-6">
                                <input id="account_ifsc_code" type="text" class="form-control" name="account_ifsc_code" required>

                                @if ($errors->has('account_ifsc_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('account_ifsc_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('account_type') ? ' has-error' : '' }}">
                            <label for="account_type" class="col-md-4 control-label">Account Type</label>

                            <div class="col-md-6">
                                <input id="account_number" type="text" class="form-control" name="account_type" required>

                                @if ($errors->has('account_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('account_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->
                        <div class="form-group{{ $errors->has('goal_amount') ? ' has-error' : '' }}">
                            <label for="goal_amount" class="col-md-4 control-label">Goal Amount</label>

                            <div class="col-md-6">
                                <input id="goal_amount" type="number" class="form-control" name="goal_amount" value="{{$beneficiary->goal_amount}}" required>

                                @if ($errors->has('goal_amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('goal_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="age" class="col-md-4 control-label">Short Description </label>

                            <div class="col-md-6">
                                <input id="summary" type="text" class="form-control" name="summary" value="{{$beneficiary->summary}}" required maxlength="160">

                                @if ($errors->has('summary'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('summary') }}</strong>
                                    </span>
                                @endif
                                <span class="help-block">
                                    <strong id="remainingSC"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Brief Description</label>

                            <div class="col-md-6">
                                <textarea name="description"  class="form-control" id="summernote" required>{{$beneficiary->description}}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Main Display Image</label>
                            <div class="col-md-6">
                               <img src="{{$beneficiary->images->image}}" width="50px;" height="50px;">
                            </div>   
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">If you want change the image?</label>
                            <div class="col-md-6">
                               <input type="radio" name="change_image_boolean" onchange="change_image()" id="image_change" value="1"> Yes
                               <input type="radio" name="change_image_boolean" onchange="change_image()" id="image_change" value="0"> No
                            </div>   
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}" id="image_show" style="display:none;">
                            <label for="main_display_image" class="col-md-4 control-label">Main Display Image</label>

                            <div class="col-md-6">
                                <input type="file" name="image[]"    accept="image/*,video/*">

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                            <label for="document" class="col-md-4 control-label">Upload Document</label>

                            <div class="col-md-6">
                                @if($beneficiary->document)
                                <a href="{{$beneficiary->document}}" target="_blank" class="btn btn-success">View Document</a>
                                @else
                                 <input type="file" name="document" class="form-control"  accept="image/*,">
                                @endif
                                @if ($errors->has('document'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                            <label for="status" class="col-md-4 control-label">Status</label>

                            <div class="col-md-6">
                               <label class="radio-inline">
                                 <input type="radio" name="status" required value="1">Active&nbsp;&nbsp;&nbsp;
                                 <input type="radio" name="status" required value="0">In-Active
                               </label>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                @if($beneficiary->status == 1)
                                <a href="{{url('admin/beneficiary/approve/'.$beneficiary->id)}}" class="btn btn-success">Approve</a>
                                <a href="{{url('admin/beneficiary/reject/'.$beneficiary->id)}}" class="btn btn-danger">Reject</a>
                                @endif
                                 <a href="{{url('admin/beneficiary')}}" class="btn btn-info">Return home</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</main>
<script>
 function change_image()
    {
        var change_image_val= document.querySelector('input[name="change_image_boolean"]:checked').value;
        if(change_image_val == 1)
        {
           $("#image_show").show();
        }
        else {
            $("#image_show").hide();
        }
    }
</script>
@endsection
