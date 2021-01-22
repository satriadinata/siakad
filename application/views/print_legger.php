<!DOCTYPE html>
<html>
<head>
	<title>LEGGER STTP</title>
	<style type="text/css">
		body{
			font-family: Arial, sans-serif;
			font-size: 16px;
		}
		table{
			border-collapse: collapse;
			width: 100%;
		}
		table.bordered td, table.bordered th{
			border: 1px solid #000;
			padding: 5px;
		}
	</style>
</head>
<body>
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data TranskirpNilai_".$mhs['nim'].".xls");
	?>

	<table style="font-size: 16px;">
		<tr></tr>
		<tr>
			<td rowspan="4" style="vertical-align: middle; text-align: center;align-items: center;" ><img style="margin: auto;" width="120" src="<?php echo base_url('assets/logo.jpg') ?>"></td>
			<td colspan="7" style="text-align: center;" >
				<h1 style="margin-bottom: 0" >SEKOLAH TINGGI TEKNIK PATI</h1>
			</td>
		</tr>
		<tr>
			<td colspan="7" style="text-align: center; vertical-align: middle;" >
				<h3>YAYASAN TUNAS HARAPAN BANGSA PATI</h3>
			</td>
		</tr>
		<tr>
			<td colspan="7" style="text-align: center;" >
				<p>Jalan Raya Pati-Trangkil Km.4 Telepon (0295)382470 Fax. (0295)382234 Pati</p>
			</td>
		</tr>
		<tr>
			<td colspan="7" style="text-align: center;" >
				<p>http://www.sttp.ac.id email: sttpati@yahoo.com</p>
			</td>
		</tr>
		<tr style="border-bottom: solid 2px" >
			<td height="20" colspan="8" style="text-align: center;border-bottom: solid 2px;" ></td>
		</tr>
		<tr>
			<td colspan="9" style="text-align: center;vertical-align: middle;" height="15" ><h3>Transkirp Nilai</h3></td>
		</tr>
		<tr></tr>
		<tbody>
			<tr>
				<td style="padding-bottom: 10px" width="20%">Nama</td>
				<td style="padding-bottom: 10px" width="5%">:</td>
				<td style="padding-bottom: 10px" width="25%"><?php echo $mhs['nama_mhs']; ?></td>
			</tr>
			<tr>
				<td style="padding-bottom: 10px" width="20%">NIM</td>
				<td style="padding-bottom: 10px" width="5%">:</td>
				<td style="padding-bottom: 10px;text-align: left;" width="25%"><?php echo $mhs['nim']; ?></td>
			</tr>
			<tr>
				<td style="padding-bottom: 10px" width="20%">Th. Angkatan</td>
				<td style="padding-bottom: 10px" width="5%">:</td>
				<td style="padding-bottom: 10px" width="25%"><?php echo $mhs['angkatan']; ?></td>
			</tr>
			<tr>
				<td style="padding-bottom: 10px" width="20%">Jurusan</td>
				<td style="padding-bottom: 10px" width="5%">:</td>
				<td style="padding-bottom: 10px" width="25%"><?php foreach ($jurusan as $v):?>
				<?php if ($v->kd_jurusan==$mhs['kd_jurusan']):?>
					<?php echo $v->nama_jurusan; ?>
				<?php endif ?>
				<?php endforeach ?></td>
			</tr>
		</tbody>
	</table>

	<table class="bordered" style="margin-top: 30px">
		<thead>
			<th rowspan="2" style="text-align: center;" >No</th>
			<th rowspan="2" style="text-align: center;" >Kode MK</th>
			<th rowspan="2">Mata Kuliah</th>
			<th rowspan="2">Semester</th>
			<th rowspan="2">SKS</th>
			<th colspan="2" >Nilai</th>
			<th rowspan="2">SKSN</th>
		</thead>
		<tr>
			<th>Angka</th>
			<th>Nilai</th>
		</tr>
		<tbody>
			<?php
			$no=1;
			$totalSKSN=0;
			$totalSKS=0;
			foreach ($nilai as $value):?>
				<tr>
					<td style="text-align: center;" ><?php echo $no; ?></td>
					<td><?php foreach ($jadwal as $k) {
						if ($value->id_jadwal==$k->id_jadwal) {
							echo $k->kd_mk;
						}
					} ?></td>
					<td><?php foreach ($jadwal as $k) {
						if ($value->id_jadwal==$k->id_jadwal) {
							foreach ($makul as $v) {
								if ($k->kd_mk==$v->kode_mk) {
									echo $v->nama_mk;
								}
							}
						}
					} ?></td>
					<td style="text-align: center;" ><?php
					foreach ($krs as $v) {
						if ($value->id_krs==$v->id_krs) {
							echo $v->semester;
						}
					}
					?></td>
					<td style="text-align: center;" ><?php foreach ($jadwal as $k) {
						if ($value->id_jadwal==$k->id_jadwal) {
							foreach ($makul as $v) {
								if ($k->kd_mk==$v->kode_mk) {
									echo $v->sks;
									$totalSKS+=$v->sks;
								}
							}
						}
					} ?></td>
					<td style="text-align: center;" ><?php echo $value->nilai; ?></td>
					<td style="text-align: center;" >
						<?php
						if ($value->nilai<55) {
							echo "E";
						}elseif ($value->nilai<65) {
							echo "D";
						}elseif ($value->nilai<70) {
							echo "C";
						}elseif ($value->nilai<75) {
							echo "C+";
						}elseif ($value->nilai<80) {
							echo "B";
						}elseif ($value->nilai<85) {
							echo "B+";
						}elseif ($value->nilai<90) {
							echo "A-";
						}else{
							echo "A";
						}
						?>
					</td>
					<td style="text-align: center;">
						<?php
						if ($value->nilai<55) {
							$huruf=0;
						}elseif ($value->nilai<65) {
							$huruf=1;
						}elseif ($value->nilai<70) {
							$huruf=2;
						}elseif ($value->nilai<75) {
							$huruf=2.33;
						}elseif ($value->nilai<80) {
							$huruf=3;
						}elseif ($value->nilai<85) {
							$huruf=3.33;
						}elseif ($value->nilai<90) {
							$huruf=3.67;
						}else{
							$huruf=4;
						};
						foreach ($jadwal as $k) {
							if ($value->id_jadwal==$k->id_jadwal) {
								foreach ($makul as $v) {
									if ($k->kd_mk==$v->kode_mk) {
										echo $huruf*$v->sks;
										$totalSKSN+=$huruf*$v->sks;
									}
								}
							}
						}
						?>
					</td>
					<?php $no++; endforeach ?>
					<tr style="text-align: center;font-weight: bold;">
						<td colspan="4">Total Jumlah</td>
						<td><?= $totalSKS;  ?></td>
						<td></td>
						<td></td>
						<td><?php echo $totalSKSN; ?></td>
					</tr>
				</tbody>
			</table>
			<tr></tr>
			<table>
				<tbody>
					<tr>
						<td style="font-size: 18px;text-align: center;vertical-align: middle; " >
							<div style="text-align: center;" >
								<h3>
									IPK = <?php echo round($totalSKSN/$totalSKS,2); ?>
								</h3>
							</div>
						</td>
						<td></td>
						<td></td>
						<td width="50%" style="text-align: left;padding-left: 50px;">
							<p>Pati, <?php echo date('d').' ' ?><?php $bulan=['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; echo $bulan[intval(date('m'))-1].' '.date('Y'); ?></p>
							<p>Ketua Jurusan</p>
							<br><br><br>	
							<p><?php foreach ($jurusan as $v):?>
							<?php if ($v->kd_jurusan==$mhs['kd_jurusan']):?>
								<?php echo $v->ketua_jurusan; ?>
							<?php endif ?>
							<?php endforeach ?></p>
						</td>
					</tr>
				</tbody>
			</table>

		<!-- <table>
			<tbody>
				<tr>
					<td width="33%"></td>
					<td width="33%" style="text-align: center;">
						<p>Mengetahui</p>
						<p>Ketua Program Studi / Jurusan</p>
						<br><br><br>
						<p>( ___________ )</p>
					</td>
					<td width="33%" style="text-align: center;">
						<p>Membenarkan</p>
						<p>Dosen Pembimbing Akademik</p>
						<br><br><br>
						<p>( ___________ )</p>
					</td>
				</tr>
			</tbody>
		</table> -->

	</body>
	</html>