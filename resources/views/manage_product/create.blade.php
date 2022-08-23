@extends('templates/main')

@section('css')
<style>
    .upload{
        background-color:rgba(52, 25, 80, 1);
        color:white;
        width:100px;
        border: 1px solid white;
        border-radius: 5px;
        width:150px;
        height:50px;
        
    }
    .text{
        color:rgba(52, 25, 80, 1);
        float: left;
    }
    .textField{
        background-color:white;
        border-radius: 5px;
        text-align:left;
    }
    .textview{
        background-color:white; 
        text-align:left;
        border-radius: 5px;
        padding:10px;
    }
    #tanggal_surat{
        background-color:white;
    }
</style>
@endsection

@section('content')
<div class="container justify text-center">
    <form action="{{ url('/manage_product/products') }}" method="post" name="create_form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col-2 text-align:left">
                    <label class="text">Kode Pasok</label>
                </div>
                <div class="col-10">
                    <input type="lastname" class="form-control textField" id="kode_pasok" name="kode_pasok"
                                placeholder="Masukkan Kode Pasok">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2 text-align:left">
                    <label class="text">Supplier</label>
                </div>
                <div class="col-10">
                    <div class="textview">
                        <p id="nama_supplier" name="nama_supplier">Pabrik Astana</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                <label for="exampleInputLastName" class="text">Surat Jalan</label>
                </div>
                <div class="col-10">
                <input type="lastname" class="form-control textField" id="surat_jalan" name="surat_jalan"
                        placeholder="Masukkan Surat Jalan">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label for="exampleInputEmail" class="text">Tanggal</label>
                </div>
                <div class="col-10">
                    <input class="form-control" id="tanggal_surat" name="tanggal_surat" placeholder="MM/DD/YYYY" type="text" readonly="readonly"/>
                </div>
                
            </div>
        </div>

        <div class="form-group row d-flex justify-content-left align-items-left">
            <div class="col-2 text-left">
                <p>Pembelian</p>
            </div>
            <div class="col-10">
                <div class="iq-card">
                    <div class="iq-card-body">
                        
                        <hr style="margin:8px;">
                        <div class="col text-left">
                            <table class="table table-hover table-light">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga Beli</th>
                                        <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($types as $type)
                                        <tr>
                                            <td>
                                                <div class="form-check"><input class="form-check-input" type="checkbox" id="check{{ $type->id }}" name="check{{ $type->id }}"></div>
                                            </div>
                                            <td>
                                                {{ $type->nama_produk }}
                                            </div>
                                            <td>
                                                <input type="number" class="form-control" id="jumlah{{ $type->id }}" name="jumlah{{ $type->id }}" placeholder="Masukkan Jumlah Pesanan" onchange="count()">
                                            </div>
                                            <td>
                                                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  class="form-control" id="harga_beli{{ $type->id }}" name="harga_beli{{ $type->id }}" placeholder="Masukkan Harga Beli" onchange="count()">
                                            </div>
                                            <td>
                                                <input type="text" class="form-control" id="subtotal{{ $type->id }}" placeholder="0" readonly="readonly">
                                            </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Total</label>
                </div>
                <div class="col-10">
                    <div class="textview">
                        Rp 0
                    </div>
                </div>
                
            </div>
        </div>
        
        
        <div class="form-group text-right">
        <input type="submit" onclick="" class="btn btn-primary submit" value="Tambah">
        </div>
        </div>
    </form>


@endsection

@section('script')
<script>
// $(document).ready(
//             function(){
//                 $('#sidebarcollapse').on('click',function(){
//                     $('#sidebar').toggleClass('active');
//                 });
//             }
//         )
$(document).ready(function () {
            var date_input = $('input[name="tanggal_surat"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            var options = {
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);

            // var vjumlah = document.getElementById("jumlah").value
            // var vhargabeli = document.getElementById("harga_beli").value
            // var vsubtotal = document.getElementById("subtotal").value

            // vsubtotal = vjumlah * vhargabeli;
        });

function count()
{
    // alert("aa");
    for(let i=1; i<=5; i++)
    {
        // temp="jumlah"+i.toString();
        // alert(temp);
        var vjumlah = document.getElementById("jumlah"+i.toString()).value
        var vhargabeli = document.getElementById("harga_beli"+i.toString()).value
        var vsubtotal = document.getElementById("subtotal"+i.toString()).value

        vsubtotal = vjumlah * vhargabeli;
        // alert(vjumlah + vhargabeli + vsubtotal);
        document.getElementById("subtotal"+i.toString()).value = vsubtotal;
    }
        
}
</script>
@endsection