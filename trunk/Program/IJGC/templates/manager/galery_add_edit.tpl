<div id="pesan">
	{$pesan}
</div>
{if !$dShowMe}
<script type="text/javascript" src="./js/calendarDateInput.js">

/***********************************************
* Jason's Date Input Calendar- By Jason Moon http://calendar.moonscript.com/dateinput.cfm
* Script featured on and available at http://www.dynamicdrive.com
* Keep this notice intact for use.
***********************************************/

</script>
<div id="addLinks">
	<div id="subJudul">{$subJudul}</div>
	<form method="post" name="addLinks" enctype="multipart/form-data">
		<table border="0">
			<tr>
				<td class="label">ALBUM</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="album" value="{$album}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">TANGGAL</td>
				<td class="texton">:</td>
				<td class="texton"><script>DateInput('tanggal', true, 'MM-DD-YYYY','{$tanggal}')</script>
				</td>
			</tr>
			<tr>
				<td class="label" valign="top">DESKRIPSI</td>
				<td class="texton" valign="top">:</td>
				<td class="texton">
					<textarea name="deskripsi" class="inputan" cols="36" rows="6">{$deskripsi}</textarea>
				</td>
			</tr>
			<tr>
				<td class="label">STATUS</td>
				<td class="texton">:</td>
				<td class="texton"><input type="checkbox" name="status" value="1" {$status}/> Aktif
				</td>
			</tr>
			<tr>
				<td class="tombol" colspan="3">
					{if $id_album}
					<input type="hidden" name="edit" value="edit">
					<input type="hidden" name="id" value="{$id_album}">
					{/if}
					<input type="submit" name="simpan" value="Simpan">
					<input type="button" value="Cancel" onClick="javascript:window.location.href='{$referer}'">
				</td>
			</tr>
		</table>
	</form>	
</div>
{/if}