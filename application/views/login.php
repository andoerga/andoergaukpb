<!DOCTYPE html>
<html>
	<?php $this->load->view('parts/top'); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-77713226-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-77713226-3');
</script>
	<body>
		
		<div class="container">
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2">
					<div id="panel-login" class="panel panel-primary">
						<div class="panel-heading">
							<h3>Uji Kompetensi Kenaikan Jenjang Penilik/Pamong Belajar</h3>
							<h1>Login</h1>
						</div>
						<div class="panel-body text-justify">
							<form id="register-form" action="" method="post" enctype="multipart/form-data">
								<div class="row form-group">
									<div class="col-xs-12">
										<h4 class="text-center">Silahkan masukkan akun peserta ujian anda</h4>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-5 the-label">
										<label for="inputName">Email (*)</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-md-5 col-lg-4">
										<input type="text" name="email" id="inputEmail" class="form-control" placeholder="Masukkan Email" value="" required="">
									</div>
								</div>
								<div class="row form-group">
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-5 the-label">
										<label for="inputName">Kata Sandi (*)</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-md-5 col-lg-4">
										<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Masukkan Kata Sandi" required="">
									</div>
								</div>
								<hr>
								<div class="row form-group">
									<div class="col-xs-12 col-sm-5 col-md-4 col-lg-5"></div>
									<div class="col-xs-12 col-sm-7 col-md-8 col-lg-3">
										<button name="login" class="btn btn-primary" type="submit">Masuk</button>
									</div>
								</div>
								<?php if($notif != ''){ ?>
								<div class="row form-group">
									<div class="col-xs-12">
										<div class="alert alert-danger"><?php echo $notif; ?></div>
									</div>
								</div>
								<?php } ?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<?php $this->load->view('parts/bottom'); ?>
		
	</body>
</html>