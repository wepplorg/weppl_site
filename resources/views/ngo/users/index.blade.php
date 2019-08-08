@extends('layouts.admin_layout') @section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">
            <a href="#">NGO</a>
        </li>
        <li class="breadcrumb-item active">Beneficiaries</li>
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
            <div class="row">
                @if(Session::has('message'))
                <div class="row">
                    <div class="col-md-12">
                        <p class="alert alert-info">{{ Session::get('message') }}</p>
                    </div>
                </div>
                @endif
                <div class="col-md-12">
                    <div class="row justify-content-md-end user_btn_sec">
                        <a href="{{url('ngo/users/create')}}" class="btn btn-primary user_button">Add Beneficiries</a>
                    </div>
                    <table class="display nowrap table table-hover table-striped table-bordered ngo_users_table" style="width:100%" id="ngo_users">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Beneficiary Name</th>
                                <th>Date of Birth</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->date_of_birth}}</td>
                                    <td><a href="#" class="btn btn-info story_button">View</a><a class="btn btn-primary story_button" href="{{url('ngo/beneficiary/create/'.$user->id)}}">Create Story</a></td>
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