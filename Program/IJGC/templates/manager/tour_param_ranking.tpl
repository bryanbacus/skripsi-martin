{if $pesan}
  <div id="pesan"> {$pesan} </div>
{/if}
{if !$dshowMe}
  <form method="post">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td>Position Number</td>
				<td>:</td>
				<td>
					<input type="hidden" name="id_param" value="{$id_param}"  />
					<input type="hidden" name="pos_no" value="{$position}"  />
					<input type="text" name="position" value="{$position}" size="20" maxlength="20" {$disable}/> 
				</td>
			<tr>		
			<tr>
				<td>Ranking Points</td>
				<td>:</td>
				<td>
					<input type="text" name="ranking" value="{$ranking}" size="20" maxlength="20" /> 
				</td>
			<tr>
			<tr>
				<td>Prosentase Reward</td>
				<td>:</td>
				<td>
					<input type="text" name="prosentase" value="{$prosentase}" size="10" maxlength="10" /> 
				</td>
			<tr>			
			<tr>
				<td></td>
				<td></td>
				<td>
					<input type="submit" name="addbtn" value="{$button_value}" />
				</td>
			<tr>						
		</table>
		<br>
	{if $typelist}
    <table class="adminlist" border="1" width="100%">
      <tr>
        <th>POSITION NO </th>
				<th>RANKING POINT  </th>
				<th>PROSENTASE REWARD (%) </th>
        <th colspan="2">ACTION</th>
      </tr>
      {section name=types loop=$typelist}
      <tr>
        <td>{$typelist[types].position}</td>
				<td>{$typelist[types].points}</td>
				<td>{$typelist[types].prosentase}</td>
        <td><a href="{$this_page}?aksi=ranking&aksi2=edit&id={$typelist[types].id_param}">edit</a></td>
				<td><a href="{$this_page}?aksi=ranking&aksi2=delete&id={$typelist[types].id_param}">delete</a></td>
      </tr>
      {/section}
    </table>
  {else}
		<table border="0">
			<tr>
				<td>There are currently no ranking parameter. Please create one.</td>
			</tr>
		</table>
  {/if}
  </form>	
{/if}