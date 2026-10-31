var warningTime = 60 * 5;
var warningShow = false;
var poorConnection = 0;
var defaultHref;
var syncInterval = 1000 * 10;

window.onload = function() {
	if (window.jQuery) {
		// do nothing
	} else {
		// jQuery is not loaded
		alert("Terjadi kesalahan pada sistem javascript. Silahkan menggunakan google Chrome versi 52 keatas dan bersihkan cache di browser anda");
		window.location.href = backUrl;
	}
}

$(document).ready(function(){
	theSync(false, true);
	
	defaultHref = $('body').data('default-href');
	renderSoal();
	
	$('.btn-next').click(function(){
		if(currentPosition < jumlahSoal){
			currentPosition++;
			renderSoal();
		}
	});
	
	$('.btn-prev').click(function(){
		if(currentPosition > 1){
			currentPosition--;
			renderSoal();
		}
	});
	
	$('.btn-jump').click(function(){
		var number = $(this).data('number');
		if(number < 1 || number > jumlahSoal){
			return false;
		}
		currentPosition = number;
		renderSoal();
	});
	
	$('.btn-done, .link-done').click(function(){
		$('#selesaiModal').modal('show');
		return false;
	});
	
	renderTimeLeft();
	var countdown = setInterval(function(){
		timeLeft--;
		renderTimeLeft();
		if(timeLeft<1){
			// Waktu Habis
			clearInterval(countdown);
			clearInterval(syncLog);
			theSync(false);
			$('#timeoutModal').modal('show');
			$('#ujian-area').html('');
		}
	}, 1000);
	
	var syncLog = setInterval(function(){
		theSync(false)
	}, syncInterval);
	
	$('.jawaban-soal').change(function(){
		jawaban[$(this).data('id')] = $(this).val();
		$('.btn-jump[data-number='+$(this).data('number')+']').removeClass('btn-danger').addClass('btn-success');
	});
	
	$('#force-done').click(function(){
		clearInterval(countdown);
		clearInterval(syncLog);
		timeLeft = 0;
		var href = $(this).attr('href');
		theSync(href);
		return false;
	});
	
	$('.change-mode').click(function(){
		var value = $(this).data('value');
		$('body').attr('class',value);
		document.cookie = "size_mode="+value;
	});
	
});

function  theSync(href, firsTime = false){
	$.ajax({
		url: syncUrl,
		type: 'post',
		dataType: 'json',
		data: {
			time_left: timeLeft,
			jawaban: jawaban,
			current_pos: currentPosition
		},
		error: function(){
			if(firsTime){
				alert("Terjadi gangguan koneksi ke server, silahkan coba beberapa saat lagi atau hubungi helpdesk");
				window.location.href = backUrl;
			}
			//console.log('error');
			poorConnection++;
			if(poorConnection >= 1){
				$('#connection-status').removeClass('panel-success').addClass('panel-warning').find('h4').html('Koneksi ke server terganggu');
			}
			if(poorConnection >= 3){
				$('#connection-status').removeClass('panel-warning').addClass('panel-danger').find('h4').html('Koneksi ke server terputus, silahkan periksa koneksi internet anda');
			}
			if(poorConnection >= 5){
				window.location.href = defaultHref;
			}
			if(href){
				window.location.href = href;
			}
		},
		success: function(response){
			//console.log('Sync Succeed');
			if(response.success){
				if(firsTime){
					$('body').show();
				}
				poorConnection = 0;
				$('#connection-status').removeClass('panel-warning').removeClass('panel-danger').addClass('panel-success').find('h4').html('Terhubung ke server');
				if(href){
					window.location.href = href;
				}
			}else{
				if(firsTime){
					alert("Terjadi gangguan koneksi ke server, silahkan coba beberapa saat lagi atau hubungi helpdesk");
					window.location.href = backUrl;
				}
				poorConnection++;
				if(poorConnection >= 2){
					$('#connection-status').removeClass('panel-success').addClass('panel-warning').find('h4').html('Koneksi ke server terganggu');
				}
				if(poorConnection >= 5){
					$('#connection-status').removeClass('panel-warning').addClass('panel-danger').find('h4').html('Koneksi ke server terputus, silahkan periksa koneksi internet anda');
				}
				if(poorConnection >= 7){
					window.location.href = defaultHref;
				}
				if(href){
					window.location.href = href;
				}
			}
		}
	});
}

function renderTimeLeft(){
	if(timeLeft < warningTime && !warningShow){
		$('#time-left').addClass('danger');
	}
	var menit = Math.floor(timeLeft/60);
	var detik = timeLeft%60;
	$('#time-left').html(menit + ':' + detik);
}

function renderSoal(){
	$('#soal-container .soal').hide();
	$('#soal-container .soal-' + currentPosition).show();
	
	if(currentPosition <= 1){
		$('.btn-prev').hide();
		$('.btn-next').show();
		$('.btn-done').hide();
	}else if(currentPosition >= jumlahSoal){
		//console.log(currentPosition, jumlahSoal);
		$('.btn-prev').show();
		$('.btn-next').hide();
		$('.btn-done').show();
	}else{
		$('.btn-prev').show();
		$('.btn-next').show();
		$('.btn-done').hide();
	}
}