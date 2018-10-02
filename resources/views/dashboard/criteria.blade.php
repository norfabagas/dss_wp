@extends('layouts.dashboard')

@section('breadcrumbs')
<li class="breadcrumb-item">Kriteria Penilaian</li>
@endsection

@section('content')
<div class="card mb3">
  <div class="card-header">
    Kelola Kriteria
  </div>

  <div class="card-body">
    <table id="table" class="table table-bordered">
      <thead>
        <tr>
          <td>Kriteria</td>
          <td>Bobot</td>
          @if(auth()->user()->role == 'operator')
          <td>Aksi</td>
          @endif
        </tr>
      </thead>
    </table>
  </div>
</div>

@if(auth()->user()->role == 'operator')
<!-- edit  modal -->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        Edit Bobot Kriteria
        <button class="close" role="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" id="editForm">

          <input type="hidden" value="" id="editID">

          <div class="form-group">
            <label>Nama</label>
            <input type="text" id="editNama" class="form-control" disabled>
            <span class="invalid-feedback edit-nama"></span>
          </div>

          <div class="form-group">
            <label>Bobot</label>
            <input type="number" id="editGrade" class="form-control">
            <span class="invalid-feedback edit-grade"></span>
          </div>


          <br/>
          <input type="submit" class="btn btn-info" value="Update">

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>

</div>
@endif
@endsection

@section('script')
<script>
  $(document).ready(function () {

    $('#table').DataTable({
      serverSide: true,
      processing: true,
      ajax: "{{ route('criteria') }}",
      columns: [
        { data: 'name', name: 'name' },
        { data: 'grade', name: 'grade' },
        @if(auth()->user()->role == 'operator')
        { data: 'action', name: 'action' },
        @endif
      ],
    });

    @if(auth()->user()->role == 'operator')
    $('#table').on('click', '.edit[data-id]', function () {
      var id = $(this).data('id');

      $('#editID').val(id);

      $('#editModal').modal('toggle');
      $('#editForm').trigger('reset');

      $('#editNama').removeClass('is-invalid');
      $('.invalid-feedback.edit-nama').empty();

      $('#editGrade').removeClass('is-invalid');
      $('.invalid-feedback.edit-grade').empty();

      $.ajax({
        url: "{{ url('dashboard/criteria/json') }}/" + id + "/edit",
        dataType: "JSON",
        type: "GET",
        data: {
          method: '_EDIT',
        },
        success: function (data) {
          $('#editNama').val(data.msg.name);
          $('#editGrade').val(data.msg.grade);
        }
      });
    });

    $('#editForm').on('submit', function () {
      event.preventDefault();

      var id = $('#editID').val();

      $.ajax({
        url: "{{ url('dashboard/criteria/json') }}/" + id,
        dataType: "JSON",
        type: "PUT",
        data: {
          method: '_UPDATE',
          grade: $('#editGrade').val(),
        },
        success: function (data) {
          if (data.errors) {
            if (data.errors.grade) {
              $('#editGrade').addClass('is-invalid');
              $('.invalid-feedback.edit-grade').text(data.errors.grade);
            } else {
              $('#editGrade').removeClass('is-invalid');
              $('.invalid-feedback.edit-grade').empty();
            }
          } else {
            toastr.success('Nilai bobot ' + data.msg.name + ' berhasil diperbarui');
            $('#table').DataTable().draw(false);
            $('#editModal').modal('hide');
          }
        }
      })
    });
    @endif

  });
</script>
@endsection
