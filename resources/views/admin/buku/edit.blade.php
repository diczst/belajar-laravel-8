@extends('admin.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">

                        <div class="row">
                            <div class="col">
                                <a href="{{ route('buku.index') }}" class="btn btn-primary btn-icon-split"><span
                                        class="icon text-white-50">
                                        <i class="fas fa-arrow-left"></i>
                                    </span>
                                    <span class="text">Kembali</span></a>
                            </div>

                            <div class="col">
                                <h3 class="font-weight-bold mt-2 text-center text-primary">Ubah Data Buku</h3>
                            </div>
                            <div class="col"></div>

                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Judul Buku</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title', $buku->judul) }}" required>

                                <!-- error message untuk nama -->
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="category_id" class="custom-select">
                                    @foreach ($kategoris as $kategori)
                                        @if ($kategori->id != $buku->kategori->id)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @else
                                            <option selected value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endif
                                    @endforeach


                                </select>
                            </div>

                            <div class="form-group">
                                <label>Jumlah</label>
                                <input name="jumlah" type="number" class="form-control" value="{{ $buku->jumlah }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Gambar / Sampul</label>

                                {{-- hidden input to store oldImage, delete old image if new iamge uploaded --}}

                                <input type="hidden" name="oldImage" value="{{ $buku->gambar }}">

                                @if ($buku->gambar)
                                    <img class="img-preview img-fluid col-sm-2 mb-3 d-block" src="{{ asset('storage/' . $buku->gambar) }}" alt="">
                                @else
                                    <img class="img-preview img-fluid col-sm-2 mb-3" src="" alt="">
                                @endif

                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input @error('image') is-invalid @enderror hidden" id="image"
                                        name="image" onchange="previewImage()">

                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <label class="custom-file-label" for="customFile">Upload gambar</label>
                                </div>

                            </div>

                            <div class="form-group">

                            </div>

                            <button type="submit" class="btn btn-info btn-icon-split"><span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Ubah Data</span></button>

                            <button type="reset" class="btn btn-danger btn-icon-split"><span class="icon text-white-50">
                                    <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">Batal</span></button>


                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>

    <!-- /.container-fluid -->
@endsection
