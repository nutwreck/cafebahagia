<?php
class M_produk extends CI_Model 
{
	function fetch_data_produk($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				(@row:=@row+1) AS nomor,
				a.`id_produk`, 
				a.`kode_produk`, 
				a.`nama_produk`,
				a.`expired_date`,
				a.`size`,
				IF(a.`total_stok` = 0, 'Kosong', a.`total_stok`) AS total_stok,
				CONCAT('Rp. ', REPLACE(FORMAT(a.`harga`, 0),',','.') ) AS harga,
				b.`kategori`
			FROM
				`produk` AS a 
				LEFT JOIN `kategori_produk` AS b ON a.`id_kategori_produk` = b.`id_kategori_produk`
				, (SELECT @row := 0) r WHERE 1=1 
				AND a.`dihapus` = 'tidak' 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`kode_produk` LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR a.`nama_produk` LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR a.`size` LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR IF(a.`total_stok` = 0, 'Kosong', a.`total_stok`) LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR CONCAT('Rp. ', REPLACE(FORMAT(a.`harga`, 0),',','.') ) LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR b.`kategori` LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomor',
			1 => 'a.`kode_produk`',
			2 => 'a.`nama_produk`',
			3 => 'a.`expired_date`',
			4 => 'b.`kategori`',
			5 => 'a.`size`',
			6 => '`harga`',
			7 => 'a.`total_stok`'
		);
		
		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir;
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function hapus_produk($id_produk)
	{
		$dt['dihapus'] = 'ya';
		return $this->db
				->where('id_produk', $id_produk)
				->update('produk', $dt);
	}

	function tambah_baru($kode, $nama, $id_kategori_produk, $size, $expired_date, $stok, $harga)
	{
		$dt = array(
			'kode_produk' => $kode,
			'nama_produk' => $nama,
			'total_stok' => $stok,
			'harga' => $harga,
			'id_kategori_produk' => $id_kategori_produk,
			'size' => $size,
			'expired_date' => $expired_date,
			'dihapus' => 'tidak'
		);

		return $this->db->insert('produk', $dt);
	}

	function cek_kode($kode)
	{
		return $this->db
			->select('id_produk')
			->where('kode_produk', $kode)
			->where('dihapus', 'tidak')
			->limit(1)
			->get('produk');
	}

	function get_baris($id_produk)
	{
		return $this->db
			->select('id_produk, kode_produk, nama_produk, size, total_stok, harga, id_kategori_produk, expired_date')
			->where('id_produk', $id_produk)
			->limit(1)
			->get('produk');
	}

	function update_produk($id_produk, $kode_produk, $nama, $id_kategori_produk, $size, $expired_date, $stok, $harga)
	{
		$dt = array(
			'kode_produk' => $kode_produk,
			'nama_produk' => $nama,
			'total_stok' => $stok,
			'harga' => $harga,
			'size' => $size,
			'id_kategori_produk' => $id_kategori_produk,
			'expired_date' => $expired_date
		);

		return $this->db
			->where('id_produk', $id_produk)
			->update('produk', $dt);
	}

	function cari_kode($keyword, $registered)
	{
		$not_in = '';

		$koma = explode(',', $registered);
		if(count($koma) > 1)
		{
			$not_in .= " AND `kode_produk` NOT IN (";
			foreach($koma as $k)
			{
				$not_in .= " '".$k."', ";
			}
			$not_in = rtrim(trim($not_in), ',');
			$not_in = $not_in.")";
		}
		if(count($koma) == 1)
		{
			$not_in .= " AND `kode_produk` != '".$registered."' ";
		}

		$sql = "
			SELECT 
				`kode_produk`, `nama_produk`, `harga`, `size`
			FROM 
				`produk` 
			WHERE 
				`dihapus` = 'tidak' 
				AND `total_stok` > 0 
				AND ( 
					`kode_produk` LIKE '%".$this->db->escape_like_str($keyword)."%' 
					OR `nama_produk` LIKE '%".$this->db->escape_like_str($keyword)."%' 
				) 
				".$not_in."
				AND expired_date > NOW()
		";

		return $this->db->query($sql);
	}

	function get_stok($kode)
	{
		return $this->db
			->select('nama_produk, total_stok, kode_produk, size')
			->where('kode_produk', $kode)
			->limit(1)
			->get('produk');
	}

	function get_id($kode_produk)
	{
		return $this->db
			->select('id_produk, nama_produk, size')
			->where('kode_produk', $kode_produk)
			->limit(1)
			->get('produk');
	}

	function update_stok($id_produk, $jumlah_beli)
	{
		$sql = "
			UPDATE `produk` SET `total_stok` = `total_stok` - ".$jumlah_beli." WHERE `id_produk` = '".$id_produk."'
		";

		return $this->db->query($sql);
	}
}