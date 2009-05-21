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
		{if $listProducts}
			<tr>
				<th colspan="2">ID</th>
				<th>Gambar</th>
				<th>Kategori</th>
				<th>Description</th>
				<th>Link</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
			{section name=products loop=$listProducts}
			<tr class="text">
				<td><input type="checkbox" class="inputan" value="{$listProducts[products].id}" name="cPoll[]" /></td>
				<td>{$listProducts[produtcs].id}</td>
				<td><img src="{$listProducts[products].gambar}" width="50" height="50" border="0"></td>				
				<td>{$listProducts[products].type}</td>
				<td>{$listProducts[products].isi}</td>
				<td>{$listProducts[products].link}</td>
				<td>{$listProducts[products].status}</td>
				<td>
					<a href="{$this_page}?aksi=product&aksi2=edit&id={$listProducts[products].id}">Edit</a> |
					<a href="../index.php?page=product&id={$listProducts[products].id}" target="_blank">View</a>
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
				<input type="button" value="Add" onclick="location.href='{$this_page}?aksi=product&aksi2=add'" />
				<input type="submit" name="smbDelete" value="Delete" />
				</td>
			</tr>
		{else}
			<tr>
				<td class="item">There are currently no Golf Products. Please create one <a href="{$this_page}?aksi=product&aksi2=add">here</a>.</td>
			</tr>
		{/if}
	</table>
	</form>
{/if}
</div>
 