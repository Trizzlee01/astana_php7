@extends('templates/main')

@section('css')
<style>
.tambahAkun{
    background-color:rgba(52, 25, 80, 1);
}
</style>
@endsection

@section('content')
<div class="container justify text-center">
    <div class="row">
        <div class="col-12">
            <div class="mt-3">
                <div class="row">
                    <div class="col-12">

                        <div class="row align-items-center">
                            <div class="col-sm text-left">
                                <h4>Daftar Akun</h4>
                            </div>
                            <div class="col-sm">
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
                            <div class="col-sm">
                                <div class="form-group text-right" >
                                    <input type="submit" onclick="window.location.href='{{ url('/manage_account/users/create') }}'" class="btn btn-primary tambahAkun" value="+ Add">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <form action="{{ url('/manage_account/users') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari" name="search" value={{ request('search') }}>
                                        <button class="btn" style="background-color:rgba(52, 25, 80, 1); color:white" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        {{-- <div class="row">
                            <div class="col-3">
                                <form class="position-relative">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control todo-search" id="exampleInputEmail001" placeholder="Cari">
                                    </div>
                                </form>
                            </div>
                            <div class="col-3 text-left align-middle mt-1">
                                <button class="btn" style="background-color:rgba(52, 25, 80, 1); color:white">
                                    Submit
                                </button>
                            </div>
                        </div> --}}
                        <br>
                        @if($users->count())
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <table class="table table-hover table-striped table-light table-responsive text-nowrap" style="text-align:left" id="myTable">
                                    <thead>
                                        <tr id="_judul" onkeyup="_filter()" id="myFilter">
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Posisi</th>
                                            <th scope="col">Admin Input</th>
                                            <th scope="col">Tanggal Diinput</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody id="tablebody">
                                        @foreach($users as $user)
                                            <tr>
                                                <td class='jname full-body'>
                                                    @if($user->image)
                                                        <img src={{ asset('storage/' . $user->image) }} alt=profile-img class=avatar-50 img-fluid/>
                                                    @else
                                                        <img src={{ asset('images/manage_account/users/11.png') }} alt=profile-img class=avatar-50 img-fluid/>
                                                    @endif
                                                    {{-- <img src=images/user/11.png alt=profile-img class=avatar-50 img-fluid/> --}}
                                                    {{ $user->firstname}} {{ $user->lastname }}
                                                </td>
                                                <td class='jemail full-body'>
                                                    {{ $user->email }}
                                                </td>
                                                <td class='jposisi full-body'>
                                                    {{ $user->user_position }}
                                                </td>
                                                @can('superadmin_pabrik')
                                                <td>
                                                    @if($superadmins->where('id', $user->id_input)->first())
                                                    {{ $superadmins->where('id', $user->id_input)->first()->firstname }} {{ $superadmins->where('id', $user->id_input)->first()->lastname }}
                                                    @else
                                                    {{ $user->nama_input }}
                                                    @endif
                                                </td>
                                                @endcan
                                                @can('superadmin_distributor')
                                                <td>
                                                    {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}
                                                </td>
                                                @endcan
                                                <td>
                                                    {{ $user->updated_at->format('d/m/y H:m:s') }}
                                                </td>
                                                <td class='col-2'>
                                                    <div class='btn-group'>
                                                        {{-- <button type='button' class='btn btn-edit' onclick="window.location.href='{{url('/manage_account/users/{{ $user->id }}/edit')}}'" style='color: #FDBE33;'> --}}
                                                        <button type='button' class='btn btn-edit' onclick='window.location.href="{{url('/manage_account/users/'.$user->id.'/edit')}}"' style='color: #FDBE33;'>
                                                        <i class='fas fa-edit'></i>&nbspEdit</button>
                                                        {{-- url('/manage_account/delete') }}/" + data_delete --}}
                                                        <form action="{{ url('/manage_account/users/'.$user->id) }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button type='submit' class='btn btn-remove' data-toggle='modal' onclick='return confirm("Apakah anda yakin mau menghapus {{ $user->username }} ?");' style='color: #D17826;'>
                                                            {{-- <button type='button' class='btn btn-remove' data-toggle='modal' style='color: #D17826;'> --}}
                                                            <i class='fas fa-trash'></i>&nbspHapus</button>
                                                        </form>


                                                        {{-- <button type='button' data-delete='{{ $user->id }}' class='btn btn-remove btn-delete'
                                                            style='color: #D17826;'>
                                                            <i class='fas fa-trash'></i>&nbspHapus</button> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        @else
                        <p class="text-center fs-4">No user found</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // @if ($message = Session::get('delete_success'))
    //     swal(
    //         "Berhasil!",
    //         "{{ $message }}",
    //         "success"
    //     );
    // @endif

    // $(document).on('click', '.btn-delete', function(e){
    //     e.preventDefault();
    //     var data_delete = $(this).attr('data-delete');
    //     swal({
    //     title: "Apa Anda Yakin?",
    //     text: "Data akun akan terhapus, klik oke untuk melanjutkan",
    //     icon: "warning",
    //     buttons: true,
    //     dangerMode: true,
    //     })
    //     .then((willDelete) => {
    //     if (willDelete) {
    //         window.open("{{ url('/manage_account/users') }}/" + data_delete, "_self");
    //     }
    //     });
    // });
    // function nextpage(){
    //     var handlerid=4;
    //     $.ajax({
    //         url:"handler.php",
    //         type:"POST",
    //         data:{handlerid:handlerid},
    //         success: function(){
    //             window.location.href="/add_account";
    //         },
    //         error:function(xhr,textStatus,errorThrown){
    //             var str="ERROR : SERVER error<br>"+xhr+
    //             "<br>" + textStatus + "<br>" + errorThrown;
    //             alert(str);
    //         }
    //     });
    // }

    // $(document).ready(
    //     function () {
    //         $('#sidebarcollapse').on('click', function () {
    //             $('#sidebar').toggleClass('active');
    //         });
    //     }
    // )

    // $(document).ready(
    //     function () {
    //         $('#sidebarcollapse').on('click', function () {
    //             $('#sidebar').toggleClass('active');
    //         });
    //     }
    // )
    // $(document).ready(
    //     function () {
    //         var handlerid = 8;
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

    // function refreshPage() {
    //     // selectElement()
    //     // function selectElement(){
    //     // let element= document.getElementById(id);
    //     // element.value = "filterby";
    //     document.getElementById("mySearch").value = "";
    //     document.getElementById("myFilter").innerHTML = "filterby";
    //     document.getElementById("mySort").innerHTML = "sortingby";

    //     // }
    //     window.location.reload();
    // }

    // $("button").click(function () {
    //     // alert("helo");

    //     var _mySort = document.getElementById("mySort").value;
    //     var _myFilter = document.getElementById("myFilter").value;
    //     // alert(_mySort);
    //     // alert(_myFilter);
    //     if (_mySort != "sortingby" && _myFilter != "filterby") {
    //         alert("Mohon Maaf, Harap Mengisi Salah Satu dari Sorting atau Filter.")
    //     }
    //     else if (_mySort != "sortingby") {
    //         // alert("sort");
    //         _sorting();
    //     }

    //     else if (_myFilter != "filterby") {
    //         // alert("filter");
    //         _filter();
    //     }
    //     function _sorting() {
    //         var table, rows, switching, i, x, y, shouldSwitch, input, index, whatSort, indexSort;
    //         input = document.getElementById("mySearch").value;
    //         if (input == "id" || input == "ID") {
    //             index = 0;
    //         }
    //         else if (input == "name" || input == "Name") {
    //             index = 1;
    //         }
    //         else if (input == "department" || input == "Department") {
    //             index = 2;
    //         }
    //         else if (input == "position" || input == "Position") {
    //             index = 3;
    //         }

    //         whatSort = document.getElementById("mySort").value;

    //         if (whatSort == "ascending" || whatSort == "Ascending") {
    //             indexSort = 1;
    //         }
    //         else if (whatSort == "descending" || whatSort == "Descending") {
    //             indexSort = 2;
    //         }
    //         table = document.getElementById("myTable");
    //         switching = true;
    //         if (indexSort == 1) {
    //             while (switching) {
    //                 switching = false;
    //                 rows = table.rows;
    //                 for (i = 1; i < (rows.length - 1); i++) {
    //                     shouldSwitch = false;
    //                     x = rows[i].getElementsByTagName("TD")[index];
    //                     y = rows[i + 1].getElementsByTagName("TD")[index];
    //                     if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
    //                         shouldSwitch = true;
    //                         break;
    //                     }
    //                 }
    //                 if (shouldSwitch) {
    //                     rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
    //                     switching = true;
    //                 }
    //             }
    //         }
    //         else if (indexSort == 2) {
    //             while (switching) {
    //                 switching = false;
    //                 rows = table.rows;
    //                 for (i = 1; i < (rows.length - 1); i++) {
    //                     shouldSwitch = false;
    //                     x = rows[i].getElementsByTagName("TD")[index];
    //                     y = rows[i + 1].getElementsByTagName("TD")[index];
    //                     if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
    //                         shouldSwitch = true;
    //                         break;
    //                     }

    //                 }
    //                 if (shouldSwitch) {
    //                     rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
    //                     switching = true;
    //                 }
    //             }
    //         }
    //     }
    // })

</script>
@endsection