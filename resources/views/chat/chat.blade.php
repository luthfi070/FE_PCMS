@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Chatroom: Project Tol Jababeka</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Chatroom</div>
            <div class="card-body">
               <div class="row">
                   <div class="col-12 mx-4 fixed-content">
                    Tidak ada Pesan <br>
                    coba lagi<br>
                    Lorem ipsum dolor sit <br>
                    amet, consectetur adipisicing elit.<br>
                     Porro recusandae labore et hic molestias corr<br>
                     upti quibusdam suscipit laborum, explicabo magnam, ex<br>
                     ercitationem iste in minima cupiditate quae quos, temporibus dolo<br>
                     re cum pariatur repellendus fugiat soluta. Maiores, quibusdam libero modi<br>
                      pariatur reiciendis provident repellendus aliquam molestias veritatis inventore<br>
                       similique suscipit nemo doloremque.<br>
                   </div>
                   <div class="col-8">
                       <input class="form-control" type="text" name="message" id="message" placeholder="Masukkan pesan">
                   </div>
                   <div class="col-4">
                       <button class="btn btn-primary">Kirim</button>
                   </div>
               </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('css')
    <style>
        .fixed-content {

            overflow-y: scroll;

        }
    </style>
@endpush

