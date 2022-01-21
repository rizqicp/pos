@extends('layouts.contentWrapper')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Pembelian</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" onclick="addTransaction()">Tambah</button>
            <table id="transactionTable" class="table table-bordered table-hover">
              <thead>
                <tr>
                    <th style="width:5%">No</th>
                    <th>Tanggal & Waktu</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Pelanggan</th>
                    <th>Jumlah Produk</th>
                    <th>Jumlah Harga</th>
                    <th style="width:10%">Aksi</th>
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
<div class="modal" id="modalTransaction" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formTransaction" action="" method="POST">
                @csrf
                <input type="hidden" class="form-control" id="idTransaction" name="idTransaction">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="userTransaction">User</label>
                        <select class="form-control select2Form" name="userTransaction" id="userTransaction" required>
                            <option value=""></option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productTransaction">Produk</label>
                        <select class="form-control select2Form" name="productTransaction" id="productTransaction" required>
                            <option value=""></option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantityTransaction">Jumlah</label>
                        <input type="number" class="form-control" id="quantityTransaction" name="quantityTransaction" placeholder="Jumlah" autocomplete="false" required>
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
        $('#transactionTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: "{{route('transaction.getAllSell')}}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'product_name',
                    name: 'product_name'
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'total_price',
                    name: 'total_price'
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
        $('.select2Form').select2({
            placeholder: "Pilih salah satu",
            theme: 'bootstrap4'
        });
    });

    function addTransaction() {
        $('#formTransaction').attr('action', "{{route('transaction.create')}}");
        $('#modalTitle').html('Tambah Transaksi');
        $('#idTransaction').val('');
        $('#userTransaction').val('');
        $('#productTransaction').val('');
        $('#quantityTransaction').val('');
        $('#modalTransaction').modal('show');
    }

    function editTransaction(id) {
        let url = "{{route('transaction.getById',':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            type: 'GET',
            url: url,
            success: function(respose){
                let transaction = JSON.parse(respose);
                $('#formTransaction').attr('action', "{{route('transaction.update')}}");
                $('#modalTitle').html('Edit Transaksi');
                $('#idTransaction').val(transaction.id);
                $('#userTransaction').val(transaction.user_id);
                $("#userTransaction").trigger('change');
                $('#productTransaction').val(transaction.product_id);
                $("#productTransaction").trigger('change');
                $('#quantityTransaction').val(transaction.quantity);
                $('#modalTransaction').modal('show');
            }
        });
    }

    function deleteTransaction(id) {
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
                let url = "{{route('transaction.delete',':id')}}";
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
