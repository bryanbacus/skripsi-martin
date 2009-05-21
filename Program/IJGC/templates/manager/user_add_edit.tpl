{if $pesan}
<div id="pesan">
	{$pesan}
</div>
{/if}
<div id="addRanks">
	{if !$dshowMe}
	<form method="post" name="addRanks">
		<table border="0">
			{if $aksi2 eq "edit"}
			<tr>
				<td class="label">USERNAME</td>
				<td class="texton">:</td>
				<td class="texton">{$usn}<input type="hidden" name="usn" value="{$usn}" /></td>
			</tr>
			{else}
			<tr>
				<td class="label">USERNAME</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="username" value="{$username}" size="20" maxlength="15" /></td>
			</tr>
			{/if}
			<tr>
				<td class="label">PASSWORD</td>
				<td class="texton">:</td>
				<td class="texton"><input type="password" name="pwd1" size="20" maxlength="15" /> [ biarkan kosong untuk tidak merubah password ]</td>
			</tr>
			<tr>
				<td class="label">RETYPE PASSWORD</td>
				<td class="texton">:</td>
				<td class="texton"><input type="password" name="pwd" size="20" maxlength="15" /></td>
			</tr>
			<tr>
				<td class="label">NAMA</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="nama" value="{$nama}" size="50" maxlength="255" /></td>
			</tr>
			<tr>
				<td class="label">EMAIL</td>
				<td class="texton">:</td>
				<td class="texton"><input type="text" name="email" value="{$email}" size="50" maxlength="100" /></td>
			</tr>
			<tr>
				<td class="label">LEVEL</td>
				<td class="texton">:</td>
				<td class="texton">
					<select name="level">
						<option value="1" {$s1}>Administrator</option>
						<option value="2" {$s2}>Moderator</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tombol" colspan="3">
					<input type="submit" name="simpan" value="Simpan">
					<input type="button" value="Reset" onClick="javascript:window.location.href='{$refresh}'">
					<input type="button" value="Cancel" onClick="javascript:window.location.href='{$referer}'">
				</td>
			</tr>
		</table>
	</form>	
	{/if}
</div>
