@if (session()->exists('employee_login'))
    @php
     $employeeData = session('employee_login');
   @endphp
@endif
<input type="hidden" id="global-token" value="{{ Session::token() }}" />
<nav class="navbar navbar-expand navbar-dark bg-primary">
        <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
        <a class="navbar-brand" href="#">
            @if ($employeeData->grpid == 'NA')
                National Admin
            @endif
            @if ($employeeData->grpid == 'RA')
                Regional Head, {{$employeeData->rgn_desc}}
            @endif
            @if ($employeeData->grpid == 'LO')
                Licensing Officer, {{$employeeData->rgn_desc}}
            @endif
            @if ($employeeData->grpid == 'FDA')
                FDA Officer, {{$employeeData->rgn_desc}}
            @endif
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item S01_allow dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i>1</a>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 300px;background-color: transparent;border: 0;">
                            <ul class="list-group" style="margin: 0;padding: 0;">
                                  <a class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h5 class="mb-1">John Smith</h5>
                                      <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                    <small>01/01/2018</small>
                                </a>
                              <a class="list-group-item list-group-item-action">
                                  <div class="d-flex w-100 justify-content-between">
                                  <h5 class="mb-1">Kevin Hart</h5>
                                  <small>3 days ago</small>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                <small>01/01/2018</small>
                              </a>
                              <a class="list-group-item list-group-item-action">
                                     <div class="d-flex w-100 justify-content-between">
                                          <h5 class="mb-1">Ice Cube</h5>
                                          <small>3 days ago</small>
                                        </div>
                                        <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                        <small>01/01/2018</small>
                              </a>
                            </ul>
                    </div>
                </li>
                <li class="nav-item S02_allow"><a href="#" class="nav-link "><i class="fa fa-bell"></i>1</a></li>
                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> @if ($employeeData->grpid != 'NA')
                        {{$employeeData->name}}
                    @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        <a href="#" class="dropdown-item S03_allow">Settings</a>
                        <a href="#" class="dropdown-item S03_allow">Activity Logs</a>
                        <a href="#" data-toggle="modal" data-target="#ChgPass" class="dropdown-item S03_allow">Change Password</a>

                        <a href="#" onclick="event.preventDefault();document.getElementById('employeeLogout').submit();" class="dropdown-item">Logout</a>
                        <form id="employeeLogout" action="{{asset('/employee/logout')}}" method="POST" hidden>
                        @csrf
                      </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
       <div class="d-flex">
        <div class="sidebar sidebar-dark bg-dark">
            <ul class="list-unstyled">
                <li class="S04_allow"><a href="{{asset('/employee/dashboard')}}"><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard</a></li>
                @if ($employeeData->grpid == 'NA')
                   <li>
                    <a href="#sm_base" data-toggle="collapse">
                        <i class="fa fa-fw fa-wrench"></i> Master File
                    </a>
                    <ul id="sm_base" class="list-unstyled collapse">
                        <li><a href="#AppMenu" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-clipboard-list"></i>&nbsp;Application</a>
                            <ul id="AppMenu" class="list-unstyled collapse">
                                <li class="MA07_allow"><a href="{{ asset('/employee/dashboard/mf/apptype') }}">&nbsp;&nbsp;&nbsp;&nbsp;Application Type</a></li>
                                <li class="MA08_allow"><a href="{{ asset('/employee/dashboard/mf/class') }}">&nbsp;&nbsp;&nbsp;&nbsp;Class</a></li>
                                <li class="MA06_allow"><a href="{{ asset('/employee/dashboard/mf/ownership') }}">&nbsp;&nbsp;&nbsp;&nbsp;Ownership</a></li>
                                <li class="MA05_allow"><a href="{{ asset('/employee/dashboard/mf/facility') }}">&nbsp;&nbsp;&nbsp;&nbsp;Facility Type</a></li>
                                <li class=""><a href="{{ asset('/employee/dashboard/mf/uploads') }}">&nbsp;&nbsp;&nbsp;&nbsp;Uploads</a></li>
                            </ul>
                        </li>
                        <li><a href="#PersoMenu" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-users"></i>&nbsp;Personnel</a>
                            <ul id="PersoMenu" class="list-unstyled collapse">
                                <li class=""><a href="{{ asset('/employee/dashboard/mf/department') }}">&nbsp;&nbsp;&nbsp;&nbsp;Department</a></li>
                                <li class=""><a href="{{-- {{ asset('/employee/dashboard/mf/litype') }} --}}">&nbsp;&nbsp;&nbsp;&nbsp;Section</a></li>
                                <li class=""><a href="{{-- {{ asset('/employee/dashboard/mf/litype') }} --}}#">&nbsp;&nbsp;&nbsp;&nbsp;Personnel</a></li>
                                <li class=""><a href="{{-- {{ asset('/employee/dashboard/mf/litype') }} --}}#">&nbsp;&nbsp;&nbsp;&nbsp;Education/Trainings</a></li>
                                <li class=""><a href="{{ asset('/employee/dashboard/mf/work') }}">&nbsp;&nbsp;&nbsp;&nbsp;Work</a></li>
                                <li class=""><a href="{{ asset('/employee/dashboard/mf/work_status') }}">&nbsp;&nbsp;&nbsp;&nbsp;Work Status</a></li>
                                <li class=""><a href="{{-- {{ asset('/employee/dashboard/mf/litype') }} --}}#">&nbsp;&nbsp;&nbsp;&nbsp;Eligibility</a></li>
                                <li class=""><a href="{{ asset('/employee/dashboard/mf/litype') }}">&nbsp;&nbsp;&nbsp;&nbsp;License Type</a></li>
                                <li class=""><a href="{{ asset('/employee/dashboard/mf/training') }}">&nbsp;&nbsp;&nbsp;&nbsp;Training Type</a></li>
                            </ul>
                        </li>
                        <li><a href="#phil" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-flag"></i>&nbsp;Places</a>
                            <ul id="phil" class="list-unstyled collapse">
                                <li class="MA01_allow"><a href="{{ asset('/employee/dashboard/ph/regions') }}">&nbsp;&nbsp;&nbsp;&nbsp;Regions</a></li>
                                <li class="MA02_allow"><a href="{{ asset('/employee/dashboard/ph/provinces') }}">&nbsp;&nbsp;&nbsp;&nbsp;Provinces</a></li>
                                <li class="MA03_allow"><a href="{{ asset('/employee/dashboard/ph/citymuni') }}">&nbsp;&nbsp;&nbsp;&nbsp;City/Municipalities</a></li>
                                <li class="MA04_allow"><a href="{{ asset('/employee/dashboard/ph/barangay') }}">&nbsp;&nbsp;&nbsp;&nbsp;Barangay</a></li>
                            </ul>
                        </li>
                        <li><a href="#AssMenu" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-tasks"></i>&nbsp;Assessment</a>
                            <ul id="AssMenu" class="list-unstyled collapse">
                                <li class=""><a href="{{ asset('/employee/dashboard/mf/assessment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Assessment</a></li>
                                <li class=""><a href="{{ asset('/employee/dashboard/mf/part') }}">&nbsp;&nbsp;&nbsp;&nbsp;Part</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
                <li><a href="#ProFlowMenu" data-toggle="collapse"><i class="fa fa-sitemap"></i> Process Flow</a>
                    <ul id="ProFlowMenu" class="list-unstyled collapse">
<<<<<<< HEAD
                        <li class=""><a href="{{-- {{asset('employee/dashboard/personnel/regional')} --}}#">&nbsp;&nbsp;&nbsp;&nbsp;View Applications</a></li>
=======
                        <li class=""><a href="{{asset('/employee/dashboard/lps')}}">&nbsp;&nbsp;&nbsp;&nbsp;View Applications</a></li>
>>>>>>> 145ff8616a64037725847e5e2e8719e9767c6d18
                        <li class=""><a href="{{-- {{asset('employee/dashboard/personnel/regional')} --}}">&nbsp;&nbsp;&nbsp;&nbsp;Evaluate Application</a></li>
                        <li class=""><a href="{{-- {{asset('employee/dashboard/personnel/regional')} --}}">&nbsp;&nbsp;&nbsp;&nbsp;Assessment</a></li>
                        <li class=""><a href="{{-- {{asset('employee/dashboard/personnel/regional')} --}}">&nbsp;&nbsp;&nbsp;&nbsp;Approval/Issue Certificate</a></li>
                        <li class=""><a href="{{-- {{asset('employee/dashboard/personnel/regional')} --}}">&nbsp;&nbsp;&nbsp;&nbsp;Failed Applications</a></li>
                    </ul>
                </li>
                <li><a href="#" ><i class="fa fa-chart-bar"></i> Report</a></li>                
                <li>
                    <a href="#ManMenu" data-toggle="collapse"><i class="fas fa-fw fa-cog"></i> Manage</a>
                        <ul id="ManMenu" class="list-unstyled collapse">
                            @if ($employeeData->grpid == 'NA')
                            <li>
                                <a href="{{asset('employee/dashboard/grouprights')}}"><i class="fa fa-fw fa-check"></i> Group Rights</a>
                            </li>
                            @endif
                            <li><a href="{{-- {{asset('/employee/personnel')}} --}}#perso" data-toggle="collapse"><i class="fa fa-fw fa-users"></i> Users
                                </a>
                                    <ul id="perso" class="list-unstyled collapse">
                                        <li class="UG01_allow"><a href="{{asset('employee/dashboard/personnel/regional')}}">&nbsp;&nbsp;&nbsp;&nbsp;Regional Admins</a></li>
                                        <li class="UG02_allow"><a href="{{asset('employee/dashboard/personnel/fda')}}">&nbsp;&nbsp;&nbsp;&nbsp;Food and Drug Authority</a></li>
                                            <li class="UG03_allow"><a href="{{asset('employee/dashboard/personnel/lo')}}">&nbsp;&nbsp;&nbsp;&nbsp;Licensing Officers</a></li>
                                    </ul>
                                </li>
                        </ul>
                </li>
                <li hidden><a href="{{asset('/employee/dashboard/lps')}}"><i class="fa fa-fw fa-spinner"></i> Licensing Process Status</a></li>
            </ul>
        </div>
    <div class="modal fade" id="ChgPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body text-justify" style=" background-color: #272b30;
            color: white;">
                <h5 class="modal-title text-center"><strong>Change Password</strong></h5>
                <hr>
                <div class="container">
                  <form id="ChgPass_form" class="row"  data-parsley-validate>
                    {{ csrf_field() }}
                    <div class="col-sm-4">New Password:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_pass" data-parsley-required-message="*<strong>New Password</strong> required"  class="form-control"  required>
                    </div>
                    <div class="col-sm-12">
                          <div class="row">
                              <div class="col-sm-6">
                                  <button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
                              </div>
                              <div class="col-sm-6">
                              <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                            </div>
                          </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
                        </div>
                        <div class="col-sm-12">
                          <button type="button" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                        </div>
                    </div>  --}}
                  </form>
               </div>
              </div>
            </div>
          </div>
    </div>
