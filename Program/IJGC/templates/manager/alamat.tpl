{if $pesan}
<div id="pesan">
	{$pesan}
</div>
{/if}
<script language="JavaScript" type="text/javascript" src="{$path_editor}/richtext.js"></script>
<div id="editAlamat">
<p align="justify">
<br />
Silakan ubah Objective di sini. Untuk mendapatkan hasil yang maksimal,<br />
Ketiklah materi di MS WORD / MS Excel terlebih dahulu, kemudian kopikan ke kotak di bawah ini.
<br />
</p>
	<form method="post" name="editAlamat" onsubmit="return submitForm();">
		<script language="javascript">
			{literal}
			function submitForm() {
				//make sure hidden and iframe values are in sync before submitting form
				updateRTE('alamat'); //use this when syncing only 1 rich text editor ("rtel" is name of editor)
				return true; //Set to false to disable form submission, for easy debugging.
			}
			{/literal}
			//Usage: initRTE(imagesPath, includesPath, cssFile)
			initRTE("{$path_editor}/images/", "{$path_editor}/", "{$path_editor}/");
		</script>
		<script language="JavaScript" type="text/javascript">
		<!--
			var isiAlamat = '{$alamat}';
			//Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
			writeRichText('alamat', isiAlamat, 400, 200, true, false);
			//-->
			//-->
		</script>
		<br>
		<input type="submit" name="simpan" value="Simpan Objective"> <input type="button" value="Reset" onClick="javascript:window.location.href='{$refresh}'">
	</form>	
</div>
