@extends('main')
@section('content')
@include('client.nav')
@if (session()->exists('client_data'))
   @php
     $clientData = session('client_data');
   @endphp
@else
  <script type="text/javascript">
    window.location.href = "{{asset('/')}}";
  </script>
@endif
<style type="text/css">
	table.attachments > tr{
		width: 50%;
			}
			table.attachments > td {
				padding: 1em;
			}
</style>
	
	<div class="container jumbotron" style="margin-top: 2em;">
		<div class="container" style="display: block;">
			<button  class="btn btn-success" style="float:right;" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i> Add Personnel</button>
		</div>
		<div class="jumbotron container" style="background-color: #fff;box-shadow: 10px 10px 15px rgba(73, 78, 92, 0.1);">
			

			<h4 style="border-bottom: 1px solid green;padding-bottom: 9px;position: relative;text-align:center"><strong>List of Personnel</strong><span style=" background: lightgreen none repeat scroll 0 0;bottom: -2px;height: 3px;left: 0;position: absolute;width: 75px;"></span></h4>
	  		<div class="container">
	  			<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Juan Dela Cruz</td>
							<td>Gynecologist</td>
							<td>
								<button class="btn btn-info"><i class="fa fa-eye"></i></button>
							</td>
						</tr>
					</tbody>
				</table>
	  		</div>
		</div>
	</div>
	
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content" style="border-radius: 0px;border: none;">
	      <div class="modal-body text-justify" style=" background-color: #0f8845;
	    color: white;">
	        <h5 class="modal-title" id="exampleModalLongTitle"><strong>Add Personnel</strong></h5>
	        <hr>
	        <form action="#">
	        	<ul class="nav nav-tabs">
				  <li class="nav-item">
				    <a class="TAB_BTN nav-link active" linkedtab="profile_tab"  href="#">Profile</a>
				  </li>
				  <li class="nav-item">
				    <a class="TAB_BTN nav-link" linkedtab="work_tab"  href="#">Work</a>
				  </li>
				  <li class="nav-item">
				    <a class="TAB_BTN nav-link" linkedtab="eligiblity_tab" href="#">Eligibility</a>
				  </li>
				  <li class="nav-item">
				    <a class="TAB_BTN nav-link" linkedtab="trainings_tab" href="#">Trainings</a>
				  </li>
				</ul>
	        	<span class="tab_cont" id="profile_tab" style="">
	        		<div class="row">
		        		<div class="col-sm-6">Last Name:</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-12">
			        		<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-6">First Name:</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-12">
			        		<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-6">Middle Name:</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-12">
			        		<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
		        	</div>
		        	<!--  -->
		        	<div class="row">
		        		<div class="col-sm-6">Birthday:</div>
		        		<div class="col-sm-6">Gender:</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-6">
			        		<input type="date" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
			        	<div class="col-sm-6">
			        		<select class="form-control">
			        			<option>Male</option>
			        			<option>Female</option>
			        		</select>
			        	</div>
		        	</div>
	        	</span>
	        	<span class="tab_cont" id="work_tab" style="display: none">
	        		<div class="row">
		        		<div class="col-sm-6">Position:</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-12">
			        		<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-6">Department:</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-12">
			        		<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-6">Section:</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-12">
			        		<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-6">Assigned Date :</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-12">
			        		<input type="date" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-6">End Date (Optional): </div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-12">
			        		<input type="date" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
		        	</div>
	        	</span>
	        	<span class="tab_cont" id="eligiblity_tab" style="display: none">
	        		<div class="row">
		        		<div class="col-sm-6">PRC ID: </div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-12">
			        		<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-6">Expiration/Validity Date: </div>
		        	</div>
		        	<div class="row">
		        		<div class="col-sm-12">
			        		<input type="date" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
			        	</div>
		        	</div>
		        	<hr>
		        	<div class="row">
		        		<div class="col-sm-12">
		        			<center><button type="button" onclick="addEligi();" class="btn btn-info">Add Others</button></center>
		        			<br>
		        		</div>
		        	</div>
		        	<span id="elig_others">
		        		
		        	</span>
	        	</span>
	        	<span class="tab_cont" id="trainings_tab" style="display: none">
	        		<div class="row">
			        	<div class="col-sm-6">School Graduated : </div>
			        </div>
		        	<div class="row">
			        	<div class="col-sm-12">
				        	<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
				        </div>
			        </div>
			        <div class="row">
			        	<div class="col-sm-6">Year Graduated : </div>
			        </div>
		        	<div class="row">
			        	<div class="col-sm-12">
				        	<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
				        </div>
			        </div>
			        <div class="row">
			        	<div class="col-sm-6">Course : </div>
			        </div>
		        	<div class="row">
			        	<div class="col-sm-12">
				        	<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
				        </div>
			        </div>
			        <div class="row">
			        	<div class="col-sm-6">Masteral School : </div>
			        </div>
		        	<div class="row">
			        	<div class="col-sm-12">
				        	<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
				        </div>
			        </div>
			        <div class="row">
			        	<div class="col-sm-6">Masteral Course : </div>
			        </div>
		        	<div class="row">
			        	<div class="col-sm-12">
				        	<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
				        </div>
			        </div>
			        <div class="row">
			        	<div class="col-sm-6">Year Graduated : </div>
			        </div>
		        	<div class="row">
			        	<div class="col-sm-12">
				        	<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">
				        </div>
			        </div>
			        <hr>
		        	<div class="row">
		        		<div class="col-sm-12">
		        			<center><button type="button" onclick="addTrain()" class="btn btn-info">Add Others</button></center>
		        			<br>
		        		</div>
		        	</div>
		        	<span id="train_others">
		        	</span>
	        	</span>
	        	<hr style="color:white">
			    	<span style="float:right">
			    		<button type="submit" class="btn btn-success">Save</button>
			    		<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			    	</span>
			  </form>
	      </div>
	      
	    </div>
	    
	  </div>
	</div>
	<script type="text/javascript">
		var eligi_cout = 0,tra_count = 0;
		$('.TAB_BTN').on('click',function(){
			var ifHas = $(this).hasClass('active');
			if (ifHas == false) {
				$(this).addClass('active');
				$('a.TAB_BTN').not(this).removeClass('active');
				var getLinked = $(this).attr('linkedtab');
				$('.tab_cont').hide();
				$('#'+getLinked).show();
			}
		});
		function addEligi(){
			$('#elig_others').append(
				'<span id="eligi_'+eligi_cout+'"><hr>' +
					'<div class="row">' +
				        		'<div class="col-sm-6">Other Licensed ID :</div>' +
				    '</div>' +
			       	'<div class="row">' +
				        	'<div class="col-sm-12">' +
					        	'<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">' +
					        '</div>' +
				    '</div>' +
				    '<div class="row">' +
				       	'<div class="col-sm-6">Other Licensed ID Expiration Date : </div>'+
				    '</div>'+
			        '<div class="row">'+
				        '<div class="col-sm-12">'+
					        '<input type="date" name="fname" class="form-control"  style="margin:0 0 .8em 0;">'+
					    '</div>'+
				    '</div>' +
				    '<div class="row">' +
				    	'<div class="col-sm-12">'+
				    		'<center><button type="button" onclick="$(\'#eligi_'+eligi_cout+'\').remove()" class="btn btn-danger">Delete</button></center><br>' +
				    		'</div>'+
				    '</div>' +
			    '<hr></span>'
			);
			eligi_cout++;
		}
		function addTrain(){
			$('#train_others').append(
				'<span id="tra_'+tra_count+'"><hr>' +
				'<div class="row">' +
			        		'<div class="col-sm-6">School :</div>' +
			        	'</div>' +
		        		'<div class="row">'+
			        		'<div class="col-sm-12">'+
				        		'<input type="text" name="fname" class="form-control"  style="margin:0 0 .8em 0;">'+
				        	'</div>'+
			        	'</div>'+
			        	'<div class="row">'+
			        		'<div class="col-sm-6">Training: </div>'+
			        	'</div>'+
		        		'<div class="row">'+
			        		'<div class="col-sm-12">'+
				        		'<input type="name" name="fname" class="form-control"  style="margin:0 0 .8em 0;">'+
				        	'</div>'+
			        	'</div>'+
			        	'<div class="row">'+
			        		'<div class="col-sm-6">Date: </div>'+
			        	'</div>' +
		        		'<div class="row">' +
			        		'<div class="col-sm-12">' +
				        		'<input type="date" name="fname" class="form-control"  style="margin:0 0 .8em 0;">'+
				        	'</div>' +
			        	'</div>' +
			        	'<div class="row">' +
				    	'<div class="col-sm-12">'+
				    		'<center><button type="button" onclick="$(\'#tra_'+tra_count+'\').remove()" class="btn btn-danger">Delete</button></center><br>' +
				    		'</div>'+
				    '</div>' +
			    '<hr></span>'
			);
		}
		
	</script>
@endsection