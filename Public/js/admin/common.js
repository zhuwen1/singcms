/**
 * add button 
 */
$("#button-add").click(function(){
    var url  = SCOPE.add_url;
    alert(url);
    window.location.href = url;
});
/**
 * sumit the from 
 */
$("#singcms-button-submit").click(function(){
    var data  = $("#singcms-form").serializeArray();
    // console.log(data);  
    postData = {};
    $(data).each(function(i){
        postData[this.name] = this.value;
    });
    // console.log(postData);
    //post postData to the server
    url      = SCOPE.save_url;
    jump_url = SCOPE.jump_url;
    // console.log(url);
    $.post(url,postData,function(result){
    	console.log(postData);
        if(result.status == 1){
            //success
            dialog.success(result.message,jump_url);
        }else if(result.status == 0){
            //error
            dialog.error(result.message);
        }
    },'JSON');
})
/*
edit model 
*/
$(".singcms-table #singcms-edit").on('click',function(){
    var id               = $(this).attr('attr-id');
    var url              = SCOPE.edit_url + '&id='+id;
    window.location.href = url;
});
/*
delete model
*/
$(".singcms-table #singcms-delete").on('click',function(){
    var id         = $(this).attr('attr-id');
    var a          = $(this).attr('attr-a');
    var message    = $(this).attr('attr-message');
    var url        = SCOPE.set_status_url;
    data           = {};
    data['id']     = id;
    data['status'] = -1;

    layer.open({
        type:0,
        title:'sure delete',
        btn:['yes','no'],
        icon:3,
        closeBtn:2,
        content:'are you sure'+message,
        scrollbar:true,
        yes:function(){
            todelete(url,data);
        },
    });
});    
    function todelete(url,data){
    // console.log(data);
        $.post(
            url,
            data,
            function(result){
            //   console.log(result);
                if(result.status == 1){
                    return dialog.success(result.message,'');
                }else{
                    return dialog.error(result.message);
                }
            },'JSON')
    }
$("#button-listorder").click(function(){
    //get listorder
    var data = $("#singcms-listorder").serializeArray();
    postData  = {};
    $(data).each(function(i){
        postData[this.name] =this.value;
    });
    var url =SCOPE.listorder_url;
    $.post(url,postData,function(result){
        console.log(result);
        if(result.status == 1){
            return dialog.success(result.message,result['data']['jump_url']);
        }else if(result.status == 0){
            return dialog.error(result.message,result['data']['jump_url']);
        }
    },"JSON")
})
/**edit status*/
$('.singcms-table #singcms-on-off').on('click',function(){
    console.log("singcms-on-off has been click");
    var id         = $(this).attr('attr-id');
    var status     = $(this).attr('attr-status');
    var url        = SCOPE.set_status_url;
    data = {};
    data['id']     = id;
    data['status'] = (status==1?0:1);
    console.log(data['status'],id);

    layer.open({
        type:0,
        title:'是否提交',
        btn:['yes','no'],
        icon:3,
        closeBtn:2,
        content:'是否确定更变状态',
        scrollbar:true,
        yes:function(){
            todelete(url,data);
        }
    })
})
/*推送js相关*/

$("#singcms-push").click(function(){
    console.log("singcms-push has been click");
    var id = $("#select-push").val();
    alert(id);
    if(id == 0){
        return dialog.error("请选择推荐位");
    }
    push     = {};
    postData = {};
    $("input[name='pushcheck']:checked").each(function(i){
        push[i] = $(this).val();
    });
    postData['push']        = push;
    postData['position_id'] = id;
    var url = SCOPE.push_url;
    console.log(postData);
    $.post(url,postData,function(result){
        if(result.status === 1){
            //todo
            return dialog.success(result.message,result['data']['jump_url']);
        }else if(result.status == 0){
            //todo
            return dialog.error(result.message);
        }
    },'JSON') 
})