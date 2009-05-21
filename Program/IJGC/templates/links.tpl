  <tr>
    <td width="5">&nbsp;</td>
    <td colspan="2"><img src="{$icon}" border=0></td>
    <td width="5"></td>
  </tr>
 {if $pesan}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100%" colspan="2" class="pesan">{$pesan}</td>
    <td width="5"></td>
  </tr> 
 {/if}
 {section name=links loop=$listLinks}
  <tr>
    <td width="5">&nbsp;</td>
    <td width="100" align="left" valign="top"><a href="{$listLinks[links].link}" target="_blank"><img src="{$listLinks[links].image}" width="50" height="50" class="boardimg" border="0"></a></td>
    <td width="100%" align="left" valign="top">
		<table width="100%">
			<tr>
				<td align="left"><p>{$listLinks[links].isi}</p></td>
			</tr>
		</table>
	</td>
    <td width="5"></td>
  </tr>
  <tr>
  	<td height="5px"></td>
	<td class="grsBwh" colspan="2"><td>
	<td></td>
  </tr> 
{/section}  
  <tr>
    <td width="5">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="5"></td>
  </tr>
  <tr>
    <td width="5">&nbsp;</td>
    <td colspan="2" align="right" class="paging">{$paging}</td>
    <td width="5"></td>
  </tr>