@extends('layouts.auth')
@section('page_title','NON School/College Details')
@section('content')
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid job-details-page ">
        
{{--        user details--}}
        <div class="card">
             <div class="card-header bg-blue">
                <h5 class="card-title text-white">School/College Details</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
					<th scope="col">School Code</th>
					
					<th scope="col">School/College Name</th>
                    <th scope="col">School/College Type</th>
                
                   
                </tr>
                </thead>
                <tbody>
                <tr>	
					<td>@if(isset($user->school_code)) {{$user->school_code}} @endif</td>				
               
                    <td>{{ucfirst($user->school_name)}}</td>
                    <td>{{$user->school_type}}</td>
                  
                    
                </tr>

                </tbody>
            </table>
        </div>
        </div>		
		
{{--NON School address--}}
        <div class="card">
            <div class="card-header bg-blue">
                <h5 class="card-title text-white">NON School/College Address</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
				    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                   	<th scope="col">State</th>
							<th scope="col">Country</th>
					
                </tr>
                </thead>
                <tbody>
                <tr>
                       <td>{{$user->contact_no}}</td>
                    <td>@if($user->status=='active') Approved @elseif($user->status=='deactivate')Deactivate @else Pending @endif</td>
				<td> {{$user->address}}</td>
               
                <td> {{$user->city}}</td>
                 <td>@if($user->stateInfo) {{$user->stateInfo->name}}@else {{$user->state}}@endif</td>
                <td>@if($user->countryInfo) {{$user->countryInfo->name}}@else {{$user->country}}@endif</td>
			
                </tr>
                </tbody>
            </table>
        </div>
        </div>
	     <div class="card">
            <div class="card-header bg-blue ">
                <h5 class="card-title text-white">More Info</h5>
            </div>
            <div class="table-responsive">
                <table  class="table table-striped table-bordered">
                <thead>
                <tr>
				    <th scope="col">More Info</th>
                   
					
                </tr>
                </thead>
                <tbody>
                <tr>
                       <td class="whitesapce">{{$user->more_info}}</td>
               
                </tr>
                </tbody>
            </table>
        </div>
        </div>
	
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
<script> 
$(document).ready(function(){
  $("#addPay").click(function(){
    $("#addPaymentSection").toggle();
  });	
	$("#from_date").datepicker({
        todayBtn:  1,
        autoclose: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#to_date').datepicker('setStartDate', minDate);
    });
    $("#to_date").datepicker()
        .on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#from_date').datepicker('setEndDate', maxDate);
        });
});
</script>	
@endsection