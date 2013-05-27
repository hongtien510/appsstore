function has_added_app(pageid, pagename, userid, appid)
{
	
	//customerLoadWindow("http://www.facebook.com/add.php?api_key="+appid+"&pages=1&page=" + pageid, '', '540', '400');

	var link = taaa.fbappdomain + "/admin/index/installpage?pageid="+pageid+"&pagename="+pagename+"&userid="+userid+"&appid="+appid;
	top.location.href = link;
}
 

