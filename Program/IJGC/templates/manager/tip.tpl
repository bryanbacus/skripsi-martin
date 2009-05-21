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
		{if $listTips}
			<tr>
				<th colspan="2">ID</th>
				<th>Kategori</th>
				<th>Cuplikan</th>
				<th>Link</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
			{section name=tips loop=$listTips}
			<tr class="text">
				<td><input type="checkbox" class="inputan" value="{$listTips[tips].id}" name="cPoll[]" /></td>
				<td>{$listTips[tips].id}</td>
				<td>{$listTips[tips].kategori}</td>
				<td>{$listTips[tips].isi}</td>
				<td>{$listTips[tips].link}</td>
				<td>{$listTips[tips].status}</td>
				<td>
					<a href="{$this_page}?aksi=tip&aksi2=edit&id={$listTips[tips].id}&kategori={$kategori}">Edit</a> |
					<a href="../index.php?page=tip&id={$listTips[tips].id}&kategori={$kategori}" target="_blank">View</a>
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
				<input type="button" value="Add" onclick="location.href='{$this_page}?aksi=tip&aksi2=add&kategori={$kategori}'" />
				<input type="submit" name="smbDelete" value="Delete" />
				</td>
			</tr>
		{else}
			<tr>
				<td class="item">There are currently no Golf Tips. Please create one <a href="{$this_page}?aksi=tip&aksi2=add&kategori={$kategori}">here</a>.</td>
			</tr>
		{/if}
	</table>
	</form>
{/if}
</div>
 