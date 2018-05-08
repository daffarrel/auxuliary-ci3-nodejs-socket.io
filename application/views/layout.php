<?php
    $this->load->library('datagrabs');
    $getDetail = $this->datagrabs->empDetails();
    $getCurrLog = $this->datagrabs->currLog();
    $data = $this->datagrabs->currAux();
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCID AUX</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/nifty.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/chosen/chosen.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/pnotify.custom.min.css" rel="stylesheet">
    <style>
        .popover{
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-out reveal">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">
                <div class="navbar-header">
                    <a href="<?php echo base_url(); ?>" class="navbar-brand">
                        <img src="<?php echo base_url(); ?>assets/img/logo.png" class="brand-icon" style="height: 35px; width: auto; margin-top: 3px;">
                    </a>
                </div>
                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-right">
                        <li><a href="<?php echo base_url(); ?>dashboard">DASHBOARD</a></li>
                        <li><a href="<?php echo base_url(); ?>reports">REPORT</a></li>
                        <li><a href="<?php echo base_url(); ?>configs/shiftList">CONFIG SHIFT LIST</a></li>
                        <li><a href="<?php echo base_url(); ?>configs/userList">CONFIG USER LIST</a></li>
                        <li><a href="<?php echo base_url(); ?>usermanual">USER MANUAL</a></li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="boxed">
            <div id="content-container">
                <div id="page-title">
                    <h1 class="page-header text-overflow"><?php if(isset($header)){ echo $header; }?></h1>
                </div>

                <div id="page-content">
                <?php if(isset($content)){ echo $content; }?>
                </div>
            </div>
        </div>
        <footer id="footer">
            <div class="show-fixed pull-right">
                You have <a href="#" class="text-bold text-main"><span class="label label-danger">3</span> pending action.</a>
            </div>
            <div class="hide-fixed pull-right pad-rgt">
                14GB of <strong>512GB</strong> Free.
            </div>
            <p class="pad-lft">&#0169; 2017 Your Company</p>
        </footer>
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
    </div>
    <div id="on_aux_pop" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-warning">
                <div class="modal-body">
                    <div class="text-center">
                        <div>
                            <i class="zmdi zmdi-alert-circle-o zmdi-hc-5x"></i>
                        </div>
                        <h3>Anda Sedang Aux</h3>
                        <h1 id="OnAuxCounter"></h1>
                        <p>Jangan Lupa Untuk Mengakhiri Aux <br/> Dengan Menekan Tombol "End AUX" Di Bawah Ini !</p>
                        <br/>
                        <div class="m-y-30">
                            <a type="button" href="<?php echo base_url(); ?>dashboard/auxEndAction" class="btn btn-danger btn-block btn-lg">END AUX</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--jQuery [ REQUIRED ]-->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/nifty.min.js"></script>
    <!--DataTables [ OPTIONAL ]-->
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/media/js/jquery.dataTables.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/pnotify.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
	<?php if(isset($script)){ echo $script; }?>

<script>

function getAHT() {
    $.ajax({
        url : '<?php echo base_url(); ?>dashboard/getAHT/',
        type: "POST",
        dataType: "json",
        success: function(data){
            document.getElementById("AllLogingIn").innerHTML = data.ahtLOG;
            document.getElementById("AllOnAux").innerHTML = data.ahtAUX;
            document.getElementById("AllAvail").innerHTML = data.ahtAVAIL;
            document.getElementById("AllOnShift").innerHTML = data.onShift;
        }
    });
}

var getNIP      = "<?php echo $getDetail['empNIP']; ?>";
var getFULLNAME = "<?php echo $getDetail['empFULLNAME']; ?>";
var getHsCODE   = "<?php echo $getDetail['hsCODE']; ?>";
var getlogStart = "<?php echo date('H:i:s', strtotime($getCurrLog['logSTART'])); ?>";
var hsSTART     = "<?php echo $getDetail['shiftSTART']; ?>";
var auxtypeName = "<?php echo $data['typeNAME']; ?>";
var geTotss       = "<?php echo $this->datagrabs->empTodayAllAux(); ?>"
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
        getTot      : geTotss,
    });
