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
		{if $listFoundation}
			<tr>
				<th colspan="2">ID</th>
				<th>Gambar</th>
				<th>Deskripsi</th>
				<th>Link</th>
				<th>Kategori</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
			{section name=found loop=$listFoundation}
			<tr class="text">
				<td><input type="checkbox" class="inputan" value="{$listFoundation[found].id}" name="cPoll[]" /></td>
				<td>{$listFoundation[found].id}</td>
				<td><img src="{$listFoundation[found].gambar}" border="1" width="50" height="50"></td>
				<td>{$listFoundation[found].isi}</td>
				<td>{$listFoundation[found].link}</td>
				<td>{$listFoundation[found].kategori}</td>
				<td>{$listFoundation[found].status}</td>
				<td>
					<a href="{$this_page}?aksi=found&aksi2=edit&id={$listFoundation[found].id}">Edit</a> |
					<a href="../index.php?page=found&id={$listFoundation[found].id}" target="_blank">View</a>
				</td>
			</tr>
			{/section}
			<tr>
				<td colspan="8">
				{$paging}
				</td>
			</tr>
			<tr>
				<td colspan="8" class="tombol">
				<input type="button" value="Add" onclick="location.href='{$this_page}?aksi=found&aksi2=add'" />
				<input type="submit" name="smbDelete" value="Delete" />
				</td>
			</tr>
		{else}
			<tr>
				<td class="item">There are currently no Foundation content. Please create one <a href="{$this_page}?aksi=found&aksi2=add&kategori={$kategori}">here</a>.</td>
			</tr>
		{/if}
	</table>
	</form>
{/if}
</div>
 