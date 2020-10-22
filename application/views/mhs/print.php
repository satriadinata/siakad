<!DOCTYPE html>
<html>
<head>
	<title>KRS STT</title>
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

	<img src="<?= base_url('assets/head_krs.jpg') ;?>" style="width: 100%; height: auto;">


	<table style="margin-top: 25px; font-size: 16px;">
		<tbody>
			<tr>
				<td style="padding-bottom: 10px" width="20%">Nama</td>
				<td style="padding-bottom: 10px" width="5%">:</td>
				<td style="padding-bottom: 10px" width="25%"><?php echo $mhs['nama_mhs']; ?></td>
				<td style="padding-bottom: 10px" width="20%">Th. Akademik</td>
				<td style="padding-bottom: 10px" width="5%">:</td>
				<td style="padding-bottom: 10px" width="25%"><?php echo $krs['ta']; ?></td>
			</tr>
			<tr>
				<td style="padding-bottom: 10px" width="20%">NIM</td>
				<td style="padding-bottom: 10px" width="5%">:</td>
				<td style="padding-bottom: 10px" width="25%"><?php echo $mhs['nim']; ?></td>
				<td style="padding-bottom: 10px" width="20%">Semester</td>
				<td style="padding-bottom: 10px" width="5%">:</td>
				<?php if ($krs['semester']%2==0):?>
				<td style="padding-bottom: 10px" width="25%"><s>Ganjil</s> / Genap</td>
				<?php else: ?>
				<td style="padding-bottom: 10px" width="25%">Ganjil / <s>Genap</s></td>
				<?php endif ?>
			</tr>
			<tr>
				<td style="padding-bottom: 10px" width="20%">Jenjang / Jurusan</td>
				<td style="padding-bottom: 10px" width="5%">:</td>
				<td style="padding-bottom: 10px" width="25%"><?php foreach ($jurusan as $v):?>
				<?php if ($v->id_jur==$krs['id_jurusan']):?>
					<?php echo $v->nama_jurusan; ?>
				<?php endif ?>
				<?php endforeach ?></td>
				<td style="padding-bottom: 10px" width="20%">Dosen PA</td>
				<td style="padding-bottom: 10px" width="5%">:</td>
				<td style="padding-bottom: 10px" width="25%"><?php foreach ($pa as $value) {
					if ($value->id_dosen==$krs['id_pa']) {
						echo $value->nama_dosen;
					}
				} ?></td>
			</tr>
		</tbody>
	</table>

	<table class="bordered" style="margin-top: 30px">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode MK</th>
				<th>Mata Kuliah</th>
				<th>SKS</th>
				<th>Hari</th>
				<th>Jam</th>
				<th>Nama Dosen</th>
			</tr>
		</thead>
		<tbody>
			<?php $no=0; foreach ($items as $value): $no++?>
			<tr>
				<td><?php echo $no; ?></td>
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
				<td><?php foreach ($jadwal as $k) {
					if ($value->id_jadwal==$k->id_jadwal) {
						foreach ($makul as $v) {
							if ($k->kd_mk==$v->kode_mk) {
								echo $v->sks;
							}
						}
					}
				} ?></td>
				<td><?php foreach ($jadwal as $k) {
					if ($value->id_jadwal==$k->id_jadwal) {
						echo $k->hari;
					}
				} ?></td>
				<td><?php foreach ($jadwal as $k) {
					if ($value->id_jadwal==$k->id_jadwal) {
						echo $k->jam;
					}
				} ?></td>
				<td><?php foreach ($jadwal as $k) {
					if ($value->id_jadwal==$k->id_jadwal) {
						foreach ($pa as $v) {
							if ($k->kd_dosen==$v->kd_dosen) {
								echo $v->nama_dosen;
							}
						}
					}
				} ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>

<table>
	<tbody>
		<tr>
			<td width="50%" style="font-size: 12px;">
				<br><br><br><br><br><br><br><br><br><br>
				<p>
					<b><u>KRS dicetak 3 (Tiga) Rangkap,</u></b>
				</p>
				<ul style="padding-left: 17px;">
					<li>Mahasiswa</li>
					<li>Pembimbing Akademik</li>
					<li>B A A K</li>
				</ul>
			</td>
			<td width="50%" style="text-align: center;">
				<p>Pati, ____________ 20 ____</p>
				<p>Mahasiswa</p>
				<br><br><br>
				<p>( ________________ )</p>
			</td>
		</tr>
	</tbody>
</table>

<table>
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
</table>

</body>
</html>