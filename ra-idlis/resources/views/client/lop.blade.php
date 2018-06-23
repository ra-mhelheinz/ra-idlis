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
	.close .fa-window-close{
		       transition: transform .3s ease-in-out;
	}
	.fa-window-close:hover{
		       transform: rotate(180deg);
	}
</style>
@include('client.breadcrumb')
		<div class="container" style="margin-top: 2%;">
	  		<div class="card" style="height: 500px;margin-bottom: 2%;">
	  			<div class="card-header text-center">
	  			List Of Personnel &nbsp;<button style="background-color: #28a745" class="btn-primarys"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i>&nbsp;Add Personnel</button>
	  			</div>
	  			<div class="card-body">
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
		 <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header " style="background-color: #28a745;">
          <h4 class="modal-title" style="color: #fff;text-shadow: 2px 2px 4px #000000;">ADD PERSONNEL</h4>
          <button type="button" class="close" data-dismiss="modal"><i class="fa fa-window-close" style="color: #fff;"></i></button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
                          <ul id="tabsJustified" class="nav nav-tabs">
                    <li class="nav-item"><a href="" data-target="#profile" data-toggle="tab" class="nav-link small text-uppercase active">Profile</a></li>
                    <li class="nav-item"><a href="" data-target="#work" data-toggle="tab" class="nav-link small text-uppercase ">Work</a></li>
                    <li class="nav-item"><a href="" data-target="#eligibility" data-toggle="tab" class="nav-link small text-uppercase">Eligibility</a></li>
                    <li class="nav-item"><a href="" data-target="#trainings" data-toggle="tab" class="nav-link small text-uppercase">Trainings</a></li>
                </ul>
                <br>
                <div id="tabsJustifiedContent" class="tab-content">
                    <div id="profile" class="tab-pane fade active show">
                         <form id="contact-form" method="post" role="form">
                         	<div class="container">
				            <div class="row">
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Last Name" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Middle Name" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="First Name" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				            </div>
				            <div class="row">
				            	<div class="col-sm-6">
				                       <input type="date" name="" placeholder="Birthday" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                    </div>
				            	<div class="col-sm-6">
				                        <select style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .55rem .75rem;width: 100%;">
				                        	<option disabled selected hidden>Gender</option>
				                        	<option>Female</option>
				                        	<option>Male</option>
				                        </select>
				            </div>
				        </div>
				        </div>
   						 </form>
                    </div>
                    <div id="work" class="tab-pane fade">
                    	<div class="container">
                       		<div class="row">
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Position" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Department" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Section" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				            </div>
				             <div class="row">
				            	<div class="col-sm-6"><input type="date" name="" placeholder="Assigned Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;"></div>
								<div class="col-sm-6"><input type="date" name="" placeholder="End Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;"></div>
				        </div>
				        </div>
                    </div>
                    <div id="eligibility" class="tab-pane fade">
                    	<div class="container">
                    		<div class="row">
                    			<div class="col-sm-3"></div>
                    			<div class="col-sm-6">
                    				<input type="text" name="" placeholder="PRC ID" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                    <input type="date" name="" placeholder="Expiration/Validity Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div style="margin-top: 5%;margin-bottom: 5%;"></div>
				                        <div class="text-center"><button style="background-color:#28a745 ; " class="btn-primarys" onclick="add()"><i class="fa fa-plus-circle" ></i> Add Others</button> <button class="btn-primarys" onclick="removeClone()"><i class="fa fa-undo"></i>Reset</button></div>
				                        <br>	
				                        <div id="other">
				                        	<div id="cloneOther">
							                    <input type="text" name="" placeholder="Other Licensed ID" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							                    <input type="date" name="" placeholder="Licensed ID Expiration Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							                    <hr>
							                </div>
				                        </div>
													<script>
															var i = 0;
															var i_last = 0;
															var original = document.getElementById('cloneOther');
															var cloneother = document.getElementById('other');

															function add() {
															    var clone = original.cloneNode(true); // "deep" clone
															    clone.id = 'clone' + i;
															    clone.classList.add("removeClone");
															    // or clone.id = ""; if the divs don't need an ID
															    cloneother.appendChild(clone);
															    i++;
															}
															function removeClone(){
																for(j = i_last; j < i; j++){
																	document.getElementById('other').removeChild(document.getElementById('clone' + j));
																}
																i_last = i;
															}
													</script>
                    			</div>
                    			<div class="col-sm-3"></div>
                    		</div>
                    	</div>
                    </div>
                    <div id="trainings" class="tab-pane fade">
                         	<div class="container">
                       		<div class="row">
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="School Graduated" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Year Graduated" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				                <div class="col-sm-4">
				                    <div class="form-group">
				                        <input type="text" name="" placeholder="Course" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
				                        <div class="help-block with-errors"></div>
				                    </div>
				                </div>
				            </div>
				             <div class="row">
				            	<div class="col-sm-12"><input type="text" name="" placeholder="Masteral School" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;"></div>
								<div class="col-sm-12"><input type="text" name="" placeholder="Masteral Course" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;"></div>
				               <div class="col-sm-12"><input type="text" name="" placeholder="Year Graduated" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;"></div> 

				        </div>
				        <br>
				        <div class="text-center"><button style="background-color:#28a745 ; " class="btn-primarys" onclick="add()"><i class="fa fa-plus-circle" ></i> Add Others</button> <button class="btn-primarys" onclick="removeClone()"><i class="fa fa-undo"></i>Reset</button></div>
				        <br>
				        <div id="other">
				          	<div id="cloneOther">
							     <input type="text" name="" placeholder="School" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							     <input type="text" name="" placeholder="Training" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							     <input type="date" name="" placeholder="Date" style="border-radius:0;border: 0;border-bottom: 1px solid #b5c1c9;outline: 0;padding: .375rem .75rem;width: 100%;">
							     <hr>
							 </div>
				        </div>
				        </div>
                    </div>
                </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn-defaults" style="color: #fff;background-color: #28a745;"><i class="fa fa-floppy-o" ></i> Save</button>
           <button type="button" class="btn-defaults" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
        
      </div>
    </div>
	</div>
{{-- 	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
		
	</script> --}}
@include('client.sitemap')
@endsection