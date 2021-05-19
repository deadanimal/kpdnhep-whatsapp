@extends('layouts.main')
@section('content')
<h2>Lampiran</h2>
<div class="tabs-container">
    <ul class="nav nav-tabs">
        <li class="">
            <a >
                <span class="fa-stack">
                    <span style="font-size: 14px;" class="badge badge-danger">1</span>
                </span>
                MAKLUMAT ADUAN
            </a>
        </li>
        <li class="active">
            <a>
                <span class="fa-stack">
                    <span style="font-size: 14px;" class="badge badge-danger">2</span>
                </span>
                LAMPIRAN
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="panel-body">
                <h4>( Maksimum 3 Lampiran sahaja )</h4>
                @if($countDoc < 3)
                    <div class="row">
                        <div class="col-sm-12">
                            <a onclick="ModalAttachmentCreate('{{ $model->id }}')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Lampiran</a>
                        </div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="pertanyaan-admin-doc-table" class="table table-striped table-bordered table-hover dataTables-example" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <th>Nama Fail</th>
                                <th>Tarikh Muatnaik</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12" align="center">
                        <a class="btn btn-success btn-sm" href="{{ route('laporan.helpdesk.editFirst', $model->id) }}"><i class="fa fa-chevron-left"></i> Sebelum</a>
                        <a class="btn btn-default btn-sm" href="{{ url('laporan/helpdesk/laporanhdws') }}">Kembali</a>
                        <a class="btn btn-success btn-sm" href="{{ url('laporan/helpdesk/laporanhdws') }}">Simpan<i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Create Attachment Start -->
<div class="modal fade" id="modal-create-attachment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id='modalCreateContent'></div>
    </div>
</div>
<!-- Modal Edit Attachment Start -->
<div class="modal fade" id="modal-edit-attachment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id='modalEditContent'></div>
    </div>
</div>
@stop

@section('script_datatable')
<script type="text/javascript">
    
    function ModalAttachmentCreate(id) {
        $('#modal-create-attachment').modal("show").find("#modalCreateContent").load("{{ route('laporan.helpdesk.createAttachment','') }}" + "/" + id);
        return false;
    }

    function ModalAttachmentEdit(id) {
        $('#modal-edit-attachment').modal("show").find("#modalEditContent").load("{{ route('laporan.helpdesk.editAttachment','') }}" + "/" + id);
        return false;
    }
    
    $('#pertanyaan-admin-doc-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        aaSorting: [],
        bLengthChange: false,
        bPaginate: false,
        bInfo: false,
        language: {
            lengthMenu: 'Paparan _MENU_ rekod',
            zeroRecords: 'Tiada rekod ditemui',
            info: 'Memaparkan _START_-_END_ daripada _TOTAL_ rekod',
            infoEmpty: 'Tiada rekod ditemui',
            infoFiltered: '(Paparan daripada _MAX_ jumlah rekod)',
        },
        ajax: {
            url: "{{ url('laporan/helpdesk/getdatatable', 'LW' . $model->id) }}"
        },
        columns: [
            {data: 'DT_Row_Index', name: 'id', 'width': '5%', searchable: false, orderable: false},
            {data: 'img_name', name: 'img_name'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', searchable: false, orderable: false, width: '5%'}
        ]
    });
</script>
@stop
