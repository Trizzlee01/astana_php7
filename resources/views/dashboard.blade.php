@extends('templates/main')

@section('css')

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        <div class="container">
                            <div class="row d-flex ">
                                <div class="col-xl-5 form-group" style="text-align:left;">
                                    <h4 style="text-align:left;">Daftar Barang Pusat</h4>
                                </div>
                                <div class="col-xl-4">
                                    <button type="button" class="btn btn-success">
                                        <i class="fa fa-file-excel-o"></i>
                                        <span>Import</span>
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-file-excel-o"></i>
                                        <span>Export</span>
                                    </button>
                                    <button type='button' class='btn btn-primary'><i
                                            class='fa fa-print'></i>
                                        <span>Print</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <?php $pos=0 ?>
                    @foreach($distributors as $distributor)
                        @if($pos%3==0)
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="iq-card">
                                    <div class="iq-card-body">
                                        <div class="row" style="width:100%; padding:10px;">
                                            <div class="col-xl-10">
                                                <p style="font-size:20px; font-weight:bold">{{ $distributor->firstname }} {{ $distributor->lastname }}</p>
                                            </div>
                                            <div class="col-xl-2">
                                                <td>
                                                    <button type="button" class="btn btn-primary "
                                                        style="background-color:rgb(42, 20, 64);"
                                                        onclick="location.href='dashboard_detailReseller.php'">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xl-12" style="font-size:14px;">
                                                <div class="row">
                                                    <div class="col-xl-7" style="font-weight:600">
                                                        Total Stock Parfum:
                                                    </div>
                                                    <div class="col-xl-5">
                                                        5.000 pcs
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-7" style="font-weight:600">
                                                        Total Pembelian:
                                                    </div>
                                                    <div class="col-xl-5">
                                                        Rp 50.000.000
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($pos%3==2)
                            <div class="col-lg-4">
                                <div class="iq-card">
                                    <div class="iq-card-body">

                                        <div class="row" style="width:100%; padding:10px;">
                                            <div class="col-xl-10">
                                                <p style="font-size:20px; font-weight:bold">{{ $distributor->firstname }} {{ $distributor->lastname }}</p>

                                            </div>
                                            <div class="col-xl-2">
                                                <td>
                                                    <button type="button" class="btn btn-primary "
                                                        style="background-color:rgb(42, 20, 64);"
                                                        onclick="location.href='dashboard_detailReseller.php'">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xl-12" style="font-size:14px;">
                                                <div class="row">
                                                    <div class="col-xl-7" style="font-weight:600">
                                                        Total Stock Parfum:
                                                    </div>
                                                    <div class="col-xl-5">
                                                        5.000 pcs
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-7" style="font-weight:600">
                                                        Total Pembelian:
                                                    </div>
                                                    <div class="col-xl-5">
                                                        Rp 50.000.000
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="col-lg-4">
                                <div class="iq-card">
                                    <div class="iq-card-body">
                                        <div class="row" style="width:100%; padding:10px;">
                                            <div class="col-xl-10">
                                                <p style="font-size:20px; font-weight:bold">{{ $distributor->firstname }} {{ $distributor->lastname }}</p>
                                            </div>
                                            <div class="col-xl-2">
                                                <td>
                                                    <button type="button" class="btn btn-primary "
                                                        style="background-color:rgb(42, 20, 64);"
                                                        onclick="location.href='dashboard_detailReseller.php'">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xl-12" style="font-size:14px;">
                                                <div class="row">
                                                    <div class="col-xl-7" style="font-weight:600">
                                                        Total Stock Parfum:
                                                    </div>
                                                    <div class="col-xl-5">
                                                        5.000 pcs
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-7" style="font-weight:600">
                                                        Total Pembelian:
                                                    </div>
                                                    <div class="col-xl-5">
                                                        Rp 50.000.000
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    <?php $pos++ ?>
                    @endforeach
                </div>
            </div>
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
@endsection

@section('script')
<script>
    // $(document).ready(function () {
    //     $('#myTable').DataTable({
    //         "order": [[3, "desc"]]
    //     });
    //     $('.dataTables_length').addClass('bs-select');
    // })
    // $(document).ready(
    //     function () {
    //         $('#sidebarcollapse').on('click', function () {
    //             $('#sidebar').toggleClass('active');
    //         });
    //     }
    // )
    // $(document).ready(
    //     function () {
    //         var handlerid = 5;
    //         $.ajax({
    //             url: "handler.php",
    //             type: "POST",
    //             data: { handlerid: handlerid },
    //             success: function (response) {
    //                 $('#tablebody').html(response);
    //             },
    //             error: function (xhr, textStatus, errorThrown) {
    //                 var str = "ERROR : SERVER error<br>" + xhr +
    //                     "<br>" + textStatus + "<br>" + errorThrown;
    //                 alert(str);
    //             }
    //         });
    //     }
    // )
    // function msuccess(str) {
    //     $('#mmMyModal').modal('hide');
    //     $('#scmode').text(str);
    //     var handlerid = 4;
    //     $.ajax({
    //         url: "handler.php",
    //         type: "POST",
    //         data: { handlerid: handlerid },
    //         success: function (response) {
    //             $('#ModalSuccess').modal();
    //         },
    //         error: function (xhr, textStatus, errorThrown) {
    //             var str = "ERROR : SERVER error<br>" + xhr +
    //                 "<br>" + textStatus + "<br>" + errorThrown;
    //             alert(str);
    //         }
    //     });
    // }
</script>
@endsection