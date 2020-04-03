function loadExaminerByTestid(){

    var testid=$('#test_id').val();

    /*/alert(testid);*/

    if(testid!='') {

        $.ajax({

            dataType:'json',

            url: base_path + "/mailpdf/getExaminerByTestId",

            type: 'POST',

            data: {

                _token: $('input[name=_token]').val(),

                testid: testid

            },

            beforeSend: function () {

                /*/ overlay_ajax();*/

            },

            success: function (data) {
			
                $("#examiner").select2('destroy').empty().select2({maximumSelectionLength: data.no_of_examiner, data: data.examiners});

                $('#minimum').val(data.no_of_examiner);

                /*/ $("#examiner").select2({*/

                /*/     maximumSelectionLength: 0*/

                /*/ });*/



            },

            error: function () {

                /*/ $('#modal-default').modal('show');*/

            },

            complete: function () {

                /*/ $('.box-body').unblock();*/

            }

        });

    }else{

        $("#examiner").select2('destroy').empty().select2({ data: []});

        $('#minimum').val('');

    }

}


function loadFachByTestid(){

    var testid=$('#test_id').val();

    /*/alert(testid);*/

    if(testid!='') {

        $.ajax({

            dataType:'json',

            url: base_path + "/mailpdf/getFaecherByTestId",

            type: 'POST',

            data: {

                _token: $('input[name=_token]').val(),

                testid: testid

            },

            beforeSend: function () {

                /*/ overlay_ajax();*/

            },

            success: function (data) {

				if (data.num_faecher>1){
						$("#fachpicker").show();
						$("#fach").select2('destroy').empty().select2({data: data.faecher});	
					}else{
						$("#fachpicker").hide();
					}		
						
            },

            error: function () {

                /*/ $('#modal-default').modal('show');*/

            },

            complete: function () {

                /*/ $('.box-body').unblock();*/

            }

        });

    }else{

        $("#fach").select2('destroy').empty().select2({ data: []});


    }

}







function loadExaminerByFach(){

    var fach=$('#fach').val();
	var testid=$('#test_id').val();
	var old_selection = ($("#examiner :selected").select2().text());
	
    if(fach!='') {

        $.ajax({

            dataType:'json',

            url: base_path + "/mailpdf/getExaminerByFach",

            type: 'POST',

            data: {

                _token: $('input[name=_token]').val(),

				testid: testid,
				
                fach: fach

            },

            beforeSend: function () {

                /*/ overlay_ajax();*/

            },

            success: function (data) {
				
				if(old_selection!=""){
					$("#examiner").select2('destroy').select2({maximumSelectionLength: data.no_of_examiner, data: data.examiners});
					/*/alert(old_selection);*/
				}else{
					$("#examiner").select2('destroy').empty().select2({maximumSelectionLength: data.no_of_examiner, data: data.examiners});
				}
                $('#minimum').val(data.no_of_examiner);
            },

            error: function () {

                /*/ $('#modal-default').modal('show');*/

            },

            complete: function () {

                /*/ $('.box-body').unblock();*/

            }

        });

    }else{

        $("#examiner").select2('destroy').empty().select2({ data: []});

        $('#minimum').val('');

    }

}

	
$('#request-protocol').on('submit', function(){

	var minimum =$('#minimum').val();

	if($("#examiner").select2('data').length>=minimum || (userType=='moderator' && $("#examiner").select2('data').length>=1 )){
	
		if(userType=='moderator') 
		  alert('Als Moderator darfst du auch einzelne Prüfer auswählen. Das ist nur für das Hochladen von Protokollen gedacht');
		
		decision = confirm("Bist du sicher, dass alles richtig ist?");
		// preventing double submission of form
		if (decision){
			$('#submit').attr('disabled','disabled');
		}
		return  decision;

	//moderators should pick minimum 1 examiner
	} else if (userType=='moderator' && $("#examiner").select2('data').length<1 ) {
		alert('Bitte wähl mindestens einen Prüfer aus')
	}else {
		if (minimum>4){
			alert('Bitte wähl genau '+minimum+' Prüfer aus. D.h. '+minimum/2+' Prüfer und '+minimum/2+' Vertreter')
		} else {
			alert('Bitte wähl genau '+minimum+' Prüfer aus')
		}
		return false;
	}

})

