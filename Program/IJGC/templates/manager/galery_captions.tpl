<div id="pesan">
	{$pesan}
</div>
{if !$dShowMe}
<div id="galery">
	<div id="subJudul">{$subJudul}</div>
	<form method="post">
	<table border="0">
		<tr>
			<td class="label">ALBUM</td>
			<td class="texton">:</td>
			<td class="texton">{$album}</td>
		</tr>
		<tr>
			<td class="label">TANGGAL</td>
			<td class="texton">:</td>
			<td class="texton">{$tanggal}</td>
		</tr>
		<tr>
			<td class="label" valign="top">DESKRIPSI</td>
			<td class="texton" valign="top">:</td>
			<td class="texton">
				{$deskripsi}
			</td>
		</tr>
		<tr>
			<td class="label">STATUS</td>
			<td class="texton">:</td>
			<td class="texton">{$status}</td>
		</tr>
	</table>
	<br />
	<table class="adminlist">
		{if $listGalery}
		<tr>
			<td>
				{section name=loop loop=$listGalery}
					<div id="kotakGalery">
						<table border="0">
							<tr>
								<td id="kosong">
									<img src="{$listGalery[loop].thumb}" border="0" width="150" height="100"/>
								</td>
								<td>
								<input type="hidden" name="id[]" value="{$listGalery[loop].id}" />
								JUDUL : <input type="text" name="judul{$listGalery[loop].id}" size="50" maxlength="100" value="{$listGalery[loop].caption}" /><br /><br />
								STATUS : <input type="checkbox" name="status{$listGalery[loop].id}" value="1" {$listGalery[loop].status}> Aktif
								</td>
							</tr>
						</table>
					</div>
				{/section}
			</td>
		</tr>
		<tr>
			<td colspan="9" class="tombol">
				{if $edit}
				<input type="hidden" value="edit" name="edit" /> 
				{/if}
				<input type="submit" value="Simpan" name="simpan" /> 
				<input type="reset"/> 
			</td>
		</tr>
		{else}
		<tr>
			<td>Invalid Actions !</td>
		</tr>
		{/if}
	</table>
	</form>
</div>
{/if}
