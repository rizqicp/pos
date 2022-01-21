@extends('layouts.contentWrapper')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Edit Produk</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form id="formProduct" action="{{route('product.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="idProduct" name="idProduct" value="{{$product->id}}">
                    <div style="display: flex; justify-content: center;">
                        <img id="imageProductPreview" src="{{asset('storage/uploads/'.$product->image)}}" style="max-height:300px;max-width:200px;height:auto;width:auto;" alt="Gambar Produk">
                    </div>
                    <div class="custom-file mt-3 mb-3">
                        <input type="file" class="custom-file-input" id="imageProduct" name="imageProduct" accept="image/png, image/jpg, image/jpeg">
                        <label class="custom-file-label" for="imageProduct">Pilih Gambar</label>
                        <small class="form-text text-muted">Biarkan kosong apabila tidak ingin mengganti gambar</small>
                    </div>
                    <div class="form-group">
                        <label for="nameProduct">Nama</label>
                        <input type="text" class="form-control" id="nameProduct" name="nameProduct" placeholder="Nama" autocomplete="false" value="{{$product->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="supplierProduct">Supplier</label>
                        <select class="form-control select2Form" name="supplierProduct" id="supplierProduct" value="{{$product->id_supplier}}" required>
                            <option value=""></option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoryProduct">Kategori</label>
                        <select class="form-control select2Form" name="categoryProduct" id="categoryProduct" value="{{$product->id_category}}" required>
                            <option value=""></option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="buyPriceProduct">Harga Beli</label>
                        <input type="number" class="form-control" id="buyPriceProduct" name="buyPriceProduct" placeholder="Harga Beli" autocomplete="false" value="{{$product->buy_price}}" required>
                    </div>
                    <div class="form-group">
                        <label for="sellPriceProduct">Harga Jual</label>
                        <input type="number" class="form-control" id="sellPriceProduct" name="sellPriceProduct" placeholder="Harga Jual" autocomplete="false" value="{{$product->sell_price}}" required>
                    </div>
                    <div class="form-group">
                        <label for="quantityProduct">Jumlah Awal</label>
                        <input type="number" class="form-control" id="quantityProduct" name="quantityProduct" placeholder="Jumlah" autocomplete="false" value="{{$product->quantity}}" required>
                    </div>
                    <div class="form-group">
                        <label for="descriptionProduct">Deskripsi</label>
                        <textarea class="form-control" id="descriptionProduct" name="descriptionProduct" cols="30" rows="10" placeholder="Deskripsi" required>{{$product->description}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="modalSubmit">Simpan</button>
                    <a href="{{route('product')}}" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
                </div>
            </form>
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
@endsection

@section('script')
<script>
    $(function () {
        $('.select2Form').select2({
            placeholder: "Pilih salah satu",
            theme: 'bootstrap4'
        });
        $('#descriptionProduct').summernote();
        bsCustomFileInput.init();
        imageProduct.onchange = evt => {
            const [file] = imageProduct.files
            if (file) {
                imageProductPreview.src = URL.createObjectURL(file);
            }else{
                imageProductPreview.src = "{{asset('storage/uploads/'.$product->image)}}";
            }
        }
    });
</script>
@endsection
