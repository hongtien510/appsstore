	
$(document).ready(function(){
    
	if(getParameterValue('result') == 1)
		ThongBao("Thêm mới thành công",2000);
	if(getParameterValue('result') == 2)
		ThongBao("Chỉnh sửa thành công",2000);
	if(getParameterValue('result') == 3)
		ThongBao("Xóa thành công",2000);
        
  
    $('.dangxuatadmin').click(function(){
        alert('bb');
        /*
        $.ajax({
		url:taaa.appdomain + '/admin/loginadmin/xulydangxuat',
		type:'post',
		data:{},
		success:function(data){
		  //alert(data);
            alert("Đăng xuất thành công");
            window.location="../admin";
		}
	   });
       */	
    });
    
    $('.close_thongbao').live('click',function(){
        $('#thongbao').hide(); 
        $('#bg_thongbao').hide();
    });
});

function LoginAdmin(ops)
{
    UserAdmin = ops.useradmin;
    PassAdmin = ops.passadmin;
    
    //alert(UserAdmin);
    //alert(PassAdmin);
    
    $.ajax({
		url:taaa.appdomain + '/admin/loginadmin/xulylogin',
		type:'post',
		data:{useradmin: UserAdmin, passadmin:PassAdmin},
		success:function(data){
			if(data==1)
            {
                alert("Đăng nhập thành công");
                window.location="../admin/";
            }
            else
                alert("Đăng nhập không thành công");
		}
	});	
}

function getParameterValue(name)
{
	name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp( regexS );
	var results = regex.exec( window.location.href );
	if( results == null ) return "";
	else return results[1];
}


function ThongBao(nd,time)
{
	$('#bg_thongbao').show();
	$('#thongbao').show();
	$('#thongbao').html("<p class='title_tb'>Thông Báo</p><div class='content_tb'>"+nd+"</div>");
	myVar = setTimeout(function(){$('#thongbao').hide(); $('#bg_thongbao').hide();return false},time);
}

function ThongBaoLoi(nd)
{
    $('#bg_thongbao').show();
	$('#thongbao').show(); 
	$('#thongbao').html("<p class='title_tb'>Thông Báo</p><div class='content_tb'><p>" +nd+ "</p><p class='close_thongbao'>Đóng</p>");
	myVar = setTimeout(function(){$('#thongbao').hide(); $('#bg_thongbao').hide();return false},time);
}




function ThemLoaiSanPham(tenlsp, vitri, anhien)
{
    if(anhien==true) anhien=1; else anhien = 0;

    if(tenlsp=="")
    {
        ThongBaoLoi('Tên loại sản phẩm không được để trống');
        return false;
    }
    $.ajax({
        url:taaa.appdomain+'/admin/category/xulyadd',
        type:'post',
        data:{tenlsp:tenlsp, vitri:vitri, anhien:anhien},
        success:function(data){
            if(data==1)
            {
                ThongBao('Thêm mới loại sản phẩm thành công',2000);
                window.location = '../category';
            }
            else
                ThongBaoLoi('Thêm mới không thành công');
        }
        
    });

   
}

function CapNhatLoaiSanPham(idcategory, tenlsp, vitri, anhien)
{
    if(anhien==true) anhien=1; else anhien = 0;
    
    if(tenlsp=="")
    {
        ThongBaoLoi('Tên loại sản phẩm không được để trống');
        return false;
    }
    $.ajax({
        url:taaa.appdomain+'/admin/category/xulyupdate',
        type:'post',
        data:{idcategory:idcategory, tenlsp:tenlsp, vitri:vitri, anhien:anhien},
        success:function(data){
            //alert(data);
           
            if(data==1)
            {
                ThongBao('Cập nhật loại sản phẩm thành công',2000);
                
            }
            else
                ThongBaoLoi('Cập nhật không thành công');
            
        }
        
    });
}

