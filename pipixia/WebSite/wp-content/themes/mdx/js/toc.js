let showPreview = mdx_show_preview.preview === "true" ? true : false;
let tocShown = false;
let titleArr = [];
let firstClick = false;
let isToc = true;
let previewShown = false;
let mdx_toc = undefined;
let isInited = false;

$(function() {
    let tocHTML = getTitleListHtml();
    addToc(tocHTML[0]);
    if(isToc){
        if(showPreview){
            $(".PostMain").append('<div id="mdx-toc-preview" mdui-drawer="'+document.getElementById("menu").getAttribute("mdui-drawer")+'">'+tocHTML[1]+'</div>');
            mdui.mutation();
        }
        isInited = true;
        scrollToc(true);
    }
})

function getTitleListHtml() {
    let titleList = $("article > h1, article > h2, article > h3");
    if(titleList.length <= 1){
        isToc = false;
        return false;
    }
    let finalHtml = '<div class="mdui-list" id="mdx-toc">';
    let finalPreview = '';
    let counter = 0;
    let title1 = 0;
    let title2 = 0;
    let title3 = 0;
    for(title of titleList){
        title.dataset.mdxtoc = "mdx-toc-" + counter;
        titleArr.push("mdx-toc-" + counter);
        if($(title)[0].tagName ==="H1"){
            title1++;
            title2 = 0;
            title3 = 0;
            finalHtml += '<a class="mdui-list-item mdui-ripple mdx-toc-item" id="mdx-toc-'+counter+'-item" title="'+$(title).text()+'"><span>'+title1+'</span><div>'+$(title).text()+'</div></a>';
            finalPreview += '<div class="mdx-toc-preview-h1 mdx-toc-preview-item mdui-color-theme" id="mdx-toc-'+counter+'-preview"></div>';
        }else if($(title)[0].tagName ==="H2"){
            title2++;
            title3 = 0;
            if(title1 === 0){
                title1 = 1;
            }
            finalHtml += '<a class="mdui-list-item mdui-ripple mdx-toc-item mdx-toc-item-h2" id="mdx-toc-'+counter+'-item" title="'+$(title).text()+'"><span>'+title1+'.'+title2+'</span><div>'+$(title).text()+'</div></a>';
            finalPreview += '<div class="mdx-toc-preview-h2 mdx-toc-preview-item mdui-color-theme" id="mdx-toc-'+counter+'-preview"></div>';
        }else if($(title)[0].tagName ==="H3"){
            title3++;
            if(title1 === 0){
                title1 = 1;
            }
            if(title2 === 0){
                title2 = 1;
            }
            finalHtml += '<a class="mdui-list-item mdui-ripple mdx-toc-item mdx-toc-item-h3" id="mdx-toc-'+counter+'-item" title="'+$(title).text()+'"><span>'+title1+'.'+title2+'.'+title3+'</span><div>'+$(title).text()+'</div></a>';
            finalPreview += '<div class="mdx-toc-preview-h3 mdx-toc-preview-item mdui-color-theme" id="mdx-toc-'+counter+'-preview"></div>';
        }
        counter++;
    }
    return [finalHtml+'</div>', finalPreview];
}

function addToc(titleList) {
    if(!titleList){
        return;
    }
    $("#mdx_menu").after(titleList);
    $("#mdx-toc").css("transform", "translateX("+$("#mdx-toc").width()+"px)");
    $("#left-drawer nav").before('<div class="mdui-tab mdui-tab-full-width" id="mdx-toc-select"><a href="#" id="mdx-toc-menu" class="mdui-ripple"><i class="mdui-icon material-icons">&#xe241;</i><label>'+mdx_toc_i18n_1+'</label></a><a href="#" id="mdx-toc-toc" class="mdui-ripple"><i class="mdui-icon material-icons">&#xe86d;</i><label>'+mdx_toc_i18n_2+'</label></a></div>');
    mdx_toc = new mdui.Tab("#mdx-toc-select", {});
    mdx_toc.next();
    $("#mdx-toc").css("transform", "translateX(0)");
    $("#mdx_menu").css("transform", "translateX(-"+$("#mdx_menu").width()+"px)");
}

$("#menu").click(function() {
    if(!firstClick){
        scrollToc(false);
        tocShown = true;
        firstClick = true;
    }
})

