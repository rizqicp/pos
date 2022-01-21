@extends('layouts.contentWrapper')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row text-center">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 hero-feature">
                        <div class="card">
                            <img src="{{asset('storage/uploads/'.$product->image)}}" style="max-height:320px; width:100%;" alt="">
                            <div class="caption">
                                <h3>{{$product->name}}</h3>
                                <h5><sup>Rp</sup>{{$product->sell_price}}</h5>
                                {!! $product->description !!}
                                <p><button class="btn btn-success" onclick="addTransaction({{$product->id}})">Beli!</button></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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
                <input type="hidden" class="form-control" id="userTransaction" name="userTransaction" value="{{$user->id}}">
                <div class="modal-body">
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
        $('.select2Form').select2({
            placeholder: "Pilih salah satu",
            theme: 'bootstrap4'
        });
    });

    function addTransaction(id) {
        $('#formTransaction').attr('action', "{{route('transaction.create')}}");
        $('#modalTitle').html('Tambah Transaksi');
        $('#idTransaction').val('');
        $('#productTransaction').val(id);
        $("#productTransaction").trigger('change');
        $('#quantityTransaction').val('');
        $('#modalTransaction').modal('show');
    }
</script>
@endsection
