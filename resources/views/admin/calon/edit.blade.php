@extends('/admin/layouts/master',['title'=>'Edit Calon'])
@section('content')
<div ui-view class="app-body" id="view">

  <div class="padding">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h2>Create Calon</h2>
          </div>
          <div class="box-divider m-0"></div>
          <div class="box-body">
            <form role="form" method="post" action="/admin/calon/update/{{$calon->id}}" enctype="multipart/form-data">
              @method('put')
              @csrf
              <input type="hidden" name="user_id" value="{{$calon->user_id}}">
              <div class="form-group">
                <label for="Nama">Nama Panggilan</label>
                <input type="text" name="nama_panggilan" class="form-control" id="nama"
                  placeholder="Enter nama Panggilan" value="{{$calon->nama_panggilan}}">
              </div>
              <div class="form-group">
                <label for="visi">Visi</label>
                <textarea name="visi" id="input-visi" name="visi" class="form-control" rows="10" cols="80"
                  placeholder="Masukkan Visi">
                      {!!$calon->visi!!}
                    </textarea>
              </div>
              <div class="form-group">
                <label for="misi">Misi</label>
                <textarea name="misi" id="input-misi" name="misi" class="form-control" rows="10" cols="80"
                  placeholder="Masukkan Misi">
                      {!!$calon->misi!!}
                    </textarea>
              </div>
              <div class="form-group">
                <label for="Jenis Calon">Jenis Calon</label>
                <select name="jenis_calon" id="" class="form-control">
                  <option value="" disabled hidden selected>Pilih Jenis</option>
                  <option value="SMFT" @if($calon->jenis_calon == 'SMFT') selected @endif>SMFT</option>
                  <option value="BPMFT" @if($calon->jenis_calon == 'BPMFT') selected @endif>BPMFT</option>
                </select>
              </div>
              <div class="form-group">
                <input type="hidden" id="id_user" class="form-control" value="{{$calon->user_id}}" name="photo_url">
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Foto</label><br>
                <div class="imgae-wie p-3">

                  <img src="{{$calon->takeimage}}" width="10%" alt="">
                </div>
                <input type="file" id="exampleInputFile" class="form-control @error('photo_url') is-invalid @enderror"
                  name="photo_url">
                @error('photo_url')
                {{--default laravel = {{$message}} == the field is required--}}
                <div class="invalid-feedback">
                  {{-- pemanggilan error validasi --}}
                  <b style="color: red">File tidak Boleh Lebih Dari 2mb</b>
                </div>
                @enderror
                <input type="hidden" id="exampleInputFile" value="{{$calon->photo_url}}" class="form-control"
                  name="old_photo_url">
              </div>

              <button type="submit" class="btn white m-b">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  CKEDITOR.replace( 'input-visi' );
  CKEDITOR.replace( 'input-misi' );
</script>
@endsection