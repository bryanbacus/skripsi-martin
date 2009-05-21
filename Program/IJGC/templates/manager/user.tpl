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
			<th>USERNAME</th>
			<th>NAMA</th>
			<th>EMAIL</th>
			<th>LEVEL</th>
			<th>AKSI</th>
		</tr>
		{section name=users loop=$listUsers}
		<tr>
			<td><input type="checkbox" class="inputan" value="{$listUsers[users].usn}" name="cUser[]" /></td>
			<td>{$listUsers[users].usn}</td>
			<td>{$listUsers[users].nama}</td>
			<td>{$listUsers[users].email}</td>
			<td>{$listUsers[users].level}</td>
			<td><a href="{$this_page}?aksi=users&aksi2=edit&usn={$listUsers[users].usn}">edit</a></td>
		</tr>
		{/section}
		<tr>
			<td colspan="9">
			{$paging}
			</td>
		</tr>
		<tr>
			<td colspan="9" class="tombol">
				<input type="button" value="Add" name="add"  onClick="javascript:window.location.href='{$this_page}?aksi=users&aksi2=add'"/> 
				<input type="submit" value="Delete" name="delete" /> 
			</td>
		</tr>
	</table>
	</form>
	{else}
	<table border="1">
		<tr>
			<td>There are currently no User. Please create one <a href="{$this_page}?aksi=users&aksi2=add">here</a>.</td>
		</tr>
	</table>
	{/if}
  {/if}
</div>
