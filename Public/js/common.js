function checkInfoFileChange(target,id)
{
	var isIE = /msie/i.test(navigator.userAgent) && !window.opera;
	var fileSize = 0;
	var filetypes =[".jpg",".jpeg",".png"];
	var filepath = target.value;
	var filemaxsize = 1024*3;

	if(filepath)
	{
		var isnext = false;
		var postf = filepath.substring(filepath.lastIndexOf("."), filepath.length);
		
		if(filetypes && filetypes.length>0)
		{
			for(var i =0; i<filetypes.length;i++)
			{
				if(filetypes[i]==postf)
				{
					isnext = true;
					break;
				}
			}
		}
		
		if(!isnext)
		{
			alert("不接受此文件类型照片！请上传jpg或者png格式图片!");
			target.value ="";
			return false;
		}
	}
	else
	{
		return false;
	}

	if (isIE && !target.files)
	{
		var filePath = target.value;
		var fileSystem = new ActiveXObject("Scripting.FileSystemObject");
		if(!fileSystem.FileExists(filePath))
		{
			alert("照片不存在，请重新输入！");
			return false;
		}

		var file = fileSystem.GetFile (filePath);
		fileSize = file.Size;
	}
	else
	{
		fileSize = target.files[0].size;
	}

	var size = fileSize / 1024;
	if(size>filemaxsize)
	{
		alert("照片大小不能大于"+filemaxsize/1024+"M！请处理后再试!");
		target.value ="";
		return false;
	}
	/*
	if(size<=0)
	{
		alert("附件大小不能为0M！");
		target.value ="";
		return false;
	}
	*/
}

$(document).ready(function()
{
    function yesno(id)
    {
        if(confirm('id为【' + id + '】信息是否删除?'))
        {
        	var thisHref = $('.del[v=' + id + ']').attr('site');
        	$('.del[v=' + id + ']').attr('href', thisHref);
            return true;
        }
        else
        {
            return false;
        }
    }

    $('.del').click(function(){
    	var id = $(this).attr('v');
        return yesno(id);
    });
    
    $('#more_del').click(function(){
        if(confirm('你确定要删除所选中的吗?'))
        {
            return true;
        }
        else
        {
            return false;
        }
    });
    
    $('#more_pull').click(function(){
        if(confirm('你确定要领取吗?'))
        {
            return true;
        }
        else
        {
            return false;
        }
    });  
    /*
    $('#more_checkbox').click(function()
    {
        if($('.check').attr('checked'))
        {
            $(this).attr('checked', true);
            $('.check').attr('checked', false);
        }
        else
        {
            $(this).attr('checked', false);
            $('.check').attr('checked', true);
        }
    });
	*/
    $('tr td').slice(1, -1).hover(function(){
        $(this).parent().find('td').css('background', '#C1FFC1');
    },function(){
        $(this).parent().find('td').css('background', '#ffffff');
    });
    /*
    $('tr').slice(1,-1).click(function(){
        var checkbox = $(this).find("input[type=checkbox]");
        if(checkbox.attr('checked'))
        {
            checkbox.attr('checked', false);
        }
        else
        {
            checkbox.attr('checked', true);
        }
    });
    
    $('input[type="checkbox"]').click(function(){
        if($(this).attr('checked'))
        {
            $(this).attr('checked', false);
        }
        else
        {
            $(this).attr('checked', true);
        }
    });
    */
});