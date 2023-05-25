<div class="content-wrapper">

    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('contentheader')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">@yield('contentheaderactivelink')</li>
              <li class="breadcrumb-item active">@yield('contentheaderactive')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
     <div class="row" style="background-color: white;">
     @yield('content')


     </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>