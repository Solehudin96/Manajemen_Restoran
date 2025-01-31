<table class="table table-bordered table-hover mt-5">
    <thead class="text-bg-success">
        <tr>
            <th>No</th>
            <th>Kode Pesanan</th>
            <th>Nama Pelanggan</th>
            <th>Waktu</th>
            <th>Total Harga</th>
            <th>Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($menu as $m) {
            $kode_pesanan = $m["kode_pesanan"];
            $total_pembayaran = ambil_data("SELECT pesanan.qty, menu.harga FROM pesanan
                JOIN transaksi ON pesanan.kode_pesanan = transaksi.kode_pesanan
                JOIN menu ON menu.kode_menu = pesanan.kode_menu
                WHERE transaksi.kode_pesanan = '$kode_pesanan'");
            
            // Hitung total harga
            $total = 0;
            foreach ($total_pembayaran as $tp) {
                $total += $tp["qty"] * $tp["harga"];
            }
        ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $m["kode_pesanan"]; ?></td>
                <td><?= $m["nama_pelanggan"]; ?></td>
                <td><?= $m["waktu"]; ?></td>
                <td>Rp.<?= number_format($total, 0, ',', '.'); ?></td>
                <td>
                    <form action="cetak/cetak.php" target="_blank" method="GET">
                        <input type="hidden" name="kode_pesanan" value="<?= $m["kode_pesanan"]; ?>">
                        <input class="form-control" name="pembayaran" type="number" min="0" placeholder="Masukkan pembayaran">
                </td>
                <td>
                        <button class="btn btn-primary">Cetak</button>
                    </form>
                    <a class="btn btn-danger" href="hapus.php?kode_pesanan=<?= $m["kode_pesanan"]; ?>" onclick="return confirm('Hapus Data Transaksi?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
