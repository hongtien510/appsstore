function modalPopup(align, top, width, padding, disableColor, disableOpacity, backgroundColor, borderColor, borderWeight, borderRadius, fadeOutTime, content, loadingImage){

    var zindex = 1000;
    var _width = width;
    var containerid = "innerModalPopupDiv";
		
    var popupDiv = document.createElement('div');
    var popupMessage = document.createElement('div');
    var blockDiv = document.createElement('div');
	
    popupDiv.setAttribute('id', 'outerModalPopupDiv');
    popupDiv.setAttribute('class', 'outerModalPopupDiv');
	
    popupMessage.setAttribute('id', 'innerModalPopupDiv');
    popupMessage.setAttribute('class', 'innerModalPopupDiv');
	
    blockDiv.setAttribute('id', 'blockModalPopupDiv');
    blockDiv.setAttribute('class', 'blockModalPopupDiv');
    blockDiv.setAttribute('onClick', 'closePopup(' + fadeOutTime + ')');
	
    document.body.appendChild(popupDiv);
    popupDiv.appendChild(popupMessage);
    document.body.appendChild(blockDiv);
	 
    //	if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){ //test for MSIE x.x;
    //	 var ieversion=new Number(RegExp.$1) // capture x.x portion and store as a number     
    //	   if(ieversion>6) {
    //		 getScrollHeight(top);
    //	   }
    //	} else {
    //	  getScrollHeight(top);
    //	}    
    
    getScrollHeightW(top);
	
    document.getElementById('outerModalPopupDiv').style.display='block';
    //	document.getElementById('outerModalPopupDiv').style.width = width + 'px';
    document.getElementById('outerModalPopupDiv').style.padding = borderWeight + 'px';
    document.getElementById('outerModalPopupDiv').style.background = borderColor;
    document.getElementById('outerModalPopupDiv').style.borderRadius = borderRadius + 'px';
    document.getElementById('outerModalPopupDiv').style.MozBorderRadius = borderRadius + 'px';
    document.getElementById('outerModalPopupDiv').style.WebkitBorderRadius = borderRadius + 'px';
    document.getElementById('outerModalPopupDiv').style.borderWidth = 0 + 'px';
    document.getElementById('outerModalPopupDiv').style.position = 'absolute';
    document.getElementById('outerModalPopupDiv').style.zIndex = zindex;
	
    document.getElementById('innerModalPopupDiv').style.padding = padding + 'px';
    document.getElementById('innerModalPopupDiv').style.background = backgroundColor;
    document.getElementById('innerModalPopupDiv').style.borderRadius = (borderRadius - 3) + 'px';
    document.getElementById('innerModalPopupDiv').style.MozBorderRadius = (borderRadius - 3) + 'px';
    document.getElementById('innerModalPopupDiv').style.WebkitBorderRadius = (borderRadius - 3) + 'px';
	
    document.getElementById('blockModalPopupDiv').style.width = 100 + '%';
    document.getElementById('blockModalPopupDiv').style.border = 0 + 'px';
    document.getElementById('blockModalPopupDiv').style.padding = 0 + 'px';
    document.getElementById('blockModalPopupDiv').style.margin = 0 + 'px';
    document.getElementById('blockModalPopupDiv').style.background = disableColor;
    document.getElementById('blockModalPopupDiv').style.opacity = (disableOpacity / 100);
    document.getElementById('blockModalPopupDiv').style.filter = 'alpha(Opacity=' + disableOpacity + ')';
    document.getElementById('blockModalPopupDiv').style.zIndex = zindex - 1;
    document.getElementById('blockModalPopupDiv').style.position = 'fixed';
    document.getElementById('blockModalPopupDiv').style.top = 0 + 'px';
    document.getElementById('blockModalPopupDiv').style.left = 0 + 'px';
    document.getElementById('blockModalPopupDiv').style.right = 0 + 'px';
    document.getElementById('blockModalPopupDiv').style.bottom = 0 + 'px';
	
	
	
    blockPage();	
    document.getElementById(containerid).innerHTML=content;
    if(_width<=0){
        _width = jQuery('#'+containerid).width();
        _width += 20;		
    }
	
    document.getElementById('outerModalPopupDiv').style.width = _width + 'px';
    if(align=="center") {
        document.getElementById('outerModalPopupDiv').style.marginLeft = (-1 * (_width / 2)) + 'px';
        document.getElementById('outerModalPopupDiv').style.left = 50 + '%';
    } else if(align=="left") {
        document.getElementById('outerModalPopupDiv').style.marginLeft = 0 + 'px';
        document.getElementById('outerModalPopupDiv').style.left = 10 + 'px';
    } else if(align=="right") {
        document.getElementById('outerModalPopupDiv').style.marginRight = 0 + 'px';
        document.getElementById('outerModalPopupDiv').style.right = 10 + 'px';
    } else {
        document.getElementById('outerModalPopupDiv').style.marginLeft = (-1 * (_width / 2)) + 'px';
        document.getElementById('outerModalPopupDiv').style.left = 50 + '%';
    }
	
}

