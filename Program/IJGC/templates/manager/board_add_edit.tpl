{if $pesan}
<div id="pesan">
	{$pesan}
</div>
{/if}
{if $kembali}
<a href="{$this_page}?aksi=news&aksi2=edit&id={$id}">Edit Profile kembali</a>
{/if}
{if !$dShowMe}
<script language="JavaScript" type="text/javascript" src="{$path_editor}/richtext.js"></script>
<div id="profile">
	<div id="subJudul">{$subJudul}</div>
	<form method="post" name="addProfile" onSubmit="return submitForm();" enctype="multipart/form-data">
	  <input type="hidden" value={$id} name="id">
	  <table id='tblProfile'>
		<tr> 
		  <td class='labelProfile'>Nama</td>
		  <td class='labelProfile'>:</td>
		  <td colspan="2"><input name="nama" type=text class=inputan size=40 maxlength=255 value="{$nama}"></td>
		</tr>
		<tr> 
		  <td class='labelProfile'>Title</td>
		  <td class='labelProfile'>:</td>
		  <td colspan="2">
		  <select name="title">
		  	{section name=board loop=$ListBoards}
		  		{if $ListBoards[board].id eq $title}
					<option value="{$ListBoards[board].id}" selected>{$ListBoards[board].description}</option>
				{else}
					<option value="{$ListBoards[board].id}">{$ListBoards[board].description}</option>
				{/if}
			{/section}
		  </select>
		</tr>
		{if $aksi2 eq "edit"}
		<tr>
			<td class="label" valign="top">FOTO</td>
			<td class="texton" valign="top">:</td>
			<td class="texton">
				{if $gbr}
				<img src="{$urlGbr}" height="150" width="150" border="1" align="top"/>
				{else}
				BELUM ADA FOTO
				{/if}
			</td>
		</tr>
		<tr>
			<td class="label" valign="top">UBAH FOTO</td>
			<td class="texton" valign="top">:</td>
			<td class="texton">
				<input type="file" name="gambar" size="30"/> Ukuran gambar harus 150 x 150 px
			</td>
		</tr>
		{else}
		<tr>
			<td class="label" valign="top">FOTO</td>
			<td class="texton" valign="top">:</td>
			<td class="texton">
				<input type="file" name="gambar" size="30"/> Ukuran gambar harus 150 x 150 px
			</td>
		</tr>
		{/if}
		<tr>
			<td class="label">STATUS</td>
			<td class="texton">:</td>
			<td class="texton"><input type="checkbox" name="status" value="1" {$checked}/> Aktif
			</td>
		</tr>
		<tr>
			<td class="label" valign="top">NARASI</td>
			<td class="texton" valign="top">:</td>
			<td class="texton">
				<script language="javascript">
					{literal}
					function submitForm() {
						//make sure hidden and iframe values are in sync before submitting form
						updateRTE('narasi'); //use this when syncing only 1 rich text editor ("rtel" is name of editor)
						return true; //Set to false to disable form submission, for easy debugging.
					}
					{/literal}
					//Usage: initRTE(imagesPath, includesPath, cssFile)
					initRTE("{$path_editor}/images/", "{$path_editor}/", "{$path_editor}/");
				</script>
				<script language="JavaScript" type="text/javascript">
				<!--
					var isi = '{$narasi}';
					//Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
					writeRichText('narasi', isi, 400, 200, true, false);
					//-->
					//-->
				</script>
			</td>
		</tr>
		<tr>
			<td class="tombol" colspan="5">
				<input type="submit" name="simpan" value="Simpan">
				<input type="button" value="Reset" onClick="javascript:window.location.href='{$refresh}'">
				<input type="button" value="Cancel" onClick="javascript:window.location.href='{$referer}'">
			</td>
		</tr>
	  </table>
	</form>
</div>
{/if}