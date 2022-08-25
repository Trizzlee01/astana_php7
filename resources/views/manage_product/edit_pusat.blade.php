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
    #date{
        background-color:white;
    }
</style>
@endsection

@section('content')
<div class="container justify text-center">
    <form action="{{ url('/manage_product/update_pusat/'.$product->id) }}" method="post" name="create_form" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col-2 text-align:left">
                    <label class="text">Nama Barang</label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control textField" id="namabarang" name="nama_produk"
                        placeholder="Masukkan Nama Barang" value="{{ $product->product_type->nama_produk }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2 text-align:left">
                    <label class="text">Stok Barang</label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control textField" id="stokbarang" name="stok"
                        placeholder="Masukkan Stok Barang" value="{{ $product->stok }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2 text-align:left">
                    <label class="text">Harga Jual</label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control textField" id="hargajual" name="harga_jual"
                        placeholder="Masukkan Harga Jual (per pcs)" value="{{ $product->harga_jual }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2 text-align:left">
                    <label class="text">Harga Modal</label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control textField" id="hargamodal" name="harga_modal"
                        placeholder="Masukkan Harga Modal (per pcs)" value="{{ $product->harga_modal }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2 text-align:left">
                    <label class="text">Keterangan</label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control textField" id="keterangan" name="keterangan"
                        placeholder="Masukkan Keterangan Barang" value="{{ $product->keterangan }}">
                </div>
            </div>
        </div>

        <div class="form-group text-right">
            <input type="submit" onclick="" class="btn btn-primary submit" value="Edit">
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
$(document).ready(function () {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            var options = {
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
        });
</script>
@endsection