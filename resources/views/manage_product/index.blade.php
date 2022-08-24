@extends('templates/main')

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="container justify text-center">
    <div class="d-flex justify-content-between">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-sm-4">
                    <h4 style="text-align:left;">Pasok Barang</h4>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-success">
                        <i class="fa fa-file-excel-o"></i>
                        <span>Import</span>
                    </button>
                    <button type="button" class="btn btn-primary">
                        <i class="fa fa-file-excel-o"></i>
                        <span>Export</span>
                    </button>
                </div>
                <div class="col-sm text-right">
                    <button type="button" class="btn btn-primary"
                        onclick="location.href='{{ url('/manage_product/products/create') }}'">
                        <span>+ Add</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="container row d-flex justify-content-end">
        <form style="margin-right:8px;">
            <div class="form-group mb-0">
                <input type="text" class="form-control todo-search" id="exampleInputEmail001"
                    placeholder="Cari">
            </div>
        </form>
        <button type="button" class="btn btn-primary">
            <span>Search</span>
        </button>
    </div>

    @if($histories_group->count())
    <div class="iq-card">

        <div class="iq-card-body">
            <table id="mytable" class="table table-hover table-striped table-light "
                style="text-align:left">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Kode Pasok</th>
                        <th scope="col">Nama Pasok</th>
                        <th scope="col">Total Pasok</th>
                        <th>Admin</th>
                        {{-- <th>Waktu Input</th> --}}
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories_group as $history)
                        <tr>
                            {{-- <td>12 Januari 2022</td> --}}
                            {{-- <td>{{ $history->created_at->format('d/M/y H:m:s') }}</td> --}}
                            <td>{{ $history->created_at->format('j F Y H:m:s') }}</td>
                            <td>{{ $history->kode_pasok }}</td>
                            <td>{{ $history->nama_supplier }}</td>
                            <td>Rp {{ number_format($history->total, 0, ',', '.') }}</td>
                            <td>
                                {{ $superadmins->where('id', $history->admin_id)->first()->firstname }} {{ $superadmins->where('id', $history->admin_id)->first()->lastname }}
                            </td>
                            {{-- <td>{{ $history->created_at->format('d/m/y H:m:s') }}</td> --}}
                            <td>
                                <div class="form-group text-left">
                                    <button type="button" onclick='window.location.href="{{ url('/manage_product/detail_pasok/'.$history->kode_pasok) }}"' class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @else
    <p class="text-center fs-4">No history found</p>
    @endif
</div>
</div>
@endsection

@section('script')
<script>
// function nextpage() {
//             var handlerid = 4;
//             $.ajax({
//                 url: "handler.php",
//                 type: "POST",
//                 data: { handlerid: handlerid },
//                 success: function () {
//                     window.location.href = "kelolaBarang_aksiInputPasokBarang.php";
//                 },
//                 error: function (xhr, textStatus, errorThrown) {
//                     var str = "ERROR : SERVER error<br>" + xhr +
//                         "<br>" + textStatus + "<br>" + errorThrown;
//                     alert(str);
//                 }
//             });
//         }
//         $(document).ready(
//             function () {
//                 $('#sidebarcollapse').on('click', function () {
//                     $('#sidebar').toggleClass('active');
//                 });
//             }
//         )
//         $(document).ready(
//             function () {
//                 var handlerid = 22;
//                 $.ajax({
//                     url: "handler.php",
//                     type: "POST",
//                     data: { handlerid: handlerid },
//                     success: function (response) {
//                         $('#showdata').html(response);
//                     },
//                     error: function (xhr, textStatus, errorThrown) {
//                         var str = "ERROR : SERVER error<br>" + xhr +
//                             "<br>" + textStatus + "<br>" + errorThrown;
//                         alert(str);
//                     }
//                 })
//             });
// </script>
@endsection

