@extends('/admin/layouts/master',['title'=>'Role'])
@section('content')

<!-- Small boxes (Stat box) -->
<!-- ############ PAGE START-->
<div ui-view class="app-body" id="view">
  <!-- ############ PAGE START-->
  <div class="padding">
    <div class="box">
      <div class="box-header">
        <h4 style="position: relative;top:10px">Role User</h4>

        {{-- <div class="form-group">
            <select class="form-control" name="" id="selectfilter">
                <option value="" >--All--</option>
            </select>
        </div> --}}
      </div>
      <hr>
      <div class="p-3 table-responsive">
        <table id="role-table" class="dataTable table table-striped table-bordered dt-responsive nowrap">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Nim</th>
              <th>Status</th>
              <th>Verified At</th>
              <th class="text-center">Role</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($mahasiswa as $item)

            <tr>
              <td>{{$item->name}}</td>
              <td>{{$item->nim}}</td>
              <td>{{$item->status}}</td>
              <td>{{$item->verified_at}}</td>
              <td class="text-center">
                <select name="role_id" class="roleSelect" data-id="{{$item->model_id}}">
                  @foreach ($role as $item2)
                  <option value="{{$item2->id}}" @if($item2->id == $item->role_id) selected @endif>{{$item2->name}}
                  </option>
                  @endforeach
                </select>
                </form>
              </td>

            </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>
  </div>

  <!-- ############ PAGE END-->

</div>
</div>
<!-- / -->

<!-- theme switcher -->


@endsection

@section('footer')
<script>
  $('#role-table').DataTable({
      order : false,
    });

    $(".dataTable").on('change','.roleSelect', function () { 
        event.preventDefault()
        var model_id = $(this).attr('data-id');
        var role_id = $(this).val();
     
            
        $.ajax({
          url: '/admin/role/update/' + model_id,
          type: 'put',
          data: {model_id : model_id, role_id : role_id},
          success: function(data){
            alert('success');

          },
          error: function(data) {
            var errors = data.responseJSON;
            console.log(errors);
          }
        });
      })
</script>
@endsection