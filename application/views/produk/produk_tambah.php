<?php echo form_open('produk/tambah', array('id' => 'TabelTambahProduk')); ?>
<div style="margin-bottom:10px;">
	<div>
		<font class="bg-info">
			<b>Informasi : Anda juga bisa menambahkan produk dengan upload file excel.
				<a href="<?= config_item('file') . "Import-Excel.xlsx" ?>" download>
					<font>Download Template Upload Produk Excel</font>
				</a>
			</b>
		</font>
	</div>
</div>
<div>
	<font style="color:red">(*) Wajib Diisi</font>
</div>
<table class='table table-bordered' id='TabelTambahProduk'>
	<thead>
		<tr>
			<th>#</th>
			<th>Kode Produk <font style="color:red">*</font>
			</th>
			<th>Nama Produk <font style="color:red">*</font>
			</th>
			<th>Kategori <font style="color:red">*</font>
			</th>
			<th>Ukuran</th>
			<th>Tanggal <br />Kadaluarsa <font style="color:red">*</font>
			</th>
			<th>Stok <font style="color:red">*</font>
			</th>
			<th>Harga <font style="color:red">*</font>
			</th>
			<th>Batal</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
<?php echo form_close(); ?>

<div class="row" style="margin-bottom: 10px;">
	<div class="col-sm-3"><button id='BarisBaru' class='btn btn-default'>Baris Baru</button></div>
</div>
<div class="row">
	<div class="col-sm-3">
		<label class="btn btn-success">
			Pilih file excel upload<input type="file" id="importExcel" onchange="readExcel()" style="display:none;">
		</label>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<font><b>NB : Reset form terlebih dahulu sebelum upload file excel yang baru.</b></font>
	</div>
</div>
</div>
<select id="kategoriSelectTemp" style="display:none;">
	<option value=""></option>
	<?php
	if ($kategori->num_rows() > 0) {
		foreach ($kategori->result() as $k) { ?>
			<option value='<?php echo $k->id_kategori_produk; ?>'><?php echo $k->kategori; ?></option>;
	<?php }
	}
	?>
</select>
<div id='ResponseInput'></div>

