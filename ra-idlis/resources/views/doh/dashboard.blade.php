@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/fullcalendar.min.css')}}">
    <script type="text/javascript" src="{{ asset('ra-idlis/public/js/fullcalendar.min.js') }}"></script>
@endsection
@section('content')
  <input type="" id="token" value="{{ Session::token() }}" hidden>
<div class="content p-4">
    <h2 class="mb-4">Dashboard</h2>

    <div class="flex-grow-1 bg-white p-4">

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-white font-weight-bold">
                      Application Status
                    </div>
                    <div class="card-body">
                        <div  class="table-responsive"  id="chart_div_3" style="width: 100%; height: auto;">
                            <table id="displayTable" class="table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">Type</th>
                                        <th class="text-center" scope="col">Code</th>
                                        <th class="text-center" scope="col">Name Facility</th>
                                        <th class="text-center" scope="col">Facility Type</th>
                                        @if(isset($grpid) && $grpid == 'LO')
                                            <th class="text-center" scope="col">Deadline of Inspection</th>
                                        @endif
                                        <th class="text-center" scope="col">&nbsp;</th>
                                        <th class="text-center" scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($BigData)
                                        @foreach ($BigData as $d)
                                            <tr>
                                                <td class="text-center">{{$d->hfser_id}}</td>
                                                <td class="text-center">{{$d->hfser_id}}R{{$d->rgnid}}-{{$d->appid}}</td>
                                                <td class="text-center font-weight-bold">{{$d->facilityname}}</td>
                                                <td class="text-center">{{$d->facname}}</td>
                                                @if(isset($grpid) && $grpid == 'LO')
                                                    @isset($d->proposedInspectiondate) 
                                                        <td class="text-center font-weight-bold" style="color:{{$d->checkInspectDate}}">{{$d->formattedDateInspection}}</td> {{-- Recommended Date of Inspection --}}
                                                    @else
                                                        <td class="text-center font-weight-bold">Not yet Added</td>
                                                    @endisset
                                                @endif
                                                <td class="text-center">{{$d->aptdesc}}</td>
                                                <td class="text-center" style="background-color: @isset($d->statColor){{$d->statColor}}@endisset;color: white;font-weight: bold;text-shadow: 2px 2px 4px #000000">
                                                    {{$d->trns_desc}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-white font-weight-bold">
                        Calendar
                    </div>
                    <div class="card-body" style="">
                        <div id="CalendarMode" style="width: 100%; height: auto;">
            
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

    
    </div>
</div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#displayTable').DataTable();

            // $('#CalendarMode').fullCalendar({
            //     themeSystem: 'bootstrap4',
            //     aspectRatio: 1.5,
            //     eventSources: [
            //         // your event source
            //         {
            //           url: '{{ asset('/mf/getCalendarEvents') }}',
            //           type: 'POST',
            //           data: {
            //             _token: $('#token').val()
            //           },
            //           error: function() {
            //               $('#CalendarFetchAlertError').show(100);
            //           },
            //           color: 'yellow',   // a non-ajax option
            //           textColor: 'black' // a non-ajax option
            //         },

            //         {
            //           url: '{{ asset('/mf/getCalendarEvents2') }}',
            //           type: 'POST',
            //           data: {
            //             _token: $('#token').val()
            //           },
            //           error: function() {
            //               $('#CalendarFetchAlertError').show(100);
            //           },
            //           color: 'green',   // a non-ajax option
            //           textColor: 'white' // a non-ajax option
            //         }
            //       ],
            //       eventRender: function(eventObj, $el) {
            //           $el.popover({
            //             title: eventObj.hdy_typ + ' Holiday',
            //             content: eventObj.title,
            //             trigger: 'hover',
            //             placement: 'top',
            //             container: 'body'
            //           });
            //         },
            //         eventColor: '#378006',
            //  });
        });
    </script>
@endsection