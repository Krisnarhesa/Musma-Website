@extends('/admin/layouts/master',['title'=>'Create Calon'])
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
            <form role="form" method="post" action="/admin/calon/store" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label for="Nama">nim</label>
                <input type="number" class="form-control" name="nim" id="nim" placeholder="Enter Nim">
                <div class="" id="nimList">
                </div>
              </div>
              <div class="form-group">
                <label for="Nama">Nama Panggilan</label>
                <input type="text" class="form-control" name="nama_panggilan" id="nama"
                  placeholder="Enter nama Panggilan">
              </div>
              <div class="form-group">
                <label for="visi">Visi</label>
                <textarea name="visi" id="input-visi" name="visi" class="form-control" rows="10" cols="80"
                  placeholder="Masukkan Visi"></textarea>
              </div>
              <div class="form-group">
                <label for="misi">Misi</label>
                <textarea name="misi" id="input-misi" name="misi" class="form-control" rows="10" cols="80"
                  placeholder="Masukkan Misi"></textarea>
              </div>
              <div class="form-group">
                <label for="Jenis Calon">Jenis Calon</label>
                <select name="jenis_calon" id="" class="form-control">
                  <option value="" disabled hidden selected>Pilih Jenis</option>
                  <option value="SMFT">SMFT</option>
                  <option value="BPMFT">BPMFT</option>
                </select>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Foto</label>
                <input type="file" id="exampleInputFile" class="form-control" name="photo_url" required>
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