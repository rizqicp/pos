@extends('layouts.master')

@section('contentWrapper')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{isset($title) ? $title : ucwords(last(request()->segments()))}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            @if (last(request()->segments()) != "home")
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            @endif
            <li class="breadcrumb-item active">{{ucwords(last(request()->segments()))}}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    @yield('content')
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
