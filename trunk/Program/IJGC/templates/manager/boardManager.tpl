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
		{if $listProfile}
			<tr>
				<th colspan="2">ID</th>
				<th>Nama</th>
				<th>Title</th>
				<th>Description</th>
				<th>Photo</th>
				<th>Aksi</th>
				<th>Order</th>
			</tr>
			{section name=board loop=$listProfile}
			<tr class="text">
				<td><input type="checkbox" class="inputan" value="{$listProfile[board].id}" name="cProf[]" /></td>
				<td>{$listProfile[board].id}</td>
				<td>{$listProfile[board].name}</td>
				<td>{$listProfile[board].jabatan}</td>
				<td>{$listProfile[board].deskripsi}</td>
				<td><img src="{$listProfile[board].photo}" border="1" width="75" height="75"></td>
				<td>
					<a href="{$this_page}?aksi=board&aksi2=edit&id={$listProfile[board].id}">Edit</a>
				</td>
				{if $listProfile[board].pertama}
					<td><a href="{$this_page}?aksi=board&aksi2=down&urut={$listProfile[board].urut}">down</a></td>
				{elseif $listProfile[board].terakhir}
					<td><a href="{$this_page}?aksi=board&aksi2=up&urut={$listProfile[board].urut}">up</a></td>
				{else}
					<td>
						<a href="{$this_page}?aksi=board&aksi2=up&urut={$listProfile[board].urut}">up</a>
						<a href="{$this_page}?aksi=board&aksi2=down&urut={$listProfile[board].urut}">down</a>
					</td>
				{/if}
			</tr>
			{/section}
			<tr>
				<td colspan="9">
				{$paging}
				</td>
			</tr>
			<tr>
				<td colspan="8" class="tombol">
				<input type="button" value="Add" onclick="location.href='{$this_page}?aksi=board&aksi2=add'" />
				<input type="submit" name="smbDelete" value="Delete" />
				</td>
			</tr>
		{else}
			<tr>
				<td>There are currently no Profile. Please create one <a href="{$this_page}?aksi=board&aksi2=add">here</a>.</td>
			</tr>
		{/if}
	</table>
	</form>
</div>
{/if}