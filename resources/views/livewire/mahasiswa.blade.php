<div class="container">
    @if ($errors->any())
        <div class="pt-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if (session()->has('message'))
    <div class="pt-3">
        <div class="alert alert-success">
            <ul>
                {{session('message')}}
            </ul>
        </div>
    </div>
    @endif
    <!-- START FORM -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <form>
            <div class="mt-3 mb-3 row">
                <label for="nip" class="col-sm-2 col-form-label">Nip</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" wire:model="nip">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" wire:model="nama">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" wire:model="email">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nohp" class="col-sm-2 col-form-label">No Hp</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" wire:model="nohp">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" wire:model="alamat">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" wire:model="id_jurusan">
                        <option selected>Pilih Jurusan</option>
                        @foreach ($jurusan as $data)
                        <option value="{{$data->id}}">{{$data->nama_jurusan}}</option>
                        @endforeach
                        
                      </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" wire:model="status">
                        <option selected>Status Kelulusan</option>
                        <option value="BELUM" selected>BELUM</option>
                        <option value="LULUS">LULUS</option>
                        
                      </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    @if ($updateData == false)
                    <button type="button" class="btn btn-primary" name="submit" wire:click="store()">SIMPAN</button>
                    @else
                    <button type="button" class="btn btn-primary" name="submit" wire:click="update()">Update</button>
                    @endif
                    
                    <button type="button" class="btn btn-secondary" name="submit" wire:click="clear()">Clear</button>
                </div>
            </div>
        </form>
    </div>
    <!-- AKHIR FORM -->
    
    <!-- START DATA -->
   
    <div class="my-3 p-3 bg-body rounded shadow-sm table-responsive">
        <h1>Data Mahasiswa</h1>
       <div class="pb-3 pt-3">
        <input type="text" class="form-control mb-3 w-25" placeholder="search..." wire:model.live="katakunci">
       </div>
        <table id="example" class="table table-light table-striped responsive" style="width:100%">
            <div class="px-1 col-sm-1">
                <label class="text-sm">Per Page</label>
         
            <select  wire:model.live='perPage' class="form-select form-select-sm mb-2 px-3" aria-label="form-select-sm example">
               
                <option value="3">3</option>
                <option value="6">6</option>
                <option value="9">9</option>
              </select>
        </div>
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-2">Nip</th>
                    <th class="col-md-2">Nama</th>
                    <th class="col-md-2">Email</th>
                    <th class="col-md-2">No Hp</th>
                    <th class="col-md-2">Alamat</th>
                    <th class="col-md-2">Jurusan</th>
                    <th class="col-md-2">Status LULUS</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                            $no = 1;
                        @endphp
                @foreach ($dataMahasiswa as $item => $data)
                <tr>
                   
                    <td>{{ $item + $dataMahasiswa->firstItem() }}</td>
                    <td>{{$data->nip;}}</td>
                    <td>{{$data->nama;}}</td>
                    <td>{{$data->email;}}</td>
                    <td>{{$data->nohp;}}</td>
                    <td>{{$data->alamat;}}</td>
                    <td>{{$data->jurusan->nama_jurusan;}}</td>
                    <td>{{$data->status;}}</td>
                    <td>
                        <a wire:click="edit({{$data->id}})" class="btn btn-warning btn-sm">Edit</a>
                        <button wire:click="delete_confrimation({{$data->id}})" class="btn btn-danger btn-sm" 
                            data-bs-toggle="modal" data-bs-target="#exampleModal">Del</button>
                    </td>
                </tr>    
                @endforeach
              
            </tbody>
        </table>
        <div class="px-1 col-1">
                <label class="text-sm">Per Page</label>
         
            <select  wire:model.live='perPage' class="form-select form-select-sm mb-3 px-3" aria-label="form-select-sm example">
               
                <option value="3">3</option>
                <option value="6">6</option>
                <option value="9">9</option>
              </select>
        </div>
            
            {{ $dataMahasiswa->links() }}
        

    </div>
    <!-- AKHIR DATA -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Apakah Yakin Delete</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
            <div class="modal-body">
              {{session('message2')}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
              <button type="button" class="btn btn-primary" wire:click="delete()" data-bs-dismiss="modal">Delete</button>
            </div>
          </div>
        </div>
      </div>
</div>