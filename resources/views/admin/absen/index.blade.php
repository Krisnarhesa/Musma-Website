@extends('/admin/layouts/master', ['title' => 'Absen'])
@section('content')
    <div ui-view class="app-body" id="view">

        <div class="padding">
            <div class="box">
                <div class="box-header">
                    <h4 style="position: relative;top:10px">Absen Mahasiswa</h4>
                </div>
                <hr>
                <div class="p-3 ">
                    <table id="absen" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Program Studi</th>
                                {{-- <th class="text-center">Status Absen</th> --}}
                                <th>Waktu Memilih</th>
                                <th>SMFT</th>
                                <th>BPMFT</th>
                                @if (Auth::user()->hasRole('admin'))
                                    <th class="text-center">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absen as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['nim'] }}</td>
                                    <td>{{ $item['nama_prodi'] }}</td>
                                    <td>{{ $item['waktu_memilih'] }}</td>
                                    {{-- <td class="text-center"> <span>&#10004;</span> </td> --}}
                                    <td>
                                        @if (optional($item)['smft'] == 1)
                                            Ida Bagus KD. Riva Wiguna Putra
                                        @elseif(optional($item)['smft'] == 2)
                                            Anak Agung Gede Weda Baweswara
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if (optional($item)['bpmft'] == 3)
                                            I Dewa Gede Raiyana
                                        @elseif(optional($item)['bpmft'] == 4)
                                            I Putu Depa Aristya Putra
                                        @elseif(optional($item)['bpmft'] == 5)
                                            Dhiyo Mahata Negara
                                        @else
                                            -
                                        @endif
                                    </td>
                                    @if (Auth::user()->hasRole('admin'))
                                        <td class="text-center"><a href="#myModal" class="reset btn btn-danger"
                                                data-id="{{ $item['mahasiswa_id'] }}" data-nama="{{ $item['name'] }}"
                                                role="button" data-toggle="modal">Reset Suara</a></td>
                                    @endif
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
                    <h3 id="myModalLabel">Reset Confirmation</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p class="error-text">
                        <i class="fa fa-warning modal-icon"></i>
                        apakah anda yakin ingin mereset suara dari user ini?
                    </p>
                </div>
                <div class="modal-footer">
                    <form id="modalReset" action="#" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        <button type="submit" class="btn btn-danger">reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();

            var d = day + "-" + month + "-" + year;

            var table = $('#absen').DataTable({
                ordering: true,
                dom: 'lBfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    className: 'btn btn-danger',
                    text: 'Export to excel',
                    title: 'ABSEN MUSMA TEKNIK - ' + d,
                    filename: 'absen musma - ' + d,
                    init: function(api, node, config) {
                        $(node).removeClass('dt-button')
                    },
                    exportOptions: {
                        rows: {
                            search: 'applied'
                        },
                        orthogonal: 'export',
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }],
            });

            $(".dataTable").on('click', '.reset', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var title = document.getElementById("myModalLabel");
                title.innerHTML = "Data : " + nama;
                $('#modalReset').attr('action', '/admin/absen/reset/' + id);
            });
        });
    </script>

    {{-- <script>
    $(document).ready(function() {
      var currentDate = new Date();
      var day = currentDate.getDate();
      var month = currentDate.getMonth() + 1;
      var year = currentDate.getFullYear();

      var d = day + "-" + month + "-" + year;

      $('#absen').DataTable({
        ordering: true,
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          className: 'btn btn-danger',
          text: 'Export to excel',
          title: 'ABSEN MUSMA TEKNIK - ' + d,
          filename: 'absen musma - ' + d,
          init: function(api, node, config) {
            $(node).removeClass('dt-button')
          },
          exportOptions: {
            rows: {
              search: 'applied'
            },
            orthogonal: 'export',
            columns: [0, 1, 2, 3, 4, 5]
          }
        }],
      });

      $(".dataTable").on('click', '.reset', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var title = document.getElementById("myModalLabel");
        title.innerHTML = "Data : " + nama;
        $('#modalReset').attr('action', '/admin/absen/reset/' + id);
      });
    });
  </script> --}}
@endsection
{{-- @extends('/admin/layouts/master', ['title' => 'Absen'])
@section('content')
  <div ui-view class="app-body" id="view">

    <div class="padding">
      <div class="box">
        <div class="box-header">
          <h4 style="position: relative;top:10px">Absen Mahasiswa</h4>
        </div>
        <hr>
        <div class="p-3 ">
          <table id="absen" class="table table-striped table-bordered dt-responsive nowrap">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Nim</th>
                <th>Program Studi</th>
                <th class="text-center">Status Absen</th>
                @if (Auth::user()->hasRole('admin'))
                  <th class="text-center">Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($absen as $item)
                <tr>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->nim }}</td>
                  <td>{{ $item->nama_prodi }}</td>
                  <td class="text-center"> <span>&#10004;</span> </td>
                  @if (Auth::user()->hasRole('admin'))
                    <td class="text-center"><a href="#myModal" class="reset btn btn-danger"
                        data-id="{{ $item->mahasiswa_id }}" data-nama="{{ $item->name }}" role="button"
                        data-toggle="modal">Reset Suara</a></td>
                  @endif
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
          <h3 id="myModalLabel">Reset Confirmation</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <p class="error-text">
            <i class="fa fa-warning modal-icon"></i>
            apakah anda yakin ingin mereset suara dari user ini?
          </p>
        </div>
        <div class="modal-footer">
          <form id="modalReset" action="#" method="post">
            @method('delete')
            @csrf
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button type="submit" class="btn btn-danger">reset</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script>
    $(document).ready(function() {
      var currentDate = new Date();
      var day = currentDate.getDate();
      var month = currentDate.getMonth() + 1;
      var year = currentDate.getFullYear();

      var d = day + "-" + month + "-" + year;

      $('#absen').DataTable({
        order: false,
        dom: 'Bfrtip',
        buttons: [{
          extend: 'excelHtml5',
          className: 'btn btn-danger',
          text: 'Export to excel',
          title: 'ABSEN MUSMA TEKNIK - ' + d,
          filename: 'absen musma - ' + d,
          init: function(api, node, config) {
            $(node).removeClass('dt-button')
          },
          exportOptions: {
            rows: {
              search: 'applied'
            },
            orthogonal: 'export',
            columns: [0, 1, 2, 3]
          }
        }],
      });

      $(".dataTable").on('click', '.reset', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var title = document.getElementById("myModalLabel");
        title.innerHTML = "Data : " + nama;
        $('#modalReset').attr('action', '/admin/absen/reset/' + id);
      });
    });
  </script>
@endsection --}}
