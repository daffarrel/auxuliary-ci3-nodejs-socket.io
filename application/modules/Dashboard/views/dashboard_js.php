<script>
$( document ).ready(function(){
	var mTable = $('#loginDT').dataTable({
		"responsive": true,
        "scrollY":        "600px",
        "scrollCollapse": true,
        "paging":         false
	});
});

var cNum = $('.nums').length;
setInterval(function() {
for (var i = 0; i <= cNum; i++) {
		getVals = $('.counter' + i + ' .getdaux').val();
	var getcount = $('.counter' + i + ' .counters');
	$('.counter' + i + ' .counters').text(getVals);
	if(getVals != 'Nol' || typeof(getVals) != "undefined") {
			    
	    if (new Date(getVals) != "Invalid Date") {
	    	var fiD = new Date(getVals);
			var exD = new Date();
			var diffTimes = Number(exD - fiD);
			var gets = secondsToTime(diffTimes);
			seconds = gets.s;
			minutes = gets.m;
			hours = gets.h;
					    seconds++;
					    if (seconds >= 60) {
					        seconds = 0;
					        minutes++;
					        if (minutes >= 60) {
					            minutes = 0;
					            hours++;
					        }
					    }
				    	$('.counter' + i + ' .counters').text((hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds));
	    	}
		}
	}
}, 1000);

function secondsToTime(secs)
{	
	sec = secs / 1000;

    var hours = Math.floor(sec / (60 * 60));
   
    var divisor_for_minutes = sec % (60 * 60);
    var minutes = Math.floor(divisor_for_minutes / 60);
 
    var divisor_for_seconds = divisor_for_minutes % 60;
    var seconds = Math.ceil(divisor_for_seconds);
   
    var obj = {
        "h": hours,
        "m": minutes,
        "s": seconds
    };
    return obj;
}

function forceLogout(getNip) {
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/forceLogout/' + getNip,
        type: "POST",
        dataType: "json",
        success: function(data){
        	// $('.row_user_' + data.backNIP).remove();
            var socket = io.connect( 'http://'+window.location.hostname+':3033' );
            socket.emit('forceLog', { 
                nip         : data.backNIP,
            });
        }
    });
}

<?php if ($this->session->flashdata('success')) { ?>
    new PNotify({
        title: "Success Logging In",
        text: "<?php echo $this->session->flashdata('success'); ?>",
        type: 'success',
        icon: false,
        buttons: {
                    sticker: false
                }
    });
    var socket = io.connect( 'http://'+window.location.hostname+':3033' );
    socket.emit('onLogin', { 
        nip         : getNIP,
        fullname    : getFULLNAME,
        sCODE       : getHsCODE,
        sDATESTART  : getlogStart,
        hsSTART     : hsSTART,
        auxtypeName : auxtypeName,
        getTot      : "<?php echo $this->datagrabs->empTodayAllAux(); ?>",
    });
<?php } ?>

$(document).ready(function(){
    $('#submitAux').prop('disabled', true);
    $('#auxREASON').change(function() {
        var op =$(this).val();
        if(op !='') {                 
            $('#submitAux').prop('disabled',false);
        } else {
            $('#submitAux').prop('disabled', true);
        }   
    });
});
</script>