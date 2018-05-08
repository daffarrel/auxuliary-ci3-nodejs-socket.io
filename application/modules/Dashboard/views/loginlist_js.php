<script>
	    $('.chosens').chosen();
    $(function() {
    	$('#demo-dt-basic').dataTable( {
	        "responsive": true,
	        "bFilter" : false,               
			"bLengthChange": false,
			"scrollY":        "600px",
        	"scrollCollapse": true,
        	"paging":         false
	    });
    });
</script>
