@extends('layouts.main')
<?php
    use App\Ref;
?>
@section('content')
<!--<style>
    table.table-bordered.dataTable tbody td a:visited {
        color: purple !important;
    }
</style>-->
<style>
    #helpdeskbanner{
        
        background-image: url({{ url('Hand-Banner.png') }}) !important; 
        
                /* no-repeat; */
                /* Keep the inherited background full size. */
                background-attachment: fixed; 
                /* background-size: cover; */
                display: grid;
                align-items: center;
                justify-content: center;
                height: 30vh;
    }
    #helpdeskcontainer{
        width: 45rem;
        height: 20rem;
        box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2); 
        border-radius: 5px;
        right: 300px;
        position: relative;
        z-index: 1;
        background: inherit;
        overflow: hidden;
    }
    #helpdeskcontainer:before{
        content: "";
        position: absolute;
        background: inherit;
        z-index: -1;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        box-shadow: inset 0 0 2000px rgba(255, 255, 255, .5);
        filter: blur(10px);
        margin: -20px;
    }
</style>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!-- <div style="background-image: url({{ url('Hand-Banner.png') }}) !important; height: 100%;"> -->
                    <!-- <div style="background-color:rgb(242, 243, 244);opacity:0.1; width: 100px; margin-left: 100px;">
                        <b>Laporan Helpdesk WhatsApp</b>
                    </div>
                    
                    <br><br><br><br><br>
                    <br><br><br><br><br> -->
                <!-- </div> -->
                <div id="helpdeskbanner">
                    <div id="helpdeskcontainer">
                        <div style="padding-left: 30px;padding-top: 10px;">
                            <p style="font-size:32px;color:black;font-weight:bolder;">Laporan</p>
                            <p style="font-size:32px;color:black;font-weight:bolder;">Helpdesk</p>
                            <p style="font-size:32px;color:black;font-weight:bolder;">WhatsApp</p>
                        </div>
                    </div>

                <!-- <br><br><br><br><br><br><br><br><br><br><br> -->
                </div>
                
                @include('nota')
                <div class="ibox-content">
                    {!! Form::open(['id' => 'search-form', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <!-- <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('CA_CASEID', 'No. Telefon', ['class' => 'col-sm-4 control-label']) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('CA_CASEID', '', ['class' => 'form-control input-sm', 'id' =>'CA_CASEID']) }}
                                    </div>
                                </div>
                            
                            </div> -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('CA_RCVDT', 'Tarikh Penerimaan', ['class' => 'col-sm-4 control-label']) }}
                                    <div class="col-sm-8">
                                        {{ Form::text('CA_RCVDT', '', ['class' => 'form-control input-sm']) }}
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                        <div class="form-group">
                            {{ Form::submit('Carian', ['class' => 'btn btn-primary btn-sm']) }}
                            {{ link_to('laporan/helpdesk/laporanhdws', 'Semula', ['class' => 'btn btn-default btn-sm']) }}
                        </div>
                    {!! Form::close() !!}
                    <form action="{{ route('pindah.editkelompok') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="table-responsive">
                        <!-- <button type="submit" class="btn btn-success btn-sm" id="btnkelompok"><i class="fa fa-plus"></i> Pertanyaan / Cadangan Baru</a>Tambah Aduan</button> -->
                        <a href="{{ url('laporan/helpdesk/laporanhdws/create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah Aduan</a>
                        <table id="pindah-aduan-table" class="table table-striped table-bordered table-hover dataTables-example" style="width: 100%">
                            <thead>
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Bil.</th>
                                    <th>No. Aduan</th>
                                    <th>Aduan</th>
                                    <th>Nama Yang Diadu</th>
                                    <th>Status Aduan</th>
                                    <th>Tarikh Penerimaan</th>
                                  <th><center>Hari </center></th>
                                   <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal Start -->
<div id="modal-show-summary" class="modal fade" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id='ModalShowSummary'></div>
    </div>
</div>
<!-- Modal End -->
@stop

@section('script_datatable')
<script type="text/javascript">
    
function anyCheck(){
    var CheckCount = $("#pindah-aduan-table [type=checkbox]:checked").length;
//    alert(CheckCount);
    if(CheckCount >= 2) {
//        alert("Lebih atau sama 2");
        document.getElementById("btnkelompok").disabled = false;
    }else{
        document.getElementById("btnkelompok").disabled = true;
    }
}
    
function ShowSummary(CASEID)
{
//    var CASEID = $("#penugasan-table a").value;
     $('#modal-show-summary').modal("show").find("#ModalShowSummary").load("{{ route('tugas.showsummary','') }}" + "/" + CASEID);
}
        $(function() {
            var oTable = $('#pindah-aduan-table').DataTable({
                processing: true,
                serverSide: true,
                bFilter: false,
                aaSorting: [],
                pagingType: "full_numbers",
                pageLength: 50,
                order: [ 6, 'desc' ],
                dom: "<'row'<'col-sm-6'i><'col-sm-6 html5buttons'B<'pull-right'l>>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12'p>>",
                buttons: [
//                    {extend: 'excel'},
                    {
                        extend: 'excel',
                        title: 'Senarai Pindah Aduan',
                        exportOptions: { 
                            orthogonal: 'export'
                        }
                    },
                    {extend: 'pdf'},
                    {extend: 'print',text: 'Cetak', customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                        }
                    }
                ],
                language: {
                    lengthMenu: 'Memaparkan _MENU_ rekod',
                    zeroRecords: 'Tiada rekod ditemui',
                    info: 'Memaparkan _START_-_END_ daripada _TOTAL_ rekod',
                    infoEmpty: 'Tiada rekod ditemui',
                    infoFiltered: '(Paparan daripada _MAX_ jumlah rekod)',
                    paginate: {
                        previous: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
                        next: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
                        first: 'Pertama',
                        last: 'Terakhir',
                    },
                },
                ajax: {
                    url: "{{ url('laporan/helpdesk/getdatatable2/') }}",
                    data: function (d) {
                        d.CA_CASEID = $('#CA_CASEID').val();
                        d.CA_SUMMARY = $('#CA_SUMMARY').val();
                        d.CA_AGAINSTNM = $('#CA_AGAINSTNM').val();
                        d.CA_INVSTS = $('#CA_INVSTS').val();
                        d.CA_RCVDT = $('#CA_RCVDT').val();
//                        d.CA_CASESTS = $('#CA_CASESTS').val();
                    }
                },
                columns: [
                    // {data: 'check', name: 'check', 'width': '1%', searchable: false, orderable: false},
                    {data: 'DT_Row_Index', name: 'id', 'width': '5%', searchable: false, orderable: false},
//                    {data: 'CA_CASEID', name: 'CA_CASEID'},
                    {data: 'CA_CASEID', render: function (data, type) {
                        return type === 'export' ?
                            "' " + data :
                            data;
                    }, name: 'CA_CASEID'},
                    {data: 'CA_SUMMARY', name: 'CA_SUMMARY'},
                    {data: 'CA_AGAINSTNM', name: 'CA_AGAINSTNM'},
                    {data: 'CA_INVSTS', name: 'CA_INVSTS'},
                    {data: 'CA_RCVDT', name: 'CA_RCVDT'},
                    {data: 'tempoh', name: 'tempoh', searchable: false, orderable: false},
                    {data: 'action', name: 'action', searchable: false, orderable: false}
                ]
            });

            $('#search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
        });
        
        $('#CA_RCVDT').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: "linked",
            todayHighlight: true,
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });
    </script>
@stop