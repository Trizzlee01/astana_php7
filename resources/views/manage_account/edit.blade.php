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
</style>
@endsection

@section('content')
<div class="container justify text-center">
    <form action="{{ url('/manage_account/users/'.$user->id) }}" method="post" name="create_form" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="profile-img" class="avatar-130 img-fluid img-preview"/>
                        {{-- <img src={{ asset('storage/' . $user->image) }} alt=profile-img class=avatar-50 img-fluid/> --}}
                    @else
                        <img src="{{ asset('images/manage_account/users/11.png') }}" alt="profile-img" class="avatar-130 img-fluid img-preview"/>
                    @endif
                    
                </div>
                <div class="btn-action col-3 d-flex justify-content-center align-items-center">
                    <label for="file-upload" class="custom-file-upload upload btn-primary d-flex justify-content-center align-items-center">
                        <p>Upload Foto</p>
                    </label>
                    <input class="form-control @error('image') is-invalid @enderror" id="file-upload" name="image" type="file" hidden="" onchange="previewImage()"/>
                    &nbsp;
                    &nbsp;
                    <label class="custom-file-upload upload btn-primary d-flex justify-content-center align-items-center" onchange="deleteImage()">
                        Delete Foto
                    </label>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label for="username" class="text">Username</label>
                </div>
                <div class="col-10">
                    <input type="text" name="username" class="form-control textField" id="username"
                        placeholder="Masukkan Username" value="{{ $user->username }}">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label for="firstname" class="text">Nama Depan</label>
                </div>
                <div class="col-10">
                    <input type="text" name="firstname" class="form-control textField" id="firstname"
                        placeholder="Masukkan Nama Depan" value="{{ $user->firstname }}">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                <label for="lastname" class="text">Nama Belakang</label>
                </div>
                <div class="col-10">
                <input type="text" name="lastname" class="form-control textField" id="lastname"
                        placeholder="Masukkan Nama Belakang" value="{{ $user->lastname }}">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                <label for="ktp" class="text">Nomor KTP</label>
                </div>
                <div class="col-10">
                <input type="text" name="ktp" class="form-control textField" id="ktp"
                        placeholder="Masukkan Nomor KTP" value="{{ $user->ktp }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                <label for="password" class="text">Password Baru</label>
                </div>
                <div class="col-10">
                <input type="text" name="password" class="form-control textField" id="password"
                        placeholder="Masukkan Password Baru">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label for="email" class="text">Email</label>
                </div>
                <div class="col-10">
                    <input type="email" name="email" class="form-control textField" id="email" placeholder="Enter your Email" value="{{ $user->email }}">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Provinsi</label>
                </div>
                
                <div class="col-10">
                    <select class="form-control" id="province" name="province_id" onchange="getProvince(this.value)">
                        <option value="">Pilih Provinsi</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Kota</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="city" name="city_id">
                        <option value="">Pilih Kota</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label for="address" class="text">Alamat</label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control" id="address" name="address"
                        placeholder="Masukkan Alamat" value="{{ $user->address }}">
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Zip/Postal Code</label>
                </div>
                <div class="col-10">
                    <input class="form-control" type="text" min=5 max=5 name="postcode" id="postcode" placeholder="Enter your Zip/Portal Code" value="{{ $user->postcode }}">
                </div>
            </div>
        </div>

        @can('superadmin_pabrik')
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Posisi</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="user_position" name="user_position" onchange="getUserPosition(this.value)" value="{{ $user->user_position }}">
                        <option value="user_position">Pilih Posisi</option>
                        <option value="superadmin_pabrik">Super Admin</option>
                        <option value="accounting_pabrik">Accounting</option>
                        <option value="cashier_pabrik">Cashier</option>
                        <option value="superadmin_distributor">Distributor</option>
                    </select>
                </div>
                
            </div>
        </div>
        <div class="form-group" id="form_cluster">
            <div class="row">
                <div class="col-2">
                    <label class="text">Klaster</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="cluster" name="cluster">
                        <option value="cluster">Pilih Klaster</option>
                        <option value="klasterA">Klaster A</option>
                        <option value="klasterB">Klaster B</option>
                        <option value="klasterC">Klaster C</option>
                    </select>
                </div>
                
            </div>
        </div>
        @endcan
        @can('superadmin_distributor')
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <label class="text">Posisi</label>
                </div>
                <div class="col-10">
                    <select class="form-control" id="user_position" name="user_position" onchange="getUserPosition(this.value)">
                        <option value="user_position">Pilih Posisi</option>
                        <option value="accounting_distributor" selected>Accounting</option>
                        <option value="cashier_distributor">Cashier</option>
                        <option value="reseller">Reseller</option>
                    </select>
                </div>
                
            </div>
        </div>
        @endcan

        <!-- <div class="col-12 d-flex justify-content-end">
            <button class="btn simpan-btn btn-sm" type="submit" autocomplete="off">
                <i class="mdi mdi-content-save">
                    ::before
                </i>
                Simpan
            </button>
        </div> -->

        {{-- @can('superadmin_distributor') --}}
        <div class="form-group" id="toko_online">
            <div class="row">
                <div class="col-2">
                    <label class="text">Toko Online</label>
                </div>
                <div class="col-10 text-left">
                    <div class="form-group row align-items-center">
                        <div class="col-2">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="tokopedia" name="tokopedia" >Tokopedia</div>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control textField" id="tokopedialink" name="tokopedialink"
                            placeholder="Masukkan Link Tokopedia">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-2">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="shopee" name="shopee">Shopee</div>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control textField" id="shopeelink" name="shopeelink"
                            placeholder="Masukkan Link Shopee">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-2">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="lazada" name="lazada">Lazada</div>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control textField" id="lazadalink" name="lazadalink"
                            placeholder="Masukkan Link Lazada">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-2">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="bukalapak" name="bukalapak">Buka Lapak</div>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control textField" id="bukalapaklink" name="bukalapaklink"
                            placeholder="Masukkan Link Buka Lapak">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-2">
                            <div class="form-check"><input class="form-check-input" type="checkbox" id="blibli" name="blibli">Blibli</div>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control textField" id="bliblilink" name="bliblilink"
                            placeholder="Masukkan Link Blibli">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endcan --}}
        
        <div class="form-group text-right">
            <input type="submit" onclick="" class="btn btn-primary submit" value="Submit">
        </div>
    </form>