function ThemMoiSanPham(masp, tensp, thuocloaisp, giaban, string_img_upload, string_img_upload_ch, mota, chitiet, hethang, anhien, showindex, titlefb, metafb)
{
    /*
    alert(masp);
    alert(tensp);
    alert(thuocloaisp);
    alert(giaban);
    alert(string_img_upload);
    alert(string_img_upload_ch);
    alert(mota);
    alert(chitiet);
    alert(hethang);
    alert(anhien);
    alert(showindex);
    alert(titlefb);
    alert(metafb);
    */
    if(anhien==true) anhien=1; else anhien = 0;
    if(hethang==true) hethang=1; else hethang = 0;
    if(showindex==true) showindex=1; else showindex = 0;

    
    if(tensp == "")
    {
        document.getElementById('tensp').focus();
        ThongBaoLoi('Tên sản phẩm không được để trống');
    }
    if(thuocloaisp == 0)
    {
        document.getElementById('thuocloaisp').focus();
        ThongBaoLoi('Chọn loại sản phẩm');
    }
    if(giaban == "")
    {
        document.getElementById('giaban').focus();
        ThongBaoLoi('Giá bán không được để trống');
    }
    
    $.ajax({
        url:taaa.appdomain+'/admin/product/xulyadd',
        type:'post',
        data:{masp:masp, tensp:tensp, thuocloaisp:thuocloaisp, giaban:giaban ,string_img_upload:string_img_upload, string_img_upload_ch:string_img_upload_ch, mota:mota, chitiet:chitiet, hethang:hethang, anhien:anhien, showindex:showindex, titlefb:titlefb, metafb:metafb},
        success:function(data){
            if(data==1)
            {
                ThongBao('Thêm mới sản phẩm thành công',2000);
                window.location = '../product';    
            }
            else
                ThongBaoLoi('Thêm mới không thành công');
            
        }
        
    });
  
    
}


function CapNhatSanPham(idsp, masp, tensp, thuocloaisp, giaban, string_img_upload, string_img_upload_ch, mota, chitiet, hethang, anhien, showindex, titlefb, metafb)
{
    if(anhien==true) anhien=1; else anhien = 0;
    if(hethang==true) hethang=1; else hethang = 0;
    if(showindex==true) showindex=1; else showindex = 0;
    /*
    alert(masp);
    alert(tensp);
    alert(thuocloaisp);
    alert(giaban);
    alert(string_img_upload);
    alert(string_img_upload_ch);
    alert(mota);
    alert(chitiet);
    alert(hethang);
    alert(anhien);
    alert(showindex);
    alert(titlefb);
    alert(metafb);
    */
    
    if(tensp == "")
    {
        document.getElementById('tensp').focus();
        ThongBaoLoi('Tên sản phẩm không được để trống');
    }
    if(thuocloaisp == 0)
    {
        document.getElementById('thuocloaisp').focus();
        ThongBaoLoi('Chọn loại sản phẩm');
    }
    if(giaban == "")
    {
        document.getElementById('giaban').focus();
        ThongBaoLoi('Giá bán không được để trống');
    }
    
    $.ajax({
        url:taaa.appdomain+'/admin/product/xulyupdate',
        type:'post',
        data:{idsp:idsp, masp:masp, tensp:tensp, thuocloaisp:thuocloaisp, giaban:giaban ,string_img_upload:string_img_upload, string_img_upload_ch:string_img_upload_ch, mota:mota, chitiet:chitiet, hethang:hethang, anhien:anhien, showindex:showindex, titlefb:titlefb, metafb:metafb},
        success:function(data){
            if(data==1)
            {
                ThongBao('Cập nhật sản phẩm thành công',2000);
                //window.location = '../product';
            }
            else
                ThongBaoLoi('Cập nhật không thành công');
                
            document.getElementById('string_img_upload').value = "";
            document.getElementById('string_img_upload_ch').value = "";
            location.reload();
            
        }
        
    });
}

function DeleteProduct(idsp)
{
    var flag = confirm('Bạn có chắc chắn muốn xóa sản phẩm này');
    if(flag==true)
    {
        $.ajax({
            url:taaa.appdomain+'/admin/product/xulydelete',
            type:'post',
            data:{idsp:idsp},
            success:function(data){
               
                if(data==1)
                    ThongBao('Xóa sản phẩm thành công',2000);
                else
                    ThongBaoLoi('Xóa không thành công');
                    
                location.reload();
                
            }
            
        });
    }
    else
        return false;
}

function SearchCategory(idcat)
{
    if(idcat == -1)
    {
        return false;
    }
    if(idcat == 0)
    {
        window.location = 'product';
    }
    else
        window.location = 'product?idcat=' + idcat;
}

//Get URL
function getParameterValue(name)
{
	name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp( regexS );
	var results = regex.exec( window.location.href );
	if( results == null ) return "";
	else return results[1];
}

function LoginAdmin(user, pass)
{
    //alert(user);
    //alert(pass);

    $.ajax({
        url:taaa.appdomain+'/admin/login/xulylogin',
        type:'post',
        data:{user:user, pass:pass},
        success:function(data){
            if(data==1)
            {
                ThongBao('Đăng nhập thành công',2000);
                window.location = 'category';
            }
            else
            {
                ThongBaoLoi('Đăng nhập không thành công');
                return false;    
            }
        }
    });
}

function DangXuat()
{
    var flag = confirm('Bạn có chắc chắn muốn đăng xuất');
    if(flag==true)
        window.location = taaa.appdomain+'/admin/login/dangxuat';
    else
        return false;
}













