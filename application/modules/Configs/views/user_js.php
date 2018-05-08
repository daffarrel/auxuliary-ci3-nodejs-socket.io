<script>
	$('.chosend').chosen({ width : "100%"});
	$('#userList').DataTable();
	$('#getDate').datepicker({
	    format: 'yyyy-mm-dd'
	});

	$('#selectMoth').datepicker({
    	format: "yyyy-mm",
	    viewMode: "months", 
	    minViewMode: "months"
    });

 	$("#userList").on("click", ".sbtnUser", function(){
		var empNIP = $(this).parent().parent().find('#empNIP').val();
		var empLEVEL = $(this).parent().parent().find('#empLEVEL').val();
		var empSTATUS = $(this).parent().parent().find('#empSTATUS').val();
		var shiftData = 'empNIP='+ empNIP +'&empLEVEL='+ empLEVEL +'&empSTATUS='+ empSTATUS;
		$.ajax({
            url : '<?php echo base_url(); ?>configs/updateUser',
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