@extends('main3')
@section('content')
<input type="text" id="CurrentPage" value="" hidden>
  <script type="text/javascript">Right_GG();</script>
  <style type="text/css">
  	div .short{
    font-weight:bold;
	color:#FF0000;
	font-size:larger;
	}
	div .weak{
	    font-weight:bold;
		color:orange;
		font-size:larger;
	}
	div .good{
	    font-weight:bold;
		color:#2D98F3;
		font-size:larger;
	}
	div .strong{
	    font-weight:bold;
		color: limegreen;
		font-size:larger;
	}
  </style>
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           System Users <span class=""><a href="#" title="Add New Region" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
           {{-- <span style="float:right">Filter : 
              <select class="form-control" id="filterer" onchange="filterGroup()">
                <option value="">Select Region ...</option>
                <option value="All">All Region</option>
                @foreach ($region as $regions)
                  <option value="{{$regions->rgnid}}">{{$regions->rgnid}}</option>
                @endforeach
              </select>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
           </span> --}}
        </div>
        <div class="card-body">
          <span id="success_add">
            
          </span>
          <table class="table" id="example" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 10%">User ID</th>
                  <th style="width: 20%">Name</th>
                  <th style="width: 15%">Type</th>
                  <th style="width: 10%;" class="text-center">Position</th>
                  <th style="width: 20%"><center>Region</center></th>
                  <th style="width: 10%"><center>Status</center></th>
                  <th style="width: 15%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody>
              @if(isset($users))
              @foreach ($users as $user)
                <tr>
                  <td>{{$user->uid}}</td>
                  <td style="font-weight: bold">{{$user->fname}} @if ($user->mname != "") {{substr($user->mname,0,1)}}. @endif {{$user->lname}}
                  </td>
                  <td>{{$user->grp_desc}}</td>
                  <td style="text-align: center">@if($user->position != ''){{$user->position}} @else NONE @endif</td>
                  <td><center>{{$user->rgn_desc}}</center></td>
                  <td>
                    <center>
                      @if ($user->isActive == 1)
                        <font style="color:green">Active</font>
                      @else
                        <font style="color:red">Deactived</font>
                      @endif
                    </center>
                  </td>
                <td>
                        <center>
                        <a href="#" ><button data-toggle="modal" data-target="#ViewModal" onclick="showData('{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}','{{$user->contact}}','{{$user->rgn_desc}}', '{{$user->email}}', '{{$user->grp_desc}}', '{{$user->position}}')" class="btn btn-primary" title="View Account">&nbsp;<i class="fa fa-eye"></i>&nbsp;</button></a>
                        @if ($user->isActive == 1)
                          <a href="#"><button data-toggle="modal" onclick="showIfActive({{$user->isActive}},'{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}')" data-target="#IfActiveModal" class="btn btn-danger" title="Deactivate Account">&nbsp;<i class="fa fa-toggle-off"></i>&nbsp;</button></a>
                        @else
                          <a href="#"><button data-toggle="modal" onclick="showIfActive({{$user->isActive}},'{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}')" data-target="#IfActiveModal" class="btn btn-success" title="Reactivate Account">&nbsp;<i class="fa fa-toggle-on"></i>&nbsp;</button></a>
                      @endif
                        {{-- <a href="#"><button class="btn btn-warning" title="Edit Account">&nbsp;<i class="fa fa-edit"></i>&nbsp;</button></a>&nbsp; --}}
                      </center>
                    
                  </td>
                </tr>
              @endforeach
              @endif
              </tbody>
            </table>
            @if (!isset($users))
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><i class="fas fa-exclamation"></i></strong> No <strong>System Users</strong> are currently registered!
            </div>
            @endif
        </div>

    </div>
        </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 0px;border: none;">
      <div class="modal-body" style=" background-color: #272b30;
    color: white;">
        <h5 class="modal-title text-center"><strong>System Users Registration</strong></h5>
        <hr>
        <div class="container">
          <form id="RAdmin" class="" data-parsley-validate>
          	<div class="row">
          		<div class="col-sm-12" id="ACCError"></div>
          	</div>
            {{ csrf_field() }}
            <div class="row">
            	<div class="col-sm-12 alert alert-danger alert-dismissible fade show text-left" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                    <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
             </div>
            </div>
            <div class="row">
            	<div class="col-sm-4">First Name:</div>
	            <div class="col-sm-8" style="margin:0 0 .8em 0;">
	            <input type="text" name="fname" class="form-control" data-parsley-required-message="*<strong>First name</strong> required"  required>
	            </div>
            </div>	
            <div class="row">
            	<div class="col-sm-4" >Middle Name:</div>
	            <div class="col-sm-8" style="margin:0 0 .8em 0;">
	            <input type="text" name="mname" class="form-control">
	            </div>
            </div>	
            <div class="row">
            	<div class="col-sm-4">Last Name:</div>
	            <div class="col-sm-8" style="margin:0 0 .8em 0;">
	            <input type="text" name="lname" class="form-control" data-parsley-required-message="*<strong>Last name</strong> required"  required>
	            </div>
            </div>
            <div class="row">
            	<div class="col-sm-4" >Region:</div>
	            <div class="col-sm-8" style="margin:0 0 .8em 0;">
	            <select class="form-control" name="rgn" id="pos_val" data-parsley-required-message="*<strong>Region</strong> required" required="">
	            <option value=""></option>  
	                @if (isset($region))
	                  @foreach ($region as $regions)
	                    <option value="{{$regions->rgnid}}">{{$regions->rgn_desc}}</option>
	                  @endforeach
	                @endif
	            </select> 
	            </div>
            </div>
            <div class="row">
              <div class="col-sm-4">Type:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <select class="form-control" name="typ" data-parsley-required-message="*<strong>Type</strong> required" required="">
                  <option value=""></option>
                @if (isset($types))
                  @foreach ($types as $type123)
                  <option value="{{$type123->grp_id}}">{{$type123->grp_desc}}</option>
                  @endforeach   
                @endif  
                </select>
              </div>
            </div>              	
            <div class="row">
            	<div class="col-sm-4">Position:</div>
	            <div class="col-sm-8" style="margin:0 0 .8em 0;">
	            <input type="text" name="position" class="form-control" data-parsley-required-message="*<strong>Position</strong> required" required>
	            </div>
            </div>
            <div class="row">
              <div class="col-sm-4">Team:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                 <select class="form-control" name="team" data-parsley-required-message="*<strong>Team</strong> required">
                   
                 </select>
              </div> 
            </div>
            <div class="row">
              <div class="col-sm-4">Default Facility Assignment:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <select class="form-control" name="def_faci">
                  <option value=""></option>
                  @isset($facilitys)
                    @foreach ($facilitys as $dt)
                      <option value="{{$dt->facid}}">{{$dt->facname}}</option>
                    @endforeach
                  @endisset
                </select>
              </div>
            </div>
            <div class="row">
            	<div class="col-sm-4">Email Address:</div>
	            <div class="col-sm-8" style="margin:0 0 .8em 0;">
	            <input type="email" name="email" class="form-control" data-parsley-required-message="*<strong>Email</strong> required" required>
	            </div>
            </div>	
            <div class="row">
            	<div class="col-sm-4">Contact No:</div>
	            <div class="col-sm-8" style="margin:0 0 .8em 0;">
	            <input type="text" name="cntno" class="form-control" data-parsley-required-message="*<strong>Contact no.</strong> required" required>
	            </div>
            </div>	
            <div class="row">
            	<div class="col-sm-4">
	              Username:
	            </div>
	            <div class="col-sm-8" style="margin:0 0 .8em 0;">
	              <input type="text" name="uname" class="form-control" data-parsley-required-message="*<strong>Username</strong> required" required>
	            </div>
            </div>		
            <div class="row">
            	<div class="col-sm-4">
	              Password:
	            </div>
	            <div class="col-sm-8" style="margin:0 0 .8em 0;">
	              <input type="password" name="pass" onkeyup="checkPassword()" id="ThePassWord" class="form-control" data-parsley-required-message="*<strong>Password</strong> required" required>
	            </div>
            </div>
            <div class="row">
            	<div class="col-sm-4">
	              Password Strength: <input type="text" id="passStr" hidden>
	            </div>
	            <div class="col-sm-8 text-center" style="margin:0 0 .8em 0;text-align: center" ><span id="result"></span></div>
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New System User</button>
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 0px;border: none;">
      <div class="modal-body text-justify" style=" background-color: #272b30;
    color: white;">
        <h5 class="modal-title text-center"><strong>System User Information</strong></h5>
        <hr>
        <div class="container">
          <form  class="row" >
            <div class="col-sm-12" id="Error">
            </div>
            <div class="col-sm-4">First Name:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewFname" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Middle Name:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewMname" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Last Name:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewLname" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Region:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewRegion" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Type:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewType" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Position:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewPosi" style="font-weight: bold"></span>
            </div>

            <div class="col-sm-4">Team:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewTeam" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Email Address:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewEmail" style="font-weight: bold"></span>
            </div>
            <div class="col-sm-4">Contact No:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <span id="ViewCntNo" style="font-weight: bold"</span>
            </div>
            <div class="col-sm-12">
              <hr>
              <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="IfActiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 0px;border: none;">
      <div class="modal-body text-justify" style=" background-color: #272b30;
    color: white;">
        <h5 class="modal-title text-center"><strong><span id="ifActiveTitle"></span></strong></h5>
        <hr>
        <div class="container">
          <form  class="row" >
          	<div class="col-sm-12 alert alert-danger alert-dismissible fade show text-left" style="display:none;margin:5px" id="ActiveErrorAlert" role="alert">
                    <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#ActiveErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
             </div>
            <div class="col-sm-12" id="Error">
            <div class="col-sm-12" id="IfActiveModalBody">
            </div>
            <div class="col-sm-12">
              <hr>
              <div class="row">
                <div class="col-sm-6">
                  <button type="button" onclick="ChangeActiveStateNow()" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                </div>
                <div class="col-sm-6">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                </div>
              </div>
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
    <script type="text/javascript">
      $(document).ready(function() {
         $('#example').DataTable({
         	searchDelay: 350
         });
      } );
      $(".dataTables_filter input [type='search']").keyup( function (e) {
      		var table = $('#example').DataTable();
		   table.search( this.value ).draw();
		} );
        $('#RAdmin').on('submit', function(e){
          e.preventDefault();
              var form = $(this);
              var passSTR = parseInt($('#passStr').val());
              var passSTRMsg = $('#result').text();
              console.log(passSTR);
              form.parsley().validate();
              if (form.parsley().isValid()){
                // $('input[name="fname"]').val() $('#passStr').val()
                  if (passSTR >= 2) {
                  		$.ajax({
		                  url: " {{asset('employee/dashboard/manage/system_users')}}",
		                  method: 'POST',
		                  data: {
		                    _token : $('input[name="_token"]').val(),
		                    fname : $('input[name="fname"]').val(),
		                    mname : $('input[name="mname"]').val(),
		                    lname : $('input[name="lname"]').val(),
		                    rgn : 	$('select[name="rgn"]').val(),
		                    typ : 	$('select[name="typ"]').val(),
		                    email : $('input[name="email"]').val(),
		                    cntno : $('input[name="cntno"]').val(),
		                    uname : $('input[name="uname"]').val(),
		                    posti : $('input[name="position"]').val(),
		                    pass : 	$('input[name="pass"]').val(),
                        // def : $('select[name="def_faci"]').val(),
		                  },
		                  success: function(data) {
		                    if (data === 'DONE') {
		                        // $("#RAdmin").trigger( "reset" );
		                        // $('#myModal').modal('toggle');
		                        alert('Successfully Added New System User');
		                       window.location.href = "{{asset('employee/dashboard/manage/system_users')}}";
		                    } else if (data == 'SAME') {
		                      $('input[name="uname"]').focus();
		                      showEr();
		                    } else if (data == 'ERROR') {
		                    	$('#AddErrorAlert').show(100);
		                    }
		                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
		                  		console.log(errorThrown);
		                  		$('#AddErrorAlert').show(100);
		                  }
		              });
                  } else {
                  		alert('Password is ' + passSTRMsg + ', please re-type another password.');
                  		$('input[name="pass"]').focus();
                  }
              }
        });
        function showEr(){
          $('#ACCError').empty();
          $('#ACCError').append(
          '<center>'+
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                  '<strong><i class="fas fa-times"></i></strong> <strong>  Username</strong> is already been taken.'+
                '</div>'+
              '</center>'
          );
        }
        function SuccessAdd(){
          // <div class="alert alert-success alert-dismissible fade show" role="alert">
          //     <strong><i class="fas fa-check"></i></strong> Successfully added new Regional Administrator
          //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          //       <span aria-hidden="true">&times;</span>
          //     </button>
          //   </div>
        }
        function showData(id,fname,mname,lname,cntno,rgn,email,accType,posi){
          $('#ViewFname').text(fname.toUpperCase());
          $('#ViewMname').text(mname.toUpperCase());
          $('#ViewLname').text(lname.toUpperCase());
          $('#ViewRegion').text(rgn.toUpperCase());
          $('#ViewEmail').text(email);
          $('#ViewCntNo').text(cntno);
          $('#ViewType').text(accType);
          var AccPosi = (posi == '') ? 'NONE' : posi;
          $('#ViewPosi').text(AccPosi);
        }
        function showIfActive(state,id,fname,mname,lname){
          var title,name,message;
          if (mname != "" || mname != null) {
              mname = mname.charAt(0)+'.';
          }
          name = fname + ' ' + mname + ' ' + lname;
          if (state == 1) {
            title = "Deactivate Account";
            message = "Are you sure you want to deactivate <strong>" + name.toUpperCase() + "</strong> account?";
          } else {
            title = "Reactivate Account";
            message = "Are you sure you want to reactivate <strong>" + name.toUpperCase() + "</strong> account?";
          }
          $('#ifActiveTitle').text(title);
          $('#IfActiveModalBody').empty();
          $('#IfActiveModalBody').append(message+'<span id="ifActiveState" hidden>'+state+'</span><span id="ifActiveID" hidden>'+id+'</span>');
        }
        function ChangeActiveStateNow(){
          var state = $('#ifActiveState').text();
          var id = $('#ifActiveID').text();
          $.ajax({
            url: "{{ asset('/personnel/isActive') }}",
            method: "POST",
            data: {_token:$('input[name="_token"]').val(),isActive:state,id:id},
            success: function(data){
                if (data == 'DONE') {
                    alert('Successfully change state of a Regional Administrator');
                    window.location.href = "{{asset('employee/dashboard/manage/system_users')}}";
                } else if (data == 'ERROR') {
                	$('#ActiveErrorAlert').show(100);
                }
              }, error : function(XMLHttpRequest, textStatus, errorThrown){
              		$('#ActiveErrorAlert').show(100);
              }
          });
        }
        function checkPassword(){
        	var password = $('#ThePassWord').val();
        	var strength = 0;
        	var resultName = '';
        	if (password != "") {
        		if (password.length > 7) strength += 1;
			
				//If password contains both lower and uppercase characters, increase strength value.
				if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1;
				
				//If it has numbers and characters, increase strength value.
				if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 ;
				
				//If it has one special character, increase strength value.
				if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1;
				
				//if it has two special characters, increase strength value.
				if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
				
				
				//Calculated strength value, we can return messages
				//If value is less than 2
				
				if (strength < 2 )
				{
					$('#result').removeClass();
					$('#result').addClass('weak');
					resultName = 'Weak'	;		
				}
				else if (strength == 2 )
				{
					$('#result').removeClass();
					$('#result').addClass('good');
					resultName = 'Good'	;	
				}
				else if (strength == 3) 
				{
					$('#result').removeClass();
					$('#result').addClass('strong');
					resultName = 'Strong';
				} else if (strength > 3) {
					$('#result').removeClass();
					$('#result').addClass('strong');
					resultName = 'Very Strong';
				}

				if (password.length < 6) { 
					$('#result').removeClass();
					$('#result').addClass('short');
					resultName = 'Too short' ;
				}
        	} else {
        		$('#result').removeClass();
        		resultName = '&nbsp;&nbsp;';
        	}
        	$('#passStr').attr('value','');
			$('#result').empty();
	        $('#result').append(resultName);
	        $('#passStr').attr('value',strength);
        }
    </script>
@endsection