$('#submit-protocol').on('submit', function(){

	var testid = $('#test_id').val() ;
	var questions = document.getElementById("submit-protocol").elements["questions[]"];
	var answers = document.getElementById("submit-protocol").elements["answers[]"];
	var extras = document.getElementById("submit-protocol").elements["personal_extra[]"];
	var num_questions = questions.length;
	var num_answers = answers.length;
	var num_validated = 0;
	
	//count for each examiner if both questions and answers are at least 10 charachters long
	for (var i=0; i<num_questions; i++){
			if (questions[i].value.length>=10 && answers[i].value.length>=10){
				num_validated++;
			} else if (questions[i].value.length>=1) {
				alert("Du hast irgendwo die Fragen ausgefüllt, aber ohne die entsprechenden Antworten. Bitte jeweils mindestens 10 Zeichen schreiben");
				return false;
			} else if (answers[i].value.length>=1) {
				alert("Du hast irgendwo die Antworten ausgefüllt, aber ohne die entsprechenden Fragen. Bitte jeweils mindestens 10 Zeichen schreiben");
				return false;
			} else if (extras[i].value.length>=1) {
				alert("Du hast irgendwo die Tipps ausgefüllt, aber weder Fragen noch Antworten eingegeben.");
				return false;
			}
	}
	
	//if(userType!='moderator') { //requirment added for moderators as well
		//M3 has different rules. only needs one questions/answers per pair of examiners (main and substitute). so allow half of examiners to pass test
		//however, this was a dynamic change and the first users were allowed only 4 protocols and should return all. so the prerequisite for the relaxed condition is when more than four examiners are present in the page
		if(num_questions>4){
			if (num_validated<(num_questions/2)){
				alert("Bitte jeweils mindestens 10 Zeichen in jedes Fragen- und jedes Antworten-Eingabefeld eingeben");
				return false;
			}
		}  else {
			if (num_validated!=num_questions){
				alert("Bitte jeweils mindestens 10 Zeichen in jedes Fragen- und jedes Antworten-Eingabefeld eingeben");
				return false;
			}
		}
	//}
	decision = confirm("Bist du sicher, dass alles richtig ist?");
	// preventing double submission of form
	if (decision){
		$('#submit').attr('disabled','disabled');
	}
	return decision;

})

function getDownload(id){

    if(id!='') {

        $.ajax({

            dataType:'json',

            url: base_path + "/getDownload",

            type: 'POST',

            data: {

                _token: $('input[name=_token]').val(),

                id:id

            },

            beforeSend: function () {

                /*/ overlay_ajax();*/

            },

            success: function (data) {

            },

            error: function () {

                /*/ $('#modal-default').modal('show');*/

            },

            complete: function () {

                /*/ $('.box-body').unblock();*/

            }

        });

    }

}

function loadDatepickerDates(){

	var testid=$('#test_id').val();
    if(testid!='') {

        $.ajax({

            dataType:'json',

            url: base_path + "/mailpdf/loadDates",

            type: 'POST',

            data: {

                _token: $('input[name=_token]').val(),

				testid: testid,

            },

            beforeSend: function () {
                /*/ overlay_ajax();*/
            },

            success: function (data) {
				 
					$('#date').datepicker('setStartDate',data.rangeStart);
					$('#date').datepicker('setEndDate',data.rangeEnd);
					$('#date').datepicker('setDate',data.rangeEnd);
					
					if (data.multiDates){
						$('#datepicker').show();
						$('#datelabel').show();
					}else{
						$('#datepicker').hide();
						$('#datelabel').hide();
					}
            },

            error: function () {
                /*/ $('#modal-default').modal('show');*/

            },

            complete: function () {

                /*/ $('.box-body').unblock();*/

            }

        });

    }else{
		$('#datepicker').hide();
		$('#datelabel').hide();
	}

}