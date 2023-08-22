<?php
function p($par, $st = false)
{
	if ($st) {
		return htmlspecialchars(addslashes(trim($_POST[$par])));
	} else {
		return addslashes(trim($_POST[$par]));
	}
}
function g($par)
{
	global $baglan;
	return str_replace('<', ' ', strip_tags(mysqli_real_escape_string($baglan, htmlspecialchars(trim($_GET[$par])))));
}
function query($query)
{
	global $baglan;
	return mysqli_query($baglan, $query);
}
function row($query)
{
	return mysqli_fetch_assoc($query);
}
function rows($query)
{
	return mysqli_num_rows($query);
}
function ip_sehir_getir($ip)
{
	$content =  file_get_contents('http://www.ipsorgu.com/?ip=' . $ip . '#sorgu');
	if (preg_match('#\<title>(.*?)\</title>#', $content, $regs)) {
		$city = $regs[1];
	}
	if ($city != '') {
		return iconv('windows-1254', 'UTF-8', explode('lke: ', explode('-', $city)[0])[1]);
	} else {
		return 'yok';
	}
	/*$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
		return $details->city?$details->city:'Lokasyon Belirlenemiyor';*/
}
function sayac_ayar()
{
	$ip = $_SERVER['REMOTE_ADDR']; //Localhost uzerinde calistiginda ip degeri '::1' seklinde doner. Sunucuya atildiginda dogru ip degeri gosterilir.
	$zaman = time();
	$buguntarih = date('Y-m-d');
	$sure_siniri = $zaman - 60 * 5;
	$kayit_sql = row(query('SELECT count(id) as kayit_sayisi FROM sayac_ip WHERE tarih=\'' . $buguntarih . '\' AND ip=\'' . $ip . '\''));
	if ($kayit_sql['kayit_sayisi'] == 0) { //bugün bu ip ye sahip kullanıcı siteye girmediyse
		query('INSERT INTO sayac_ip (tarih, tiklama, ip) VALUES (\'' . $buguntarih . '\',1,\'' . $ip . '\')'); //bugünün tarihini ve kullancıının ip sini kaydet
		$toplam_kayit_sayisi = rows(query('SELECT id FROM sayac_toplam'));
		if ($toplam_kayit_sayisi == 0) {
			query('INSERT INTO sayac_toplam(toplam_tekil,toplam_cogul) VALUES(1,1)');
		} else {
			query('UPDATE sayac_toplam SET toplam_tekil=toplam_tekil+1, toplam_cogul=toplam_cogul+1 WHERE id=1 LIMIT 1');
		}
	} else {
		query('UPDATE sayac_ip SET tiklama=tiklama+1 WHERE tarih=\'' . $buguntarih . '\' and ip=\'' . $ip . '\''); //bugün siteye bu kullancıı kaç kere girmiş, tıklama sayısını kaydet
		query('UPDATE sayac_toplam SET toplam_cogul=toplam_cogul+1 WHERE id=1 LIMIT 1');
	}
	query('DELETE FROM sayac_online WHERE tarih < \'' . $sure_siniri . '\''); //5 dakika boyunca sitede aktif olmayan kullanıcıları online listesinden (sayac_online tablosundan) çıkart
	$online_kontrol = row(query('SELECT count(id) as online_kontrol FROM sayac_online WHERE ip=\'' . $ip . '\''));
	if ($online_kontrol['online_kontrol'] == 0) { //kullanıcının ip si sayac_online tablosunda yok ise
		query('INSERT INTO sayac_online (ip, tarih) VALUES (\'' . $ip . '\',\'' . $zaman . '\')'); //kullanıcıyı sayac_online tablosuna ekle
	} else {
		query('UPDATE sayac_online SET tarih=\'' . $zaman . '\' WHERE ip=\'' . $ip . '\''); //sayac_online tablosundaki tarih alanını şu an ki zaman ile güncelle
	}
}
function sayac_bilgiler()
{
	$buguntarih = date('Y-m-d');
	$secilen_gun = g('secilen_gun') ? g('secilen_gun') : $buguntarih;
	$online_sql = row(query('SELECT count(id) as online_sayisi FROM sayac_online'));
	$online_ziyaretci_sayisi = $online_sql['online_sayisi'];
	$toplam_tc_cek = row(query('SELECT * FROM sayac_toplam WHERE id=1 LIMIT 1'));
	$toplam_tekil_sayisi = $toplam_tc_cek['toplam_tekil'];
	$toplam_cogul_sayisi = $toplam_tc_cek['toplam_cogul'];
	$secilen_gun_sql = row(query('SELECT COUNT(ip) AS ttoplam, SUM(tiklama) AS ctoplam FROM sayac_ip WHERE tarih=\'' . $secilen_gun . '\''));
	$bugun_tekil = $secilen_gun_sql['ttoplam'];
	$bugun_cogul = $secilen_gun_sql['ctoplam'];
?>


	<h2 class="text-black text-center mt-5 ">Genel Ziyaretçi Analizi</h2>
	<table class="mb-5 mt-3" width="50%" border="1" bordercolor="#e1e1e1" cellpadding="10" cellspacing="0" align="center" style="box-shadow: 2px 2px 15px black;">
		<tr>
			<td class="text-primary">Site Online</td>
			<td class="text-primary fw-bold"><?php echo $online_ziyaretci_sayisi ?></td>
		</tr>
		<tr>
			<td class="text-primary ">Toplam Siteye Giren Sayısı</td>
			<td class="text-primary fw-bold"><?php echo $toplam_tekil_sayisi ?></td>
		</tr>
		<tr>
			<td class="text-primary ">Toplam Sayfa Görüntülenme Sayısı</td>
			<td class="text-primary fw-bold"><?php echo $toplam_cogul_sayisi ?></td>
		</tr>
	</table>




<?php
}
