<script>
$( document ).ready(function(){
	$('#reportDT').dataTable();
	$('#empNIP,#empNIP2').chosen();
	$('#getDate').datepicker({
	    format: 'yyyy-mm-dd',
	    autoclose: true
	});
	$('.date-range-wrap .input-daterange').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true
	});
});
</script>