@extends('admin.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @include('sweetalert::alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Data Buku</h5>
            </div>
            <div class="card-body">
                <a data-toggle="modal" data-target="#exampleModal" href="#" class="mb-4 btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah Buku</span>
                </a>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bukus as $buku)
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->kategori->nama }}</td>
                                    <td>{{ $buku->jumlah }}</td>
                                    <td>

                                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ?');">

                                            {{-- berada dalam form agar sejajar --}}
                                            <a href="{{ route('buku.edit', $buku->id) }}"
                                                class="btn btn-primary btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span class="text">Ubah</span>
                                            </a>

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon-split btn-sm"><span
                                                    class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span> <span class="text">Hapus</span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $bukus->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    {{-- modal tambah data --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Judul:</label>
                            <input name="judul" type="text" class="form-control" value="{{ old('judul') }}">
                            @error('judul')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori_id" class="custom-select">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jumlah</label>
                            <input name="jumlah" type="number" value="{{ old('jumlah') }}"class="form-control">
                            @error('jumlah')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Gambar / Sampul</label>

                            <img class="img-preview img-fluid col-sm-2 mb-3" src="" alt="">

                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror hidden"
                                    id="image" name="image" onchange="previewImage()">

                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <label class="custom-file-label" for="customFile">Upload gambar</label>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Buku</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    {{-- image preview on upload--}}
    <script>
        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview')
        
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
        
            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
        </script>

<script>
    function confirmDelete(item_id) {
        swal({
             title: 'Apakah Anda Yakin?',
              text: "Anda Tidak Akan Dapat Mengembalikannya!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
        })
            .then((willDelete) => {
                if (willDelete) {
                    $('#'+item_id).submit();
                } else {
                    swal("Cancelled Successfully");
                }
            });
    }
</script>
@endsection