<?php } ?>

<?php if ($this->session->flashdata('auxEnd')) { ?>
    var socket = io.connect( 'http://'+window.location.hostname+':3033' );
    socket.emit('auxEnd', { 
        nip         : getNIP,
        fullname    : getFULLNAME,
        sCODE       : getHsCODE,
        sDATESTART  : getlogStart,
        hsSTART     : hsSTART,
        auxtypeName : auxtypeName,
        getTot      : geTotss,
    });
<?php } ?>
<?php if ($empDetail['statusAUX'] == "Y") { ?>
window.onload = function() {
   $('#on_aux_pop').modal('show');
};
$('#on_aux_pop').on('shown.bs.modal', function(){
        setInterval(function() {
            var fiD1 = new Date('<?php echo date("Y-m-d H:i:s", strtotime($data["auxSTART"])); ?>');
            var exD1 = new Date();
            var diffTimes1 = Number(exD1 - fiD1);
            var gets = secondsToTime(diffTimes1);
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

        // console.log($(".row_user_" + data.nip + " td")[0].text());
            $('#OnAuxCounter').text((hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds));
        }, 1000);

        var getCurrTime = "<?php echo $data['auxSTART']; ?>";
        var socket = io.connect( 'http://'+window.location.hostname+':3033' );
        socket.emit('auxStart', { 
            nip         : getNIP,
            fullname    : getFULLNAME,
            getTot      : "<?php echo $this->datagrabs->empTodayAllAux(); ?>",
            currReason  : "<?php echo $data['typeNAME']; ?>",
            currTime    : getCurrTime,
        });
});
<?php } ?>

var socket = io.connect( 'http://'+window.location.hostname+':3033' );

socket.on('auxStart', function(data){
    new PNotify({
        title: "Aux In Notification !",
        text: data.fullname + "On Aux",
        type: 'warning',
        icon: false,
        buttons: {
                    sticker: false
                }
    });
    var myvar = "auxS_"+data.nip;
    this[myvar] = setInterval(function() {
        var fiD1 = new Date(data.currTime);
        var exD1 = new Date();
        var diffTimes1 = Number(exD1 - fiD1);
        var gets = secondsToTime(diffTimes1);
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
        $(".row_user_" + data.nip + " .getReasons").html("<button class='btn btn-danger btn-block btn-xs'>"+ data.currReason +"</button>");
        $('.row_user_' + data.nip + ' td').eq(5).attr('class', 'nums counters');
        var getClass = ".row_user_" + data.nip + " .counters";
        $(getClass).html("<button class='btn btn-danger btn-block btn-xs'>" + (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds) + "</button>");
        console.log("masih Jalan");
    }, 1000);
    
    getAHT();
});

socket.on('auxEnd', function(data){
    new PNotify({
        title: "Return From Aux !",
        text: data.fullname + " Now Available...",
        type: 'success',
        icon: false,
        buttons: {
                    sticker: false
                }
    });
    var myvar2 = "auxS_"+data.nip;
    clearInterval(this[myvar2]);

    if (data.sDATESTART > data.hsSTART) {
        var statClass = "btn-danger";
        var statName = "Late At ";
    } else {
        var statClass = "btn-info";
        var statName = "On TIme ";
    }
    var hms = data.getTot;
    var a = hms.split(':');
    var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 
    if (seconds >= 1) {
        var lims = (seconds / 4500) * 100;
    } else {
        var lims = 0;
    }
    if (lims >= 86 ) {
        getcalls = 'progress-bar-danger';
    } else if (lims >= 65 && lims <= 85 ) {
        getcalls = 'progress-bar-warning';
    } else {
        getcalls = 'progress-bar-success';
    }

    $(".row_user_" + data.nip).html( "<td class='center'>" + data.nip +"</td>" +
            "<td class='center'>" + data.fullname +"</td>" +
            "<td class='text-center'></td>" +
            "<td class='text-center'>" + data.sCODE + "</td>" +
            "<td class='text-center'><button class='btn btn-block " + statClass +" btn-xs'> " + statName + " : " + data.sDATESTART + "</button></td>" +
            "<td class='text-center getReasons'>" + data.auxtypeName + "</td>" +
            "<td>" +
                "<button class='btn btn-info btn-block btn-xs'>Available</button>" +
            "</td>" +
            "<td class='text-center'>" + 
                "<div class='progress progress-lg text-center' style='margin-bottom:0px !important;' >" +
                    "<div class='progress-bar " + getcalls +" progress-bar-striped active' role='progressbar' aria-valuenow='" + seconds + "'' aria-valuemin='0' aria-valuemax='4500' style='width: " + lims +"%'>" +
                        "<span>" + data.getTot + "</span>" +
                    "</div>" +
                "</div>" +
            "</td>" +
            "<td><button class='btn btn-danger btn-block btn-xs' onclick='forceLogout(" + data.nip + ");'>FORCE LOGOUT</button></td>");

    getAHT();
});