$('.PostMain').on('click', '#mdx-toc-preview', function(){
    if($("#mdx-toc").css("transform") !== "translateX(0)" && showPreview){
        mdx_toc.next();
        $("#mdx-toc").css("transform", "translateX(0)");
        $("#mdx_menu").css("transform", "translateX(-"+$("#mdx_menu").width()+"px)");
        if(!firstClick){
            scrollToc(false);
            tocShown = true;
            firstClick = true;
        }else{
            scrollToc(true);
            tocShown = true;
            firstClick = false;
        }
    }
})

$('#left-drawer').on('click', '#mdx-toc-menu', function(e){
    e.preventDefault();
    tocShown = false;
    $("#mdx_menu").css("transform", "translateX(0)");
    $("#mdx-toc").css("transform", "translateX("+$("#mdx-toc").width()+"px)");
})

$('#left-drawer').on('click', '#mdx-toc-toc', function(e){
    e.preventDefault();
    tocShown = true;
    scrollToc(false);
    $("#mdx-toc").css("transform", "translateX(0)");
    $("#mdx_menu").css("transform", "translateX(-"+$("#mdx_menu").width()+"px)");
})

$(window).on("resize", function() {
    if(isToc){
        if(tocShown || !firstClick){
            $("#mdx-toc").css("transform", "translateX(0)");
            $("#mdx_menu").css("transform", "translateX(-"+$("#mdx_menu").width()+"px)");
        }else{
            $("#mdx_menu").css("transform", "translateX(0)");
            $("#mdx-toc").css("transform", "translateX("+$("#mdx-toc").width()+"px)");
        }
    }
})

$('#left-drawer').on('click', '.mdx-toc-item', function(e) {
    e.preventDefault();
    $("body,html").animate({scrollTop:($("article *[data-mdxtoc='mdx-toc-"+$(this).attr("id").split("-")[2]+"']").offset().top - 75)},500);
})

let tickingToc = false;
$(window).on("scroll", function(){
    if(isToc && isInited){
        if(!tickingToc) {
            requestAnimationFrame(function(){
                scrollToc(true);
            });
            tickingToc = true;
        }
    }
    
})
function scrollToc(firstCall){
    if(!isInited){
        return;
    }
    if(tocShown || firstCall){
        let howFar = document.documentElement.scrollTop || document.body.scrollTop;
        $(".mdx-toc-item").removeClass("mdx-toc-read").removeClass("mdui-list-item-active");
        $("#mdx-toc-preview > *").removeClass("mdx-toc-preview-item-active");
        let counter = 0;
        if(howFar >= $("article").offset().top + $("article").height() - 80){
            $(".mdx-toc-item").addClass("mdx-toc-read");
            if(previewShown && showPreview){
                $("#mdx-toc-preview").removeClass("mdx-toc-preview-show");
                previewShown = false;
            }
        }else{
            for(let i = 1; i < titleArr.length; i++){
                if(howFar >= $("article *[data-mdxtoc='"+titleArr[i]+"']").offset().top - 80){
                    $("#"+titleArr[i-1]+"-item").addClass("mdx-toc-read");
                    counter++;
                }else{
                    break;
                }
            }
            if(howFar > $("article").offset().top - 140){
                if(!previewShown && showPreview){
                    $("#mdx-toc-preview").addClass("mdx-toc-preview-show");
                    previewShown = true;
                }
                let item = $("#"+titleArr[counter]+"-item");
                item.addClass("mdui-list-item-active");
                $("#"+titleArr[counter]+"-preview").addClass("mdx-toc-preview-item-active");
                if(showPreview){
                    $("#mdx-toc-preview").css("transform", "translateY(-"+((counter+1)*20-4)+"px)");
                }
                if(item.length > 0){
                    let topDist = item[0].getBoundingClientRect().top;
                    if(topDist + 48 > window.innerHeight && tocShown){
                        $("#left-drawer").clearQueue().animate({scrollTop:document.getElementById("left-drawer").scrollTop + (topDist + 48 - window.innerHeight) + 8}, 200);
                    }else if(topDist < 8 && tocShown){
                        $("#left-drawer").clearQueue().animate({scrollTop:document.getElementById("left-drawer").scrollTop + topDist - 8}, 200);
                    }
                }
            }else{
                if(previewShown && showPreview){
                    $("#mdx-toc-preview").removeClass("mdx-toc-preview-show");
                    previewShown = false;
                }
            }
        }
        
    }
    tickingToc = false;
};