<?php
class M_penjualan_detail extends CI_Model
{
	function insert_detail($id_master, $id_produk, $jumlah_beli, $harga_satuan, $sub_total)
	{
		$dt = array(
			'id_penjualan_m' => $id_master,
			'id_produk	' => $id_produk,
			'jumlah_beli' => $jumlah_beli,
			'harga_satuan' => $harga_satuan,
			'total' => $sub_total
		);

		return $this->db->insert('penjualan_detail', $dt);
	}

	function get_detail($id_penjualan)
	{
		$sql = "
			SELECT 
				b.`kode_produk`,  
				b.`nama_produk`, 
				b.`size`,
				CONCAT('Rp. ', REPLACE(FORMAT(a.`harga_satuan`, 0),',','.') ) AS harga_satuan, 
				a.`harga_satuan` AS harga_satuan_asli, 
				a.`jumlah_beli`,
				CONCAT('Rp. ', REPLACE(FORMAT(a.`total`, 0),',','.') ) AS sub_total,
				a.`total` AS sub_total_asli  
			FROM 
				`penjualan_detail` a
				LEFT JOIN `produk` b ON a.`id_produk` = b.`id_produk` 
			WHERE 
				a.`id_penjualan_m` = '".$id_penjualan."' 
			ORDER BY 
				a.`id_penjualan_d` ASC 
		";

		return $this->db->query($sql);
	}
}