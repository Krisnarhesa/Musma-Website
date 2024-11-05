@extends('/admin/layouts/master',['title'=>'Calon'])
@section('content')
<div ui-view class="app-body" id="view">
  <div class="padding">
    <div class="box">
      <div class="box-header">
        <h4 style="position: relative;top:10px">List Calon</h4>
      </div>

      <hr>

      <div class="p-3">
        <a href="/admin/calon/create" class="btn btn-success">Create</a>

        <table id="calon" class="table table-striped table-bordered dt-responsive nowrap">
          <thead>
            <tr>
              <th>Nama Panggilan</th>
              <th>Jenis calon</th>
              <th>Visi</th>
              <th>Misi</th>
              <th>Photo</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($calon as $item)
            <tr>
              <td>{{$item->nama_panggilan}}</td>
              <td>{{$item->jenis_calon}}</td>
              <td>{!!substr($item->visi, 0, 100) . '...'!!}</td>
              <td>{!!substr($item->misi, 0, 100) . '...'!!}</td>
              <td><img src="{{$item->takeimage}}" alt="avatar" style="width: 100px"></td>
              <td><a class="btn btn-primary" href="/admin/calon/edit/{{$item->id}}">Edit</a> | <a href="#myModal"
                  class="trash btn btn-danger" data-id="{{$item->id}}" data-nama="{{$item->nama_panggilan}}"
                  role="button" data-toggle="modal">Hapus</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="myModalLabel">Delete Confirmation</h3>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <p class="error-text">
          <i class="fa fa-warning modal-icon"></i>
          apakah anda yakin ingin menghapus item ini?
        </p>
      </div>
      <div class="modal-footer">
        <form id="modalDelete" action="#" method="post">
          @method('delete')
          @csrf
          <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  $(document).ready(function() {
    $('#calon').DataTable({
      order : false,
    });

    $(".dataTable").on('click','.trash', function () { 
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var title = document.getElementById("myModalLabel");
      title.innerHTML = "Data : "+ nama;
      
      $('#modalDelete').attr('action', '/admin/calon/delete/' + id);
    });
  });
</script>
@endsection