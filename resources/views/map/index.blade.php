<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <title>地图</title>
    <link rel="stylesheet" href="{{ asset('main1119.css') }}"/>
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.9&key=ba761e9399a546c37a5caa707229a571&plugin=AMap.Geocoder,AMap.MarkerClusterer"></script>
    <script type="text/javascript" src="{{ asset('js/addToolbar.js') }}"></script>
    <link href="css/jquery-accordion-menu.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="js/jquery-accordion-menu.js" type="text/javascript"></script>
    <style type="text/css">
    *{box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;}
    body{background:#f0f0f0;}
    .content{width:30%;margin:10px;}
    .filterinput{
        background-color:rgba(249, 244, 244, 0);
        border-radius:15px;
        width:90%;
        height:30px;
        border:thin solid #FFF;
        text-indent:0.5em;
        font-weight:bold;
        color:#FFF;
    }
    #demo-list a{
        overflow:hidden;
        text-overflow:ellipsis;
        -o-text-overflow:ellipsis;
        white-space:nowrap;
        width:100%;
    }
    #container {
    position: absolute;
    top: 0;
    left: 198px;
    right: 0;
    bottom: 0;
    width: 80%;
    height: 100%;
}

.green {
    color: #16a085;
}

.blue {
    color: #3472ce;
}


div .bottom {
    position: absolute;
    margin: 36% 0;
}

.circle {
    position: relative;
    width: 20px;
    height: 20px;
    border-radius: 25px; 
    box-shadow: 5px 5px 5px #888888; 
    margin: 10px 0;
}

.bg-red {
    background-color: #ca0c16;
}

.bg-green {
    background-color: #16a085;
}

.bg-blue {
    background-color: #3472ce;
}


    </style>
    <script type="text/javascript">

$(function(){   
    //顶部导航切换
    $("#demo-list li").click(function(){
        $("#demo-list li.active").removeClass("active")
        $(this).addClass("active");
    })  
})  
</script>
</head>
<body onload="geocoder()">

<div>

<!-- 分类侧栏 start-->
<div class="content">
    <div id="jquery-accordion-menu" class="jquery-accordion-menu green">
        
        <div class="header"><img src="{{asset('images/logo.png')}}" style="max-width: 120px; max-height: 120px;"></div>
        <ul id="demo-list">
            <li class="<?php echo  ($category_id == 'all' ? 'active' : ''); ?> "><a href="all"> 全部 </a></li>
            @foreach ($categories as $category) 
           <li class="<?php echo  ($category_id == $category->id ? 'active' : ''); ?> "><a href="{{ $category->id }}"> {{ $category->title }} </a></li>
            @endforeach
        </ul>
    </div>
     <div class="bottom">
         <div class="circle bg-green"></div> 
         <div style="position: relative;">&nbsp;&nbsp;未建</div> 
         <div class="circle bg-blue"></div> 
         <div style="position: relative;">&nbsp;&nbsp;待建</div>
         <div class="circle bg-red"></div> 
         <div style="position: relative;">&nbsp;&nbsp;已建</div>
     </div>

    
</div>
<!-- 分类侧栏 end -->

<!-- 地图START -->
<div class="main">
<div id="container">
    
</div>
</div>
<!-- 地图END -->

</div>

<script type="text/javascript">
(function($) {
$.expr[":"].Contains = function(a, i, m) {
    return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
};
function filterList(header, list) {
    //@header 头部元素
    //@list 无需列表
    //创建一个搜素表单
    var form = $("<form>").attr({
        "class":"filterform",
        action:"#"
    }), input = $("<input>").attr({
        "class":"filterinput",
        type:"text"
    });
    $(form).append(input).appendTo(header);
    $(input).change(function() {
        var filter = $(this).val();
        if (filter) {
            $matches = $(list).find("a:Contains(" + filter + ")").parent();
            $("li", list).not($matches).slideUp();
            $matches.slideDown();
        } else {
            $(list).find("li").slideDown();
        }
        return false;
    }).keyup(function() {
        $(this).change();
    });
}
$(function() {
    filterList($("#form"), $("#demo-list"));
});
})(jQuery); 
</script>

<script type="text/javascript">

    jQuery("#jquery-accordion-menu").jqueryAccordionMenu();
    
</script>

