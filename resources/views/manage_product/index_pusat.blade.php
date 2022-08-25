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
                                <div class="col-sm text-right">
                                    <button type="button" class="btn btn-primary"
                                        onclick="location.href='{{ url('/manage_product/create_new_type/') }}'">
                                        <span>+ Add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div><hr>

                    <div class="row">
                        <div class="form-group col-6 ">
                            <span class="glyphicon glyphicon-name"></span>
                            <input type="text"
                                onkeyup="_sorting(), _filter()" name="myySearch" id="mySearch"
                                placeholder="Search with Filter or Sorting" class="form-control search-emp">
                        </div>
                        <div class="form-group col-3 ">
                            <select class="form-control" id="myFilter" onkeyup="_filter()" style="width: 100%; height: 100%;">
                                <option value="filterby">Filter by</option>
                                <option value="id">id</option>
                                <option value="barang">Barang</option>
                                <option value="kemasan">Kemasan</option>
                                <option value="keterangan">Keterangan</option>
                            </select>
                        </div>
                        <div class="form-group col-3 ">
                            <select class="form-control" id="mySort" onkeyup="_sorting()" style="width: 100%; height: 100%;">
                                <option value="sortingby">Sorting by</option>
                                <option value="ascending">ascending</option>
                                <option value="descending">descending</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <button class="btn col-3" style="background-color:rgba(52, 25, 80, 1); color:white" id="submit" onkeyup="_sorting(), _filter()" name="submit">
                            Submit</button> &nbsp;&nbsp;&nbsp;
                        <button class="btn col-3" style="background-color:rgba(52, 25, 80, 1); color:white" id="refresh" onClick="refreshPage()" name="refresh">
                            Refresh</button>

                        

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
                                                        <th >Barang</th>
                                                        <th >Stok</th>
                                                        <th >Harga Jual</th>
                                                        <th >Harga Modal</th>
                                                        <th >Nilai Total</th>
                                                        <th >Keterangan</th>
                                                        <th ></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach($products as $product)
                                                        <tr>
                                                            <td>{{ $product->product_type->kode_produk }}</td>
                                                            <td>{{ $product->product_type->nama_produk }}</td>
                                                            <td>{{ number_format($product->stok, 0, ',', '.') }} pcs</td>
                                                            <td>Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                                            <td>Rp {{ number_format($product->harga_modal, 0, ',', '.') }}</td>
                                                            <td>Rp {{ number_format($product->stok * $product->harga_modal, 0, ',', '.') }}</td>
                                                            <td>{{ $product->keterangan }}</td>
                                                            <td><button class="btn btn-primary btn-sm" onclick="location.href='{{ url('/manage_product/products/'.$product->id) }}'"><i class="fa fa-eye"></button></td>
                                                            <td><button type="button" class="btn btn-sm btn-warning" onclick="location.href='{{ url('/manage_product/edit_pusat/'.$product->id) }}'">
                                                                    <span><i class="fa fa-edit"></i>Edit</span>
                                                                </button></td>
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
$(document).ready(function () {
        $('#myTable').DataTable({
            "order": [[ 3, "desc" ]]
        });
            $('.dataTables_length').addClass('bs-select');
        });
        $(document).ready(
            function(){
                $('#sidebarcollapse').on('click',function(){
                    $('#sidebar').toggleClass('active');
                });
            }
        )
        // $(document).ready(
        //     function(){
        //         var handlerid=5;
        //         $.ajax({
        //             url:"handler.php",
        //             type:"POST",
        //             data:{handlerid:handlerid},
        //             success: function(response){
        //                 $('#tablebody').html(response);
        //             },
        //             error:function(xhr,textStatus,errorThrown){
        //                 var str="ERROR : SERVER error<br>"+xhr+
        //                 "<br>" + textStatus + "<br>" + errorThrown;
        //                 alert(str);
        //             }
        //         });
        //     }
        // )
        function msuccess(str){
            $('#mmMyModal').modal('hide');
            $('#scmode').text(str);
            var handlerid=4;
            $.ajax({
                    url:"handler.php",
                    type:"POST",
                    data:{handlerid:handlerid},
                    success: function(response){
                        $('#ModalSuccess').modal();
                    },
                    error:function(xhr,textStatus,errorThrown){
                        var str="ERROR : SERVER error<br>"+xhr+
                        "<br>" + textStatus + "<br>" + errorThrown;
                        alert(str);
                    }
                });
        }

        function refreshPage() {
            
            document.getElementById("mySearch").value = "";
            document.getElementById("myFilter").innerHTML = "filterby";
            document.getElementById("mySort").innerHTML = "sortingby";

            window.location.reload();
        }

        $("button").click(function () {

            var _mySort = document.getElementById("mySort").value;
            var _myFilter = document.getElementById("myFilter").value;

            if (_mySort != "sortingby" && _myFilter != "filterby") {
                alert("Mohon Maaf, Harap Mengisi Salah Satu dari Sorting atau Filter.")
            }
            else if (_mySort != "sortingby") {
                _sorting();
            }

            else if (_myFilter != "filterby") {
                _filter();
            }
            function _sorting() {
                var table, rows, switching, i, x, y, shouldSwitch, input, index, whatSort, indexSort;
                input = document.getElementById("mySearch").value;
                if (input == "id" || input == "ID") {
                    index = 0;
                }
                else if (input == "barang" || input == "Barang") {
                    index = 1;
                }
                else if (input == "kemasan" || input == "Kemasan") {
                    index = 2;
                }
                else if (input == "keterangan" || input == "Keterangan") {
                    index = 3;
                }

                whatSort = document.getElementById("mySort").value;

                if (whatSort == "ascending" || whatSort == "Ascending") {
                    indexSort = 1;
                }
                else if (whatSort == "descending" || whatSort == "Descending") {
                    indexSort = 2;
                }
                table = document.getElementById("myTable");
                switching = true;
                if (indexSort == 1) {
                    while (switching) {
                        switching = false;
                        rows = table.rows;
                        for (i = 1; i < (rows.length - 1); i++) {
                            shouldSwitch = false;
                            x = rows[i].getElementsByTagName("TD")[index];
                            y = rows[i + 1].getElementsByTagName("TD")[index];
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                shouldSwitch = true;
                                break;
                            }
                        }
                        if (shouldSwitch) {
                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                        }
                    }
                }
                else if (indexSort == 2) {
                    while (switching) {
                        switching = false;
                        rows = table.rows;
                        for (i = 1; i < (rows.length - 1); i++) {
                            shouldSwitch = false;
                            x = rows[i].getElementsByTagName("TD")[index];
                            y = rows[i + 1].getElementsByTagName("TD")[index];
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch = true;
                                break;
                            }

                        }
                        if (shouldSwitch) {
                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                        }
                    }
                }
            }

            //button search menggunakan keyup baru tekan lgsg trigger keluar sesuai yang kita search
            function _filter() {
                var input, filter, table, tr, td, i, txtValue, index;
                input = document.getElementById("mySearch");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                filt = document.getElementById("myFilter").value;
                $('myFilter').click(function () {
                    filt = document.getElementById("myFilter").value;
                });
               
                if (filt == "id" || filt == "ID") {
                    index = 0;
                }
                if (filt == "barang" || filt == "Barang") {
                    index = 1;
                }
                if (filt == "kemasan" || filt == "Kemasan") {
                    index = 2;
                }
                if (filt == "keterangan" || filt == "Keterangan") {
                    index = 3;
                }

                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[index];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

        })

</script>
@endsection