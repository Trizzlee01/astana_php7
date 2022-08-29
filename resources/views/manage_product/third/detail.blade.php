@extends('templates/main')

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-end text-right">
        <div class="container">
            <div class="row d-flex justify-content-end align-items-center text-right">
                <div class="col-sm">
                    <div class="row text-right">
                        <form class="position-relative" style="margin-right:8px;">
                            <div class="form-group mb-0">
                            <input type="text" class="form-control todo-search" id="exampleInputEmail001" placeholder="Cari">
                            </div>
                        </form>
                        <button type="button" class="btn btn-primary" onclick="location.href='formReseller.php'">
                            <span>Search</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
<div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 grid-margin ">
        <div class="iq-card">

            <div class="iq-card-body">
            <div class="col-12">
                <p style="font-size:20px; font-weight:bold">{{ $distributor->firstname }} {{ $distributor->lastname }}</p>
            </div>
                <div class="table-responsive-xl" style="overflow: scroll; ">
                    <table
                        class="table table-hover table-striped table-light display sortable table-responsive text-nowrap"
                        cellspacing="0" id="myTable">
                        <thead>
                            <br>
                            <tr id="_judul" onkeyup="_filter()" id="myFilter">
                                <th>Aksi</th>
                                <th>Nama Distributor</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Waktu Join</th>
                                <th>Stock Produk</th>
                                <th>Total Penjualan</th>
                                <th>Total Reseller</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                            <td>
                                <button type="button" onclick="location.href='{{ url('/manage_product/distributor_reseller/products/chart/'.$distributor->id) }}'" class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                                <td>{{ $distributor->firstname }} {{ $distributor->lastname }}</td>
                                <td>{{ $distributor->address }}</td>
                                <td>{{ $distributor->city->name }}</td>
                                <td>{{ $distributor->created_at->format('j F Y') }}</td>
                                <td>{{ $stock }} pcs</td>
                                <td>5.000 pcs</td>
                                <td>{{ $totalReseller }} Reseller</td>
                                <td>
                                    <div class='btn-group'>
                                        <button type='button' class='btn btn-edit'
                                            onclick="location.href='dashboard_editDetailReseller_distributor.php'" style='color: #FDBE33;'>
                                            <i class='fas fa-edit'></i>&nbspEdit</button>
                                        <button type='button' class='btn btn-remove' data-toggle='modal'
                                            data-target='#mmMyModal' style='color: grey;'>
                                            <i class='fas fa-trash'></i>&nbspRemove</button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>


            </div>
        </div>

    </div>
</div>

@if($resellers->count())

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 grid-margin ">
        <div class="iq-card">
            <div class="iq-card-body">
            <div class="col-12">
                <p style="font-size:20px; font-weight:bold">Reseller Distributor A</p>
            </div>
                <div class="table-responsive-xl" style="overflow: scroll; ">
                    <table
                        class="table table-hover table-striped table-light display sortable table-responsive text-nowrap"
                        cellspacing="0" id="myTable">
                        <thead>
                            <br>
                            <tr id="_judul" onkeyup="_filter()" id="myFilter">
                                <th>Aksi</th>
                                <th>ID</th>
                                <th>Nama Reseller</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Waktu Join</th>
                                <th>Stock Produk</th>
                                <th>Total Penjualan</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($resellers as $reseller)
                                <tr>
                                    <td>
                                        <button type="button" onclick="location.href='{{ url('/manage_product/distributor_reseller/products/chart/'.$reseller->id) }}'" class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>{{ $reseller->id }}</td>
                                    <td>{{ $reseller->firstname }} {{ $reseller->lastname }}</td>
                                    <td>{{ $reseller->address }}</td>
                                    <td>{{ $reseller->city->name }}</td>
                                    <td>{{ $reseller->created_at->format('j F Y') }}</td>
                                    <td>{{ $reseller->stock }} pcs</td>
                                    <td>1.000 pcs</td>
                                    <td>
                                        <div class='btn-group'>
                                            <button type='button' class='btn btn-edit'
                                                onclick="location.href='dashboard_editDetailReseller_reseller.php'" style='color: #FDBE33;'>
                                                <i class='fas fa-edit'></i>&nbspEdit</button>
                                            <button type='button' class='btn btn-remove' data-toggle='modal'
                                                data-target='#mmMyModal' style='color: grey;'>
                                                <i class='fas fa-trash'></i>&nbspRemove</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<p class="text-center fs-4">No reseller found</p>
@endif

<!-- Modal Remove Account -->
<div class="modal fade" id="mmMyModal" role="dialog" style="border-radius:45px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background:rgba(52, 25, 80, 1); color:white;">
                <p id="employeeidname" style="font-weight: bold;">DeusCode</p>
                <button type="button" class="close" data-dismiss="modal" style="color:white;">×</button>
            </div>

            <div class="modal-body">
                <button id="btnModalBiodata" onclick="msuccess('remove')" style="text-align:left">
                    <a style="color: rgba(3, 15, 39, 1);">
                        <i class='fas fa-edit'></i>&nbspRemove Akun</a></button>
                <hr>
                
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>

</script>
@endsection