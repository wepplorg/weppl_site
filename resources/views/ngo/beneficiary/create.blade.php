@extends('layouts.admin_layout')

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
    <div class="row ">
               <div class="col-lg-12">
            <div class="card ">
                <div class="card-header">Add Beneficiary</div>

                <div class="card-body row justify-content-md-center">
                    <div class="col-lg-10">
                    <form class="form-horizontal row create_story_form" method="POST" action="{{ url('ngo/beneficiary') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="status" value="1">
                        <div class="col-md-6 form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id" class="col-md-12 ">Category*</label>

                            <div class="col-md-12">
                                <select name="category_id" class="form-control" required>
                                    <option value="">Choose Category</option>
                                    @foreach($categories as $category)
                                      <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                
                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <!-- <div class="col-md-6 form-group{{ $errors->has('feature_id') ? ' has-error' : '' }}">
                            <label for="feature_id" class="col-md-12 ">Feature*</label>

                            <div class="col-md-12">
                                <select name="feature_id" class="form-control" required>
                                    <option value="">Choose Feature</option>
                                    @foreach($features as $feature)
                                      <option value="{{$feature->id}}">{{$feature->name}}</option>
                                    @endforeach
                                </select>
                                
                                @if ($errors->has('feature_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('feature_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->
                        <div class="col-md-6 form-group{{ $errors->has('beneficiary_name') ? ' has-error' : '' }}">
                            <label for="beneficiary_name" class="col-md-12 ">Choose Beneficiary Name*</label>

                            <div class="col-md-12">
                                <select name="ngo_user_id" class="form-control" selected id="ngo_user_id" required>
                                    
                                      <option value="{{$ngo_user->id}}">{{$ngo_user->name}}</option>
                                   
                                </select>

                                @if ($errors->has('beneficiary_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('beneficiary_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6 form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="age" class="col-md-12 ">Age*</label>

                            <div class="col-md-12">
                                <input id="age" type="text" class="form-control" name="age" value="{{$ngo_user->age}}" required>

                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-12 ">Title*</label>

                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required autofocus maxlength="70">

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

                        <div class="col-md-6 form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-12 ">Location of Beneficiary*</label>

                            <div class="col-md-12">
                                <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" required>

                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group{{ $errors->has('campaign_duration') ? ' has-error' : '' }}">
                            <label for="campaign_duration" class="col-md-12 ">Campaign Duration (in days)*</label>

                            <div class="col-md-12">
                                <input id="campaign_duration" type="number" class="form-control"  placeholder="Enter no. of days" name="campaign_duration" value="{{ old('campaign_duration') }}" required>
                             
                                @if ($errors->has('campaign_duration'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('campaign_duration') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <!--<div class="col-md-6 form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label for="end_date" class="col-md-12 ">End Date</label>

                            <div class="col-md-12">
                                <input id="end_date" type="date" class="form-control" name="end_date" required>

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
                        <div class="col-md-6 form-group{{ $errors->has('goal_amount') ? ' has-error' : '' }}">
                            <label for="goal_amount" class="col-md-12">Goal Amount*</label>

                            <div class="col-md-12">
                                <input id="goal_amount" type="number" class="form-control" name="goal_amount" required>

                                @if ($errors->has('goal_amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('goal_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="age" class="col-md-12 ">Short Description*</label>

                            <div class="col-md-12">
                                <input id="summary" type="text"  class="form-control" name="summary" required maxlength="160">

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
                        <div class="col-md-6 form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-12 ">Brief Description*</label>

                            <div class="col-md-12">
                                <textarea name="description" id="description" class="form-control codeable" required="required"></textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group{{ $errors->has('display_main_image') ? ' has-error' : '' }}">
                            <label for="display_main_image" class="col-md-12 ">Display Main Image*</label>

                            <div class="col-md-12">
                                <input type="file" name="display_main_image[]"  required  accept="image/*,video/*">

                                @if ($errors->has('display_main_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('display_main_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-12 ">Slider Image(Multiple)*</label>

                            <div class="col-md-12">
                                <input type="file" name="image[]"  required  accept="image/*,video/*" multiple>

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                            <label for="document" class="col-md-12">Upload Document</label>

                            <div class="col-md-12">
                                <input type="file" name="document"   accept="image/*,">

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
                        <div class="col-md-12 form-group">
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <a href="{{url('ngo/beneficiary')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</main>
@endsection
