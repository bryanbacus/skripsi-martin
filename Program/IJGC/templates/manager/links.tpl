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
		{if $listLinks}
			<tr>
				<th colspan="2">ID</th>
				<th>Gambar</th>
				<th>Description</th>
				<th>Link</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
			{section name=links loop=$listLinks}
			<tr class="text">
				<td><input type="checkbox" class="inputan" value="{$listLinks[links].id}" name="cPoll[]" /></td>
				<td>{$listLinks[produtcs].id}</td>
				<td><img src="{$listLinks[links].gambar}" width="50" height="50" border="0"></td>				
				<td>{$listLinks[links].isi}</td>
				<td>{$listLinks[links].link}</td>
				<td>{$listLinks[links].status}</td>
				<td>
					<a href="{$this_page}?aksi=link&aksi2=edit&id={$listLinks[links].id}">Edit</a> |
					<a href="../index.php?page=link&id={$listLinks[links].id}" target="_blank">View</a>
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
				<input type="button" value="Add" onclick="location.href='{$this_page}?aksi=link&aksi2=add'" />
				<input type="submit" name="smbDelete" value="Delete" />
				</td>
			</tr>
		{else}
			<tr>
				<td class="item">There are currently no Golf Products. Please create one <a href="{$this_page}?aksi=link&aksi2=add">here</a>.</td>
			</tr>
		{/if}
	</table>
	</form>
{/if}
</div>
 