<div id="pesan">
	{$pesan}
</div>
{if !$dShowMe}
<div id="galery">
	<div id="subJudul">{$subJudul}</div>
	<form method="post">
	<table class="adminlist">
		{if $listAlbum}
		<tr>
			<td>
				{section name=loop loop=$listAlbum}
					<div id="kotakAlbum">
						<table border="0" width="98%">
							<tr>
								<td valign="top" rowspan="6" width="5%" id="kosong">
									<input type="radio" name="cAlbum" value="{$listAlbum[loop].id}" />
								</td>
								<td rowspan="6" width="45%" id="kosong">
									<a href="{$this_page}?aksi=galery&aksi2=gambar&id={$listAlbum[loop].id}"><img src="{$listAlbum[loop].thumbs}" border="0" width="150" height="100"/></a>
								</td>
								<td width="50%" class="header">ALBUM :</td>
							</tr>
							<tr>
								<td>{$listAlbum[loop].album}...</td>
							</tr>
							<tr>
								<td class="header">TANGGAL :</td>
							</tr>
							<tr>
								<td>{$listAlbum[loop].tanggal}</td>
							</tr>
							<tr>
								<td class="header">STATUS :</td>
							</tr>
							<tr>
								<td>{$listAlbum[loop].status}</td>
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
				<input type="button" value="Add" name="add"  onClick="javascript:window.location.href='{$this_page}?aksi=galery&aksi2=add'"/> 
				<input type="submit" value="Edit" name="edit" /> 
				<input type="submit" value="Delete" name="delete" /> 
			</td>
		</tr>
		{else}
		<tr>
			<td>There are currently no Album. Please create one <a href="{$this_page}?aksi=galery&aksi2=add">here</a>.</td>
		</tr>
		{/if}
	</table>
	</form>
</div>
{/if}
