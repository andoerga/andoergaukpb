<?php
$now = time();
$ujianBuka = true;
if(getenv('UJIAN_MULAI') <= $now && getenv('UJIAN_SELESAI') >= $now){
	$ujianBuka = true;
}
?>
<!DOCTYPE html>
<html>
	<?php $this->load->view('parts/top'); ?>
	
	<body user-id=<?php echo $user_id; ?>>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><?php echo get_tingkat_name() ?></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a><?php echo $nama_user; ?></a></li>
						<li><a class="btn-done" href="<?php echo site_url('logout'); ?>">Keluar</a></li>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		
		<div class="container">
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2 text-center">
					<h3><?php echo get_tingkat_name(); ?></h3>
				</div>
				<div class="col-xs-8 col-xs-offset-2">
					
					<h4>Daftar  Ujian</h4>
					<ul class="list-group">
						<?php $n = 1; ?>
						<?php foreach($ujian_list as $u){ ?>
						<li class="list-group-item <?php echo $u['id_ujian'] == $id_ujian_current ? 'active' : ''; ?> <?php echo in_array($u['id_ujian'], $id_ujian_done) ? 'done' : ''; ?>"><?php echo $n++ . '. ' . $u['nama_ujian']; ?> (<?php echo $u['waktu']/60; ?> Menit)</li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-xs-8 col-xs-offset-2 text-center">
					<?php if($status == 'next'){ ?>
						<?php $menit = floor($log['time_left']/60); ?>
						<?php $detik = $log['time_left']%60; ?>
						<h3 class="text-danger">Ujian Selanjutnya : </h3>
						<h4><?php echo $next_ujian['nama_ujian']; ?></h4>
						<h4>Waktu : <?php echo $menit . ' Menit '; ?> <?php echo $detik > 0 ? $detik . ' Detik' : ''; ?></h4>
						<?php if($ujianBuka){ ?>
						<a class="btn btn-xl btn-primary" href="<?php echo site_url('ujian'); ?>">Mulai Ujian</a>
						<?php } ?>
					<?php }else if($status == 'continue'){ ?>
						<?php $menit = floor($log['time_left']/60); ?>
						<?php $detik = $log['time_left']%60; ?>
						<h3 class="text-danger">Anda sedang melaksanakan ujian : </h3>
						<h4><?php echo $next_ujian['nama_ujian']; ?></h4>
						<h4>Siswa Waktu : <?php echo $menit . ' Menit '; ?> <?php echo $detik > 0 ? $detik . ' Detik' : ''; ?></h4>
						<?php if($ujianBuka){ ?>
						<a class="btn btn-xl btn-primary" href="<?php echo site_url('ujian'); ?>">Lanjut Ujian</a>
						<?php } ?>
					<?php }else{ ?>
						<h3 class="text-success">Anda telah selesai mengikuti seluruh proses ujian</h3>
						<h3 class="text-success">Terima Kasih</h3>
						<a class="btn btn-xl btn-primary" href="<?php echo site_url('logout'); ?>">Keluar</a>
					<?php } ?>
				</div>
			</div>
		</div>
	
		<?php $this->load->view('parts/bottom'); ?>
	</body>
</html>