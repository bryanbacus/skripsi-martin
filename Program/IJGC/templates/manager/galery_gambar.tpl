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
					<div id="kotakAlbum">
						<table border="0" width="98%">
							<tr>
								<td valign="top" rowspan="6" width="5%" id="kosong">
									<input type="checkbox" name="cGalery[]" value="{$listGalery[loop].id}" />
								</td>
								<td rowspan="6" width="45%" id="kosong">
									<a href="/images/galery/{$id_album}/{$listGalery[loop].thumbs}" target="_blank"><img src="{$listGalery[loop].thumb}" border="0" width="150" height="100"/></a>
								</td>
								<td width="50%" class="header">JUDUL :</td>
							</tr>
							<tr>
								<td>{$listGalery[loop].caption}</td>
							</tr>
							<tr>
								<td class="header">STATUS :</td>
							</tr>
							<tr>
								<td>{$listGalery[loop].status}</td>
							</tr>
						</table>
					</div>
				{/section}
			</td>
		</tr>
		<tr>
			<td colspan="9">
			{$paging}
			</td>
		</tr>
		<tr>
			<td colspan="9" class="tombol">
				<input type="button" value="Add" name="add"  onClick="javascript:window.location.href='{$this_page}?aksi=galery&aksi2=gambar&aksi3=add&id={$id_album}'"/> 
				<input type="submit" value="Edit" name="edit" /> 
				<input type="submit" value="Delete" name="delete" /> 
				<input type="button" value="Back" name="back"  onClick="javascript:window.location.href='{$this_page}?aksi=galery'"/> 
			</td>
		</tr>
		{else}
		<tr>
			<td>There are currently no Picture. Please add one <a href="{$this_page}?aksi=galery&aksi2=gambar&aksi3=add&id={$id_album}">here</a>.</td>
		</tr>
		{/if}
	</table>
	</form>
</div>
{/if}
