<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">
            <i class="fa fa-close"></i>
        </span>
        <span class="sr-only"></span>
    </button>
    <h4 class="modal-title">Kemaskini Lampiran</h4>
</div>
<div class="modal-body">
    {!! Form::open(['route' => ['laporan.helpdesk.updateAttachment', $model->id], 'id' => 'form-edit-attachment', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div id="file_field" class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            {{ Form::label('file', 'Fail', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
                {{ Form::file('file') }}
                <span style="color: red;">Format : jpeg, jpg, png, pdf. Maksimum 2Mb bagi setiap fail.</span>
                <span id="file_block" style="display: none;" class="help-block"></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-12" align="center">
                <button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-sm">Kemaskini</button>
            </div>
        </div>
    {!! Form::close() !!}
</div>
<script type="text/javascript">
    $("#form-edit-attachment").submit(function(e){
        e.preventDefault();
        var l = $('.ladda-button-demo').ladda();
        $.ajax({
            type : "POST",
            url: "{{ url('call-center-case/AjaxValidateEditAttachment') }}",
            dataType : "json",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                l.ladda('start');
            },
            success: function (data) {
                console.log(data);
                if (data['fails']) {
                    $('.form-group').removeClass('has-error');
                    $('.help-block').hide().text();
                    $.each(data['fails'], function (key, value) {
                        $("#form-edit-attachment div[id=" + key + "_field]").addClass('has-error');
                        $("#form-edit-attachment span[id=" + key + "_block]").show().html('<strong>' + value + '</strong>');
                    });
                    l.ladda('stop');
                } else {
                    $('#form-edit-attachment').unbind('submit').submit();
                }
            }
        });
    });
</script>