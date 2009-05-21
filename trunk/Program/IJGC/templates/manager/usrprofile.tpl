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
			<th>CEK</th>
			<th>ID</th>
			<th colspan="2" align="center">USER CHILD</th>
			<th colspan="2" align="center">USER PARENT</th>
			<th align="center">AKSI</th>
		</tr>
		<tr bgcolor="#F3F3F3">
			<td></td>
			<td></td>
			<td><font color="#990000"><b>Child User</b></font></td>
			<td><font color="#990000"><b>Status</b></font></td>
			<td><font color="#990000"><b>Parent User</b></font></td>
			<td><font color="#990000"><b>Status</b></font></td>
			<td></td>
		</tr>
		{section name=users loop=$listUsers}
		<tr>
			<td><input type="checkbox" class="inputan" value="{$listUsers[users].id_unik}" name="cUser[]" /></td>
			<td>{$listUsers[users].id_unik}</td>
			<td>{$listUsers[users].userc}</td>
			<td>{$listUsers[users].statusc}</td>
			<td>{$listUsers[users].userp}</td>
			<td>{$listUsers[users].statusp}</td>
			<td><a href="{$this_page}?aksi=usrprofile&aksi2=edit&id={$listUsers[users].id_unik}">edit profile</a> 
			</td>
		</tr>
		{/section}
		<tr>
			<td colspan="7">
			{$paging}
			</td>
		</tr>
		<tr>
			<td colspan="7" class="tombol">
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
