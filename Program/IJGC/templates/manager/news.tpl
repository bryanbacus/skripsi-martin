<div id="bdr">	
{if $pesan}
<div id="pesan">
	{$pesan}
</div>
{/if}
{if !$dShowMe}

<div class="subj">{$subJudul}</div>

	<form method="post">
			<table class="adminlist">
		{if $listNews}
			<tr>
				<th colspan="2">ID</th>
				<th>Judul</th>
				<th>Tanggal</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
			{section name=news loop=$listNews}
			<tr class="text">
				<td><input type="checkbox" class="inputan" value="{$listNews[news].id}" name="cPoll[]" /></td>
				<td>{$listNews[news].id}</td>
				<td>{$listNews[news].judul}</td>
				<td>{$listNews[news].tanggal}</td>
				<td>{$listNews[news].status}</td>
				<td>
					<a href="{$this_page}?aksi=news&aksi2=edit&id={$listNews[news].id}&kategori={$kategori}">Edit</a> |
					<a href="../index.php?page=news&id={$listNews[news].id}&test=1&kategori={$kategori}">View</a>
				</td>
			</tr>
			{/section}
			<tr>
				<td colspan="9">
				{$paging}
				</td>
			</tr>
			<tr>
				<td colspan="8" class="tombol">
				<input type="button" value="Add" onclick="location.href='{$this_page}?aksi=news&aksi2=add&kategori={$kategori}'" />
				<input type="submit" name="smbDelete" value="Delete" />
				</td>
			</tr>
		{else}
			<tr>
				<td class="item">There are currently no News. Please create one <a href="{$this_page}?aksi=news&aksi2=add&kategori={$kategori}">here</a>.</td>
			</tr>
		{/if}
	</table>
	</form>
{/if}
</div>
 