<script type="text/javascript">
    var map = new AMap.Map("container", {
        resizeEnable: true
    });
    var list = <?php echo $projects; ?>;
    var count = <?php echo json_encode($count); ?>;
    // console.log(list);
    var num = 0;
    var cluster, markers = [];
    var areaCount = [];
    function geocoder() {
        
        // var data;
        // console.log(list);
         for (index in count){
              //地理编码,返回地理编码结果
            // data = item;
            // console.log(count[index]);
            showProvince(index);
            
            
        }
        
    }
    function showProvince(index)
    {
        var geocoder = new AMap.Geocoder({
            // city: "010", //城市，默认：“全国”
            radius: 100 //范围，默认：500
        });
        var name = count[index]['name'];
         geocoder.getLocation(name, function(status, result) {
                    // console.log(item);
                    if (status === 'complete' && result.info === 'OK') {
                        // console.log(index);
                        geocoder_CallBack(result, index, count[index], 0);
                    }
                });
    }

    function showDetail(index) {
        var geocoder = new AMap.Geocoder({
            // city: "010", //城市，默认：“全国”
            // radius: 1000 //范围，默认：500
        });
        map.remove(markers);
       list[index].forEach(function (item, index) {
            geocoder.getLocation(item.area_text, function(status, result) {
                // console.log(item);
                if (status === 'complete' && result.info === 'OK') {
                    areaCount[item['area_code']] = 0;
                    geocoder_CallBack(result, num, item);
                }
            });
       })
         
    }

    function addCircleMarker(i, d, index, item) {
        var amap = new AMap.LngLat(d.location.getLng(), d.location.getLat());
        var num = 0;
        for (ind in item['count']) {
            var color = 'rgba(0,0,255,1)';
            // console.log(index);
            switch (ind) {
                case '0': color = '#16a085';break;
                case '1': color = '#3472ce';break;
                case '2': color = '#ca0c16';break;
            } 
            // console.log(color);
            marker = new AMap.Marker({
             position: amap,
             content: '<div style="background-color: ' + color +'; height: 24px; width: 24px; border: 1px solid hsl(180, 100%, 40%); border-radius: 12px; box-shadow: hsl(180, 100%, 50%) 0px 0px 1px;">' + item['count'][ind] + '</div>',
             offset: new AMap.Pixel(-15+num,-15+num),
             map: map
            });
            num+=20;
            markers.push(marker);
            // console.log(markers);
            marker.on("click", function(e) {
                showDetail(index);
            });
        }
        

       
        // map.addMarker(marker);
    }

    function addMarker(i, d, index, content, item) {
        // console.log(parseFloat(d.location.getLng()));
        // console.log(parseFloat(d.location.getLng()) + num);
        // console.log(d.adcode);
        var amap = new AMap.LngLat(d.location.getLng(), d.location.getLat());
        amap.offset(10 * areaCount[item['area_code']], 10 * areaCount[item['area_code']]);
        marker = new AMap.Marker({
            icon: "https://webapi.amap.com/theme/v1.3/markers/n/mark_r.png",
            position: amap,
            map:map,
        });
        areaCount[item['area_code']] ++;
        marker.content = content;
        marker.on("click", markerClick);
        marker.emit('click', {target: marker});
    }

     function markerClick(e) {
        var infoWindow = new AMap.InfoWindow({offset: new AMap.Pixel(0, -30)});
        infoWindow.setContent(e.target.content);
        infoWindow.open(map, e.target.getPosition());
    }
    //地理编码返回结果展示
    function geocoder_CallBack(data, index, content, addmarker = 1) {
        var resultStr = "";
        //地理编码结果数组
        var geocode = data.geocodes;
        // console.log(content);
        for (var i = 0; i < geocode.length; i++) {
            // //拼接输出html
            // resultStr += "<span style=\"font-size: 12px;padding:0px 0 4px 2px; border-bottom:1px solid #C1FFC1;\">" + "<b>地址</b>：" + geocode[i].formattedAddress + "" + "&nbsp;&nbsp;<b>的地理编码结果是:</b><b>&nbsp;&nbsp;&nbsp;&nbsp;坐标</b>：" + geocode[i].location.getLng() + ", " + geocode[i].location.getLat() + "" + "<b>&nbsp;&nbsp;&nbsp;&nbsp;匹配级别</b>：" + geocode[i].level + "</span>";
            
            if (addmarker) {
                resultStr += "<span style=\"font-size: 12px;padding:0px 0 4px 2px; border-bottom:1px solid #C1FFC1;\">" 
            + "<b>名称</b>：" + content.title + "" 
            + "<br/><b>地址</b>：" + content.area_text + (content.address ? content.address : "")
            + "<br/><b>常住人口</b>：" + content.population + " 万"
            + "<br/><b>进度</b>：" + (content.schedule ? content.schedule : "-")
            + "<br/><b>状态</b>：" + content.status_text
            + "<br/><b>供应商</b>：" + (content.investor ? content.investor : "-")
            + "<br/><b>规模</b>：" + (content.size ? content.size : "-")
            + "<br/><b>备注</b>：" + (content.remark ? content.remark : "-")
            + "</span>";
                addMarker(i, geocode[i], index, resultStr, content);
            }else {
                addCircleMarker(i, geocode[i], index, content);
            } 
        }
        map.setFitView();
        // document.getElementById("result").innerHTML = resultStr;
    }
</script>
</body>
</html>