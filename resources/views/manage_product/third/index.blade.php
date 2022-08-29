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
                                    <h4 style="text-align:left;">Daftar Barang Pusat</h4>
                                </div>
                                <div class="col-sm" style="text-align:left;">
                                    <button type="button" class="btn btn-success">
                                        <i class="fa fa-file-excel-o"></i>
                                        <span>Import</span>
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-file-excel-o"></i>
                                        <span>Export</span>
                                    </button>
                                    <button type='button' class='btn btn-primary'><i class='fa fa-print'></i> Cetak</button>
                                </div>
                                <!-- <div class="col-sm text-right">
                                    <button type="button" class="btn btn-primary"
                                        onclick="location.href='kelolaBarang_daftarBarangResellerAdd.php'">
                                        <span>+ Add</span>
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <hr>
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
                    
                    
                    <div class="row d-flex justify-content-center align-items-center">  
                        <div class="col-12 grid-margin ">
                            <div class="iq-card">
                                    <div class="iq-card-body">
                                        <div class="table-responsive-xl" style="overflow: scroll; ">  
                                            <table class="table table-hover table-striped table-light display sortable  text-nowrap" cellspacing="0"  id="myTable" >
                                                <thead>
                                                    <br>
                                                    <tr id="_judul" onkeyup="_filter()" id="myFilter">
                                                        <th >ID</th>
                                                        <th >Distributor</th>
                                                        <th >Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($distributors as $distributor)
                                                        <tr>
                                                            <td>{{ $distributor->id }}</td>
                                                            <td>{{ $distributor->firstname }} {{ $distributor->lastname }}</td>
                                                            <td><button class="btn btn-primary btn-sm" onclick="location.href='{{ url('/manage_product/distributor_reseller/products/'. $distributor->id) }}'"><i class="fa fa-eye"></button></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        <div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
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
                    </div>

                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection