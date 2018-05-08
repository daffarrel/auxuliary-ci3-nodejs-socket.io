<script>
	$('.chosend').chosen();
	$('#shiftList').DataTable({
    	"bLengthChange": false,
    	"bFilter" : false,
    	"autoWidth": false
	});
	$('#getDate').datepicker({
	    format: 'yyyy-mm-dd'
	});

	$('#selectMoth').datepicker({
    	format: "yyyy-mm",
	    viewMode: "months", 
	    minViewMode: "months"
    });

 	$("#shiftList").on("click", ".sbtnShift", function(){
		var idshift = $(this).parent().parent().find('#hsID').val();
		var shift = $(this).parent().parent().find('#hsCODE').val();
		var shiftcurr = $(this).parent().parent().find('#currShift').val();
		var shiftData = 'hsCODE='+ shift +'&hsCHANGE='+ shiftcurr +'&hsID='+ idshift;
		$.ajax({
            url : '<?php echo base_url(); ?>configs/updateShift',
            async: false,
            type: "POST",
            dataType: "html",
            data: shiftData,
            success: function(data){
                location.reload();
            }
        });
	});
</script>