@extends('templates/main')

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="container">
                            <div class="row d-flex align-items-center">
                                <div class="col-sm-4" style="text-align:left;">
                                    <h4 style="text-align:left;">Daftar Barang Distributor</h4>
                                </div>
                                <div class="col-sm">
                                    <button type="button" class="btn btn-success">
                                        <i class="fa fa-file-excel-o"></i>
                                        <span>Import</span>
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-file-excel-o"></i>
                                        <span>Export</span>
                                    </button>
                                    <button type='button' class='btn btn-primary'><i
                                            class='fa fa-print'></i> Cetak</button>
                                </div>
                                {{-- <div class="col-sm text-right">
                                    <button type="button" class="btn btn-primary"
                                        onclick="location.href='kelolaBarang_daftarBarangDistributorAdd.php'">
                                        <span>+ Add</span>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="form-group col-6 ">
                            <span class="glyphicon glyphicon-name"></span>
                            <input type="text" onkeyup="_sorting(), _filter()" name="myySearch"
                                id="mySearch" placeholder="Search with Filter or Sorting"
                                class="form-control search-emp">
                        </div>
                        <div class="form-group col-3 ">
                            <select class="form-control" id="myFilter" onkeyup="_filter()"
                                style="width: 100%; height: 100%;">
                                <option value="filterby">Filter by</option>
                                <option value="id">id</option>
                                <option value="distributor">Distributor</option>
                                <option value="barang">Barang</option>
                                <option value="kemasan">Kemasan</option>
                                <option value="keterangan">Keterangan</option>
                            </select>
                        </div>
                        <div class="form-group col-3 ">
                            <select class="form-control" id="mySort" onkeyup="_sorting()"
                                style="width: 100%; height: 100%;">
                                <option value="sortingby">Sorting by</option>
                                <option value="ascending">ascending</option>
                                <option value="descending">descending</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <button class="btn col-3" style="background-color:rgba(52, 25, 80, 1); color:white"
                            id="submit" onkeyup="_sorting(), _filter()" name="submit">
                            Submit</button> &nbsp;&nbsp;&nbsp;
                        <button class="btn col-3" style="background-color:rgba(52, 25, 80, 1); color:white"
                            id="refresh" onClick="refreshPage()" name="refresh">
                            Refresh</button>
                    </div>

                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 grid-margin ">
                            <div class="iq-card">

                                <div class="iq-card-body">
                                    <div class="table-responsive-xl" style="overflow: scroll; ">
                                        <table
                                            class="table table-hover table-striped table-light display sortable text-nowrap"
                                            cellspacing="0" id="myTable">
                                            <thead>
                                                <tr id="_judul" onkeyup="_filter()" id="myFilter">
                                                    <th>ID</th>
                                                    <th>Distributor</th>
                                                    <th>Barang</th>
                                                    <th>Stok</th>
                                                    <th>Harga Jual</th>
                                                    <th>Harga Modal</th>
                                                    <th>Nilai Total</th>
                                                    <th>Keterangan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td>{{ $product->product_type->kode_produk }}</td>
                                                        <td>{{ $product->owner->firstname }} {{ $product->owner->lastname }}</td>
                                                        <td>{{ $product->product_type->nama_produk }}</td>
                                                        <td>{{ number_format($product->stok, 0, ',', '.') }} pcs</td>
                                                        <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                                        <td>Rp {{ number_format($product->harga_modal, 0, ',', '.') }}</td>
                                                        <td>Rp {{ number_format($product->stok * $product->harga_modal, 0, ',', '.') }}</td>
                                                        <td>{{ $product->keterangan }}</td>
                                                        <td><button type="button" class="btn btn-sm btn-warning" onclick="location.href='{{ url('/manage_product/distributor/products/edit/'.$product->id) }}'">
                                                            <span><i class="fa fa-edit"></i>Edit</span>
                                                        </button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                    <!-- Modal Remove Account -->
                    <div class="modal fade" id="mmMyModal" role="dialog" style="border-radius:45px">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header"
                                    style="background:rgba(52, 25, 80, 1); color:white;">
                                    <p id="employeeidname" style="font-weight: bold;">DeusCode</p>
                                    <button type="button" class="close" data-dismiss="modal"
                                        style="color:white;">×</button>
                                </div>

                                <div class="modal-body">
                                    <button id="btnModalBiodata" onclick="msuccess('remove')"
                                        style="text-align:left">
                                        <a style="color: rgba(3, 15, 39, 1);">
                                            <i class='fas fa-edit'></i>&nbspRemove Akun</a></button>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
@if ($message = Session::get('update_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
@endif
</script>
@endsection