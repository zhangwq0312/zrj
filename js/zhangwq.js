function closeWindows() {
	window.open('about:blank','_self'); window.close();
	/*	
		var userAgent = navigator.userAgent;
		if (userAgent.indexOf("Firefox") != -1|| userAgent.indexOf("Chrome") != -1) {
			//alert(1);
			close();//直接调用JQUERY close方法关闭
		} else {
			window.opener = null;
			window.open("", "_self");
			window.close();
		}
	*/
};