</div>
@endsection

@section('script')
<script type="text/javascript">

    $(function() {
        // alert("ready");
        // console.log("bbb");

        // const $select = document.querySelector('#user_position');
        // $select.value = {{ '$user->user_position' }}

    
        
        // $("#form_cluster").hide();
        // $("#toko_online").hide();

        $("#user_position").val("{{ $user->user_position }}");
        $("#province").val("{{ $user->province_id }}");
        getProvince({{ $user->province_id }});
        

        if("{{ auth()->user()->user_position }}" == "superadmin_pabrik")
        {
            if("{{ $user->user_position }}" == "superadmin_distributor") {
                $("#form_cluster").show();
                $("#toko_online").show();

                $("#cluster").val("{{ $user->cluster }}");
                $("#tokopedialink").val("{{ $user->tokopedia }}");
                $("#shopeelink").val("{{ $user->shopee }}");
                $("#lazadalink").val("{{ $user->lazada }}");
                $("#bukalapaklink").val("{{ $user->bukalapak }}");
                $("#bliblilink").val("{{ $user->blibli }}");

                if("{{ $user->tokopedia }}" != ""){
                    $('#tokopedia').prop('checked', true);
                }
                if("{{ $user->shopee }}" != ""){
                    $('#shopee').prop('checked', true);
                }
                if("{{ $user->lazada }}" != ""){
                    $('#lazada').prop('checked', true);
                }
                if("{{ $user->bukalapak }}" != ""){
                    $('#bukalapak').prop('checked', true);
                }
                if("{{ $user->blibli }}" != ""){
                    $('#blibli').prop('checked', true);
                }

            }
            else {
                $("#form_cluster").hide();
                $("#toko_online").hide();
            }
        }
        else
        {
            if(user_position == "reseller") {
                $("#toko_online").show();
            }
            else {
                $("#toko_online").hide();
            }
        }

        // alert('{{ $user->user_position }}');

        // $("#user_position").value('{{ $user->user_position }}').change();

        
    });

    function getProvince(province)
    {
        $('#city').html('');
        $.ajax({
            url: "{{ url('fetch-cities') }}",
            type: "POST",
            data: {
                province_id: province,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                var check=false;
                $('#city').html('<option value="">Pilih Kota</option>');
                $.each(result.cities, function (key, value) {
                    $("#city").append('<option value="' + value
                        .id + '">' + value.name + '</option>');

                        if("{{ $user->city_id }}" == value.id){
                            check=true;
                        }
                });

                if(check) {
                    $("#city").val("{{ $user->city_id }}");
                }
                
            }
        });
        
    }

    function getUserPosition(user_position)
    {
        // alert(user_position);
        if("{{ auth()->user()->user_position }}" == "superadmin_pabrik")
        {
            if(user_position == "superadmin_distributor") {
                $("#form_cluster").show();
                $("#toko_online").show();
            }
            else {
                $("#form_cluster").hide();
                $("#toko_online").hide();
            }
        }
        else
        {
            if(user_position == "reseller") {
                $("#toko_online").show();
            }
            else {
                $("#toko_online").hide();
            }
        }

    }

    function previewImage() {
        const image = document.querySelector('#file-upload');
        const imgPreview = document.querySelector('.img-preview');
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    function deleteImage() {
        // const image = document.querySelector('#file-upload');
        const imgPreview = document.querySelector('.img-preview');
        
        // const oFReader = new FileReader();
        // oFReader.readAsDataURL(image.files[0]);

        // oFReader.onload = function(oFREvent) {
        //     imgPreview.src = oFREvent.target.result;
        // }

        imgPreview.src = "images/manage_account/users/11.png";
    }

    
</script>
@endsection