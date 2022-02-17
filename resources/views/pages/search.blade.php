@extends('layouts.app', ['activePage' => 'search', 'titlePage' => __('Search')])

@section('content')
    <link href="{{ asset('material') }}/css/dataTables/buttons.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('material') }}/css/dataTables/jquery.dataTables.min.css" rel="stylesheet">
    <script src="{{ asset('material') }}/js/core/jquery-3.5.1.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/dataTables.buttons.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jszip.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/pdfmake.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/vfs_fonts.js"></script>
    <script src="{{ asset('material') }}/js/plugins/buttons.html5.min.js"></script>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            {{ Form::open(array('url' => '/search', 'method' => 'get')) }}
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Organization</label>
                            {!! Form::select('docCode', $items, null, ['class' => 'form-control','placeholder' => 'Search..', 'id'=>'docCode']) !!}
                        </div>
                    </div>
                    <div class="row" style="margin-top : 1%">
                        <div class="col-sm-2">
                        <label class="label-control">EmpCode</label>
                            <input type="text" class="form-control" name="userId">
                        </div>
                        <div class="col-sm-4">
                        <label class="label-control">Name</label>
                            <input type="text" class="form-control"  name="fullName">
                        </div>
                        <div class="col-sm-2">
                        <label class="label-control">Date of birth</label>
                            <input class="form-control" type="date" name="date_from" id="date_from" data-date="">
                        </div>
                    </div>
                    <div class="row" style="margin-top : 1%">
                        <div class="col-md-3">
                            <label class="label-control">Identity card</label>
                            <input type="text" class="form-control"  name="fullName">
                        </div>
                    </div>
                    <div class="row" style="margin-top : 1%">
                        <div class="col-md-2" style="padding-bottom: 2%;">
                            <button type="submit" class="btn btn-default">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
            <div class="table-responsive">
                <table id="dataTable-search" class="table table-striped table-hover table-condensed" style="text-align: center;width:100%">
                    <tbody>
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>EmpID</td>
                                <td>Name</td>
                                <td>Identity Card</td>
                                <td>OrgUnit Code</td>
                                <td>Phone</td>
                                <td>Date of birth</td>
                                <td>SourceDB</td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
var role = "{{ Auth::user()->role }} ";
$(document).ready(function () {
    var table = $('#dataTable-search').DataTable({
        processing: true,
        serverSide: true,
        columns: [
            {data: "DT_RowIndex" },
            {data: 'mdName', name: 'mdName'},
            {data: 'download', name: 'download'},
            {data: 'eMember', name: 'eMember'},
            {data: 'mb_name', name: 'mb_name'},
            {data: 'name', name: 'name'},
            {data: 'created_at', name: 'created_at',
                "render": function (data) {
                    var datePart = data.match(/\d+/g),
                        year = datePart[0], // get only two digits
                        month = datePart[1],
                        day = datePart[2];
                    var time = data.split(" ");
                    return day+'/'+month+'/'+year+' '+time[1];
                }
            },
            {data: 'eFile', name: 'eFile',
                "render": function (data) {
                    if(role == 1) {
                        return data;
                    } else {
                        return 'ไม่มีสิทธ์ดาวน์โหลด';
                    }
                }
            },
        ],
    });
});
</script>
@endsection
