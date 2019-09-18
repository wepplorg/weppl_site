@extends('layouts.users')
@section('content')
<main>
   <div class="container-fluid">
      <div class="row justify-content-center">
         <h3 class="contact_title">About Partners</h3>
      </div>
      <div class="row partner_sec justify-content-center">
      </div>   
   </div>
   <div class="container">
            <div class="owl-carousel owl-theme partner-carousel partner_sec">
               @foreach($ngos as $ngo)
                @if($ngo->ngo_profiles)
                @if($ngo->ngo_profiles->status == 2)
                @if($ngo->ngo_profiles->logo)

              <a href="" data-toggle="modal" data-target="#partnerModal{{$ngo->id}}"> <div class="item text-center">
                     <img src="{{$ngo->ngo_profiles->logo}}" alt="partner_logo" class="rounded-circle partner_logo  mx-auto"/>
                     <p class="mt-2"> {{$ngo->name}}</p>
               </div></a>          
               @endif
               @endif
               @endif
               @endforeach

             </div>
         </div>

         @foreach($ngos as $ngo)
              @if($ngo->ngo_profiles)
                @if($ngo->ngo_profiles->status == 2)
                @if($ngo->ngo_profiles->logo)
                     <!-- Modal -->
                  <div id="partnerModal{{$ngo->id}}" class="modal">
                  <div class="modal-dialog modal-lg">
                     <!-- Modal content-->
                     <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">NGO Description</h4>
                          <button type="button"  class="close" data-dismiss="modal">&times;</button> 
                        </div>
                        <div class="modal-body">
                        <p>{!! $ngo->ngo_profiles->description !!}</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                     </div>

                  </div>
                  </div>
                @endif
               @endif
               @endif
         @endforeach
</main>
@endsection
