<script language="javascript" src="./js/jscript.js"></script>
{literal}
<style>
	#dropmenudiv{
		position:absolute;
		border:1px solid #990000;
		border-bottom-width: 0;
		line-height:18px;
		z-index:100;
		padding:0px;
		margin:0px;
		FONT-SIZE: 12px;
		COLOR: #333;
		FONT-FAMILY: Arial, Helvetica, sans-serif;
	}
	#dropmenudiv a{
		width: 100%;
		display: block;
		text-indent: 3px;
		border-bottom: 1px solid #990000;
		padding: 1px 0;
		text-decoration: none;
		color:#333333;
		FONT-SIZE: 12px;
		FONT-FAMILY: Arial, Helvetica, sans-serif;
	}
		#dropmenudiv a:hover{ /*hover background color*/
		background-color: #993300;
		color:#ffffff;
	}
	.menu{
		color:#333;
		border-collapse:collapse;
	}
	.menu a{
		text-decoration:none;
		color:#333;
	}
	.menu a:hover{
		text-decoration:none;
		color:#FF0000;
	}
	.menuitem{
		color:#333333;
		padding:5px 5px;
		text-align:center;
		border-right:1px solid #A44A15;
		background-color:#E1BDB3;
	}
</style>
{/literal}
<DIV id=wrapper>
<DIV id=header>
<DIV id=joomla><IMG alt="Setyoclub! Logo" src="../images/logo.gif"></DIV></DIV></DIV>
<TABLE class=menubar cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD class=menubackgr style="PADDING-LEFT: 5px">
		<table border="0" class="menu" cellpadding="0" cellspacing="1">
			<tr>
				<td class="menuitem"><a href="index.php">HOME</a></td>
				<td class="menuitem" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu1, '133px')" onMouseout="delayhidemenu()">STATIC CONTENT</td>
				<td class="menuitem" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu7, '133px')" onMouseout="delayhidemenu()">FOUNDATION</td>
				<td class="menuitem" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu2, '133px')" onMouseout="delayhidemenu()">COURSE & TOURNAMENTS</td>
				<td class="menuitem" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu5, '133px')" onMouseout="delayhidemenu()">MATCH & STATISTIC</td>
				<td class="menuitem" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu3, '133px')" onMouseout="delayhidemenu()">PROFILE</td>
				<td class="menuitem" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu4, '133px')" onMouseout="delayhidemenu()">NEWS</td>
				<td class="menuitem" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu6, '133px')" onMouseout="delayhidemenu()">GOLF TIPS</td>
				<td class="menuitem"><a href="./index.php?aksi=product">GOLF PPRODUCTS</a></td>
				<td class="menuitem"><a href="./index.php?aksi=link">GOLF LINKS</a></td>
				{php}
				if($_SESSION['levelUser']==1){
					echo '<td class="menuitem" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu8, \'133px\')" onMouseout="delayhidemenu()">USER MANAGEMENT</td>';
				}
				{/php}
				<td class="menuitem"><a href="index.php?aksi=out">LOGOUT</a></td>
			</tr>
		</table>
    </TD>
    <TD class=menubackgr align=right>
      </TD>
    <TD class=menubackgr style="PADDING-RIGHT: 5px" align=right></TD></TR></TBODY></TABLE>
<TABLE class=menubar cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD class=menudottedline align=right height="25">{$tanggal}</TD>
  </TR></TBODY></TABLE>