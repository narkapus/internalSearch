@extends('layouts.app', ['activePage' => 'create_users', 'titlePage' => __('Create User')])

@section('content')

<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('material') }}/css/dataTables/buttons.dataTables.min.css" rel="stylesheet">
<link href="{{ asset('material') }}/css/dataTables/jquery.dataTables.min.css" rel="stylesheet">
<script src="{{ asset('material') }}/js/core/jquery-3.5.1.js"></script>
<script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
<script src="{{ asset('material') }}/js/plugins/dataTables.buttons.min.js"></script>
<script src="{{ asset('material') }}/js/plugins/jszip.min.js"></script>
<script src="{{ asset('material') }}/js/plugins/pdfmake.min.js"></script>
<script src="{{ asset('material') }}/js/plugins/vfs_fonts.js"></script>
<script src="{{ asset('material') }}/js/plugins/buttons.html5.min.js"></script>
<script>
    error=false

    function validate()
    {
    if(document.offForm.mb_no.value !='' && document.offForm.mb_name.value !='' )
    document.offForm.dibtnsavesabled=false
    else
    document.offForm.btnsave.disabled=true
    }
    </script>
</head>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<body>
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary" style="background: #fdcdcd;padding-bottom: 0px;">
                  <div class="row">
                      <p class="card-category col-sm-8"></p>
                      <div class="form-group text-right col-sm-4">
                        <div class="btn mb-2 pull-right" style="border-radius: 1.2rem;">
                            <i class="material-icons" id="new-off" data-toggle="modal">add</i>
                        </div>
                     </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover table-condensed data-table" style="text-align: center;width:100%">
                      <thead>
                        <tr>
                          <td style="width:10%">No.</td>
                          <td style="width:20%">User id</td>
                          <td style="width:45%">Name</td>
                          <td style="width:10%">Action</td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-- Add and Edit User modal -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="offCrudModal"></h4>
            </div>
            <div class="modal-body">
                <form name="offForm" action="{{ route('create_users.store') }}" method="POST">
                    <input type="hidden" name="officer_id" id="officer_id" >
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>User id:</strong>
                                <input type="text" name="mb_no" id="mb_no" class="form-control" placeholder="new user id" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="mb_name" id="mb_name" class="form-control" placeholder="user name" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Save</button>
                            <a href="{{ route('create_users.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">

$(document).ready(function () {

var table = $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('create_users.index') }}",
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'mb_no', name: 'mb_no'},
        {data: 'mb_name', name: 'mb_name'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});

/* When click New User button */
$('#new-off').click(function () {
    $('#btn-save').val("create-officer");
    $('#off').trigger("reset");
    $('#offCrudModal').html("New User");
    $('#crud-modal').modal('show');
});

/* Edit User */
$('body').on('click', '#edit-off', function () {
var officer_id = $(this).data('id');
$.get("/create_users/" +officer_id+ "/edit", function (data) {
    $('#offCrudModal').html("Edit User");
    $('#btn-update').val("Update");
    $('#btn-save').prop('disabled',false);
    $('#crud-modal').modal('show');
    $('#mb_no').val(data.mb_no);
    $('#mb_name').val(data.mb_name);
    })
});

/* Delete User */
$('body').on('click', '#delete-off', function () {
    var officer_id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
        if(confirm("Confirm Deleted!")) {
            $.ajax({
            type: "DELETE",
            url: "../create_users/"+officer_id,
            data: {
            "id": officer_id,
            "_token": token,
            },
            success: function (data) {
                table.ajax.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
            });
        }
        else
        {
            return false;
        };
    });
});

</script>
@endsection
