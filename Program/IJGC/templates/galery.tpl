<tr><td>
<div id="pformat">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		 <td class="headcformat" width="100" align="left">Galery</td>
		 <td bgcolor="#DFDFDF">&nbsp;</td>
	<tr>
	<tr>
	  <td colspan="2" height="10"></td>
	</tr>	
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="175">
	{if $listAlbum}
	<div id="listAlbum">	
		<table border="0" cellpadding="0" cellspacing="0">
		  <tr>
		  	<td class="header" colspan="3">List Album</td>
			<td width="5"></td>
		  </tr>
		  	<tr>
		  	<td colspan="3" height="5"></td>
			<td width="5"></td>
		  </tr>
		{section name=loop loop=$listAlbum}
		  <tr>
			<td width="9"></td>
			<td width="5" align="center"><img src="./images/dot.gif"></td>
			<td class="item" align="left"><a href="{$this_page}?page=galery&id={$listAlbum[loop].id}&p={$pNum}&pF={$pFNum}">{$listAlbum[loop].album}</a></td>
			<td width="5"></td>
		  </tr>
		  <tr>
			<td colspan="3" height="3"></td>
			<td width="5"></td>
		  </tr>	
		  <tr>
			<td></td>
			<td class="tdbg" colspan="2"></td>
			<td width="5"></td>
		  </tr>
		  <tr>
			<td colspan="3" height="4"></td>
		  </tr>	
		 {/section}
		  <tr>
			<td colspan="3">{$paging}</td>
		  </tr>	
		</table>
	</div>
	{/if}
	{$pesan}
	</td>
    <td valign="top" align="left">
	{if $detailAlbum}
	<div id="detailAlbum">
	<table border="0" width="100%">
		<tr>
			<td class="label" width="20%">ALBUM</td>
			<td class="texton" width="2%">:</td>
			<td class="texton">{$album}</td>
		</tr>
		<tr>
			<td height="1" bgcolor="#E6E6E6" colspan="3"></td>
		</tr>
		<tr>
			<td class="label">TANGGAL</td>
			<td class="texton">:</td>
			<td class="texton">{$tanggal}</td>
		</tr>
		<tr>
			<td height="1" bgcolor="#E6E6E6" colspan="3"></td>
		</tr>
		<tr>
			<td class="label" valign="top">DESKRIPSI</td>
			<td class="texton" valign="top">:</td>
			<td class="texton">
				{$deskripsi}
			</td>
		</tr>
		<tr>
			<td height="1" bgcolor="#E6E6E6" colspan="3"></td>
		</tr>
	</table>
	<br />
	<table>
		{if $listGalery}
		<tr>
			<td align="center" width="100%">
				{section name=loop loop=$listGalery}
					<div id="kotakAlbum">
						<a href="/images/galery/{$id_album}/{$listGalery[loop].thumbs}" target="_blank"><img src="{$listGalery[loop].thumb}" class="imgk" width="150" height="100"/></a>
						<br />
						{$listGalery[loop].caption}
					</div>
				{/section}
			</td>
		</tr>
		<tr>
			<td align="center" class="page">{$pagingPhoto}</td>
		</tr>
		{else}
		<tr>
			<td>There are currently no Picture in this Album.</td>
		</tr>
		{/if}
	</table>
	</div>
	{/if}

	</td>
  </tr>
</table>
</div>
</td></tr>