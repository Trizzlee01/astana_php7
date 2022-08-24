@extends('templates/main')

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="container justify text-center">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-sm-4" style="text-align:left;">
                <h4 style="text-align:left;">Parfum varian 1</h4>
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
        </div>
    </div>
    <hr>

    <div class="iq-card">
        <div class="iq-card-body">
            <h5 style="text-align:left;font-weight:bold;">Barang Keluar</h5>
            <table
                class="table table-hover table-striped table-light display sortable text-left text-nowrap"
                cellspacing="0" id="myTable">
                <thead>
                    <br>
                    <tr id="_judul" onkeyup="_filter()" id="myFilter">
                        <th>Tanggal Keluar</th>
                        <th>Admin</th>
                        <th>No Transaksi</th>
                        <!-- <th>Customer</th> -->
                        <th>Jumlah barang Keluar</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>06/07/2022 16:28:28</td>
                        <td>Ria</td>
                        <td>T1006072022160030</td>
                        <!-- <td>Hera</td> -->
                        <td>100 pcs</td>
                    </tr>
                    <tr>
                        <td>06/07/2022 16:28:28</td>
                        <td>Ria</td>
                        <td>T1006072022160030</td>
                        <!-- <td>Hera</td> -->
                        <td>100 pcs</td>
                    </tr>
                    <tr>
                        <td>06/07/2022 16:28:28</td>
                        <td>Ria</td>
                        <td>T1006072022160030</td>
                        <!-- <td>Hera</td> -->
                        <td>100 pcs</td>
                    </tr>
                    <tr>
                        <td>06/07/2022 16:28:28</td>
                        <td>Ria</td>
                        <td>T1006072022160030</td>
                        <!-- <td>Hera</td> -->
                        <td>100 pcs</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="iq-card">
        <div class="iq-card-body">
            <h5 style="text-align:left;font-weight:bold;">Barang Masuk</h5>
            <table
                class="table table-hover table-striped table-light display sortable text-nowrap text-left"
                cellspacing="0" id="myTable">
                <thead>
                    <br>
                    <tr id="_judul" onkeyup="_filter()" id="myFilter">
                        <th>Tanggal Masuk</th>
                        <th>Admin</th>
                        <th>Jumlah barang Masuk</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($masuk as $m)
                        <tr>
                            <td>{{ $m->created_at->format('d/m/y H:m:s') }}</td>
                            <td>
                                {{ $superadmins->where('id', $m->admin_id)->first()->firstname }} {{ $superadmins->where('id', $m->admin_id)->first()->lastname }}
                            </td>
                            <td>{{ $m->jumlah }} pcs</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@section('script')
<script>

</script>
@endsection