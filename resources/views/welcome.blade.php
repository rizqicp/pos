<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General UI</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">

</head>
<body class="layout-top-nav">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
          <h5>Majoo Teknologi Indonesia</h5>
      </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @if (Route::has('login'))
            @auth
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                </li>
            @else
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </li>
            @endauth
        @endif
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h3>Produk</h3>
            </div>
        </div>
        <div class="row text-center">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-6 hero-feature">
                    <div class="card">
                        <img src="{{asset('storage/uploads/'.$product->image)}}" style="max-height:320px; width:100%;" alt="">
                        <div class="caption">
                            <h3>{{$product->name}}</h3>
                            <h5><sup>Rp</sup>{{$product->sell_price}}</h5>
                            {!! $product->description !!}
                            <p><a href="{{route('home')}}" class="btn btn-success">Beli!</a></p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
  </div>
  <!-- /.content-wrapper -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/dist/js/demo.js"></script>
</body>
</html>
