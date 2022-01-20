@extends('layouts.contentWrapper')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Kategori</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" onclick="addCategory()">Tambah</button>
            <table id="categoryTable" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<div class="modal" id="modalCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCategory" action="" method="POST">
                @csrf
                <input type="hidden" class="form-control" id="idCategory" name="idCategory">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nameCategory">Nama</label>
                        <input type="text" class="form-control" id="nameCategory" name="nameCategory" placeholder="Nama" autocomplete="false" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="modalSubmit">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        $('#categoryTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: "{{route('category.getAll')}}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    });

    function addCategory() {
        $('#formCategory').attr('action', "{{route('category.create')}}");
        $('#modalTitle').html('Tambah Kategori');
        $('#idCategory').val('');
        $('#nameCategory').val('');
        $('#modalCategory').modal('show');
    }

    function editCategory(id) {
        let url = "{{route('category.getById',':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'GET',
            url: url,
            success: function(respose){
                let category = JSON.parse(respose);
                $('#formCategory').attr('action', "{{route('category.update')}}");
                $('#modalTitle').html('Edit Kategori');
                $('#idCategory').val(category.id);
                $('#nameCategory').val(category.name);
                $('#modalCategory').modal('show');
            }
        });
    }

    function deleteCategory(id) {
        Swal.fire({
            title: 'Yakin akan menghapus data?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                let url = "{{route('category.delete',':id')}}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(){
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil terhapus.',
                            'success'
                        );
                        location.reload();
                    },
                    error: function(){
                        Swal.fire(
                            'Gagal!',
                            'Data gagal dihapus.',
                            'error'
                        );
                    }
                });
            }
        })
    }

</script>
@endsection
