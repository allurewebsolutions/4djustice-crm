$(document).ready(function() {
	$('#wait_1').hide();
	$('#practicearea').change(function(){
	  $('#wait_1').show();
	  $('#result_1').hide();
      $.get("../includes/func.php", {
		func: "practicearea",
		drop_var: $('#practicearea').val()
      }, function(response){
        $('#result_1').fadeOut();
        setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
      });
    	return false;
	});
});

function finishAjax(id, response) {
  $('#wait_1').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
}

$(document).ready(function() {
	$('#wait_2').hide();
	$('#state').change(function(){
	  $('#wait_2').show();
	  $('#result_2').hide();
      $.get("../includes/func.php", {
		func: "state",
		drop_var: $('#state').val()
      }, function(response){
        $('#result_2').fadeOut();
        setTimeout("finishAjax('result_2', '"+escape(response)+"')", 400);
      });
    	return false;
	});
});

function finishAjax(id, response) {
  $('#wait_2').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
}