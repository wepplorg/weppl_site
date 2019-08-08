@extends('layouts.super_admin_layout') @section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">
            Manage NGO
        </li>

        <li class="breadcrumb-item active">NGO</li>
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
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs admin_nav_tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#pending_ngo" role="tab" aria-controls="home">Pending NGO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#approved_ngo" role="tab" aria-controls="profile">Approved NGO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#rejected_ngo" role="tab" aria-controls="messages">Rejected NGO</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="pending_ngo" role="tabpanel">
                            <table class="table table-striped table-bordered " style="width:100%" id="ngo_pending">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile number</th>
                                        <th>Logo</th>
                                        <th>Verify</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                        @foreach($ngos as $ngo)
                                        @if($ngo->ngo_profiles)
                                         @if($ngo->ngo_profiles->status == 1)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$ngo->name}}</td>
                                            <td>{{$ngo->email}}</td>
                                            <td>{{$ngo->mobile_no}}</td>
                                            @if($ngo->ngo_profiles->logo)
                                            <td><img src="{{ $ngo->ngo_profiles->logo }}" height="100px;" width="150px;"></td>
                                            @else
                                            <td>-</td>
                                            @endif
                                            @if($ngo->ngo_profiles) @if($ngo->ngo_profiles->verify == 1)
                                            <td>
                                                <span class="badge badge-success">verified</span>
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-danger">Not Verified</span>
                                            </td>
                                            @endif @else
                                            <td>-</td>
                                            @endif @if($ngo->ngo_profiles) @if($ngo->ngo_profiles->status == 1)
                                            <td>
                                                <span class="badge badge-info">Pending</span>
                                            </td>
                                            @endif @else
                                            <td>-</td>
                                            @endif
                                            <td>
                                                <div class="row justify-content-center">
                                                <a href="{{url('admin/ngo/'.$ngo->id.'/edit')}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>&nbsp;
                                                <a href="{{url('admin/ngo/'.$ngo->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>&nbsp;
                                                <form class="delete" action="{{url('admin/ngo/'.$ngo->id)}}" method="POST">
                                                {{ method_field('DELETE') }}{{csrf_field()}}
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @else
                                          <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$ngo->name}}</td>
                                            <td>{{$ngo->email}}</td>
                                            <td>{{$ngo->mobile_no}}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            </tr>
                                        @endif
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="approved_ngo" role="tabpanel">
                           <table class="table table-striped table-bordered approved_ngo_table"  style="width:100%" id="ngo_approved">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile number</th>
                                        <th>Logo</th>
                                        <th>Verify</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                        @foreach($ngos as $ngo)
                                        @if($ngo->ngo_profiles)
                                         @if($ngo->ngo_profiles->status == 2)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$ngo->name}}</td>
                                            <td>{{$ngo->email}}</td>
                                            <td>{{$ngo->mobile_no}}</td>
                                            @if($ngo->ngo_profiles->logo)
                                            <td><img src="{{ $ngo->ngo_profiles->logo }}" height="100px;" width="150px;"></td>
                                            @else
                                            <td>-</td>
                                            @endif
                                            @if($ngo->ngo_profiles) @if($ngo->ngo_profiles->verify == 1)
                                            <td>
                                                <span class="badge badge-success">Verified</span>
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-success">Not Verified</span>
                                            </td>
                                            @endif @else
                                            <td>-</td>
                                            @endif @if($ngo->ngo_profiles) @if($ngo->ngo_profiles->status == 2)
                                            <td>
                                                <span class="badge badge-success">Approved</span>
                                            </td>
                                            @endif @else
                                            <td>-</td>
                                            @endif
                                            <td>
                                                <div class="row justify-content-center">
                                                    <a href="{{url('admin/ngo/'.$ngo->id.'/edit')}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>&nbsp;
                                                    <a href="{{url('admin/ngo/'.$ngo->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>&nbsp;
                                                    <form class="delete" action="{{url('admin/ngo/'.$ngo->id)}}" method="POST">
                                                    {{ method_field('DELETE') }}{{csrf_field()}}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endif
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="rejected_ngo" role="tabpanel">
                           <table class="table table-striped table-bordered approved_ngo_table"  style="width:100%" id="ngo_rejected">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile number</th>
                                        <th>Logo</th>
                                        <th>Verify</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                        @foreach($ngos as $ngo)
                                        @if($ngo->ngo_profiles)
                                         @if($ngo->ngo_profiles->status == 3)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$ngo->name}}</td>
                                            <td>{{$ngo->email}}</td>
                                            <td>{{$ngo->mobile_no}}</td>
                                            @if($ngo->ngo_profiles->logo)
                                            <td><img src="{{ $ngo->ngo_profiles->logo }}" height="100px;" width="150px;"></td>
                                            @else
                                            <td>-</td>
                                            @endif
                                            @if($ngo->ngo_profiles) @if($ngo->ngo_profiles->verify == 1)
                                            <td>
                                                <p style="color:green;">Verified</p>
                                            </td>
                                            @else
                                            <td>
                                                <p style="color:red;">Not Verified</p>
                                            </td>
                                            @endif @else
                                            <td>-</td>
                                            @endif @if($ngo->ngo_profiles) @if($ngo->ngo_profiles->status == 2)
                                            <td>
                                                <p style="color:green;">Approved</p>
                                            </td>
                                            @endif @else
                                            <td>-</td>
                                            @endif
                                            <td>
                                              <div class="row justify-content-center">
                                                    <a href="{{url('admin/ngo/'.$ngo->id.'/edit')}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>&nbsp;
                                                    <a href="{{url('admin/ngo/'.$ngo->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>&nbsp;
                                                    <form class="delete" action="{{url('admin/ngo/'.$ngo->id)}}" method="POST">
                                                    {{ method_field('DELETE') }}{{csrf_field()}}
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endif
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection