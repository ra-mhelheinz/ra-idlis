@if (session()->exists('employee_login'))
    @php
     $employeeData = session('employee_login');
   @endphp
@endif
<nav class="navbar navbar-expand navbar-dark bg-primary">
        <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
        <a class="navbar-brand" href="#">
            @if ($employeeData->grpid == 'NA')
                National Admin
            @endif
            @if ($employeeData->grpid == 'RA')
                Regional Head, {{$employeeData->rgnid}}
            @endif
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-envelope"></i> 5</a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bell"></i> 3</a></li>
                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> @if ($employeeData->grpid != 'NA')
                        {{$employeeData->name}}
                    @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        @if ($employeeData->grpid != 'NA')
                        <a href="#" class="dropdown-item">Profile</a>
                        @endif
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
                <li><a href="{{asset('/employee/dashboard')}}"><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard</a></li>
                @if ($employeeData->grpid == 'NA')
                   <li>
                    <a href="#sm_base" data-toggle="collapse">
                        <i class="fa fa-fw fa-wrench"></i> Master File
                    </a>
                    <ul id="sm_base" class="list-unstyled collapse">
                        <li><a href="#lpro" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-tasks"></i>&nbsp;Licensing Process</a>
                            <ul id="lpro" class="list-unstyled collapse">
                                <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;Application Type</a></li>
                                <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;Class</a></li>
                                <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;Facility</a></li>
                                <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;Ownership</a></li>
                            </ul>
                        </li>
                        <li><a href="#phil" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-flag"></i>&nbsp;Philippines</a>
                            <ul id="phil" class="list-unstyled collapse">
                                <li><a href="{{ asset('/employee/dashboard/ph/regions') }}">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-area-chart"></i>&nbsp;Regions</a></li>
                                <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;Provinces</a></li>
                                <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;City/Municipalities</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="{{asset('employee/dashboard/grouprights')}}"><i class="fa fa-fw fa-check"></i> Group Rights</a>
                </li>
                @endif
                <li><a href="{{-- {{asset('/employee/personnel')}} --}}#perso" data-toggle="collapse"><i class="fa fa-fw fa-users"></i> Personnel</a>
                    <ul id="perso" class="list-unstyled collapse">
                        @if ($employeeData->grpid == 'NA')
                            <li><a href="{{asset('employee/dashboard/personnel/regional')}}">&nbsp;&nbsp;Regional Admins</a></li>
                        @endif
                        <li><a href="{{asset('employee/dashboard/personnel/lo')}}">&nbsp;&nbsp;Licensing Officers</a></li>
                    </ul>
                </li>
                <li><a href="{{-- {{asset('/headprocess')}} --}}#"><i class="fa fa-fw fa-spinner"></i> Licensing Process Status</a></li>
                {{-- <li><a href="{{asset('/LOaccount')}}"><i class="fa fa-fw fa-eye"></i> LO Account</a></li> --}}
<!--                 <li><a href=""><i class="fa fa-fw fa-edit"></i> Forms</a></li>
                <li><a href=""><i class="fa fa-fw fa-table"></i> Datatables</a></li>
                <li><a href=""><i class="fa fa-fw fa-address-card"></i> Cards</a></li>
                <li><a href=""><i class="fa fa-fw fa-calendar-alt"></i> Calendar</a></li>
                <li><a href=""><i class="fa fa-fw fa-chart-pie"></i> Charts</a></li>
                <li><a href=""><i class="fa fa-fw fa-map-marker-alt"></i> Maps</a></li>
                <li>
                    <a href="#sm_examples" data-toggle="collapse">
                        <i class="fa fa-fw fa-lightbulb"></i> Examples
                    </a>
                    <ul id="sm_examples" class="list-unstyled collapse">
                        <li><a href="">Blank/Starter</a></li>
                        <li><a href="">Pricing</a></li>
                        <li><a href="">Invoice</a></li>
                        <li><a href="">FAQ</a></li>
                        <li><a href="">Login</a></li>
                    </ul>
                </li>
                <li><a href=""><i class="fa fa-fw fa-book"></i> Documentation</a></li> -->
            </ul>
        </div>