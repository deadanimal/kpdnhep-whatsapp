@extends('layouts.main')
<?php
    use App\Menu;
    use App\Ref;
    use App\Pertanyaan\PertanyaanAdmin;
?>
@section('content')
<style> 
    textarea {
        resize: vertical;
    }
    span.select2 {
        width: 100% !important;
    }
</style>
<h2>Tambah Aduan Baru</h2>
<div class="tabs-container">
    <ul class="nav nav-tabs">
        <li class="active">
            <!--<a data-toggle="tab" href="#enq_info">@lang('pertanyaan.tab.enquiry')</a>-->
            <a>
                <span class="fa-stack">
                    <span style="font-size: 14px;" class="badge badge-danger">1</span>
                </span>
                MAKLUMAT ADUAN
            </a>
        </li>
        <li class="">
            <a>
                <span class="fa-stack">
                    <span style="font-size: 14px;" class="badge badge-danger">2</span>
                </span>
                LAMPIRAN
            </a>
        </li>
   
    </ul>
    <div class="tab-content">
        <div id="enq_info" class="tab-pane active">
            <div class="panel-body">
                {!! Form::open(['route' => 'laporan.helpdesk.saveEdit','class'=>'form-horizontal', 'method' => 'post']) !!}
                    {{ csrf_field() }}
                   <div class="row">
                    <div class="col-sm-6">
                        {{ Form::hidden('laporanid', $model->id) }}
                        <div class="form-group{{ $errors->has('AS_NI') ? ' has-error' : '' }}">
                            {{ Form::label('AS_NI', 'Nama Isu', ['class' => 'col-sm-5 control-label']) }}
                            <div class="col-sm-7">
                                {{ Form::text('AS_NI', old('AS_NI', $model->AS_NI), ['class' => 'form-control input-sm', 'id' => 'AS_NI' ]) }}
                                @if ($errors->has('AS_NI'))
                                <span class="help-block"><strong>{{ $errors->first('AS_NI') }}</strong></span>
                                @endif
                            </div>
                        </div>   
                        <div class="form-group{{ $errors->has('AS_RCVTYP') ? ' has-error' : '' }}">
                            {{ Form::label('AS_RCVTYP', 'Tahap', ['class' => 'col-sm-5 control-label ']) }}
                            <div class="col-sm-7">
                                {{ Form::select('AS_RCVTYP', array('R' => 'Rendah', 'S' => 'Sederhana', 'T' => 'Tinggi'), old('AS_RCVTYP', $model->AS_RCVTYP), ['class' => 'form-control input-sm']) }}
                                @if ($errors->has('AS_RCVTYP'))
                                    <span class="help-block"><strong>{{ $errors->first('AS_RCVTYP') }}</strong></span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('AS_SUMMARY') ? ' has-error' : '' }}">
                                {{ Form::label('AS_SUMMARY', 'Keterangan', ['class' => 'col-sm-5 control-label ']) }}
                                <div class="col-sm-7">
                                    {{ Form::textarea('AS_SUMMARY', old('AS_SUMMARY', $model->AS_SUMMARY), ['class' => 'form-control input-sm taklebar', 'rows' => 4 ]) }}
                                    @if ($errors->has('AS_SUMMARY'))
                                        <span class="help-block"><strong>{{ $errors->first('AS_SUMMARY') }}</strong></span>
                                    @endif
                                </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6">
                 
                    </div> -->
                </div>
                    <div class="row">
                        <div class="form-group" align="center">
                            <a class="btn btn-default btn-sm" href="{{ route('laporan.helpdesk.index') }}">Kembali</a>
                            <!--{{-- Form::submit(trans('button.send'), ['name' => 'btnHantar','class' => 'btn btn-success btn-sm']) --}}-->
                            <!--{{-- Form::submit(trans('button.save'), ['name' => 'btnSimpan','class' => 'btn btn-primary btn-sm']) --}}-->
                            {{ Form::button('Simpan & Seterusnya'.' <i class="fa fa-chevron-right"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-sm']) }}
                        </div>  
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('script_datatable')
<script type="text/javascript">
    $(function () {

        $('#module_ind').on('change', function(e){
            alert($('#module_ind').val());
        });
        
        $('#AS_STATECD').on('change', function (e) {
            var AS_STATECD = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{ url('admin-case/getdistlist') }}" + "/" + AS_STATECD,
                dataType: "json",
                success: function (data) {
                    $('select[name="AS_DISTCD"]').empty();
                    $.each(data, function (key, value) {
                        $('select[name="AS_DISTCD"]').append('<option value="' + value + '">' + key + '</option>');
                    });
                }
            });
        });
        
        $("select").select2();
        
    });
    
    function check(value) {
        if (value === '1') {
            $('#warganegara').show();
            $('#bknwarganegara').hide();
        } else {
            $('#warganegara').show();
            $('#bknwarganegara').show();
        }
    }
    
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    
    // $('#AS_NI').blur(function(){
    //     var AS_NI = $('#AS_NI').val();
    //     $.ajax({
    //         type: 'GET',
    //         url: "{{ url('admin-case/tojpn') }}" + "/" + AS_NI,
    //         dataType: "json",
    //         success: function (data) {
    //             if (data.Message) {
    //                 alert(data.Message);
    //             }
    //             $('#AS_EMAIL').val(data.EmailAddress); // Email
    //             $('#AS_MOBILENO').val(data.MobilePhoneNumber); // Telefon Bimbit
    //             $('#AS_STATUSPENGADU').val(data.StatusPengadu); // Status Pengadu
    //             $('#AS_NAME').val(data.Name); // Nama
    //             $('#AS_AGE').val(data.Age); // Umur
    //             $('#AS_SEXCD').val(data.Gender).trigger('change'); // Jantina
    //             if (data.Warganegara != '') {
    //                 if (data.Warganegara === '1') { // Warganegara
    //                     document.getElementById('AS_NATCD1').checked = true;
    //                     $('#warganegara').show();
    //                     $('#bknwarganegara').hide();
    //                 } else {
    //                     document.getElementById('AS_NATCD2').checked = true;
    //                     $('#warganegara').show();
    //                     $('#bknwarganegara').show();
    //                 }
    //             }
    //             // Standard Field
    //             $('#AS_ADDR').val(data.CorrespondenceAddress1 + '\n' + data.CorrespondenceAddress2); // Alamat
    //             $('#AS_POSCD').val(data.CorrespondenceAddressPostcode); // Poskod
    //             $('#AS_STATECD').val(data.CorrespondenceAddressStateCode).trigger('change'); // Negeri
    //             getDistListFromJpn(data.CorrespondenceAddressStateCode, data.KodDaerah); // Daerah
    //         },
    //         error: function (data) {
    //             console.log(data);
    //             if (data.status == '500') {
    //                 alert(data.statusText);
    //             }
    //         },
    //         complete: function (data) {
    //             console.log(data);
    //         }
    //     });
    // });
    
    function getDistListFromJpn(StateCd, DistCd) {
        if(StateCd != '' && DistCd != '') {
            $.ajax({
                type: 'GET',
                url: "{{ url('admin-case/getdistlist') }}" + "/" + StateCd,
                dataType: "json",
                success: function (data) {
                    $('select[name="AS_DISTCD"]').empty();
                    $.each(data, function (key, value) {
                        if (DistCd === value)
                            $('select[name="AS_DISTCD"]').append('<option value="' + value + '" selected="selected">' + key + '</option>');
                        else
                            $('select[name="AS_DISTCD"]').append('<option value="' + value + '">' + key + '</option>');
                    });
                }
            });
        }else{
            $('select[name="AS_DISTCD"]').empty();
            $('select[name="AS_DISTCD"]').append('<option value="">-- SILA PILIH --</option>');
        }
    }
</script>
@stop
