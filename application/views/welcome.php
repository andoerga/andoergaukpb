<!DOCTYPE html>
<html>
	<?php $this->load->view('parts/top'); ?>
	<body>
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
				<div class="col-xs-12">
					<h1><span class="label label-primary">Selamat Datang di Sistem Uji Kompeteni Online</span></h1>
				</div>
			</div>
			<div class="row">
				<?php if($tipe_jabfung == 'ptp'){ ?>
				<div class="col-xs-12">
					<ol>
						<li><span>Petunjuk Umum</span>
						<ol>
						<li>Tes dilaksanakan serempak sesuai waktu yang telah disediakan. Tidak ada tambahan waktu terhadap peserta yang belum selesai mengerjakan semua soal. Tes harus dihentikan setelah waktu habis. Total waktu yang disediakan </span><span >60</span><span > (</span><span >enam puluh</span><span >) menit</span><span >.</span></li>
						<li ><span >Ujian Inpassing PTP Tingkat pertama terdiri dari 20 soal pilihan ganda</span></li>
						<li ><span >Ujian Inpassing PTP Tingkat Muda terdiri dari 15 soal pilihan ganda dan 2 soal essay</span></li>
						<li ><span >Ujian Inpassing PTP Tingkat Madya terdiri dari 10 soal pilihan ganda dan 2 soal essay</span></li>
						<li ><span >Waktu yang disebutkan pada butir a tersebut terhitung sejak dimulainya peserta mengerjakan tes.</span></li>
						<li ><span >Peserta tes yang datang terlambat lebih dari 10 (sepuluh) menit setelah tes berlangsung dengan alasan apapun tidak diperbolehkan mengikuti tes.</span></li>
						<li ><span >Tidak ada ralat berkenaan dengan soal, kerjakan apa adanya.</span></li>
						<li ><span >Peserta ujian tidak boleh meninggalkan ruangan ujian sebelum waktu ujian selesai.</span></li>
						</ol>
						</li>
						<li ><span >Petunjuk Pengerjaan</span>
						<ol>
						<li ><span >Untuk menjawab soal ujian secara daring (<em><span style="font-family: 'Arial',sans-serif;">online</span></em>) menggunakan tetikus (<em><span style="font-family: 'Arial',sans-serif;">mouse</span></em>).</span></li>
						<li ><span >Pilihlah jawaban yang benar untuk setiap butir soal dengan cara arahkan tetikus (<em><span style="font-family: 'Arial',sans-serif;">mouse</span></em>) dan klik kiri tetikus (<em><span style="font-family: 'Arial',sans-serif;">mouse</span></em>) 1x pada pilihan jawaban yang menurut Anda paling benar. Pilihan jawaban yang terpilih akan berubah warna dari putih menjadi biru pada pilihan jawaban.</span></li>
						</ol>
						</li>
						</ol>
						<p ><span >&nbsp;</span></p>
						<ol>
						<li ><span >Untuk melanjutkan nomor soal berikutnya klik tombol<strong><span style="font-family: 'Arial',sans-serif;">&ldquo;selanjutnya&rdquo;</span></strong>&nbsp;dan untuk kembali nomor soal sebelumnya klik tombol&nbsp;<strong><span style="font-family: 'Arial',sans-serif;">&ldquo;sebelumnya&rdquo;</span></strong>.</span></li>
						<li ><span >Jika menurut Anda pilihan jawaban sebelumnya dirasa kurang tepat, maka dapat memilih jawaban lainnya dengan cara arahkan tetikus (<em><span style="font-family: 'Arial',sans-serif;">mouse</span></em>) pada pilihan jawaban, kemudian pilih nomor soal yang akan dirubah jawabannya</span><span >.</span></li>
						<li ><span >Perhatikan penghitung waktu yang ada pada sudut monitor sebelah kiri</span></li>
						<li ><span >Kerjakan soal ujian bagian demi bagian secara bertahap sesuai alokasi waktu yang telah disediakan. Bagian tes selanjutnya tidak akan terbuka sebelum alokasi waktu yang telah disediakan habis</span><span >.</span></li>
						<li ><span >Peserta dapat memeriksa kembali jawaban selama waktu masih tersisa, pastikan bahwa semua soal sudah semua terjawab hal ini ditandai dengan setiap nomor soal sudah berwarna biru</span><span >.<br /> </span></li>
						<li ><span >Apabila Anda telah yakin dengan semua jawaban yang dipilih, klik tombol<strong><span style="font-family: 'Arial',sans-serif;">&ldquo;selesai&rdquo;</span></strong>&nbsp;pada nomor soal terakhir. Yang berarti Anda telah menyelesaikan semua soal ujia</span><span >n<br /> </span>
						<ol>
						<li ><span>Petunjuk Umum</span>
						<ol>
						<li ><span >Tes dilaksanakan serempak sesuai waktu yang telah disediakan. Tidak ada tambahan waktu terhadap peserta yang belum selesai mengerjakan semua soal. Tes harus dihentikan setelah waktu habis. Total waktu yang disediakan </span><span >60</span><span > (</span><span >enam puluh</span><span >) menit</span><span >.</span></li>
						<li ><span >Ujian Inpassing PTP Tingkat pertama terdiri dari 20 soal pilihan ganda</span></li>
						<li ><span >Ujian Inpassing PTP Tingkat Muda terdiri dari 10 soal pilihan ganda dan 2 soal essay</span></li>
						<li ><span >Ujian Inpassing PTP Tingkat Madya terdiri dari 10 soal pilihan ganda dan 2 soal essay</span></li>
						<li ><span >Waktu yang disebutkan pada butir a tersebut terhitung sejak dimulainya peserta mengerjakan tes.</span></li>
						<li ><span >Peserta tes yang datang terlambat lebih dari 10 (sepuluh) menit setelah tes berlangsung dengan alasan apapun tidak diperbolehkan mengikuti tes.</span></li>
						<li ><span >Tidak ada ralat berkenaan dengan soal, kerjakan apa adanya.</span></li>
						<li ><span >Peserta ujian tidak boleh meninggalkan ruangan ujian sebelum waktu ujian selesai.</span></li>
						</ol>
						</li>
						<li ><span >Petunjuk Pengerjaan</span>
						<ol>
						<li ><span >Untuk menjawab soal ujian secara daring (<em><span style="font-family: 'Arial',sans-serif;">online</span></em>) menggunakan tetikus (<em><span style="font-family: 'Arial',sans-serif;">mouse</span></em>).</span></li>
						<li ><span >Pilihlah jawaban yang benar untuk setiap butir soal dengan cara arahkan tetikus (<em><span style="font-family: 'Arial',sans-serif;">mouse</span></em>) dan klik kiri tetikus (<em><span style="font-family: 'Arial',sans-serif;">mouse</span></em>) 1x pada pilihan jawaban yang menurut Anda paling benar. Pilihan jawaban yang terpilih akan berubah warna dari putih menjadi biru pada pilihan jawaban.</span></li>
						</ol>
						</li>
						</ol>
						<p ><span >&nbsp;</span></p>
						<ol>
						<li ><span >Untuk melanjutkan nomor soal berikutnya klik tombol<strong><span style="font-family: 'Arial',sans-serif;">&ldquo;selanjutnya&rdquo;</span></strong>&nbsp;dan untuk kembali nomor soal sebelumnya klik tombol&nbsp;<strong><span style="font-family: 'Arial',sans-serif;">&ldquo;sebelumnya&rdquo;</span></strong>.</span></li>
						<li ><span >J</span><span >ika menurut Anda pilihan jawaban sebelumnya dirasa kurang tepat, maka dapat memilih jawaban lainnya dengan cara arahkan tetikus (<em><span style="font-family: 'Arial',sans-serif;">mouse</span></em>) pada pilihan jawaban, kemudian pilih nomor soal yang akan dirubah jawabannya</span><span >.</span></li>
						<li ><span >Perhatikan penghitung waktu yang ada pada sudut monitor sebelah kiri</span></li>
						<li ><span >Kerjakan soal ujian bagian demi bagian secara bertahap sesuai alokasi waktu yang telah disediakan. Bagian tes selanjutnya tidak akan terbuka sebelum alokasi waktu yang telah disediakan habis</span><span >.</span></li>
						<li ><span >Peserta dapat memeriksa kembali jawaban selama waktu masih tersisa, pastikan bahwa semua soal sudah semua terjawab hal ini ditandai dengan setiap nomor soal sudah berwarna biru</span><span >.<br /> </span></li>
						<li ><span >Apabila Anda telah yakin dengan semua jawaban yang dipilih, klik tombol<strong><span style="font-family: 'Arial',sans-serif;">&ldquo;selesai&rdquo;</span></strong>&nbsp;pada nomor soal terakhir. Yang berarti Anda telah menyelesaikan semua soal ujia</span><span >n<br /> </span></li>
						</ol>
						</li>
						</ol>
						<br />
				</div>
				<?php }else if($tipe_jabfung == 'pamong_budaya'){ ?>
				<div class="col-xs-12">
					<ol>
						<li>Petunjuk Umum
						<ol>
							<li>Bacalah petunjuk ujian dengan cermat</li>
							<li>Pastikan jaringan internet yang digunakan stabil</li>
							<li>Tes dilaksanakan serempak sesuai waktu yang telah disediakan. Tidak ada tambahan waktu terhadap peserta yang belum selesai mengerjakan semua soal. Tes harus dihentikan setelah waktu habis. Total waktu yang disediakan 45&nbsp;(empat puluh lima) menit.</li>
							<li>Ujian <em>Inpassing</em> Pamong Budaya setiap jenjang terdiri dari 30 soal pilihan ganda</li>
							<li>Tidak ada ralat berkenaan dengan soal, kerjakan apa adanya.</li>
						</ol>
						</li>
						<li>Petunjuk Pengerjaan
						<ol>
							<li>Untuk menjawab soal ujian secara daring (<em>online</em>) menggunakan tetikus (<em>mouse</em>).</li>
							<li>Pilihlah jawaban yang benar untuk setiap butir soal dengan cara arahkan tetikus (<em>mouse</em>) dan klik kiri tetikus (<em>mouse</em>) 1x pada pilihan jawaban yang menurut Anda paling benar. Pilihan jawaban yang terpilih akan berubah warna dari putih menjadi biru pada pilihan jawaban.</li>
						</ol>
						</li>
					</ol>

					<p>&nbsp;</p>

					<ol>
						<li>Untuk melanjutkan nomor soal berikutnya klik tombol<strong>&ldquo;selanjutnya&rdquo;</strong>&nbsp;dan untuk kembali ke nomor soal sebelumnya klik tombol&nbsp;<strong>&ldquo;sebelumnya&rdquo;</strong>.</li>
						<li>Jika menurut Anda pilihan jawaban sebelumnya dirasa kurang tepat, maka dapat memilih jawaban lainnya dengan cara arahkan tetikus (<em>mouse</em>) pada pilihan jawaban, kemudian pilih nomor soal yang akan dirubah jawabannya (gugus soal sebelah kiri bawah).</li>
						<li>Perhatikan penghitung waktu yang ada pada sudut monitor sebelah pojok kiri atas</li>
						<li>Kerjakan soal ujian bagian demi bagian secara bertahap sesuai alokasi waktu yang telah disediakan.</li>
						<li>Peserta dapat memeriksa kembali jawaban selama waktu masih tersisa, pastikan bahwa semua soal sudah terjawab semua. Hal ini ditandai dengan setiap nomor soal sudah berwarna biru.</li>
					</ol>

					<p>Apabila Anda telah yakin dengan semua jawaban yang dipilih, klik tombol<strong>&ldquo;selesai&rdquo;</strong>&nbsp;pada nomor soal terakhir. Yang berarti Anda telah menyelesaikan semua soal ujian.</p>

				</div>
				<?php } ?>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<p><strong>Dengan mengklik tombol setuju, maka saya menyatakan akan mengikuti segala ketentuan dalam ujian ini secara sungguh-sungguh dan sejujurnya. 
					<br />Saya akan menerima segala resiko apabila melakukan pelanggaran terhadap ketentuan yang berlaku.</strong></p>
				</div>
				<div class="col-xs-12">
					<a class="btn btn-xl btn-primary" href="<?php echo site_url('pre'); ?>">Setuju</a>
				</div>
			</div>
		</div>
		<br />
		<br />
		<br />
		<?php $this->load->view('parts/bottom'); ?>
	</body>
</html>