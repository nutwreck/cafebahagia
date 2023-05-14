<?php echo form_open('produk/edit/' . $produk->id_produk, array('id' => 'FormEditProduk')); ?>
<div style="margin-bottom: 10px;">
	<font style="color:red">(*) Wajib Diisi</font>
</div>
<div class="form-horizontal">
	<div class="form-group">
		<label class="col-sm-3 control-label">Kode Produk <font style="color:red">*</font></label>
		<div class="col-sm-8">
			<?php
			echo form_input(array(
				'name' => 'kode_produk',
				'class' => 'form-control',
				'value' => $produk->kode_produk,
				'oninput' => 'validateInputAlphaNum(this)'
			));
			echo form_hidden('kode_produk_old', $produk->kode_produk);
			?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Nama Produk <font style="color:red">*</font></label>
		<div class="col-sm-8">
			<?php
			echo form_input(array(
				'name' => 'nama_produk',
				'class' => 'form-control',
				'value' => $produk->nama_produk
			));
			?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Kategori <font style="color:red">*</font></label>
		<div class="col-sm-8">
			<select name='id_kategori_produk' class='form-control'>
				<option value=''></option>
				<?php
				foreach ($kategori->result() as $k) {
					$selected = '';
					if ($produk->id_kategori_produk == $k->id_kategori_produk) {
						$selected = 'selected';
					}

					echo "<option value='" . $k->id_kategori_produk . "' " . $selected . ">" . $k->kategori . "</option>";
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Ukuran</label>
		<div class="col-sm-8">
			<?php
			echo form_input(array(
				'name' => 'size',
				'class' => 'form-control',
				'value' => $produk->size,
				'oninput' => 'validateInputAlphabeth(this)'
			));
			?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Tanggal Kadaluarsa <font style="color:red">*</font></label>
		<div class="col-sm-8">
			<?php
			echo form_input(array(
				'name' => 'expired_date',
				'class' => 'form-control input-sm tanggal',
				'value' => $produk->expired_date,
				'onclick' => 'showBoxDate()'
			));
			?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Stok <font style="color:red">*</font></label>
		<div class="col-sm-8">
			<?php
			echo form_input(array(
				'name' => 'total_stok',
				'class' => 'form-control',
				'value' => $produk->total_stok,
				'oninput' => 'validateInputNum(this)'
			));
			?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Harga <font style="color:red">*</font></label>
		<div class="col-sm-8">
			<?php
			echo form_input(array(
				'name' => 'harga',
				'class' => 'form-control currency',
				'value' => $produk->harga,
				'oninput' => 'formatCurrency(this)'
			));
			?>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<div id='ResponseInput'></div>

<script>
	$(document).ready(function() {
		$('#ModalGue').draggable({
			handle: '.modal-content'
		});

		var Tombol = "<button type='button' class='btn btn-primary' id='SimpanEditProduk'>Update Data</button>";
		Tombol += "<button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>";
		$('#ModalFooter').html(Tombol);

		$('#SimpanEditProduk').click(function() {
			//Remove currency format
			$('.currency').each(function() {
				let value = $(this).val().replace(/[^\d]/g, '');
				$(this).val(value);
			});

			$.ajax({
				url: $('#FormEditProduk').attr('action'),
				type: "POST",
				cache: false,
				data: $('#FormEditProduk').serialize(),
				dataType: 'json',
				success: function(json) {
					if (json.status == 1) {
						$('#ResponseInput').html(json.pesan);
						setTimeout(function() {
							$('#ResponseInput').html('');
						}, 3000);
						$('#my-grid').DataTable().ajax.reload(null, false);
					} else {
						$('#ResponseInput').html(json.pesan);
					}
				}
			});
		});
	});

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
</script>