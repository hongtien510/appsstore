var common = {};
//
common.selectOptionByValue = function(id, value){
    if(value!=''){
        var sl = document.getElementById(id);
        for(var index=0;index<sl.length; ++index){			
            if(sl.options[index].value == value){
                sl.options[index].selected = 'checked';
                break;
            }
        }	
    }		
}

common.renderPagingSearch = function(divId, titlePre, titleNext, titleFirst, titleLast, keyword) {
    var divTag = document.getElementById(divId);
    if(divTag == null){
        alert(divId + " is " + divTag);
        return;
    }
    var data = eval("("+divTag.innerHTML+")");
    divTag.innerHTML = "";
    if (data.totalRecord == '0'){
        return;
    }
    data.currentPage = parseInt(data.currentPage);
    data.pageSize = parseInt(data.pageSize);
    data.numDisplay = parseInt(data.numDisplay);

    var totalpage = parseInt(data.totalRecord / data.pageSize);
    if (data.totalRecord % data.pageSize > 0)
        totalpage += 1;
    if(data.currentPage < 0 )
        data.currentPage = 1;
    if (data.currentPage > totalpage)
        data.currentPage = totalpage;    

    var paging = "", next = "", pre = "";
    var pos_start, pos_end;

    url = data.action + "?";
    if(keyword != ''){
        url += keyword;
    }
    url += "&search_page=";
    var first = "<a href='" + url + 1 + "'>&nbsp" + titleFirst + "&nbsp</a>";
    var last = "<a href='" + url + totalpage + "'>&nbsp" + titleLast + "&nbsp</a>";

    if (data.numDisplay >= totalpage) {
        pos_start = 1;
        pos_end = totalpage;
    }else{
        var half = parseInt(data.numDisplay / 2);	
        if(data.numDisplay % 2 == 1){
            ++half;
        }
        if (data.currentPage <= half) {
            pos_start = 1;
        }else {
            if (data.currentPage + half > totalpage) {
                pos_start = totalpage - data.numDisplay + 1;
            } else {
                pos_start = data.currentPage - half + 1;
            }
        }
        pos_end = data.numDisplay;
    }
    if ((data.currentPage - 1) > 0) {
        pre = "<a href='" + url + (data.currentPage - 1) + "' style='cursor: pointer; color: rgb(0, 102, 204);' class='pre' >"+ titlePre +"</a>";
        pre = pre + "&nbsp;";
    } else {
        pre = "<strong class='current'>"+ titlePre +"</strong>";
        pre = pre + "&nbsp;";
        first = "<strong class='current'>"+ titleFirst +"&nbsp</strong>";
    }    
    if ((data.currentPage + 1) <= totalpage) {
        next = "<a href='" + url + (data.currentPage + 1) + "' style='cursor: pointer; color: rgb(0, 102, 204);' class='next' >"+ titleNext +"</a>";
        next = "&nbsp;" + next;
    } else {
        next = "<strong class='current'>"+ titleNext +"</strong>";
        next = "&nbsp;" + next;
        last = "<strong class='current'>&nbsp"+ titleLast +"</strong>";
    }
    for (var i = 0; i < pos_end; i++) {
        if (i != 0) {
            paging += "&nbsp;-&nbsp;";
        }
        if (pos_start == data.currentPage) {
            paging += "<strong class='current'>" + pos_start + "</strong>";
        }else {
            paging += "<a href='" + url + pos_start + "' class='page' style='cursor: pointer; color: rgb(0, 102, 204);' >" + pos_start + "</a>";
        }
        pos_start++;
    }
    var displayTotal = "&nbsp;<strong class='current'>("+ data.currentPage + "/" + totalpage + ")</strong>";

    paging = first + pre + paging + next + last + displayTotal;
    divTag.innerHTML = paging;
    $("#"+divId).css("display","block");
}


