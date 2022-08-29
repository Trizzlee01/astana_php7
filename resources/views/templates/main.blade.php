<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Items</title>

    <!-- TEMPLATE -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <link href="{{ asset('css/star-rating.css') }}" rel="stylesheet">

    {{-- swall --}}
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.1.2/js/star-rating.min.js"></script>


    <!-- bootdtrap css cdn -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> -->


    <!-- Latest compiled and minified CSS ??????-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    
    <!-- popper.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	
    <!-- bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Latest compiled and minified JavaScript ??????/ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- bootstrap dropdown js ?????? -->
    <!-- <script src="https://gist.github.com/dstaley/8c9d53f88d1ad53c57b4.js"></script> -->

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

        <!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.1.2/css/star-rating.min.css"></script>
        


    <link rel="stylesheet" href="{{ asset('css/templates/main/style.css') }}">

    @yield('css')

</head>
<body>
    <div class="wrapper">
        {{-- sidebar --}}
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="row align-items-center">
                    <div class="col-sm-9">
                        <h4>ASTANA</h4>
                        <p>for your daily activity</p>
                    </div>
                    <div class="col-sm-3 ">
                        <i class="btn fa fa-bell" style="color:white;" onclick="location.href='notification.php'"></i>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-left:8px;">
                <div class="col-4">
                    @if(auth()->user()->image)
                        <img src={{ asset('storage/' . auth()->user()->image) }} alt=profile-img class=avatar-50 img-fluid/>
                    @else
                        <div id="profile" class="d-flex justify-content-center align-items-center">
                            <p style="font-weight:bold;">{{ auth()->user()->firstname[0] }}{{ auth()->user()->lastname[0] }}</p>
                        </div>
                    @endif
                </div>
                <div class="col align-self-center">
                    <div class="row"><p style="font-weight:bold;">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p></div>
                    <div class="row"><p style="color:rgba(199, 199, 199, 1);">{{ auth()->user()->user_position }}</p></div>
                </div>
            </div>
        
            <ul class="list-unstyled components">     
                {{-- <li class="list-group-item">
                    <form action="/logout" method="post">
                        @csrf
                        <div class="row">
                            <button type="submit" class="col">Logout</button>
                        </div>
                    </form>
                </li>    --}}
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{asset('images/templates/main/dashboard.png')}}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        </div>
                    </div>
                </li>
{{-- KELOLA AKUN --}}
                @canany(['superadmin_pabrik','superadmin_distributor'])
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/kelola akun.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="{{ url('/manage_account/users') }}">Kelola Akun</a>
                        </div>
                        {{-- <div class="col">
                            <a href="#kelolaakun" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Kelola Akun</a>
                            <ul class="collapse list-unstyled" id="kelolaakun">
                                <li>
                                    <a href="kelolaAkun.php">Akun</a>
                                </li>
                                <li>
                                    <a href="kelolaAkunDistributor.php">Akun Distributor</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </li>
                @endcan
{{-- KELOLA BARANG --}}
                @canany(['superadmin_pabrik','superadmin_distributor'])
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/kelola barang.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="#kelolabarang" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Kelola Barang</a>
                            <ul class="collapse list-unstyled" id="kelolabarang">
                                @can('superadmin_pabrik')
                                <li>
                                    <a href="{{ url('/manage_product/products') }}">Daftar Barang Pusat</a>
                                </li>
                                <li>
                                    <a href="{{ url('/manage_product/distributor/products') }}">Daftar Barang Distributor</a>
                                </li>
                                <li>
                                    <a href="{{ url('/manage_product/distributor_reseller/products') }}">Daftar Barang Reseller</a>
                                </li>
                                <li>
                                    <a href="{{ url('/manage_product/input_pasok/supplyhistories') }}">Input Pasok Barang</a>
                                </li>
                                @endcan

                                @can('superadmin_distributor')
                                    <li>
                                        <a href="{{ url('/manage_product/products') }}">Daftar Barang Distributor</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/manage_product/reseller/products') }}">Daftar Barang Reseller</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </div>
                </li>
                @endcan
        
                @can('reseller')
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/kelola barang.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="{{ url('/manage_product/products') }}">Kelola Barang</a>
                        </div>
                    </div>
                </li>
                @endcan
{{-- RESELLER --}}
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/reseller.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="formReseller.php">Reseller</a>
                        </div>
                    </div>
                </li>
        
        
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/supplier.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="supplier.php">Supplier</a>
                        </div>
                    </div>
                </li>
        
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/distributor.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="distributor_crm_omzet.php">Distributor / CRM</a>
                        </div>
                    </div>
                </li>
        
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/retur.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="#retur" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Retur</a>
                            <ul class="collapse list-unstyled" id="retur">
                                <li>
                                    <a href="retur-customer.php">Retur Customer</a>
                                </li>
                                <li>
                                    <a href="retur-supplier.php">Retur Supplier</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
        
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/kelola transaksi.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="#kelolatransaksi" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Kelola Transaksi</a>
                            <ul class="collapse list-unstyled" id="kelolatransaksi">
                                <li>
                                    <a href="transaksi.php">Transaksi</a>
                                </li>
                                <li>
                                    <a href="riwayat-transaksi.php">Riwayat Transaksi</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
        
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/kelola laporan.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="#kelolalaporan" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Kelola Laporan</a>
                            <ul class="collapse list-unstyled" id="kelolalaporan">
                                <li>
                                    <a href="laporan-transaksi.php">Laporan Transaksi</a>
                                </li>
                                <li>
                                    <a href="laporan-pegawai.php">Laporan Pegawai</a>
                                </li>
                                <li>
                                    <a href="kelolaLaporan_laporanStock.php">Laporan Stok</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/clipboard.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="#laporanbarang" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Laporan Barang</a>
                            <ul class="collapse list-unstyled" id="laporanbarang">
                                <li>
                                    <a href="laporanBarangHarian.php">Laporan Barang Harian</a>
                                </li>
                                <li>
                                    <a href="laporan-barang-hilang.php">Laporan Barang Hilang</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
        
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">
                            <img src="{{ asset('images/templates/main/budget.png') }}" style="height:16px;width:16px;" class="invert">
                        </div>
                        <div class="col">
                            <a href="#akun" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Akuntansi</a>
                            <ul class="collapse list-unstyled" id="akun">
                                <li class="subheader">Akun</li>
                                <li>
                                    <a href="#">Manage Akun</a>
                                </li>
                                <li>
                                    <a href="#">Data Akun</a>
                                </li>
                
                                <li class="subheader">Aktiva</li>
                                <li>
                                    <a href="#">Aktiva Tetap</a>
                                </li>
                                <li>
                                    <a href="#">Aktiva Lancar</a>
                                </li>
                                <li>
                                    <a href="#">Laporan Aktiva</a>
                                </li>
                
                                <li class="subheader">Kas</li>
                                <li>
                                    <a href="#">Kas In</a>
                                </li>
                                <li>
                                    <a href="#">Kas Out</a>
                                </li>
                                <li>
                                    <a href="#">Bank</a>
                                </li>
                
                                <li class="subheader">Laporan Keuangan</li>
                                <li>
                                    <a href="#">Jurnal Harian</a>
                                </li>
                                <li>
                                    <a href="#">Buku Besar</a>
                                </li>
                                <li>
                                    <a href="#">Neraca</a>
                                </li>
                                <li>
                                    <a href="#">Laporan Laba Rugi</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-2 align-self-center">	
                            <i class="fa fa-door-open" style="color:#e86969"></i>
                        </div>
                        <div class="col">
                            <a href="{{ url('/logout') }}" style="color:#e86969">Log Out</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="container">
            {{-- sidebar button --}}
            <nav>
                <div class="row">
                    <div class="col-sm">
                        <button type="button" id="sidebarcollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                            <span>Menu</span>
                        </button>
                    </div>
                    <div class="col-sm">
                        <h2>
                            <?php 
                                // echo $_SESSION['pagename'];
                                ?>
                        </h2>
                    </div>
                </div>
            </nav>

            {{-- content --}}
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(
            function () {
                $('#sidebarcollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            }
        )
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    @yield('script')
</body>
</html>
