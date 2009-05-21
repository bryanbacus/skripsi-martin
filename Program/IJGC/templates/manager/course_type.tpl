{if $pesan}
  <div id="pesan"> {$pesan} </div>
{/if}
{if !$dshowMe}
  <form method="post">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td>Type Name</td>
				<td>:</td>
				<td>
					<input type="hidden" name="type_id" value="{$type_id}"  />
					<input type="text" name="type_name" value="{$type_value}" size="20" maxlength="20" /> 
				</td>
			<tr>
			<tr>
				<td>Type Color</td>
				<td>:</td>
				<td>
					<input type="text" name="type_color" value="{$type_color}" size="10" maxlength="10" /> 
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
        <th>NAME</th>
				<th>COLOR</th>
        <th colspan="2">ACTION</th>
      </tr>
      {section name=types loop=$typelist}
      <tr>
        <td>{$typelist[types].type_name}</td>
				<td>{$typelist[types].type_color}</td>
        <td><a href="{$this_page}?aksi=crtype&aksi2=edit&id={$typelist[types].type_id}">edit</a></td>
				<td><a href="{$this_page}?aksi=crtype&aksi2=delete&id={$typelist[types].type_id}">delete</a></td>
      </tr>
      {/section}
    </table>
  {else}
		<table border="0">
			<tr>
				<td>There are currently no type of course. Please create one.</td>
			</tr>
		</table>
  {/if}
  </form>	
{/if}