<script type="text/javascript">
    $(document).ready(
        function(){
            Right_GG();
        });
    function Right_GG(){
        var CurrentPage = $('#CurrentPage').val();
        $.ajax({
                  url: " {{asset('employee/getRights')}}",
                  data : {_token: $('#global-token').val()},
                  method: 'POST',
                  success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var moduleSelected = data[i];
                        if (moduleSelected.mod_id == CurrentPage) {
                            if (moduleSelected.allow == "0") {
                                window.location.href = "{{asset('employee/dashboard')}}";
                            }
                        }
                        if (moduleSelected.ad_d == "0") {
                            $('.'+moduleSelected.mod_id+'_add').empty();
                        }
                        if (moduleSelected.cancel == "0") {
                            $('.'+moduleSelected.mod_id+'_cancel').empty();
                        }
                        if (moduleSelected.print == "0") {
                            $('.'+moduleSelected.mod_id+'_print').empty();
                        }
                        if (moduleSelected.allow == "0") {
                            $('.'+moduleSelected.mod_id+'_allow').empty();
                        }
                        if (moduleSelected.upd == "0") {
                            $('.'+moduleSelected.mod_id+'_update').empty();
                        }
                        if (moduleSelected.view == "0") {
                            $('.'+moduleSelected.mod_id+'_view').empty();
                        }
                    }
                  }
              });
    }
</script>