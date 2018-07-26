@extends('main')
 <link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/service.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/engine1/style.css')}}" />
<script type="text/javascript" src="{{asset('ra-idlis/public/engine1/jquery.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@section('content')
<style type="text/css">

  input[type=file]{
    width:90px;
    color:transparent;
}
</style>
@include('client.nav')
<div class="container jumbotron" style="background-color: #fff;">
  <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                 <th>Salary</th>
            </tr>
        </thead>
        <tbody>
          @for($i=0;$i<10;$i++)
          <tr>
            <td>{{ $i }}</td>
            <td>Si</td>
            <td>paolo</td>
            <td>kay</td>
            <td>gwapo</td>
            <td>kaayo</td>
            <td>OMG!</td>
          </tr>
          @endfor
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>

</div>
<script type="text/javascript">
//   window.pressed = function(){
//     var a = document.getElementById('aa');
//     if(a.value == "")
//     {
//         fileLabel.innerHTML = "Choose file";
//     }
//     else
//     {
//         var theSplit = a.value.split('\\');
//         fileLabel.innerHTML = theSplit[theSplit.length-1];
//     }
// };
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
  @include('client.sitemap')
@endsection
