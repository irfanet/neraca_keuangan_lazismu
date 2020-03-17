<table>
    <tr>
        <th width="80%">Akun</th>
        <th>Catatan</th>
        <th><?= date("d/m/Y")?></th>
    </tr>

    <tr>
        <td colspan='3'><b>ASET</b></td>
    </tr>    
    <tr></tr>
    <tr>
        <td colspan='3'><br /><b>&emsp; Aset Lancar</b></td>
    </tr>
    <tr>
        <td>&emsp;&emsp; Kas dan Setara Kas</td>
        <td>1</td>
        <td style="text-align:right;"><?= nominal($aktiva_kas_n_setara); ?></td>
    </tr>
    <tr>
        <td>&emsp;&emsp; Piutang</td>
        <td>2</td>
        <td style="text-align:right;"><?= nominal($aktiva_piutang); ?></td>
    </tr>
    <tr>
        <td>&emsp;&emsp; Persediaan</td>
        <td>3</td>
        <td style="text-align:right;"><?= nominal($aktiva_persediaan_barang); ?></td>
    </tr>
    <tr>
        <td>&emsp;&emsp; Uang Muka</td>
        <td>4</td>
        <td style="text-align:right;"><?= nominal($aktiva_uang_muka_program); ?></td>
    </tr>
    <tr>
        <td>&emsp;&emsp; Biaya Dibayar Muka</td>
        <td>5</td>
        <td style="text-align:right;"><?= nominal($aktiva_biaya_dimuka); ?></td>
    </tr>
    <tr>
        <td>&emsp;&emsp; Investasi</td>
        <td>6</td>
        <td style="text-align:right;"><?= nominal($aktiva_investasi); ?></td>
    </tr>
    <tr>
        <td colspan='2'><b>&emsp;&emsp;&emsp; Jumlah Aset Lancar</b></td>
        <td style="text-align:right;"><?= nominal($aktiva_jml_aset_lancar); ?></td>
    </tr>
    <tr></tr>
    <tr>
        <td><br /><b>&emsp; Aset Tetap</b></td>
        <td colspan='2'>7</td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp; Aset Tetap</td>
        <td style="text-align:right;"><?= nominal($aktiva_aset_tetap); ?></td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp; Akumulasi Penyusutan</td>
        <td style="text-align:right;"><?= nominal($aktiva_akumulasi_penyusutan_aset_tetap); ?></td>
    </tr>
    <tr>
        <td colspan='2'><b>&emsp;&emsp;&emsp; Nilai Buku</b></td>
        <td style="text-align:right;"><?= nominal($aktiva_jml_aset_tetap); ?></td>
    </tr>
    <tr></tr>
    <tr>
        <td><br /><b>&emsp; Aset Kelolaan</b></td>
        <td colspan='2'>8</td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp; Aset Kelolaan</td>
        <td style="text-align:right;"><?= nominal($aktiva_aset_kelolaan); ?></td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp; Akumulasi Penyusutan</td>
        <td style="text-align:right;"><?= nominal($aktiva_akumulasi_penyusutan_aset_kelola); ?></td>
    </tr>
    <tr>
        <td colspan='2'><b>&emsp;&emsp;&emsp; Nilai Buku</b></td>
        <td style="text-align:right;"><?= nominal($aktiva_jml_aset_kelolaan); ?></td>
    </tr>
    <tr>
        <td colspan='2'><br />&emsp;&emsp; <b>JUMLAH ASET<b></td>
        <td style="text-align:right;"><?= nominal($aktiva_jml); ?></td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan='3'><br /><br /><b>LIABILITAS DAN SALDO DANA</b></td>
    </tr>    
    <tr>
        <td colspan='3'><br /><b>&emsp; LIABILITAS</b></td>
    </tr>
    <tr>
        <td>&emsp;&emsp; <b>Liabilitas Jangka Pendek</b></td>
        <td colspan="2">9</td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp;&emsp; Hutang Penyaluran Dana Program</td>
        <td style="text-align:right;"><?= nominal($pasiva_hutang_penyaluran_dana_program); ?></td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp;&emsp; Hutang Penyaluran Amil</td>
        <td style="text-align:right;"><?= nominal($pasiva_hutang_penyaluran_amil); ?></td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp;&emsp; Titipan Dana Wakaf</td>
        <td style="text-align:right;"><?= nominal($pasiva_titipan_dana_wakaf); ?></td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp;&emsp; Hutang Dana Zis</td>
        <td style="text-align:right;"><?= nominal($pasiva_hutang_dana_zis); ?></td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp;&emsp; Hutang Dana Amil</td>
        <td style="text-align:right;"><?= nominal($pasiva_hutang_dana_amil); ?></td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp;&emsp; Hutang Jangka Pendek Lainnya</td>
        <td style="text-align:right;"><?= nominal($pasiva_hutang_jangka_pendek_lainnya); ?></td>
    </tr>
    <tr></tr>
    <tr>
        <td>&emsp;&emsp; <b>Liabilitas Jangka Panjang</b></td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td colspan='2'>&emsp;&emsp;&emsp; Hutang Jangka Panjang</td>
        <td style="text-align:right;"><?= nominal($pasiva_hutang_jangka_panjang); ?></td>
    </tr>
    <tr>
        <td colspan='2'><b>&emsp;&emsp; Jumlah Liabilitas</b></td>
        <td style="text-align:right;"><?= nominal($pasiva_jml_liabilitas); ?></td>
    </tr>
    <tr></tr>

    <tr>
        <td><br /><b>&emsp; SALDO DANA</b></td>
        <td colspan="2">10</td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Zakat</td>
        <td style="text-align:right;"><?= nominal($pasiva_zakat); ?></td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Zakat Fitrah</td>
        <td style="text-align:right;"><?= nominal($pasiva_zakat_fitrah); ?></td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Infak / Sedekah</td>
        <td style="text-align:right;"><?= nominal($pasiva_infak); ?></td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Muqoyyad</td>
        <td style="text-align:right;"><?= nominal($pasiva_muqoyyad); ?></td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Amil</td>
        <td style="text-align:right;"><?= nominal($pasiva_amil); ?></td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Hibah</td>
        <td style="text-align:right;"><?= nominal($pasiva_hibah); ?></td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Wakaf</td>
        <td style="text-align:right;"><?= nominal($pasiva_wakaf); ?></td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Qurban</td>
        <td style="text-align:right;"><?= nominal($pasiva_qurban); ?></td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Fidyah</td>
        <td style="text-align:right;"><?= nominal($pasiva_fidyah); ?></td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Jizyah</td>
        <td style="text-align:right;"><?= nominal($pasiva_jizyah); ?></td>
    </tr>
    <tr>
        <td colspan="2">&emsp;&emsp; Hak Kelola Wilayah</td>
        <td style="text-align:right;"><?= nominal($pasiva_hak_kelola_wilayah); ?></td>
    </tr>

    <tr>
        <td colspan="2">&emsp;&emsp; <b>Jumlah Saldo Dana</b></td>
        <td style="text-align:right;"><?= nominal($pasiva_jml_saldo_dana); ?></td>
    </tr>
    <tr>
        <td colspan="2"><br />&emsp; <b>JUMLAH LIABILITAS DAN SALDO DANA</b></td>
        <td style="text-align:right;"><?= nominal($pasiva_jml); ?></td>
    </tr>




</table>