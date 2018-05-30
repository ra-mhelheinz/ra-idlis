@extends('main')
@section('content')
@include('client.nav')
<div class="jumbotron container" style="margin-top: 2em;box-shadow: 10px 10px 15px rgba(73, 78, 92, 0.1);background-color: #fff">
		<div class="container">
			<div class="table-responsive">
				<table class="table table-borderless">
					<thead>
						<tr>
							<td width="80%">
								<h2>ABC Hospital</h2>
								<h4>Rizal St. Manila</h4>
							</td>
							<td>
								<center><h4>DOH Evaluation Status</h4></center>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td >
								<font>
									1. Acknowledgement (Notarized)
								</font>
							</td>
							<td>
								<center>
									
									<button type="button" class="btn btn-success">
										<i class="fa fa-check" aria-hidden="true"></i>
									</button>
								</center>
							</td>
						</tr>
						<!-- //// -->
						<tr>
							<td >
								<font>
									2. List of Personnel
								</font>
							</td>
							<td>
								<center>
									
									<button type="button" class="btn btn-success">
										<i class="fa fa-check" aria-hidden="true"></i>
									</button>
								</center>
							</td>
						</tr>
						<!-- /// -->
						<tr>
							<td >
								<font>
									3. List of Equipment/Instrument
								</font>
							</td>
							<td>
								<center>
									
									<button type="button" class="btn btn-success">
										<i class="fa fa-check" aria-hidden="true"></i>
									</button>
								</center>
							</td>
						</tr>
						<!-- /// -->
						<tr>
							<td >
								<font>
									4. List of Ancillary Services
								</font>
							</td>
							<td>
								<center>
									
									<button type="button" class="btn btn-success">
										<i class="fa fa-check" aria-hidden="true"></i>
									</button>
								</center>
							</td>
						</tr>
						<!-- /// -->
						<tr>
							<td >
								<font>
									5. Application Form (for Medical X-ray)
								</font>
							</td>
							<td>
								<center>
									
									<button type="button" class="btn btn-success">
										<i class="fa fa-check" aria-hidden="true"></i>
									</button>
								</center>
							</td>
						</tr>
						<!-- /// -->
						<tr>
							<td >
								<font>
									6. Application Form (Hospital Pharmacy)
								</font>
							</td>
							<td>
								<center>
									
									<button type="button" class="btn btn-success">
										<i class="fa fa-check" aria-hidden="true"></i>
									</button>
								</center>
							</td>
						</tr>
						<!-- /// -->
						<tr>
							<td >
								<font>
									7. Geographic Form (Location Map)
								</font>
							</td>
							<td>
								<center>
									
									<button type="button" class="btn btn-success">
										<i class="fa fa-check" aria-hidden="true"></i>
									</button>
								</center>
							</td>
						</tr>
						<!-- /// -->
						<tr>
							<td >
								<font>
									8. Photographs of exterior & interior of facility
								</font>
							</td>
							<td>
								<center>
									
									<button type="button" class="btn btn-success">
										<i class="fa fa-check" aria-hidden="true"></i>
									</button>
								</center>
							</td>
						</tr>
						<!-- /// -->
						<tr>
							<td >
								<font>
									9. Annual Statistical Reports
								</font>
							</td>
							<td>
								<center>
									
									<button type="button" class="btn btn-success">
										<i class="fa fa-check" aria-hidden="true"></i>
									</button>
								</center>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<hr>
				<div class="row">
					<div class="col-sm-6" >
							<label>Recommended for Inspection:</label>
							<!-- data-toggle="modal" data-target="#exampleModalCenter" -->
							<strong><label style="color:green;">&nbsp;Yes</label></strong>
							<a href="" style="text-decoration: none;">View payment</a>
					</div>	
					<div class="col-sm-6">
						<span>
							<label class="form-inline">Proposed Date of Inspection:
							<strong><label style="color:green;">&nbsp;May 05, 2018</label></strong>
						</span>
					</div>		
				</div>
		</div>	
	</div>
	<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content" style="border-radius: 0px;border: none;">
	      <div class="modal-body">
	        <div>
	        	<h6 class="modal-title text-center" id="exampleModalLongTitle"><strong>Republic of the Philippines</strong></h6>
	        </div>
	        <hr>
	        <center><h6>Order of Payment</h6></center>
	        <div class="modal-footer">
		    	<button type="button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Ok</button>
		    	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Close</button>
		    </div>
	      </div>
	    </div>
	  </div>
	</div>
@endsection