function loadExaminerByTestid(){    var testid=$('#test_id').val();    /*/alert(testid);*/    if(testid!='') {        $.ajax({            dataType:'json',            url: base_path + "/mailpdf/getExaminerByTestId",            type: 'POST',            data: {                _token: $('input[name=_token]').val(),                testid: testid            },            beforeSend: function () {                /*/ overlay_ajax();*/            },            success: function (data) {			                $("#examiner").select2('destroy').empty().select2({maximumSelectionLength: data.no_of_examiner, data: data.examiners});                $('#minimum').val(data.no_of_examiner);                /*/ $("#examiner").select2({*/                /*/     maximumSelectionLength: 0*/                /*/ });*/            },            error: function () {                /*/ $('#modal-default').modal('show');*/            },            complete: function () {                /*/ $('.box-body').unblock();*/            }        });    }else{        $("#examiner").select2('destroy').empty().select2({ data: []});        $('#minimum').val('');    }}function loadFachByTestid(){    var testid=$('#test_id').val();    /*/alert(testid);*/    if(testid!='') {        $.ajax({            dataType:'json',            url: base_path + "/mailpdf/getFaecherByTestId",            type: 'POST',            data: {                _token: $('input[name=_token]').val(),                testid: testid            },            beforeSend: function () {                /*/ overlay_ajax();*/            },            success: function (data) {				if (data.num_faecher>1){						$("#fachpicker").show();						$("#fach").select2('destroy').empty().select2({data: data.faecher});						}else{						$("#fachpicker").hide();					}								            },            error: function () {                /*/ $('#modal-default').modal('show');*/            },            complete: function () {                /*/ $('.box-body').unblock();*/            }        });    }else{        $("#fach").select2('destroy').empty().select2({ data: []});    }}function loadExaminerByFach(){    var fach=$('#fach').val();	var testid=$('#test_id').val();	var old_selection = ($("#examiner :selected").select2().text());	    if(fach!='') {        $.ajax({            dataType:'json',            url: base_path + "/mailpdf/getExaminerByFach",            type: 'POST',            data: {                _token: $('input[name=_token]').val(),				testid: testid,				                fach: fach            },            beforeSend: function () {                /*/ overlay_ajax();*/            },            success: function (data) {								if(old_selection!=""){					$("#examiner").select2('destroy').select2({maximumSelectionLength: data.no_of_examiner, data: data.examiners});					/*/alert(old_selection);*/				}else{					$("#examiner").select2('destroy').empty().select2({maximumSelectionLength: data.no_of_examiner, data: data.examiners});				}                $('#minimum').val(data.no_of_examiner);            },            error: function () {                /*/ $('#modal-default').modal('show');*/            },            complete: function () {                /*/ $('.box-body').unblock();*/            }        });    }else{        $("#examiner").select2('destroy').empty().select2({ data: []});        $('#minimum').val('');    }}$('#my-form').on('submit', function(){	var minimum =$('#minimum').val();	if($("#examiner").select2('data').length>=minimum || (userType=='moderator' && $("#examiner").select2('data').length>=1 )){			if(userType=='moderator') 		  return confirm('Als Moderator darfst du auch einzelne Prüfer auswählen. Das ist nur für das Hochladen von Protokollen gedacht');				decision = confirm("Bist du sicher, dass alles richtig ist?");		// preventing double submission of form		if (decision){			$('#submit').attr('disabled','disabled');		}		return  decision	//moderators should pick minimum 1 examiner	} else if (userType=='moderator' && $("#examiner").select2('data').length<1 ) {		alert('Bitte wähl mindestens einen Prüfer aus')	}else {		alert('Bitte wähl genau '+minimum+' Prüfer aus')		return false;	}})function getDownload(id){    if(id!='') {        $.ajax({            dataType:'json',            url: base_path + "/getDownload",            type: 'POST',            data: {                _token: $('input[name=_token]').val(),                id:id            },            beforeSend: function () {                /*/ overlay_ajax();*/            },            success: function (data) {            },            error: function () {                /*/ $('#modal-default').modal('show');*/            },            complete: function () {                /*/ $('.box-body').unblock();*/            }        });    }}function loadDatepickerDates(){	var testid=$('#test_id').val();    if(testid!='') {        $.ajax({            dataType:'json',            url: base_path + "/mailpdf/loadDates",            type: 'POST',            data: {                _token: $('input[name=_token]').val(),				testid: testid,            },            beforeSend: function () {                /*/ overlay_ajax();*/            },            success: function (data) {				 					$('#date').datepicker('setStartDate',data.rangeStart);					$('#date').datepicker('setEndDate',data.rangeEnd);					$('#date').datepicker('setDate',data.rangeEnd);										if (data.multiDates){						$('#datepicker').show();						$('#datelabel').show();					}else{						$('#datepicker').hide();						$('#datelabel').hide();					}            },            error: function () {                /*/ $('#modal-default').modal('show');*/            },            complete: function () {                /*/ $('.box-body').unblock();*/            }        });    }else{		$('#datepicker').hide();		$('#datelabel').hide();	}}