<script>
	$(document).ready(function() {
		$('#ModalGue').draggable({
			handle: '.modal-content'
		});

		var Tombol = "<button type='button' class='btn btn-primary' id='SimpanTambahProduk'>Simpan Data</button>";
		Tombol += "<button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>";
		Tombol += "<button id='resetForm' class='btn btn-danger'>Reset Form</button>";
		$('#ModalFooter').html(Tombol);

		BarisBaru();

		$('#BarisBaru').click(function() {
			BarisBaru();
		});

		$('#resetForm').click(function() {
			//Hapus baris inputan
			const tableBody = document.querySelector("#TabelTambahProduk tbody");
			const rowCount = tableBody.rows.length;
			for (let i = rowCount - 1; i >= 0; i--) {
				tableBody.deleteRow(i);
			}
			document.getElementById('importExcel').value = '';
		});

		$('#SimpanTambahProduk').click(function(e) {
			e.preventDefault();

			if ($(this).hasClass('disabled')) {
				return false;
			} else {
				if ($('#TabelTambahProduk').serialize() !== '') {
					//Remove currency format
					$('.currency').each(function() {
						let value = $(this).val().replace(/[^\d]/g, '');
						$(this).val(value);
					});

					$.ajax({
						url: $('#TabelTambahProduk').attr('action'),
						type: "POST",
						cache: false,
						data: $('#TabelTambahProduk').serialize(),
						dataType: 'json',
						beforeSend: function() {
							$('#SimpanTambahProduk').html("Menyimpan Data, harap tunggu ...");
						},
						success: function(json) {
							if (json.status == 1) {
								$('.modal-dialog').removeClass('modal-lg');
								$('.modal-dialog').addClass('modal-sm');
								$('#ModalHeader').html('Sukses !');
								$('#ModalContent').html(json.pesan);
								$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button>");
								$('#ModalGue').modal('show');
								$('#my-grid').DataTable().ajax.reload(null, false);
							} else {
								$('#ResponseInput').html(json.pesan);
							}

							$('#SimpanTambahProduk').html('Simpan Data');
						},
						error: function(jqXHR, textStatus, errorThrown) {
							alert('Gagal menyimpan data produk. Silahkan ulangi kembali.')
							console.log(textStatus, errorThrown);
						}
					});
				} else {
					$('#ResponseInput').html('');
				}
			}
		});

		$("#TabelTambahProduk").find('input[type=text],textarea,select').filter(':visible:first').focus();
	});

	$(document).on('click', '#HapusBaris', function(e) {
		e.preventDefault();
		$(this).parent().parent().remove();

		var Nomor = 1;
		$('#TabelTambahProduk tbody tr').each(function() {
			$(this).find('td:nth-child(1)').html(Nomor);
			Nomor++;
		});

		$('#SimpanTambahProduk').removeClass('disabled');
	});

	function BarisBaru() {
		//Jika ada pembenaran disini ubah juga yang function readExcel
		var Nomor = $('#TabelTambahProduk tbody tr').length + 1;
		var Baris = "<tr>";
		Baris += "<td>" + Nomor + "</td>";
		Baris += "<td><input type='text' name='kode[]' class='form-control input-sm kode_produk' maxlength='5' oninput='validateInputAlphaNum(this)'><span id='SamaKode'></span></td>";
		Baris += "<td><input type='text' name='nama[]' class='form-control input-sm'></td>";
		Baris += "<td>";
		Baris += "<select name='id_kategori_produk[]' class='form-control input-sm'>";
		Baris += "<option value=''></option>";

		<?php
		if ($kategori->num_rows() > 0) {
			foreach ($kategori->result() as $k) { ?>
				Baris += "<option value='<?php echo $k->id_kategori_produk; ?>'><?php echo $k->kategori; ?></option>";
		<?php }
		}
		?>

		Baris += "</select>";
		Baris += "</td>";
		Baris += "<td><input type='text' name='size[]' class='form-control input-sm' style='width:80px;' oninput='validateInputAlphabeth(this);'></td>";

		Baris += "<td><input type='text' name='expired_date[]' class='form-control input-sm tanggal' id='expired_date' onclick='showBoxDate()' style='width:100px'></td>";

		Baris += "<td><input type='text' name='stok[]' class='form-control input-sm' oninput='validateInputNum(this)' style='width:80px'></td>";
		Baris += "<td><input type='text' name='harga[]' class='form-control input-sm currency' oninput='formatCurrency(this)' style='width:100px'></td>";
		Baris += "<td align='center'><a href='#' id='HapusBaris'><i class='fa fa-times' style='color:red;'></i></a></td>";
		Baris += "</tr>";

		$('#TabelTambahProduk tbody').append(Baris);
	}

	function check_int(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode;
		return (charCode >= 48 && charCode <= 57 || charCode == 8);
	}

	function showBoxDate() {
		$('.tanggal').datetimepicker({
			lang: 'en',
			timepicker: false,
			format: 'Y-m-d',
			minDate: new Date()
		});
	}

	function formatCurrency(input) {
		let value = input.value.replace(/[^\d]/g, '');
		value = Number(value);
		value = numeral(value).format('0,0');
		input.value = value;
	}

	function validateInputNum(input) {
		input.value = input.value.replace(/[^0-9]/g, '');
	}

	function validateInputAlphabeth(input) {
		// Menghapus karakter selain huruf dari nilai input
		input.value = input.value.replace(/[^a-zA-Z0-9 ]/g, '');
	}

	function validateInputAlphaNum(input) {
		input.value = input.value.replace(/[^a-zA-Z0-9]/g, '');
	}

	function readExcel() {
		var input = document.getElementById("importExcel");
		var file = input.files[0];
		var reader = new FileReader();

		reader.onload = function(event) {
			var data = new Uint8Array(event.target.result);
			var workbook = XLSX.read(data, {
				type: 'array'
			});

			// Ambil sheet yang ingin dibaca
			var sheet = workbook.Sheets[workbook.SheetNames[0]];

			// Baca data dari sheet
			var range = XLSX.utils.decode_range(sheet['!ref']);

			// Membuat array untuk menyimpan data
			var excelData = [];

			// Looping untuk membaca data perbaris
			for (var row = range.s.r; row <= range.e.r; row++) {
				var rowData = {};
				for (var col = range.s.c; col <= range.e.c; col++) {
					// Ambil nilai sel
					var cell = sheet[XLSX.utils.encode_cell({
						r: row,
						c: col
					})];
					if (cell !== undefined) {
						// Simpan nilai ke objek dengan key nama header kolom
						var header = sheet[XLSX.utils.encode_cell({
							r: 0,
							c: col
						})].v;
						rowData[header] = cell.v;
					}
				}
				if (Object.keys(rowData).length !== 0) { //Tidak ambil data kosong
					excelData.push(rowData);
				}
			}

			if (excelData.length > 0) {
				//Hapus baris inputan
				const tableBody = document.querySelector("#TabelTambahProduk tbody");
				const rowCount = tableBody.rows.length;
				for (let i = rowCount - 1; i >= 0; i--) {
					tableBody.deleteRow(i);
				}

				//Ambil select kategori produk
				var select = document.getElementById("kategoriSelectTemp");
				var options = select.options;

				//Looping value excel ke view
				for (let key in excelData) {
					if (key != 0) { //buang header
						var Baris = "";
						var kategori_temp = "";
						var select_kategori_find = 0;
						var Nomor = $('#TabelTambahProduk tbody tr').length + 1;

						Baris += "<tr>";
						Baris += "<td>" + Nomor + "</td>";
						Baris += "<td><input type='text' name='kode[]' class='form-control input-sm kode_produk' maxlength='5' oninput='validateInputAlphaNum(this)' value='" + excelData[key].kode_produk + "'><span id='SamaKode'></span></td>";
						Baris += "<td><input type='text' name='nama[]' class='form-control input-sm' value='" + excelData[key].nama_produk + "'></td>";
						Baris += "<td>";
						Baris += "<select name='id_kategori_produk[]' class='form-control input-sm'>";

						for (var i = 0; i < options.length; i++) {
							if (options[i].text === excelData[key].kategori_produk) {
								select_kategori_find = 1;
								Baris += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
								break;
							}
						}

						if (select_kategori_find === 0) {
							Baris += "<option value=''></option>";
						}

						Baris += "</select>";
						Baris += "</td>";
						Baris += "<td><input type='text' name='size[]' class='form-control input-sm' style='width:80px;' oninput='validateInputAlphabeth(this);' value='" + excelData[key].ukuran + "'></td>";

						Baris += "<td><input type='text' name='expired_date[]' class='form-control input-sm tanggal' id='expired_date' onclick='showBoxDate()' style='width:100px' value='" + getDateFromExcelSerialDate(excelData[key].tanggal_kadaluarsa) + "'></td>";

						Baris += "<td><input type='text' name='stok[]' class='form-control input-sm' oninput='validateInputNum(this)' style='width:80px' value='" + excelData[key].stok + "'></td>";
						Baris += "<td><input type='text' name='harga[]' class='form-control input-sm currency' oninput='formatCurrency(this)' style='width:100px' value='" + excelData[key].harga + "'></td>";
						Baris += "<td align='center'><a href='#' id='HapusBaris'><i class='fa fa-times' style='color:red;'></i></a></td>";
						Baris += "</tr>";

						$('#TabelTambahProduk tbody').append(Baris);
					}
				}
			}
		};

		reader.readAsArrayBuffer(file);
	}

	function getDateFromExcelSerialDate(serialDate) {
		var baseDate = new Date('1900-01-01');
		var offsetDays = Math.floor(serialDate) - 2;
		var offsetMilliseconds = offsetDays * 24 * 60 * 60 * 1000;
		var resultDate = new Date(baseDate.getTime() + offsetMilliseconds);
		return resultDate.toISOString().slice(0, 10);
	}
</script>