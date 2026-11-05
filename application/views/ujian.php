<!DOCTYPE html>
<html>
	<?php $this->load->view('parts/top'); ?>
	<script type="text/javascript">
	var currentPosition = <?php echo $log['current_pos']; ?>;
	var jumlahSoal = <?php echo count(json_decode($log['soal'])); ?>;
	var timeLeft = <?php echo $log['time_left']; ?>;
	var jawaban = <?php echo $log['jawaban']; ?>;
	var syncUrl = '<?php echo site_url('sync'); ?>';
	var backUrl = '<?php echo site_url('pre'); ?>';
	</script>
	<style>
	body {
		display:none;
	}
	</style>
	<?php $jawaban = json_decode($log['jawaban'], true); ?>
	<body data-default-href="<?php echo site_url(); ?>" class="<?php echo $size_mode; ?>">
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
						<li><a class="link-done" href="javascript:void(0)">Selesai</a></li>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		
		<div id="ujian-area" class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-md-3 col-lg-2">
					<div class="row">
						<div class="col-xs-12 text-center">
							<div id="connection-status" class="panel panel-success">
								<div class="panel-heading">
									<h4>Terhubung ke server</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 text-center">
							<h3><strong><?php echo $ujian['nama_ujian']; ?></strong></h3>
						</div>
						<div class="col-xs-12 text-center">
							<div class="panel panel-danger">
								<div class="panel-heading">
									<h4>Sisa Waktu</h4>
								</div>
								<div class="panel-body">
									<h2 id="time-left"></h2>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<h4 class="text-center text-primary text-strong"><strong>Daftar Soal :</strong></h4>
						</div>
					</div>
					<div id="index-soal" class="row">
						<?php $n = 1; ?>
						<?php foreach(json_decode($log['soal']) as $s){ ?>
							<div class="col-xs-2 text-center"><button class="btn-xs <?php echo !empty($jawaban[$s]) ? 'btn-success' : 'btn-danger'; ?> btn-jump" data-number="<?php echo $n; ?>"><?php echo $n++; ?></button></div>
						<?php } ?>
					</div>
				</div>
				<div class="col-xs-12 col-md-10">
					<div id="soal-container" class="row">
						<div class="col-xs-12 text-right">
							<a class="change-mode size-normal" href="javascript:void(0)" data-value="normal-mode"><i class="fas fa-font"></i></a>&nbsp;&nbsp;
							<a class="change-mode size-large" href="javascript:void(0)" data-value="large-mode"><i class="fas fa-font"></i></a>&nbsp;&nbsp;
						</div>
						<?php $n = 1; ?>
						<?php foreach(json_decode($log['soal']) as $s){ ?>
							<div class="col-xs-12 soal soal-<?php echo $n; ?>">
								<div class="row">
									<div class="col-xs-12">
										<i>
											<?php 
											$kompetensi_id = isset($soal[$s]['kompetensi_id']) ? $soal[$s]['kompetensi_id'] : null;
											if ($kompetensi_id && isset($kompetensi[$kompetensi_id]['name'])) {
												echo $kompetensi[$kompetensi_id]['name'];
											} else {
												echo ''; 
											}
											?>
										</i>
										<br /><br />
									</div>
									<div class="col-xs-1"><?php echo $n; ?></div>
									<div class="col-xs-11"><?php echo $soal[$s]['soal']; ?></div>
									<div class="col-xs-11 col-xs-offset-1 col-jawaban">
										<div class="row">
										<?php if($soal[$s]['jenis'] == 'pg'){ ?>
												<?php for($i=1; $i<=$ujian['jumlah_pil']; $i++){ ?>
												<div class="row">
													<div class="col-xs-12">
														<div class="row">
															<div class="col-xs-1">
															<input id="optradio-<?php echo $s?>-<?php echo $i; ?>" class="jawaban-soal" data-id="<?php echo $s; ?>" data-number="<?php echo $n; ?>" type="radio" name="optradio-<?php echo $s?>" value="<?php echo $i; ?>" <?php echo $jawaban[$s] == $i ? 'checked' : ''; ?>>
															</div>
															<div class="col-xs-11">
															<label for="optradio-<?php echo $s?>-<?php echo $i; ?>">
															<?php echo $soal[$s]['pil_'.$i]; ?>
															</label>
															</div>
															
														</div>
													</div>
												</div>
												<?php } ?>
										<?php }else{ ?>
											<div class="col-xs-12">
												<textarea class="jawaban-soal form-control" data-id="<?php echo $s; ?>" data-number="<?php echo $n; ?>"><?php echo $jawaban[$s]; ?></textarea>
											</div>
										<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<?php $n++; ?>
						<?php } ?>
					</div>
					<div id="nav-container" class="row">
						<div class="col-xs-6">
							<button class="btn btn-md btn-primary btn-prev">Sebelumnya</button>
						</div>
						<div class="col-xs-6 text-right">
							<button class="btn btn-md btn-primary btn-next">Berikutnya</button>
							<?php if(!$last_ujian){ ?>
							<button class="btn btn-md btn-danger btn-done">Ke Mata Ujian Selanjutnya</button>
							<?php }else{ ?>
							<button class="btn btn-md btn-danger btn-done">Selesai</button>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="selesaiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content panel-danger">
					<div class="modal-header panel-heading">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Perhatian!</h4>
					</div>
					<div class="modal-body text-center text-danger">
						<?php if(!$last_ujian){ ?>
						<h3>Anda memilih untuk selesai dari mata ujian ini dan mengikuti mata ujian berikutnya.</h3>
						<h3>Setelah mata ujian ini selesai, anda tidak dapat mengerjakan mata ujian ini kembali.</h3>
						<?php }else{ ?>
						<h3>Anda memilih untuk selesai dari ujian ini.</h3>
						<h3>Setelah ujian ini selesai, anda tidak dapat mengerjakan ujian ini kembali.</h3>
						<?php } ?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Kembali</button>
						<?php if(!$last_ujian){ ?>
						<a id="force-done" type="button" href="<?php echo site_url('pre'); ?>" class="btn btn-danger">Ke Mata Ujian Berikutnya</a>
						<?php }else{ ?>
						<a id="force-done" type="button" href="<?php echo site_url('pre'); ?>" class="btn btn-danger">Selesai</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="timeoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content panel-success">
					<div class="modal-header panel-heading">
						<h4 class="modal-title" id="myModalLabel">Ujian Selesai</h4>
					</div>
					<div class="modal-body text-success">
						<h3>Waktu Ujian Telah Habis.</h3>
						<h3>Ujian telah berakhir.</h3>
					</div>
					<div class="modal-footer">
						<a type="button" href="<?php echo site_url('pre'); ?>" class="btn btn-primary">Selanjutnya</a>
					</div>
				</div>
			</div>
		</div>
	
		<?php $this->load->view('parts/bottom'); ?>
		<script type="text/javascript" src="includes/js/ujian.js"></script>
	</body>
</html>