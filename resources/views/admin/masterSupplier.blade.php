@extends('layouts.contentWrapper')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Supplier</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" onclick="addSupplier()">Tambah</button>
            <table id="supplierTable" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
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
<div class="modal" id="modalSupplier" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formSupplier" action="" method="POST">
                @csrf
                <input type="hidden" class="form-control" id="idSupplier" name="idSupplier">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nameSupplier">Nama</label>
                        <input type="text" class="form-control" id="nameSupplier" name="nameSupplier" placeholder="Nama" autocomplete="false" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneSupplier">Telepon</label>
                        <input type="number" class="form-control" id="phoneSupplier" name="phoneSupplier" placeholder="Telepon" autocomplete="false" required>
                    </div>
                    <div class="form-group">
                        <label for="addressSupplier">Alamat</label>
                        <input type="text" class="form-control" id="addressSupplier" name="addressSupplier" placeholder="Alamat" autocomplete="false" required>
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
        $('#supplierTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: "{{route('supplier.getAll')}}",
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
                    data: 'phone',
                    name: 'phone',
                },
                {
                    data: 'address',
                    name: 'address',
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

    function addSupplier() {
        $('#formSupplier').attr('action', "{{route('supplier.create')}}");
        $('#modalTitle').html('Tambah Supplier');
        $('#idSupplier').val('');
        $('#nameSupplier').val('');
        $('#phoneSupplier').val('');
        $('#addressSupplier').val('');
        $('#modalSupplier').modal('show');
    }

    function editSupplier(id) {
        let url = "{{route('supplier.getById',':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'GET',
            url: url,
            success: function(respose){
                let supplier = JSON.parse(respose);
                $('#formSupplier').attr('action', "{{route('supplier.update')}}");
                $('#modalTitle').html('Edit Supplier');
                $('#idSupplier').val(supplier.id);
                $('#nameSupplier').val(supplier.name);
                $('#phoneSupplier').val(supplier.phone);
                $('#addressSupplier').val(supplier.address);
                $('#modalSupplier').modal('show');
            }
        });
    }

    function deleteSupplier(id) {
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
                let url = "{{route('supplier.delete',':id')}}";
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
