@extends('templates/main')

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="container justify text-center">
    <div class="d-flex justify-content-between">
        <div class="container">
            <div class="row">

                <div class="col-md-3 text-left">
                    <h4>Detail Product Distributor A</h4>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-success">
                        <i class="fa fa-file-excel-o"></i>
                        <span>Import</span>
                    </button>
                    <button type="button" class="btn btn-primary">
                        <i class="fa fa-file-excel-o"></i>
                        <span>Export</span>
                </div>
                
            </div>
        </div>
    </div>

    <hr>
    <div class="container row d-flex justify-content-between">
        <div class="row ">
            <div class="col-md-6">
                <select class="form-control" style="background-color:rgb(52,25,80); color:white">
                    <option value="department">Periode 2022</option>
                    <option value="clusterA">Periode 2021</option>
                    <option value="clusterB">Periode 2020</option>
                    <option value="clusterC">Periode 2019</option>
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-control"
                    style="background-color:rgb(52,25,80); color:white">
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>
            </div>
        </div>
        
        <div class="row ">
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
    </div>

    <div class="iq-card ">
        <div class="iq-card-body d-flex justify-content-center">
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        </div>

    </div>
    
</div>
@endsection

@section('script')
<script>

var arrProducts = <?php echo $products; ?>;
var arrTypes = <?php echo $types; ?>;

var xValues=[];
var yValues=[];
var barColors=[];

arrProducts.forEach(element => {
    console.log(element['id']);
    xValues.push(arrTypes.find(o => o.id == element['id_productType'])['nama_produk']);
    yValues.push(element['stok']);

    // barColors.push(rgba(52, 25, 80, 1));
});

// var xValues = ["Parfum Wangi1", "Parfum Wangi2", "Parfum Wangi3", "Parfum Wangi4", "Parfum Wangi5"];
// var yValues = [500, 100, 200, 300, 1000,900];
// var barColors = ["red", "green","blue","orange","brown"];

new Chart("myChart", {
type: "bar",
data: {
    labels: xValues,
    datasets: [{
    // backgroundColor: barColors,
    backgroundColor: "#341950",
    data: yValues
    }]
},
options: {
    legend: {display: false},
    title: {
    display: true,
    text: "Penjualan Distributor A Periode Januari 2022"
    }
}
});
</script>
@endsection