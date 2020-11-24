"use strict";
window.onload = () => {
    // 페이지 스크롤 롤링 function
    $('*').on('dragstart', function(event) { event.preventDefault(); });
    const elm = ".item";
    // let f = true;
    // $(elm).each(function (index) {
    //     // 개별적으로 Wheel 이벤트 적용
        
    //     $("body").on("mousewheel DOMMouseScroll", (e) => {
        
    //         e.preventDefault();
    //        if(f){

    //         f = false;
    //         let delta = 0;

    //         if (event.wheelDelta) {
    //             delta = event.wheelDelta / 120;
    //             if (window.opera) 
    //                 delta = -delta;
    //             }
    //         else if (event.detail) 
    //             delta = -event.detail / 3;
    //         let moveTop = $(window).scrollTop();

    //         let elmSelecter = $(elm).eq(index);
    //         // 마우스휠을 위에서 아래로
    //         console.log(delta);
    //         if (delta < 0) {
    //             if (elmSelecter.next() != undefined) {
    //                 try {
    //                     moveTop = elmSelecter
    //                         .next()
    //                         .offset()
    //                         .top;
    //                 } catch (e) {}
    //             }
    //             // 마우스휠을 아래에서 위로
    //         } else {
    //             if (elmSelecter.prev() != undefined) {
    //                 try {
    //                     moveTop = elmSelecter
    //                         .prev()
    //                         .offset()
    //                         .top;
    //                 } catch (e) {}
    //             }
    //        }
    //        // 화면 이동 0.8초(800)
    //        $("html,body")
    //        .stop()
    //        .animate({
    //            scrollTop: moveTop + 'px'
    //        }, {
    //            duration: 800,
    //            complete: function () {
    //                f = true;
    //            },
    //        });
    //         }

            
    //     });
    // });
    
    

    /*--------------------
    Touch
    --------------------*/
    let touchStart = 0
    let touchX = 0
    let isDragging = false
    const handleTouchStart = (e) => {
        touchStart = e.clientX || e
            .touches[0]
            .clientX
        isDragging = true
        $menu
            .classList
            .add('is-dragging')
    }
    const handleTouchMove = (e) => {
        if (!isDragging) 
            return
        touchX = e.clientX || e
            .touches[0]
            .clientX
        scrollY += (touchX - touchStart) * 2.5
        touchStart = touchX
    }
    const handleTouchEnd = () => {
        isDragging = false
        $menu
            .classList
            .remove('is-dragging')
    }

    
        /*--------------------
        Vars
        --------------------*/
        const $menu = document.querySelector('.menu')
        const $count = document.querySelectorAll('.menu--item');
        const $items = document.querySelectorAll('.menu--item.center')
        const $itemss = document.querySelectorAll('.menu--item.three')
        let itemWidth = $items[0].clientWidth
        let wrapWidth = ($items.length) * itemWidth
        if($count.length > 10){
            wrapWidth = ($items.length/2) * itemWidth
        }
        let itemWidths
        let wrapWidths
        if($count.length > 20){
            itemWidths = $itemss[0].clientWidth
            wrapWidths = ($itemss.length) * itemWidth
        }
        let scrollSpeed = 0
        let oldScrollY = 0
        let scrollY = 0
        let y = 0
        /*--------------------
        Lerp
        --------------------*/
        const lerp = (v0, v1, t) => {
            return v0 * (1 - t) + v1 * t
        }
    
    /*--------------------
    Resize
    --------------------*/
    window.addEventListener('resize', () => {
        menuWidth = $menu.clientWidth
        itemWidth = $items[0].clientWidth
        wrapWidth = ($items.length/ 2) * itemWidth;
        if($count.length > 20){
            itemWidths = $itemss[0].clientWidth
            wrapWidths = ($itemss.length) * itemWidths;
        }
    })

    /*--------------------
    Listeners
    --------------------*/
    $menu.addEventListener('touchstart', handleTouchStart)
    $menu.addEventListener('touchmove', handleTouchMove)
    $menu.addEventListener('touchend', handleTouchEnd)

    $menu.addEventListener('mousedown', handleTouchStart)
    $menu.addEventListener('mousemove', handleTouchMove)
    $menu.addEventListener('mouseleave', handleTouchEnd)
    $menu.addEventListener('mouseup', handleTouchEnd)

   $menu.addEventListener('selectstart', () => {
       return false
   })
    /*--------------------
    Dispose
    --------------------*/
    const dispose = (scroll) => {
        gsap.set($items, {
            x: (i) => {
                return i * itemWidth + scroll
            },
            modifiers: {
                x: (x, target) => {
                    const s = gsap
                        .utils
                        .wrap(-itemWidth, wrapWidth - itemWidth, parseInt(x))
                    return `${s}px`
                }
            }
        })
        if($count.length > 20){
            gsap.set($itemss, {
                x: (i) => {
                    return i * itemWidths + scroll
                },
                modifiers: {
                    x: (x, target) => {
                        const s = gsap
                            .utils
                            .wrap(-itemWidths, wrapWidths - itemWidths, parseInt(x))
                        return `${s}px`
                    }
                }
            })
        }
        
    }

    /*--------------------
    Render
    --------------------*/
    const render = () => {
        requestAnimationFrame(render)
        y = lerp(y, scrollY, .1)
        dispose(y)

        scrollSpeed = y - oldScrollY
        oldScrollY = y

        gsap.to($items, {
            skewX: -scrollSpeed * .2,
            rotate: scrollSpeed * .01,
            scale: 1 - Math.min(100, Math.abs(scrollSpeed)) * 0.003
        })
        if($count.length > 20){
            gsap.to($itemss, {
                skewX: -scrollSpeed * .2,
                rotate: scrollSpeed * .01,
                scale: 1 - Math.min(100, Math.abs(scrollSpeed)) * 0.003
            })
        }
    }
    render()


    // Portfolio 분류
            const $menu_arr = document.querySelectorAll('.menu--item');
            let test = [];
            $menu_arr.forEach((item, index) => {
                test[index] = item.innerHTML;
            });
            console.log(test);
            let item_leng;
            $('.title').on('click', 'a', function () {
                const $current_arr = [];
                let $menu_item = [];
                let filterValue = $(this).attr('data-filter');
                let $className = filterValue.substring(1,filterValue.length);
                item_leng = 0;
                if(filterValue == '*'){
                    $('.title a').removeClass('active');
                    $(this).addClass('active');
                    $menu_arr.forEach((item, index) => {
                         item.innerHTML = test[index];
                    });
                    $('.menu--wrapper').html($menu_arr);
                    
                } else{
                    $('.title a').removeClass('active');
                    $(this).addClass('active');

                    for(let key in $menu_arr){
                        $current_arr[key]= $menu_arr[key];
                    }
                    $menu_arr.forEach((item, index) => {
                        if(item.firstElementChild.classList.contains($className)){
                            $current_arr[item_leng].innerHTML = item.innerHTML;
                            $menu_item.push($current_arr[item_leng]);
                            item_leng++;
                        }
                        
                    });
                    console.log($menu_item);
                    $('.menu--wrapper').html($menu_item);
                }

                // 상세 Portfolio 영상보기
                function opee_video(this_src){
                    $('#video-overlay').addClass('open');
                    let iframe_src = $(this_src).next().attr('data-filter');
                    $("#video-overlay").append('<iframe src="https://www.youtube.com/embed/'+ iframe_src +'" frameborder="0" allowfullscreen></iframe>');
                }
                function close_video() {
                    $('.video-overlay.open').removeClass('open').find('iframe').remove();
                };
                
                //   video open
                $('.play-video').on('click', function(e){
                    e.preventDefault();
                    opee_video(this);
                    
                });
                
                //   video close
                $('.video-overlay, .video-overlay-close').on('click', function(e){
                    e.preventDefault();
                    close_video();
                });

            });
    // 상세 Portfolio 영상보기
    function opee_video(this_src){
        $('#video-overlay').addClass('open');
        let iframe_src = $(this_src).next().attr('data-filter');
        $("#video-overlay").append('<iframe src="https://www.youtube.com/embed/'+ iframe_src +'" frameborder="0" allowfullscreen></iframe>');
    }
    function close_video() {
        $('.video-overlay.open').removeClass('open').find('iframe').remove();
    };
    //   video open
    $('.play-video').on('click', function(e){
        e.preventDefault();
        opee_video(this);
        
    });
    
    //   video close
    $('.video-overlay, .video-overlay-close').on('click', function(e){
        e.preventDefault();
        close_video();
    });

    $('.work_title').on('click', () => {
        $menu_arr[0].innerHTML = $menu_arr2[7].innerHTML
    });
    // 로딩페이지 제거
    $('.loding').fadeOut();
    
}
