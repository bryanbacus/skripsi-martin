<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Website Manager</title>
<LINK href="../template_css.css" type=text/css rel=stylesheet>
{literal}
	<script language="JavaScript" src="./js/gen_validatorv2.js" type="text/javascript"></script>
	<script type="text/javascript" src="./js/calendarDateInput.js"></script>
{/literal}
</head>
<body topmargin="0">
	{if $header != "kosong"}

		{$header}

	{else}
	{/if}
<div id="judul">
	<TABLE class=menubar cellSpacing=0 cellPadding=0 width="100%" border=0>
	  <TBODY>
	  <TR>
		<TD class=menudottedline><b>{$judul}</b></TD>
	  </TR>
	  <TR>
		<TD class=menudottedline align=right></TD>
	  </TR>
	  </TBODY></TABLE>	
</div>
	<p></p>
	<center>
	<TABLE class=adminform>
  	<tbody>
  <TR>
    <TD vAlign=top>
	{$content}
	</td></tr>
	</tbody>
	</table>
	</center>
	<p></p>
	{$footer}
</body>
</html>