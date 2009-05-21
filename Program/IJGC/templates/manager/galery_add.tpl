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
				<td class="label">JML FILES</td>
				<td class="texton">:</td>
				<td class="texton">
					<select name="jml" class="inputan">
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="15">15</option>
					</select> &nbsp;<input type="submit" name="ubahForm" value="Ubah" />
				</td>
			</tr>
			{php}
				if(isset($_POST['jml'])){
					$x = $_POST['jml'];
				}else{
					$x = 5;
				}
				for($xx=1;$xx<=$x;$xx++){
			{/php}
			<tr>
				<td class="label">GAMBAR</td>
				<td class="texton">:</td>
				<td class="texton"><input type="file" name="gambar[]" size="50" /></td>
			</tr>
			{php}
				}
			{/php}
			<tr>
				<td class="tombol" colspan="3">
					<input type="submit" name="simpan" value="Simpan">
					<input type="button" value="Cancel" onClick="javascript:window.location.href='{$referer}'">
				</td>
			</tr>
		</table>
	</form>	
</div>
{/if}