function pageloader(page_request, containerid, loadingImage){
	
    document.getElementById(containerid).innerHTML = '<div align="center"><img src="' + loadingImage + '" border="0" /></div>';
	
    if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1)) {
        document.getElementById(containerid).innerHTML=page_request.responseText;
    }
	
}

function imageloader(url, containerid, loadingImage) {
	
    document.getElementById(containerid).innerHTML = '<div align="center"><img src="' + loadingImage + '" border="0" /></div>';
    document.getElementById(containerid).innerHTML='<div align="center"><img src="' + url + '" border="0" /></div>';
	
}

function blockPage() {
	
    var blockdiv = document.getElementById('blockModalPopupDiv');
    blockdiv.style.display = 'block';

}

function getScrollHeightW(top) {
    var h = window.pageYOffset || document.body.scrollTop || document.documentElement.scrollTop;

    if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
		
        var ieversion=new Number(RegExp.$1);
		
        if(ieversion>6) {
            document.getElementById('outerModalPopupDiv').style.top = h + top + 'px';
        } else {
            document.getElementById('outerModalPopupDiv').style.top = top + 'px';
        }
		
    } else {
        document.getElementById('outerModalPopupDiv').style.top = h + top + 'px';
    }
	
}

function closePopup(fadeOutTime) {
	
    fade('outerModalPopupDiv', fadeOutTime);    
    document.body.removeChild(document.getElementById('blockModalPopupDiv'));
//	document.getElementById('blockModalPopupDiv').style.display='none';

}

function fade(id, fadeOutTime) {
	
    var el = document.getElementById(id);
	
    if(el == null) {
        return;
    }
	
    if(el.FadeState == null) {
		
        if(el.style.opacity == null || el.style.opacity == '' || el.style.opacity == '1') {
            el.FadeState = 2;
        } else {
            el.FadeState = -2;
        }
	
    }
	
    if(el.FadeState == 1 || el.FadeState == -1) {
		
        el.FadeState = el.FadeState == 1 ? -1 : 1;
        el.fadeTimeLeft = fadeOutTime - el.fadeTimeLeft;
		
    } else {
		
        el.FadeState = el.FadeState == 2 ? -1 : 1;
        el.fadeTimeLeft = fadeOutTime;
        setTimeout("animateFade(" + new Date().getTime() + ",'" + id + "','" + fadeOutTime + "')", 33);
	
    }  
  
}

function animateFade(lastTick, id, fadeOutTime) {
	  
    var currentTick = new Date().getTime();
    var totalTicks = currentTick - lastTick;
	
    var el = document.getElementById(id);
	
    if(el.fadeTimeLeft <= totalTicks) {
	
        el.style.opacity = el.FadeState == 1 ? '1' : '0';
        el.style.filter = 'alpha(opacity = ' + (el.FadeState == 1 ? '100' : '0') + ')';
        el.FadeState = el.FadeState == 1 ? 2 : -2;
        document.body.removeChild(el);
        return;
	
    }
	
    el.fadeTimeLeft -= totalTicks;
    var newOpVal = el.fadeTimeLeft / fadeOutTime;
	
    if(el.FadeState == 1) {
        newOpVal = 1 - newOpVal;
    }
	
    el.style.opacity = newOpVal;
    el.style.filter = 'alpha(opacity = ' + (newOpVal*100) + ')';
	
    setTimeout("animateFade(" + currentTick + ",'" + id + "','" + fadeOutTime + "')", 33);
  
}