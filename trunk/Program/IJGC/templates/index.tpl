<html>
<head><title>Welcome to IJGA website</title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="template_css.css" rel="stylesheet" type="text/css">
{literal}
	<script language="JavaScript" src="./js/gen_validatorv2.js" type="text/javascript"></script>
	<script src="./js/vertical_drop.js" type="text/javascript"></script>
	<script type="text/javascript" src="./js/switchcontent.js"></script>
{/literal}
</head>
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="30" rowspan="2" align="left" valign="top" background="images/bgShadowAtasKiri.gif">
	  <img border="0" src="images/blank.gif" width="30" height="10"></td>
      <td colspan="2" align="left" valign="top">
		  <!--head section -->
		  {$header}	
	  </td>
	  <!--right section-->
      <td width="195" align="left" valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="195" class="bglogin">
	  		{$login}
		</table>
      </td>
	  <td width="30" rowspan="2" align="left" valign="top" background="images/bgShadowAtasKanan.gif">
	  <img border="0" src="images/blank.gif" width="30" height="10"></td>
    </tr>
    <tr>
      	<td width="170" bgcolor="#598527" align="left" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="170">
			  <!--left section -->
			  {$left}
			</table>
		</td>
	  	<td bgcolor="#FFFFFF" align="left" valign="top" width="80%">
			<!--centre section -->
			<table cellpadding="0" cellspacing="0" class="ctbl1" width="100%">
			<tr>
				<td align="center" valign="top" width="100%">
					<table border="0" cellspacing="3" id="AutoNumber15" cellpadding="3" class="ctbl2" width="100%">
						<tr>
							<td width="100%">
        						<table border="0" cellspacing="1" id="AutoNumber17" bgcolor="#C0C0C0" class="ctbl3" width="100%">
									<tr>
										<td bgcolor="#FFFFFF">
											<table border="0" cellpadding="3" cellspacing="3" width="100%" class="ctbl4">
											{if $pembuka != ""}
												{$pembuka}
											{/if}
											<!-- isi main content -->
											{$isi}
							        		{if $penutup != ""}
												{$penutup}										
											{/if}
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<!-- banner -->			
						<tr>
						    <td width="100%" align="center">
								<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" bgcolor="#C0C0C0">
									<tr>
										<td width="100%" bgcolor="#FFFFFF">
											<table border="0" cellpadding="3" cellspacing="3" style="border-collapse: collapse" width="100%" align="left">
												<tr>
													<td width="85" align="center" bgcolor="#FFFF00" valign="middle">
													<a href="#"><img src="./images/banner.jpg" border="0"></a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>	
					
					</table>
				</td>
			</tr>
			<tr>
				<td> 
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td width="10"></td>
							<td class="support" width="100" valign="top">Supported by:</td>
							<td rowspan="2"><a href="http://aplgiLogo.jpg"><img src="./images/aplgiLogo.jpg" width="48" height="48" border="0" alt="APLGI"></a></td>
						</tr>		
						<tr>
							<td></td>
							<td></td>
						</tr>		
					</table>
				</td>
			</tr>		
			</table>
	  </td>
	  <td width="195" align="left" valign="top" bgcolor="#FFFF00">
		<table border="0" cellpadding="0" cellspacing="0" width="195" class="bglogin">
	  	{$right}
		</table>
      </td>
    </tr>
  </table>
</body>
</html>