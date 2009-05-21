<div id="bdr">	
{if $pesan}
<div id="pesan">
	{$pesan}
</div>
{/if}
  {if !$dshowMe}
	{if $listUsers}
	<form method="post">
			<table class="adminlist">
		<tr>
			<th>CEK</td>
			<th>ID</th>
			<th>NAMA</th>
			<th>EMAIL</th>
			<th>BIRTH DATE</th>
			<th>HOME ADRRESS</th>
			<th>HOME PHONE</th>
			<th>HAND PHONE</th>
			<th>PARENTS NAME</th>
			<th>STATUS</th>
			<th>AKSI</th>
		</tr>
		{section name=users loop=$listUsers}
		<tr>
			<td><input type="checkbox" class="inputan" value="{$listUsers[users].id}" name="cUser[]" /></td>
			<td><img src="{$listUsers[users].gambar}" width="50" height="50" border="0" border="1"></td>
			<td>{$listUsers[users].name}</td>
			<td>{$listUsers[users].email}</td>
			<td>{$listUsers[users].tglLahir}</td>
			<td>{$listUsers[users].alamat}</td>
			<td>{$listUsers[users].noRumah}</td>
			<td>{$listUsers[users].noHp}</td>
			<td>{$listUsers[users].ortu}</td>
			<td>{$listUsers[users].status}</td>
			<td><a href="{$this_page}?aksi=userm&aksi2=edit&id={$listUsers[users].id}">edit</a> | 
				<a href="{$this_page}?aksi=userm&aksi2=aktivasi&id={$listUsers[users].id}">aktivasi</a>
			</td>
		</tr>
		{/section}
		<tr>
			<td colspan="11">
			{$paging}
			</td>
		</tr>
		<tr>
			<td colspan="11" class="tombol">
				<input type="button" value="Add" name="add"  onClick="javascript:window.location.href='{$this_page}?aksi=userm&aksi2=add'"/> 
				<input type="submit" value="Delete" name="delete" /> 
			</td>
		</tr>
	</table>
	</form>
	{else}
	<table border="1">
		<tr>
			<td>There are currently no User. Please create one <a href="{$this_page}?aksi=userm&aksi2=add">here</a>.</td>
		</tr>
	</table>
	{/if}
  {/if}
</div>
