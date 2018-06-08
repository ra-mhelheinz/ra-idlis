@extends('main3')
@section('style')
    <link rel="stylesheet" href="{{asset('ra-idlis/public/css/css/bootadmin.min.css')}}">
@endsection
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Group Rights <a href="" title="Add New" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>  
        </div>
        <div class="card-body">
          <div style="float:left;margin-bottom: 5px">
            <form class="form-inline">
              <label>Filter : &nbsp;</label>
              <input type="text" class="form-control" id="filterer" list="grp_list" onchange="filterGroup()" placeholder="Group List">
              <datalist id="grp_list">
                @foreach ($groups as $group)
                  <option value="{{$group->grp_id}}">{{$group->grp_desc}}</option>
                @endforeach
              </datalist>
              <datalist id="mod_list">
                @foreach ($modules as $module)
                  <option value="{{$module->mod_id}}">{{$module->mod_desc}}</option>
                @endforeach
              </datalist>
              &nbsp;
              <button type="button" class="btn-defaults" style="background-color: #28a745;color: #fff" onclick="chckIn()">Save</button>
              <input type="" id="token" value="{{ Session::token() }}" hidden>
              </form>
           </div>
          <span id="showSucc">
          
          </span>
          <div class="table-responsive">
            <table class="table table-hover" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 30%">Module</th>
                  <th style="width: 10%"><center>Allow</center></th>
                  <th style="width: 10%"><center>Add</center></th>
                  <th style="width: 10%"><center>Update</center></th>
                  <th style="width: 10%"><center>Cancel</center></th>
                  <th style="width: 10%"><center>Print</center></th>
                  <th style="width: 10%"><center>View</center></th>
                  <th style="width: 10%"><center>Option</center></th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
              </tbody>
            </table>
            </div>
        </div>
    </div>
      </div>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Add New Group</strong></h5>
              <hr>
              <form id="NewRight" action="#" class="row" data-parsley-validate>
                  <div class="col-sm-4">Group ID :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" id="new_modid" class="form-control" data-parsley-required-message="*<strong>Right ID</strong> required" required>
                  </div>
                  <div class="col-sm-4">Group Name :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                    <input type="text" id="new_rightdesc" class="form-control" data-parsley-required-message="*<strong>Right name</strong> required" required>
                  </div>
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Group</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Set Restriction Rights</strong></h5>
              <span id="modal_loaded"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="Test" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Add New Group</strong></h5>
                <hr>
                <span id="Test_body">
                  
                <form id="NewGropn" action="#" class="row" data-parsley-validate>
                  <div class="col-sm-4">Group ID :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" id="grp_id_holder">
                    {{-- <input type="text" id="new_grpid" class="form-control" data-parsley-required-message="*<strong>Group ID</strong> required" disabled required> --}}
                  </div>
                  <div class="col-sm-4">Group Name :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" id="grp_desc_holder">
                    {{-- <input type="text" id="new_grpdesc" class="form-control" data-parsley-required-message="*<strong>Group name</strong> required" required> --}}
                  </div>
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Group</button>
                  </div>
                </form>

                </span>                
            </div>
          </div>
        </div>
      </div>     
    <script type="text/javascript">
      function filterGroup(){
        var id = $('#filterer').val();
        var token = $('#token').val();
        $.ajax({
                url: " {{asset('employee/get_rights')}}",
                method: 'POST',
                data: {
                  _token : token,
                  grp_id : id,
                },
                success: function(data) {
                  if (data == 'NONE') {
                    $('#FilterdBody').empty();
                  } else {
                    $('#FilterdBody').empty();
                    for (var i = 0; i < data.length; i++) {
                      var alw = data[i].allow == '1' ? 'checked=""' : '';
                      var add = data[i].ad_d == '1' ? 'checked=""' : '';
                      var upd = data[i].upd == '1' ? 'checked=""' : '';
                      var cnl = data[i].cancel == '1' ? 'checked=""' : '';
                      var prt = data[i].print == '1' ? 'checked=""' : '';
                      var vw = data[i].view == '1' ? 'checked=""' : '';
                      $('#FilterdBody').append(
                          '<tr>'+
                              '<td>'+data[i].mod_desc+'</td>' +
                              '<td><center><input type="checkbox" class="checkbox disabled" '+alw+' disabled=""></center></td>' +
                              '<td><center><input type="checkbox" class="checkbox disabled" '+add+' disabled=""></center></td>' +
                              '<td><center><input type="checkbox" class="checkbox disabled" '+upd+' disabled=""></center></td>' +
                              '<td><center><input type="checkbox" class="checkbox disabled" '+cnl+' disabled=""></center></td>' +
                              '<td><center><input type="checkbox" class="checkbox disabled" '+prt+' disabled=""></center></td>' +
                              '<td><center><input type="checkbox" class="checkbox disabled" '+vw+' disabled=""></center></td>' +
                              '<td><center><button type="button" class="btn-defaults" onclick="getData('+data[i].x06_id+', \''+data[i].grp_id+'\', \''+data[i].mod_id+'\',\''+data[i].grp_desc+'\',\''+data[i].mod_desc+'\', '+data[i].allow+', '+data[i].ad_d+', '+data[i].upd+', '+data[i].cancel+', '+data[i].print+', '+data[i].view+');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button></center></td>' +
                          '<tr>'
                        );
                    }
                  }
                }
            });
      }
      function getData(id,grp,mod,grp_name,mod_name,alw,ad,upd,cnl,prnt,vw){
        var alw2 = alw == '1' ? 'checked=""' : '';
        var add2 = ad == '1' ? 'checked=""' : '';
        var upd2 = upd == '1' ? 'checked=""' : '';
        var cnl2 = cnl == '1' ? 'checked=""' : '';
        var prt2 = prnt == '1' ? 'checked=""' : '';
        var vw2 = vw == '1' ? 'checked=""' : '';
        $('#modal_loaded').empty();
        $('#modal_loaded').append(
            '<div class="container">' +
              '<form>' +
                '<div class="row text-center">' +
                    '<div class="col-sm-6">Group : '+grp_name+'</div>' +
                    '<div class="col-sm-6">Module : '+mod_name+'</div>' +
                  '</div>' +
                  '<hr>' +
                  '<div class="row">' +
                    '<div class="col-sm-6"> <div class="form-check"><label class="form-check-label"><input id="chkAlw" type="checkbox" class="form-check-input" '+alw2+'>Allow</label></div></div>' +
                    '<div class="col-sm-6"> <div class="form-check"><label class="form-check-label"><input id="chkAdd" type="checkbox" class="form-check-input" '+add2+'>Add</label></div></div>' +
                  '</div>' +
                  '<div class="row">' +
                    '<div class="col-sm-6"> <div class="form-check"><label class="form-check-label"><input id="chkUpd" type="checkbox" class="form-check-input" '+upd2+'>Update</label></div></div>' +
                    '<div class="col-sm-6"><div class="form-check"><label class="form-check-label"><input id="chkCnl" type="checkbox" class="form-check-input" '+cnl2+'>Cancel</label></div></div>' +
                  '</div>' +
                  '<div class="row">' + 
                    '<div class="col-sm-6"><div class="form-check"><label class="form-check-label"><input id="chkPrt" type="checkbox" class="form-check-input" '+prt2+'>Print</label></div></div>' +
                    '<div class="col-sm-6"><div class="form-check"><label class="form-check-label"><input id="chkVw" type="checkbox" class="form-check-input" '+vw2+'>View</label></div></div>' +
                  '</div><hr>' +
                  '<div class="row">' +
                    '<div class="col-sm-6">' +
                      '<button type="button" class="btn btn-outline-success form-control" onclick="savedChecked('+id+',\''+grp+'\',\''+mod+'\',\''+grp_name+'\',\''+mod_name+'\')" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>' +
                    '</div>' +
                    '<div class="col-sm-6">' +
                      '<button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>' +
                    '</div>' +
                  '</div>' +
              '</form>' +
            '</div>'
          );
      }
      function savedChecked(id,grp,mod,grp_name,mod_name){
          var alwChk = $('#chkAlw').prop('checked') == true ? 1 : 0;
          var addChk = $('#chkAdd').prop('checked') == true ? 1 : 0;
          var updChk = $('#chkUpd').prop('checked') == true ? 1 : 0;
          var cnlChk = $('#chkCnl').prop('checked') == true ? 1 : 0;
          var prtChk = $('#chkPrt').prop('checked') == true ? 1 : 0;
          var vwChk = $('#chkVw').prop('checked') == true ? 1 : 0;
          $.ajax({
                url: " {{asset('employee/save_rights')}}",
                method: 'POST',
                data: {
                  _token : $('#token').val(),
                  id: id,
                  alwChk : alwChk,
                  addChk :addChk ,
                  updChk :updChk ,
                  cnlChk :cnlChk ,
                  prtChk :prtChk ,
                  vwChk : vwChk,
                },
                success: function(data) {
                  if (data == 'DONE') {
                    $('#GodModal').modal('toggle');
                    filterGroup();
                    showSucc(grp_name,mod_name);
                    setInterval('refreshPage()', 3000);
                  }
                }
            });
      }
      function refreshPage(){
        location.reload();
      }
      function showSucc(grp_name,mod_name) {
          $('#showSucc').empty();
          $("#showSucc").append(
            '<div class="alert alert-success alert-dismissible fade show" role="alert">'+
            '<strong><i class="fas fa-check"></i></strong> Successfully updated rights of <strong>'+ grp_name+'</strong> in <strong>'+mod_name+ '</strong> module.' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
              '<span aria-hidden="true">&times;</span>'+
            '</button>'+
          '</div>'
          );
      }
      function chckIn(){
        var filter = $('#filterer').val().toUpperCase();
        // console.log(filter);
        if (filter == "") {
          // alert();
        } else {
          var test = $('datalist option[value]').map(function () {
              return this.value;
          }).get();
          var test2 = $.inArray(filter,test);
          if (test2 == -1) {
            $('#grp_id_holder').empty();
            $('#grp_desc_holder').empty();
            $('#grp_id_holder').append('<input type="text" id="new_grpid" class="form-control" data-parsley-required-message="*<strong>Group ID</strong> required" disabled required>');
            $('#grp_desc_holder').append('<input type="text" id="new_grpdesc" class="form-control" data-parsley-required-message="*<strong>Group name</strong> required" required>');
            $('#new_grpid').attr('value','');
            $('#new_grpid').attr('value',filter);
            $('#Test').modal();            
          } 
        }
      }
      $('#NewGropn').on('submit',function(event){
        event.preventDefault();
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
            $.ajax({
                url: " {{asset('employee/grprights/check')}}",
                method: 'POST',
                data: {
                  _token : $('#token').val(),
                  id: $('#new_grpid').val(),
                  name : $('#new_grpdesc').val(),
                },
                success: function(data) {
                  if (data == 'DONE') {
                      alert('Successfully Added New Group');
                      window.location.href = "{{ asset('employee/dashboard/grouprights') }}";
                  }
                }
            });
        }
      });
      $('#NewRight').on('submit',function(event){
        event.preventDefault();
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
          var CurrentRights =  $('#grp_list option[value]').map(function () {
              return this.value}).get();
          var newId = $('#new_modid').val();
          var testNow = $.inArray(newId,CurrentRights);
          if (testNow == -1) {
            $.ajax({
                url: " {{asset('employee/grprights/check')}}",
                method: 'POST',
                data: {
                  _token : $('#token').val(),
                  id: $('#new_modid').val(),
                  name : $('#new_rightdesc').val(),
                },
                success: function(data) {
                  if (data == 'DONE') {
                      alert('Successfully Added New Group');
                      window.location.href = "{{ asset('employee/dashboard/grouprights') }}";
                  }
                }
            });
          } else {
            alert('Right ID is already been taken');
            $('#new_modid').focus();
          }

        }
      });
    </script>
@endsection