socket.on('onLogin', function(data){
    if (getNIP != data.nip) {
        new PNotify({
            title: "Logged In Notification",
            text: data.fullname + " Now Available...",
            type: 'success',
            icon: false,
            buttons: {
                        sticker: false
                    }
        });
        if (data.sDATESTART > data.hsSTART) {
            var statClass = "btn-danger";
            var statName = "Late At ";
        } else {
            var statClass = "btn-info";
            var statName = "On TIme ";
        }
        var hms = data.getTot;
        var a = hms.split(':');
        var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 
        if (seconds >= 1) {
            var lims = (seconds / 4500) * 100;
        } else {
            var lims = 0;
        }
        if (lims >= 86 ) {
            getcalls = 'progress-bar-danger';
        } else if (lims >= 65 && lims <= 85 ) {
            getcalls = 'progress-bar-warning';
        } else {
            getcalls = 'progress-bar-success';
        }
        $("<tr class='row_user_" + data.nip + "'>" +
            "<td class='center'>" + data.nip +"</td>" +
            "<td class='center'>" + data.fullname +"</td>" +
            "<td class='text-center'></td>" +
            "<td class='text-center'>" + data.sCODE + "</td>" +
            "<td class='text-center'><button class='btn btn-block " + statClass +" btn-xs'> " + statName + " : " + data.sDATESTART + "</button></td>" +
            "<td class='text-center'>" + data.auxtypeName + "</td>" +
            "<td class='nums'>" +
                "<button class='btn btn-info btn-block btn-xs'>Available</button>" +
            "</td>" +
            "<td class='text-center'>" + 
                "<div class='progress progress-lg text-center' style='margin-bottom:0px !important;' >" +
                    "<div class='progress-bar " + getcalls +" progress-bar-striped active' role='progressbar' aria-valuenow='" + seconds + "'' aria-valuemin='0' aria-valuemax='4500' style='width: " + lims +"%'>" +
                        "<span>" + data.getTot + "</span>" +
                    "</div>" +
                "</div>" +
            "</td>" +
            "<td><button class='btn btn-danger btn-block btn-xs' onclick='forceLogout(" + data.nip + ");'>FORCE LOGOUT</button></td></tr>").prependTo("#loginDT > tbody");
    }

    getAHT();
});

socket.on('onLogout', function(data){
    new PNotify({
        title: "Logged Out Notification !",
        text: data.fullname + " Logged Out !...",
        type: 'danger',
        icon: false,
        buttons: {
                    sticker: false
                }
    });
    $("tr.row_user_" + data.nip).remove();
    getAHT();
});

socket.on('forceLog', function(data){
    new PNotify({
        title: "FORCE LOGOUT NOTIFICATION",
        text: data.fullname + " Force Logged Out !...",
        type: 'danger',
        icon: false,
        buttons: {
                    sticker: false
                }
    });
    $("tr.row_user_" + data.nip).remove();
    getAHT();
});
</script>
</body>
</html>
