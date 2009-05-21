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
		{if $listPartner}
			<tr>
				<th colspan="2">ID</th>
				<th>Logo</th>
				<th>Name</th>
				<th>Kategori</th>
				<th>Description</th>
				<th>Link</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
			{section name=partner loop=$listPartner}
			<tr class="text">
				<td><input type="checkbox" class="inputan" value="{$listPartner[partner].id}" name="cPoll[]" /></td>
				<td>{$listPartner[partner].id}</td>
				<td><img src="{$listPartner[partner].logo}" width="50" height="50" border="0"></td>				
				<td>{$listPartner[partner].name}</td>
				<td>{$listPartner[partner].type_partner}</td>
				<td>{$listPartner[partner].isi}</td>
				<td>{$listPartner[partner].link}</td>
				<td>{$listPartner[partner].status}</td>
				<td>
					<a href="{$this_page}?aksi=partnerk&aksi2=edit&id={$listPartner[partner].id}">Edit</a> |
					<a href="../index.php?page=partnerk&id={$listPartner[partner].id}" target="_blank">View</a>
				</td>
			</tr>
			{/section}
			<tr>
				<td colspan="9">
				{$paging}
				</td>
			</tr>
			<tr>
				<td colspan="9" class="tombol">
				<input type="button" value="Add" onclick="location.href='{$this_page}?aksi=partnerk&aksi2=add'" />
				<input type="submit" name="smbDelete" value="Delete" />
				</td>
			</tr>
		{else}
			<tr>
				<td class="item">There are currently no Partner or Event. Please create one <a href="{$this_page}?aksi=partnerk&aksi2=add">here</a>.</td>
			</tr>
		{/if}
	</table>
	</form>
{/if}
</div>
 