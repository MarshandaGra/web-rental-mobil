<x-app-layout class="d-flex">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemesan') }}
        </h2>
    </x-slot>
    <div class="container-fluid ">
        <p class="h3">Form Edit Data Pemesan</p>
    </div>

    <div class="row mt-4">
        <div class="col-5">
            <!-- Header dengan warna biru -->
            <div class="mb-3">
                <h4 class="bg-secondary text-white p-2 rounded">Edit Data</h4>
            </div>
            <!-- Form dengan shadow -->
            <form method="POST" action="{{ route('pemesan.update', $pemesan->id) }}" class="shadow p-3 mb-5 bg-white rounded" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" class="form-control @error('nama_pemesan') is-invalid @enderror"
                        id="nama_pemesan" value="{{ old('nama_pemesan', $pemesan->nama_pemesan) }}">
                    @error('nama_pemesan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                        id="alamat" value="{{ old('alamat', $pemesan->alamat) }}">
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                        id="no_hp" value="{{ old('no_hp', $pemesan->no_hp) }}">
                    @error('no_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Foto</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()">
                    <input type="hidden" name="oldImage" value="{{ $pemesan->image }}">
                    @if ($pemesan->image)
                        <img src="{{ asset('storage/'.$pemesan->image) }}" class="img-preview img-fluid mt-2 col-sm-5 d-block">
                    @else
                        <img class="img-preview img-fluid mt-2 col-sm-5">
                    @endif
                    @error('image')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>

        <script>
        
            function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
    
        imgPreview.style.display = 'block';
        const ofReader = new FileReader();
        ofReader.readAsDataURL(image.files[0]);
    
        ofReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
        }
        </script>
</x-app-layout>
