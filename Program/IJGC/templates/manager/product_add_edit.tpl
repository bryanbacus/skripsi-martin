{if $pesan}
<div id="pesan">
	{$pesan}
</div>
{/if}
{if $kembali}
<a href="{$this_page}?aksi=product&aksi2=edit&id={$id}">Edit Product kembali</a>
{/if}
{if !$dShowMe}
<script language="JavaScript" type="text/javascript" src="{$path_editor}/richtext.js"></script>
<div id="addLinks">
	<div class="subj">{$subJudul}</div>
	<form method="post" name="addLinks" onSubmit="return submitForm();" enctype="multipart/form-data">
		<table border="0">
			<tr>
				<td class="label" valign="top">DESCRIPTION</td>
				<td class="texton" valign="top">:</td>
				<td class="texton">
					<script language="javascript">
						{literal}
						function submitForm() {
							//make sure hidden and iframe values are in sync before submitting form
							updateRTE('content'); //use this when syncing only 1 rich text editor ("rtel" is name of editor)
							return true; //Set to false to disable form submission, for easy debugging.
						}
						{/literal}
						//Usage: initRTE(imagesPath, includesPath, cssFile)
						initRTE("{$path_editor}/images/", "{$path_editor}/", "{$path_editor}/");
					</script>
					<script language="JavaScript" type="text/javascript">
					<!--
						var isi = '{$content}';
						//Usage: writeRichText(fieldname, html, width, height, buttons, readOnly)
						writeRichText('content', isi, 400, 200, true, false);
						//-->
						//-->
					</script>
				</td>
			</tr>
			<tr>
				<td class="label">LINK</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="link" value="{$link}" size="50" maxlength="255" /> <em>ex: yahoo.com</em></td>
			</tr>
			<tr>
				<td class="label">KATEGORI</td>
				<td class="texton">:</td>
				<td class="texton">
					<select name="kategori">
						{$drawK}
					</select>
				</td>
			</tr>
			<tr>
				<td class="label">STATUS</td>
				<td class="texton">:</td>
				<td class="texton"><input type="checkbox" name="status" value="1" {$checked}/> Aktif
				</td>
			</tr>
			{if $aksi2 eq "edit"}
			<tr>
				<td class="label" valign="top">GAMBAR</td>
				<td class="texton" valign="top">:</td>
				<td class="texton">
					{if $gbr}
					<img src="{$urlGbr}" height="150" width="150" border="1" align="top"/>
					{else}
					BELUM ADA GAMBAR
					{/if}
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">UBAH GBR</td>
				<td class="texton" valign="top">:</td>
				<td class="texton">
					<input type="file" name="gambar" size="30"/> Ukuran gambar harus 150 x 150 px
				</td>
			</tr>
			{else}
			<tr>
				<td class="label" valign="top">GAMBAR</td>
				<td class="texton" valign="top">:</td>
				<td class="texton">
					<input type="file" name="gambar" size="30"/> Ukuran gambar harus 150 x 150 px
				</td>
			</tr>
			{/if}
			<tr>
				<td class="tombol" colspan="3">
					<input type="submit" name="simpan" value="Simpan">
					<input type="button" value="Reset" onClick="javascript:window.location.href='{$refresh}'">
					<input type="button" value="Cancel" onClick="javascript:window.location.href='{$referer}'">
				</td>
			</tr>
		</table>
	</form>	
</div>
{/if}
