@extends('layouts.dashboard')

@section('breadcrumbs')
<li class="breadcrumb-item">Kelola Penilaian</li>
@endsection

@section('content')
<div class="card mb3">
  <div class="card-header">
    Kelola Penilaian
  </div>

  <div class="card-body">
    <table id="table" class="table table-bordered">
      <thead>
        <tr>
          <td>NIP</td>
          <td>Nama</td>
          <td>Aksi</td>
        </tr>
      </thead>
    </table>
  </div>
</div>

@if(auth()->user()->role == 'penyeleksi')
<!-- edit  modal -->
<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        Edit Penilaian
        <button class="close" role="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form method="post" id="editForm">

          <input type="hidden" value="" id="editID">

          <div class="form-group">
            <label>NIP</label>
            <input type="text" id="editNIP" class="form-control" disabled>
            <span class="invalid-feedback edit-nip"></span>
          </div>

          <div class="form-group">
            <label>Nama</label>
            <input type="text" id="editNama" class="form-control" disabled>
            <span class="invalid-feedback edit-nama"></span>
          </div>

          @foreach($criterias as $a)
          <div class="form-group">
            <label>{{ $a->name }}</label>
            <input type="number" id="editC{{ $a->id }}" class="form-control">
            <span class="invalid-feedback edit-c{{ $a->id }}"></span>
          </div>
          @endforeach

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

<!-- show  modal -->
<div id="showModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        Lihat Penilaian
        <button class="close" role="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <table class="table">
          <tr>
            <td>NIP</td>
            <td id="showNIP"></td>
          </tr>
          <tr>
            <td>Nama Guru</td>
            <td id="showNama"></td>
          </tr>
          @foreach($criterias as $a)
          <tr>
            <td>{{ $a->name }}</td>
            <td id="showC{{ $a->id }}"></td>
          </tr>
          @endforeach
        </table>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>

</div>
@endsection

