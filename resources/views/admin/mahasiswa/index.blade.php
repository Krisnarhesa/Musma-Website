@extends('/admin/layouts/master',['title'=>'Mahasiswa'])
@section('content')
<div ui-view class="app-body" id="view">
  <div class="modal fade" id="verif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          apakah yakin ingin memverifikasi?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="btnVerif" class="btn btn-danger" data-id="" data-dismiss="modal">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          apakah yakin ingin menghapus data?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="btnDelete" class="btn btn-danger" data-id="" data-dismiss="modal">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Data berhasil Dihapus
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="padding">
    <div class="box">
      <div class="box-header">
        <small>List Mahasiswa</small>
      </div>
      <div class="p-3 ">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Nim</th>
              <th>Program Studi</th>
              <th>File</th>
              <th>Status</th>
              <th>Registered At</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody class="hasil">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  $(document).ready(function() {
    loaddata();

    $(document).on("click",'#btnVerif',function(){
      event.preventDefault()
      var data = $(this).attr('data-id');
      console.log(data);
      var table = $('#example').DataTable(); 

      $.ajax({
        url: '/admin/mahasiswa/verif/' + data,
        type: 'put',
        data: data,
        success: function(data){
          loaddata();
        },
        error: function(data) {
          var errors = data.responseJSON;
          console.log(errors);
        }
      });
    })

    $(document).on("click",'#btnDelete',function(){
      event.preventDefault()
      var data = $(this).attr('data-id');
      console.log(data);

      $.ajax({
        url: '/admin/mahasiswa/delete/' + data,
        type: 'delete',
        data: data,
        success: function(data){
          loaddata();
          $('#alert').modal('show');

        },
        error: function(data) {
          var errors = data.responseJSON;
          console.log(errors);
        }
      });
    });

    function loaddata(){
      $.ajax({
      url: '/admin/mahasiswa/data',
      type: 'get',
      dataType: 'html',
      success: function(data){
        // Destroy existing table
        $('#example').DataTable().destroy();
        
        $('.hasil').html(data);
        // Initialize the table
        $('#example').DataTable({
          "bStateSave": true,
          "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('example', JSON.stringify(oData));
          },
          "fnStateLoad": function (oSettings, oData) {
            return JSON.parse(localStorage.getItem('example'));
          }
        });
      },
      error: function(data) {
        var errors = data.responseJSON;
        console.log(errors);
      }});
    };

  });
</script>
@endsection