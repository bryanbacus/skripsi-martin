{if $pesan}
<div id="pesan">
	{$pesan}
</div>
{/if}
<div id="addRanks">
	{if !$dshowMe}
	<form method="post" name="addRanks">
		<table border="0">
			<tr>
				<td class="label">USERNAME</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="username" size="20" maxlength="255" /></td>
				<td class="label">USERNAME PARENT</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="usernamep" size="20" maxlength="255" /></td>
			</tr>
			<tr>
				{if $pwdc}
				<td class="label">PASSWORD</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="pwdc" value="{$pwdc}" size="20" maxlength="15" /></td>
				{else}
				<td class="label">PASSWORD</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="pwdc" value="123456" size="20" maxlength="15" /></td>
				{/if}
				{if $pwdp}
				<td class="label">PASSWORD</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="pwdc" value="{$pwdp}" size="20" maxlength="15" /></td>
				{else}
				<td class="label">PASSWORD PARENT</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="pwdp" value="123456" size="20" maxlength="15" /></td>
				{/if}
			</tr>
			<tr>
				<td class="label">MEMBERSHIP LEVEL</td>
				<td class="texton">:</td>
				<td class="texton">
					<select name="level_membership">
					{section name=level loop=$listLevel}
						<option value="{$listLevel[level].id}" {$listLevel[level].select}>{$listLevel[level].level}</option>
					{/section}
					</select>
				</td>
				<td colspan="3">
			<tr>
				<td class="tombol" colspan="6">
					<input name="tipe_child" value="2" type="hidden">
					<input name="tipe_parent" value="1" type="hidden">
					<input name="idChild" value="{$idChild}" type="hidden">									
					<input type="submit" name="simpan" value="Simpan">
					<input type="button" value="Reset" onClick="javascript:window.location.href='{$refresh}'">
					<input type="button" value="Cancel" onClick="javascript:window.location.href='{$referer}'">
				</td>
			</tr>
		</table>
	</form>	
	{/if}
</div>