@section('script')
<script>
  $(document).ready(function () {
    $('#table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('grade') }}",
      columns: [
        { data: 'nip', name: 'nip' },
        { data: 'nama', name: 'nama' },
        { data: 'action', name: 'action' },
      ],
    });

    @if(auth()->user()->role == 'penyeleksi')
    $('#table').on('click', '.edit[data-id]', function () {
      var id = $(this).data('id');

      $('#editModal').modal('toggle');

      $('#editID').val(id);

      for (var i = 1; i <= 14; i++) {
        $('#editC' + i).removeClass('is-invalid');
        $('.invalid-feedback.edit-c' + i).empty();
      }

      $.ajax({
        url: "{{ url('dashboard/grade/json') }}/" + id + "/edit",
        dataType: "JSON",
        type: "GET",
        data: {
          method: '_EDIT',
        },
        success: function (data) {
          $('#editNIP').val(data.msg.nip);
          $('#editNama').val(data.msg.nama);
          $('#editC1').val(data.msg.c1);
          $('#editC2').val(data.msg.c2);
          $('#editC3').val(data.msg.c3);
          $('#editC4').val(data.msg.c4);
          $('#editC5').val(data.msg.c5);
          $('#editC6').val(data.msg.c6);
          $('#editC7').val(data.msg.c7);
          $('#editC8').val(data.msg.c8);
          $('#editC9').val(data.msg.c9);
          $('#editC10').val(data.msg.c10);
          $('#editC11').val(data.msg.c11);
          $('#editC12').val(data.msg.c12);
          $('#editC13').val(data.msg.c13);
          $('#editC14').val(data.msg.c14);
        }
      });
    });

    $('#editForm').on('submit', function () {
      event.preventDefault();

      var id = $('#editID').val();
      console.log(id);

      $.ajax({
        url: "{{ url('dashboard/grade/json') }}/" + id,
        dataType: "JSON",
        type: "PATCH",
        data: {
          method: '_UPDATE',
          c1: $('#editC1').val(),
          c2: $('#editC2').val(),
          c3: $('#editC3').val(),
          c4: $('#editC4').val(),
          c5: $('#editC5').val(),
          c6: $('#editC6').val(),
          c7: $('#editC7').val(),
          c8: $('#editC8').val(),
          c9: $('#editC9').val(),
          c10: $('#editC10').val(),
          c11: $('#editC11').val(),
          c12: $('#editC12').val(),
          c13: $('#editC13').val(),
          c14: $('#editC14').val(),
        }, success: function (data) {
          if (data.errors) {
            if (data.errors.c1) {
              $('#editC1').addClass('is-invalid');
              $('.invalid-feedback.edit-c1').text(data.errors.c1);
            } else {
              $('#editC1').removeClass('is-invalid');
              $('.invalid-feedback.edit-c1').empty();
            }

            if (data.errors.c2) {
              $('#editC2').addClass('is-invalid');
              $('.invalid-feedback.edit-c2').text(data.errors.c2);
            } else {
              $('#editC2').removeClass('is-invalid');
              $('.invalid-feedback.edit-c2').empty();
            }

            if (data.errors.c3) {
              $('#editC3').addClass('is-invalid');
              $('.invalid-feedback.edit-c3').text(data.errors.c3);
            } else {
              $('#editC3').removeClass('is-invalid');
              $('.invalid-feedback.edit-c3').empty();
            }

            if (data.errors.c4) {
              $('#editC4').addClass('is-invalid');
              $('.invalid-feedback.edit-c4').text(data.errors.c4);
            } else {
              $('#editC4').removeClass('is-invalid');
              $('.invalid-feedback.edit-c4').empty();
            }

            if (data.errors.c5) {
              $('#editC5').addClass('is-invalid');
              $('.invalid-feedback.edit-c5').text(data.errors.c5);
            } else {
              $('#editC5').removeClass('is-invalid');
              $('.invalid-feedback.edit-c5').empty();
            }

            if (data.errors.c6) {
              $('#editC6').addClass('is-invalid');
              $('.invalid-feedback.edit-c6').text(data.errors.c6);
            } else {
              $('#editC6').removeClass('is-invalid');
              $('.invalid-feedback.edit-c6').empty();
            }

            if (data.errors.c7) {
              $('#editC7').addClass('is-invalid');
              $('.invalid-feedback.edit-c7').text(data.errors.c7);
            } else {
              $('#editC7').removeClass('is-invalid');
              $('.invalid-feedback.edit-c7').empty();
            }

            if (data.errors.c8) {
              $('#editC8').addClass('is-invalid');
              $('.invalid-feedback.edit-c8').text(data.errors.c8);
            } else {
              $('#editC8').removeClass('is-invalid');
              $('.invalid-feedback.edit-c8').empty();
            }

            if (data.errors.c9) {
              $('#editC9').addClass('is-invalid');
              $('.invalid-feedback.edit-c9').text(data.errors.c9);
            } else {
              $('#editC9').removeClass('is-invalid');
              $('.invalid-feedback.edit-c9').empty();
            }

            if (data.errors.c10) {
              $('#editC10').addClass('is-invalid');
              $('.invalid-feedback.edit-c10').text(data.errors.c10);
            } else {
              $('#editC10').removeClass('is-invalid');
              $('.invalid-feedback.edit-c10').empty();
            }

            if (data.errors.c11) {
              $('#editC11').addClass('is-invalid');
              $('.invalid-feedback.edit-c11').text(data.errors.c11);
            } else {
              $('#editC11').removeClass('is-invalid');
              $('.invalid-feedback.edit-c11').empty();
            }

            if (data.errors.c12) {
              $('#editC12').addClass('is-invalid');
              $('.invalid-feedback.edit-c12').text(data.errors.c12);
            } else {
              $('#editC12').removeClass('is-invalid');
              $('.invalid-feedback.edit-c12').empty();
            }

            if (data.errors.c13) {
              $('#editC13').addClass('is-invalid');
              $('.invalid-feedback.edit-c13').text(data.errors.c13);
            } else {
              $('#editC13').removeClass('is-invalid');
              $('.invalid-feedback.edit-c13').empty();
            }

            if (data.errors.c14) {
              $('#editC14').addClass('is-invalid');
              $('.invalid-feedback.edit-c14').text(data.errors.c14);
            } else {
              $('#editC14').removeClass('is-invalid');
              $('.invalid-feedback.edit-c14').empty();
            }

          } else {
            toastr.success('Nilai berhasil diperbarui');
            $('#table').DataTable().draw(false);
            $('#editModal').modal('hide');
          }
        }
      })
    });
    @endif

    $('#table').on('click', '.show[data-id]', function () {
      var id = $(this).data('id');
      $('#showModal').modal('toggle');

      $.ajax({
        url: "{{ url('dashboard/grade/json') }}/" +id,
        dataType: "JSON",
        type: "GET",
        data: {
          method: '_SHOW',
        },
        success: function (data) {
          $('#showNIP').text(data.msg.nip);
          $('#showNama').text(data.msg.nama);
          $('#showC1').text(data.msg.c1);
          $('#showC2').text(data.msg.c2);
          $('#showC3').text(data.msg.c3);
          $('#showC4').text(data.msg.c4);
          $('#showC5').text(data.msg.c5);
          $('#showC6').text(data.msg.c6);
          $('#showC7').text(data.msg.c7);
          $('#showC8').text(data.msg.c8);
          $('#showC9').text(data.msg.c9);
          $('#showC10').text(data.msg.c10);
          $('#showC11').text(data.msg.c11);
          $('#showC12').text(data.msg.c12);
          $('#showC13').text(data.msg.c13);
          $('#showC14').text(data.msg.c14);
        }
      })
    });

  });
</script>
@endsection
