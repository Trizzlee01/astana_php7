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
    <div class="form-group">
        <div class="row">
            <div class="col-2 text-align:left">
                <label class="text">Nama Barang</label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control textField" id="namabarang"
                    placeholder="Masukkan Nama Barang">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-2 text-align:left">
                <label class="text">Stok Barang</label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control textField" id="stokbarang"
                    placeholder="Masukkan Stok Barang">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-2 text-align:left">
                <label class="text">Harga Jual</label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control textField" id="hargajual"
                    placeholder="Masukkan Harga Jual (per pcs)">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-2 text-align:left">
                <label class="text">Harga Modal</label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control textField" id="hargamodal"
                    placeholder="Masukkan Harga Modal (per pcs)">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-2 text-align:left">
                <label class="text">Keterangan</label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control textField" id="keterangan"
                    placeholder="Masukkan Keterangan Barang">
            </div>
        </div>
    </div>

    <div class="form-group text-right">
        <input type="submit" onclick="nextpage()" class="btn btn-primary submit" value="Submit">
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection