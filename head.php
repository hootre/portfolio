<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<!-- 상단 시작 { -->

<div class='wrap'>
    <ul class="hd_login">
        <?php if ($is_admin) {  ?>
            <li class="tnb_admin">
                <a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리자</a>
            </li>
            <li>
                <a href='/bbs/board.php?bo_table=portfolio'>더보기</a>
            </li>
        <?php } else {  ?>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a>
            </li>
        <?php }  ?>

    </ul>
    <div class='container'>
        <!-- <div class='main-page item'>
            <div class="controls">
                <button class="controls__btn" id="btn-restart" title="Play it with audio!">
                    <svg viewbox="0 0 24 24">
                        <path
                            d="M19,12H22.32L17.37,16.95L12.42,12H16.97C17,10.46 16.42,8.93 15.24,7.75C12.9,5.41 9.1,5.41 6.76,7.75C4.42,10.09 4.42,13.9 6.76,16.24C8.6,18.08 11.36,18.47 13.58,17.41L15.05,18.88C12,20.69 8,20.29 5.34,17.65C2.22,14.53 2.23,9.47 5.35,6.35C8.5,3.22 13.53,3.21 16.66,6.34C18.22,7.9 19,9.95 19,12Z"></path>
                    </svg>
                </button>
            </div>
            <div id="root">
                <div class="card"><img
                    src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxITEhUTEhIVFRUWGBgXFxcVFRcVFRcXFhgWFxUXFRgYHSggGBolHRUXITEhJSkrLi4uFx8zODMsNygtLisBCgoKDg0OGhAQGi0lHSUvKy0tLS0tLS0tKy0tLS0tKy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAQAAxQMBIgACEQEDEQH/xAAcAAAABwEBAAAAAAAAAAAAAAAAAQIDBAUHBgj/xAA/EAABAwIDBQILBwQDAAMAAAABAAIDESEEEjEFBkFRYXGBBxMigpGhsbLC0fAUI0JScsHhMjNi8SRDkhYXc//EABkBAAIDAQAAAAAAAAAAAAAAAAABAgMEBf/EACgRAAICAQQBAwQDAQAAAAAAAAABAhEDBBIhMUETIjJRYZHwUnGBFP/aAAwDAQACEQMRAD8Aw9BBBMQEEEEABBBBMAIIIIACCCMBABIJ5kBJ+vUnPsnX1gpDoioKY7C9CPrkm/sxOl+uiBEZBPPw5GtO4g+xNUQASCCCADQQCCAAggggAIIIIAJBGggYaCCNMQlGgggAIkaCABRABGn4hl1CBjTIq0T/AIoDt+tE/wCTStb8v9aBN+OobWvX5d6jY6ofjgy9XG3IAEXr1+uNUDhtM1NRYH1Wv6FGknIJ4dEqCapsgCU2Fo0ueNzQ+goi008quUgitBa/Cyac2mo+XW/HRIlkLqAVtYc6ITE0O5R237/WmZoRelK686j5pNaU6qY1lWZzoKd5Oo7UAVLgkqVO0Dn6lHcEwEoI0EAEggggAIII0AEQgjQQAaC3TC7iQljT4sXa06N4ivJPjcKGn9tvob8l0v8Ahj/Nfgp9X7GCILR98t02RAua0CleA4CvBZ3Iyhos+o00sNW7TJQnuEIIUQosxMVG1SI2mta06og2lLJYqBUixt38kmSQl8l6k17rpq/BOuodGgen99EcDSHD9/5SANn5vodRyRiOtSCa9NR2/WikzYSh5VvTgK8PWkPzNBFL8fYOp70rHRF8Q7X119qeY/L5PPjr/wCfmjixBHCvb8k3LJmNSOzomRCoKaV4j+fUpDXVblAsBm41Oub66JsSENykAC5FBWp1ueVkmAEXBpcfqvoRy7UyLYeIhtX67FBVrPM1woK8NacGhp9Yr3qHI361PemCfHJGRJRCFEiQgoJVEKIASgl5UoMToVjaCW5qCGgPXmAiHio/0M90KQ6IUUXAO+6j/Qz3Qn5nGi1Kyhmc+EogRO7D7qwqfUrX/Cjijlp2+6sfkWjWuoQiPF5G6IBqUncMyrgFzS8U+Ojdeg6p3AS3yu0NtK+npVFiRoOSVhcOTfjw7f8ASiyS7HxGKigHLlbQqdho2Z2ZhQWaa9DQn2ejqo3jamp7LeS4U+vVxU7DTxULJCC06GzSDzFrG/8ACrl0Wwqyy23slwOahoaA9Hc68jc9y5+ewFRWmvMdOq6rD7TDoRHIS8tFGuAJDm00NBUWPW97Xrz+IIzXryNePX1KEG+mW5YKrRXQQtJI4FSzgWgDmmGRAEigNz6K2opmHobWB5G3p6K1szxjaaIQwtf2+uSieJv09X8K4wtM+XrYG1+RPbZG9rWiQHUGo9IrXuKn4KG+SjjsaHv5ckuouaXFRw10T2Lw1HhtDW+oppcpEoA71OKthZCLEVFJLEgxqUsbBSGKIUThaiAVdErA1qkRwpEYVnh22WrBjUnyVzlRWzRUQU7FNuEFOeJKQlPg9TbPjHio/wBDPdCenjFFDwEv3cf6G8vyhPyS2/0opMTMk8KcNq9T7qyGQLafCW2rD3+6sYlF1o1y9sH9h4vI0pWAPldop6/koydwzqOB+vqy5heixxMdTbh/Ff29Kde3I06fv0UZuJo4nhWleFxcV52VgyPxssUY/E5rT3kD91Bk0rZ1O5O54xLHTTghmgpYkj8Xdp1orh+6uHhkDYYjNJxDhVjbam2q7jAYdscTY22AFAixeLjhGaR7WNGpcQ0ekrA8jbs6ccaiqRx8+7+Ka2keHib0OU94pVUW1dgzutNHR3NraU7F2OO8IULRWODEzNBpmjhOW/IvIJHUBWGG3lw+Jio6KaNzmlzRNE5laXIa7+kusfJrW1QCLq6MHJWuCjJlUGk1ZkOM3TxDT5DDIKCh4hHHu9itXtrQEUPlailOljxHJbhsjCtAuL2r3qFvNRlXAeSASQAToaWABJOlhzVuOdx3MzZ4NZFCPkxKfd7FUJZBIdLNaXaV0pom8Vs7EtZ46WGVlCAS5jm61oTXjVarhN5XRvaBgsW+p1bELc9XWVhjJYtoxPiGZpOrXtcxwIvQg8OxWwe5WZNQvTkkYx44yxgj+oA1PedFTTnyj2roNrbJfgp2xyUFQHVrbLmIue66o9owuZK9jxlc1xBHKnLmOvFWpkYJXx0JYUbgm4ylvV6dobXIy5OxQE8E2wVcB1C7vYGxA9gNOCnp8HqyYTltOJdGQpEL11e2t3ctwFz0mAc3gpzxSxSFxJEXEO0QTWItqgqZZlY1A9U4CL7qP9DfdCkGKyRs9/3Uf6Ge6FJzpWyLOB39wAdE7sPsWC42KjyOq9I73NrE/sPsXnjbTKSu7fktmf3aeLfgUOJMrMql7HwglxEMTv6ZJY2OpY0c8A060JTCOKVzXNe00c0hzSODmmoPcQFzZR4L0+eTb93sFJPBK5zgYTWOPC5WiAMboA2lj/kL2vXRZ9Jsx2ExjWOBGSRlKmti5p17gtN3Q2s3EYHxkbcpOarR+F+ar29lTUdHBUG8m6z/ALOcSHVfm8Zl1JaAA411rYGnQrmQk4ypnazwjkW6PXg7yI6Jc+AEguGntvRV+BxGZoPMAjsIqrTCzc1Qu6JPorX7GxGjZWBv6SjGAeaNc8uHICg7T0VtitoMYCarnMFt8SzOaHZGN48XHlXgArt22NLyRjj3PdJddHQQWKXisI1+ouK0vQ31oe4KA7akLT5Twew/NTPt0Tmgh4FetOyhCs0/Noxa727Z/QiR7Go6rZHD6/xorBmFp5RJJ5niqWHbpZM6GW9LtcRQuadK9Rp3LoftDXR21V+J8tGXWQuKk/JlvhP2b4yeAhpNGPrTkC0+omvpWc74NAxUgH4WxNNPzMgia8docCO0FbltbDVk8YaERxOtW5cXBwAHYwjzliG3NlyMcXOqSSSTxJNyVocXVlOD4UUbCnymC2iehKljl4JSQ2LEHqFp25WNaWAGnD91wsWBzBWWx5nQuHK3FdLSxeJ2+mVz5RqmKwrXt0HqVFjdhNvb2Kw2PtQOaP55K88UHBa5pSFBGObd2XleLc0F2u9GzvKae39ka5uTBHczRRp+CcfFx0/Iz3U6ye9EnZo+6jr+RvL8oVRtfHiKRgH4jT1KWOG97UZZOuSz2vhczD2H2LAd/NlmOYmliT7AvQwlDmf6WX+EnZ2ZpcBpm9gVuFOcJY2K6aZjhKIlLmbQkJtcuVp0aUdZ4Pt7PsUrmS5vESkZy2uaNwsJG01tYjiKcqHWZN7cDLJ9k8aXPLRkfSsbnSMLgwPFsxbQ3FPKA1svPKcbO4CgcQBcUNKG9xTjdZ54YzdmnHqJQVeD0Lsi7ADqBl9FlLxE2ULmNxdtnEYdr3Grx5En626nvBDu9dDiX1XPyRcZUdKElJJo5Tb+05ZJBBHXM71DSv7BdNsXdqOOCkoaSbuzadBdVO2Ni4hxM+FIEoY0MzaGhdmFeFiadXLm9ibu4zGSH7dinspnHi81HBzWtcPJH4bm45caqxR8kpS/BeYzcTCukLoJ8jtcolL69KOcV1mxdmxxRtY4Mzs0Li0ntFdCq3AeDjCXpLITkYRSUm5BveutNe1WTtysKA2r3mwv417anMK2a4XuFpwto5muWOUabC3n2I2dmdrskjbtdWo7D0VduZj3yMc19Q+NxY4HUEWVFuxu/jPtMv8AyJPsbXuDGueX+NGgILrhuprxtrqutwGFyzTuAoCWDtIYKlWP5Jozu44nCT65X7/oGSOfNPG5oDGCPK6/lOc1xeL2oPI05noqHeHYTXtNhx5cl1MRJJPVOyQZhddiEFGG1lWL2qjz5t3Yzo3G1lSAUK9AbY3cEgNvauH2huC6pLR73yWTJp5RdwL7T7OW2TOD9dVazxhwUqHcmVpt7HK2wu6stq+wrbizTcakimWNX2c7s6eWN1hUd/JaJsfHEtFfZ2IsBuva49RVxh9ghug9StjKu2HBS7xGuQ0/N8KCn7w4Cgj874UapnNWT3HTYBh8VH+hvuhchvXIPtEAqf6iO+i7nZ9PFR/oZ7oWcb6S/wDLwv8A+7fWx6lonczLPk7zAR+QqzeDZIkYQeR5K+wFMqemYCFSszhO0FWjzPvdsN0Mhtap9q5khb5v7shr43GlxX2hYVjYsr3DkT6ilrMa4yR8lmKT6ZGRoJTG1IA4rAXHXeDfaRZM+Imz25h0c23sPqC0uObNZY1uq+mMh1NXhjhQ1pJ5B96vctQM5hkySGn5XHQjgsWpjbOhpZe2jrMDMQACpM7GmpI4UqLGh4Gmo6KDgcU0gGoVq2RhCzRbNdlQ4szEhlzWp4310U/BMElnhxFrVIFtKjuUyLJwopeHDb6LXhaMmrlwxDGBooLCirJzSw4/vqrKWQAH2KF9nJdU/wClvwY90rZyIrdKvA9hW2UtqZjhToaVuk7LmxdAkugBRhpR5T9UUeiDY0MK3klDDDknQ1KypOT+pF2JZGAnQAkBqVlUWRKXemn3fn/Cgk70D+35/wAKCqfZJWc47f8Aw8UbQ51w1tqVNmgaVXC4/ecYrGwZQcolaQTauo0712O1txYJMMMrAx+Vrg8C9cvHmFlscTocZGHjK5r2V63Fx0K6O/Y04VVohFXd9npPAk5VKqUxs8jKOxSxRYpv3MF0c/vFhszDZeeN58MWTOHU+8V6c2jGC0rE989hl09QOfvFaUnlwOK7Q06lZm6cw7dTyXS4vdZ4bUN9Q+aqYsPkBB1vX5Ln5cMsfyL4yUuix3X259jxLcR4pkhDXM8rUB4oXMP4XgWrQ2LhxWoOkw+0IM8bg6liPxNNP6Xjh7DwqFjJZZO7N2rNhn+MheWuHocPyuHEdO+xuseXHv8A7NOHLsfPR2UrsThiQwlzR+E8OxNP3vxH4RTmuy2fi8PjYRKwagZmn+pjuIPz4qg23uqTV0NK8uayRaupI2tNq4Mp2b24kOqCPrsXV7D3lmkoAwklc9sjdeZ7vvBTpxWi7I2M2EAUWyCiujmarJJraRN49oYiDBy4hn92MBzRTMKBzc2YcRlzV5Cumq6LdjarMZhYsQ0Zc7fKbrleDR7a8aEGh4ihXL7+bbjgiEZIL3kDLrRmry4ciAR1qqPwMbYysmwzjpllbfmAySnTyY/StmCTbpGeCcVz5NbawI8oUAY4c0BjhzWr05FhYUCFAoIxg5pX2oKPpyETRRKsoQnRiZLYxMmVCOoULxqPxpS2Cort6afd+f8ACgom80n9vzvhRqDhySRZ4ZmaJgI/A3l+ULKd+dmNGKjdS5kaPr0BbDgI/uo/0N90LLfCY7JiIXGwEzCTyaBcrXp5Jpr97KvJpOz3HIOzopYefqi4Sbwn4CIUYJpjpWNga30yFvqBVLj/AAvyGogwbW8nSyl/pY1rfeWeeSNskoM1SUEhZ5vPtzBQvIfIHvH4I6PI6EjyWnoSFnG3N58Zi6iedzmn/rb5EfZkbQO86p6qlyWoox1Tx/El6V9nb7a32Y+PJh4S0mxfJlqB/iATfqTbkVxTQa6pqKSgoeHFSGCyz5c08juTLYxUegnsuo80VQpLmHge4/NIzcxT2elVEi53VZiWRuxEIJbE7LJS9qB3lt1yXF+HRaFhccJGh4BHMa0+faoHgeY5gLho9xLhw1DR6mLQNr7oNAMmHblGpjHDnkHL/H0clny4tztGrFnUIpMqtlY5jxYXFkxvftKSDD5o7OJArrSvEJez8MIqkmg1UmDZDtpOGcFmEYbnR0xH4Wng2ou7uF7gT42rsi4J5N8viYntjOY3TylxL3hrHE3c4EOe6vIAZe0uHBN7rbS+zziStBRzXV0oR8wFsnhp3djds/xrGBv2bKQGigDP6aADgM2nVYQB5J6rZhfptNeDDmlve40c74/VD80G74Hr6P5WXuzNNiR2Kx2dtjIR4yJsjeP4X9xFj6O9dKOuTdNUR28Gkwb29vo/lWmG3nafofNc3sHD4HF0EUjRIf8AreMkncCaO80lX3/wsjS3m/ytkZqSvj8ldl5htuNPH2c1a4fHg8fYuRj3YkboT6B81Mh2fOzifUEnGLGpHXxygp9pC5aCWVuo9YVlh8W7j7Vnni+hdFpid5x/b8/4UFF3imJEfnfCgs0o8kqM42/4RMbLRmHecPC0NAyWldQAVe/UV5NpTSpXI4id8ji+R7nvOrnuLnHtJunWm3d+yLKFicmySil0NCNLa1OhqGVIBsNRGNOgJLkCRAxLLp5iTiTeqW11VFkw2lFIEEsIEXG7u9GKwRBgc2muSRgewnnwcO4hdt/904jxbmnCxCQtIbI2R2UO5+LLTUDWmZZcdEmqAO3i3pxOJBcXtzA5STHCcxoDV1Yy0m/JSdheEHaGHxTQ55xELv7kby2oA1dE4AZDQWaBl6DUcZs2ORlJcwbHJnGlalhpYV58eCnYXGRB5eXVky3FOZ4daNHpQkl4LZXKCfg3ffHEx4nZGKkiOZj8LK5p7GONCODgRQjgRReaY4zQVFO3mr2fbk5hOHEjhAXmTxdbFxprxItXLpW9K3VS5TRiaIWJF1HAUt7bpt7EE0NFlV2G7XhFxuEo17vtMQ/BMSXAf4S3cO/MOi5IBKypxk10DR6B3Z8IWzsXRhd9nlNsk1Ggk8GSf0u6A0J5Lsjg28l5LMa6bdbfvHYGjY5DJEP+mUlzKcmHWPuNOhVqyMg4Hoh+ACjvwAVLul4QcLjqMaTHNSpifrbXI7R4Gtr04BdQZAVdHJIjRy28sFPF+f8ACiUren/r8/4UaTm7Jp8Hn5psOwJJk+giabdyZcTwWEvJbH27ErNVRYnc061yYqDL0KpstoUuiGSSQzMLJjDP4KW4KG5tDVIGSUoJppqlhIQbgkUS0280BPIVTAb2ntElkEQFBEHOsdTMQ4n0UCbwL6vPd+6q2lWWzIi119CNfT80xOTaosnlNA6pciQpFKQhoFaJueI8Lo816p0pMmkRGBLUjKkPh5IGxpCiOiNoTIsJjnMc17HFrmuDmuGrSCKEdV6R3W2oMThoprAvYC4Dg4WeB2OBC84Sad4+f7LZvBPi/wDhtbX+l8g9Li/4lpwc2hVZ0+9DP7fn/CghvLJaPzvgQUZXYJHnngEojiEitkTOqylwT68ShFqm5pK9gSmmgQBLKKiRC+oToCA6Gwm3tTxCSUiaI1KJxpQcEkWQRaHAo2OdRjutvSpAUHarrNHM19H+0xMrgrjCm4VS0K1gFDTs/ZMiS36pt6W9NPKZBIYeU7C6oTDkqI0KRIlBG5AIigAkh9kuialTQmNPeeAqtY8C14ZwdWyg/wDpgHwFZM06lab4DZT43FM5sid/5dID7wV+F1Ii+DRN5G2j874EEveYWj8/4EacnyCPObdB2IPdWyKtkgghZS4andaicz1oouIelwuqEAyU004qUyUFQWqRF2oAkVSSjogEhjbkgBOyjTt/YpCCS5CVRjpMzz0t6NfXVWGMlytrxNh81UtCaK5DkLfKHarIHiomGZx5KU5rhqCKioqKVHMc0CJTkxIpDmHkbjMLcL1PZY+hR3CtkxDRQCN7SDQgg8jYhAIAeiclptoTiACJUeUp8qNOU0JjRPD0rR/AfJTHvbwdh3+lskNPaVnTGruvA0+m0m9YZh7h+FWY+yLNi3qp935/wIKFvZN/b874Uat9NgjzvSwSHuoizmmiTU8lkLiNOUiCSiOc3UZ5TRF9lpDKDy9ATzT0HoCq4OasI5LJMaZJa7onBTqO9NNenGlIYrL1PqVngcEMrS8xjxjiGZw4k0t+GzRXmqxWw2nFGxoE3kZfLicwvJN65TSgBPdqgZAGHDjne2JjWuMbCQ5wc8G7qDhUalKh2U1zjGfENcwmoGYkgUNa004U4dqc2LjY2NBbKY21Jkic0vBqa0Za1qCyYhxcbXYh48nMxwjbT856WGgTE0OzQMbE57BE9oIacodYk1rcU5elScHKyNjYcSQWubmAI/t1JsSLgnUU0uoexcVG1sjZj5JyuApWpY6tO+yr8RiHSPL3auNezkO4UHcgR1kkYjBIax0bGtIGW5bJXOGuc6mgB696r8TtSOIERNaZSBmewDIDS+XWtDw0uqXNUCpJoBSt6dnJNPTEJeSSSTUm5J1JOtU5GziksbUqQkMJEhVIJTEFK+gJUFr+adxj7KO1NCJBcuy8E0uXaLCbfdy+4uLDuS6rwbsccYKaiN591vxK3DzNEWrNT3pxdSyn+XL/ABQTW2MKQ2Ov+XsajW+TSZKkYg0igSZnckljRTVJlcFyCxEKY3TDk5Kbo8M0Fwrpqe5SIPslxYew7ENE7LiBwUTPUpATGPT7HKCxyeY/qgkmTM1BVV8tSalPF9SG16n9vrolvjbz9aQ12NRNoEpxRkjmE093VAMcBSQbpsSdUDIEyJMidb0j0FILSUInin12/unGkDiEDDa2iFUReOaSXjmECA4pDihmHMJt7wmIj4gpsFCZyIFMQ80rtPBMf+ffjFJ7WH9lxAK67wZSgY4EkCkUmpA/KOParcL96Bdmxbw0pH53wIKh2/tZvkDM38XEf49UFrklfZY0f//Z"
                    alt="Marques Brownlee"/>
                    <h1 class="name">
                        <span>H</span>
                        <span>A</span>
                        <span>N</span>
                        <span>G</span>
                        <span>T</span>
                        <span>E</span>
                        <span>A</span>
                    </h1>
                </div>
                <div class="wrapper">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="bg-line"></div>
                    <div class="logo-mkbhd">
                        <div class="skewed-box white bottom over">
                            <div class="mask">
                                <div class="line left"></div>
                            </div>
                        </div>
                        <div class="skewed-box white top over">
                            <div class="mask">
                                <div class="line left"></div>
                            </div>
                        </div>
                        <div class="skewed-box white top">
                            <div class="stripe top"></div>
                            <div class="stripe topBottom"></div>
                            <div class="stripe bottomTop"></div>
                            <div class="stripe bottom"></div>
                            <div class="mask">
                                <div class="line top"></div>
                                <div class="line right"></div>
                            </div>
                        </div>
                        <div class="skewed-box pink">
                            <div class="stripe bottom"></div>
                            <div class="stripe top"></div>
                            <div class="bg"></div>
                        </div>
                        <div class="skewed-box white bottom">
                            <div class="mask">
                                <div class="line bottom"></div>
                                <div class="line right"></div>
                            </div>
                        </div>
                    </div>
                    <div class="stripe final-stripe right"></div>
                    <div class="stripe final-stripe left"></div>
                </div>
            </div>
        </div> -->
        <div class='about item'>
            <div class='about_box'>
                <div class='card-container'>
                    <aside class="profile-card">
                        <div id='profile-img'>
                            <img src='https://t1.daumcdn.net/cfile/tistory/27312D4853882C4C1D' alt=''>
                        </div>
                        <ul class="profile-sns">
                            <li>
                                <i class="fas fa-map-marked-alt"></i>
                                <p>서울특별시, 광진구</p>
                            </li>
                            <li>
                                <i class="fas fa-phone-alt"></i>
                                <p>+82) 010 8007 1895</p>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <p>zxv7295@naver.com</p>
                            </li>
                            <li>
                                <i class="fab fa-facebook-square"></i>
                                <p>FaceBook</p>
                            </li>
                            <li>
                                <i class="fab fa-instagram"></i>
                                <p>Instagram</p>
                            </li>
                        </ul>
                    </aside>
                    <div class='card-content'>
                        <div class='profile-0 graph about'>
                            <h2>About me</h2>
                            <p>
                                안녕하세요 <br>
                                이렇게 아무 말이라도 써놔야 <br>
                                나중에 적당히 맞는 텍스트를 삽입하겠죠? <br>
                                근데 박스가 너무 길어서 무슨 말들을 적어야 <br>
                                제가 적당히 잘 적었다 생각이 날까요 <br>
                                아니 이렇게 해봤자 뭐가 좋은건지 <br>
                                잘 모르게쎈요 ㅋㅋㅋ 이정도면 적당히 <br>
                                적은건가>? 아직도 기준을 잘 모르겠네 <br>
                                그래 이정도면 충분히 나를 <br>
                                설명하기 적당한 텍스트라고 생각합니다 수고링 <br>
                            </p>
                        </div>
                        <div class='profile-1 graph work'>
                            <h3><i class="fa fa-briefcase"></i>Experience</h3>
                            <ul>
                                <li><span>Technical Consultant -<br>Web Design</span><small>Fiserv</small><small>Apr 2018 - Now</small></li>
                                <li><span>Web Designer</span><small>Lynden</small><small>Jan 2018 - Apr 2018</small></li>
                                <li><span>Intern - Web Design</span><small>Lynden</small><small>Aug 2017 - Dec 2017</small></li>
                            </ul>
                        </div>
                        <div class='profile-2 graph edu'>
                            <h3><i class="fa fa-graduation-cap"></i>Education</h3>
                            <ul>
                                <li><span>Bachelor of Science<br>Web Design and Development</span><small>BYU-Idaho</small><small>Jan. 2016 - Apr. 2018</small></li>
                                <li><span>Computer Science</span><small>Edmonds Community College</small><small>Sept. 2014 - Dec. 2015</small></li>
                                <li><span>High School</span><small>Henry M. Jackson High School</small><small>Jan. 2013 - Jun. 2015</small></li>
                            </ul>
                        </div>
                        <div class='profile-3 graph interests'>
                            <div class="interests-items">
                                <div class="art"><i class="fas fa-palette"></i><span>Art</span></div>
                                <div class="art"><i class="fas fa-book"></i><span>Books</span></div>
                                <div class="movies"><i class="fas fa-film"></i><span>Movies</span></div>
                                <div class="music"><i class="fas fa-headphones"></i><span>Music</span></div>
                                <div class="games"><i class="fas fa-gamepad"></i><span>Games</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- that’s all folks! -->

            </div>
        </div>
        <div class='main_video_item item'>
            <div class='main_video_box'>
                <div class='main_video'>
                <video id="videoBG" poster="/video/main.JPG" autoplay muted loop>
                    <source src="/video/main.mp4" type="video/mp4">
                </video>
                </div>
                <div class='black_box'></div>
                <div class='profile_sns_box'>
                    <ul class='profile_sns'>
                        <li>
                            <a href='#'>
                                <img
                                    src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE4LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDExMi4xOTcgMTEyLjE5NyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTEyLjE5NyAxMTIuMTk3OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8Y2lyY2xlIHN0eWxlPSJmaWxsOiM1NUFDRUU7IiBjeD0iNTYuMDk5IiBjeT0iNTYuMDk4IiByPSI1Ni4wOTgiLz4NCgk8Zz4NCgkJPHBhdGggc3R5bGU9ImZpbGw6I0YxRjJGMjsiIGQ9Ik05MC40NjEsNDAuMzE2Yy0yLjQwNCwxLjA2Ni00Ljk5LDEuNzg3LTcuNzAyLDIuMTA5YzIuNzY5LTEuNjU5LDQuODk0LTQuMjg0LDUuODk3LTcuNDE3DQoJCQljLTIuNTkxLDEuNTM3LTUuNDYyLDIuNjUyLTguNTE1LDMuMjUzYy0yLjQ0Ni0yLjYwNS01LjkzMS00LjIzMy05Ljc5LTQuMjMzYy03LjQwNCwwLTEzLjQwOSw2LjAwNS0xMy40MDksMTMuNDA5DQoJCQljMCwxLjA1MSwwLjExOSwyLjA3NCwwLjM0OSwzLjA1NmMtMTEuMTQ0LTAuNTU5LTIxLjAyNS01Ljg5Ny0yNy42MzktMTQuMDEyYy0xLjE1NCwxLjk4LTEuODE2LDQuMjg1LTEuODE2LDYuNzQyDQoJCQljMCw0LjY1MSwyLjM2OSw4Ljc1Nyw1Ljk2NSwxMS4xNjFjLTIuMTk3LTAuMDY5LTQuMjY2LTAuNjcyLTYuMDczLTEuNjc5Yy0wLjAwMSwwLjA1Ny0wLjAwMSwwLjExNC0wLjAwMSwwLjE3DQoJCQljMCw2LjQ5Nyw0LjYyNCwxMS45MTYsMTAuNzU3LDEzLjE0N2MtMS4xMjQsMC4zMDgtMi4zMTEsMC40NzEtMy41MzIsMC40NzFjLTAuODY2LDAtMS43MDUtMC4wODMtMi41MjMtMC4yMzkNCgkJCWMxLjcwNiw1LjMyNiw2LjY1Nyw5LjIwMywxMi41MjYsOS4zMTJjLTQuNTksMy41OTctMTAuMzcxLDUuNzQtMTYuNjU1LDUuNzRjLTEuMDgsMC0yLjE1LTAuMDYzLTMuMTk3LTAuMTg4DQoJCQljNS45MzEsMy44MDYsMTIuOTgxLDYuMDI1LDIwLjU1Myw2LjAyNWMyNC42NjQsMCwzOC4xNTItMjAuNDMyLDM4LjE1Mi0zOC4xNTNjMC0wLjU4MS0wLjAxMy0xLjE2LTAuMDM5LTEuNzM0DQoJCQlDODYuMzkxLDQ1LjM2Niw4OC42NjQsNDMuMDA1LDkwLjQ2MSw0MC4zMTZMOTAuNDYxLDQwLjMxNnoiLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg=="/>
                            </a>
                        </li>
                        <li>
                            <a href='#'>
                                <img
                                    src="data:image/svg+xml;base64,PHN2ZyBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyNCAyNCIgaGVpZ2h0PSI1MTIiIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjUxMiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayI+PGxpbmVhckdyYWRpZW50IGlkPSJTVkdJRF8xXyIgZ3JhZGllbnRUcmFuc2Zvcm09Im1hdHJpeCgwIC0xLjk4MiAtMS44NDQgMCAtMTMyLjUyMiAtNTEuMDc3KSIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSItMzcuMTA2IiB4Mj0iLTI2LjU1NSIgeTE9Ii03Mi43MDUiIHkyPSItODQuMDQ3Ij48c3RvcCBvZmZzZXQ9IjAiIHN0b3AtY29sb3I9IiNmZDUiLz48c3RvcCBvZmZzZXQ9Ii41IiBzdG9wLWNvbG9yPSIjZmY1NDNlIi8+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjYzgzN2FiIi8+PC9saW5lYXJHcmFkaWVudD48cGF0aCBkPSJtMS41IDEuNjMzYy0xLjg4NiAxLjk1OS0xLjUgNC4wNC0xLjUgMTAuMzYyIDAgNS4yNS0uOTE2IDEwLjUxMyAzLjg3OCAxMS43NTIgMS40OTcuMzg1IDE0Ljc2MS4zODUgMTYuMjU2LS4wMDIgMS45OTYtLjUxNSAzLjYyLTIuMTM0IDMuODQyLTQuOTU3LjAzMS0uMzk0LjAzMS0xMy4xODUtLjAwMS0xMy41ODctLjIzNi0zLjAwNy0yLjA4Ny00Ljc0LTQuNTI2LTUuMDkxLS41NTktLjA4MS0uNjcxLS4xMDUtMy41MzktLjExLTEwLjE3My4wMDUtMTIuNDAzLS40NDgtMTQuNDEgMS42MzN6IiBmaWxsPSJ1cmwoI1NWR0lEXzFfKSIvPjxwYXRoIGQ9Im0xMS45OTggMy4xMzljLTMuNjMxIDAtNy4wNzktLjMyMy04LjM5NiAzLjA1Ny0uNTQ0IDEuMzk2LS40NjUgMy4yMDktLjQ2NSA1LjgwNSAwIDIuMjc4LS4wNzMgNC40MTkuNDY1IDUuODA0IDEuMzE0IDMuMzgyIDQuNzkgMy4wNTggOC4zOTQgMy4wNTggMy40NzcgMCA3LjA2Mi4zNjIgOC4zOTUtMy4wNTguNTQ1LTEuNDEuNDY1LTMuMTk2LjQ2NS01LjgwNCAwLTMuNDYyLjE5MS01LjY5Ny0xLjQ4OC03LjM3NS0xLjctMS43LTMuOTk5LTEuNDg3LTcuMzc0LTEuNDg3em0tLjc5NCAxLjU5N2M3LjU3NC0uMDEyIDguNTM4LS44NTQgOC4wMDYgMTAuODQzLS4xODkgNC4xMzctMy4zMzkgMy42ODMtNy4yMTEgMy42ODMtNy4wNiAwLTcuMjYzLS4yMDItNy4yNjMtNy4yNjUgMC03LjE0NS41Ni03LjI1NyA2LjQ2OC03LjI2M3ptNS41MjQgMS40NzFjLS41ODcgMC0xLjA2My40NzYtMS4wNjMgMS4wNjNzLjQ3NiAxLjA2MyAxLjA2MyAxLjA2MyAxLjA2My0uNDc2IDEuMDYzLTEuMDYzLS40NzYtMS4wNjMtMS4wNjMtMS4wNjN6bS00LjczIDEuMjQzYy0yLjUxMyAwLTQuNTUgMi4wMzgtNC41NSA0LjU1MXMyLjAzNyA0LjU1IDQuNTUgNC41NSA0LjU0OS0yLjAzNyA0LjU0OS00LjU1LTIuMDM2LTQuNTUxLTQuNTQ5LTQuNTUxem0wIDEuNTk3YzMuOTA1IDAgMy45MSA1LjkwOCAwIDUuOTA4LTMuOTA0IDAtMy45MS01LjkwOCAwLTUuOTA4eiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg=="/>
                            </a>
                        </li>
                        <li>
                            <a href='#'>
                                <img
                                    src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMjsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHBhdGggc3R5bGU9ImZpbGw6IzE5NzZEMjsiIGQ9Ik00NDgsMEg2NEMyOC43MDQsMCwwLDI4LjcwNCwwLDY0djM4NGMwLDM1LjI5NiwyOC43MDQsNjQsNjQsNjRoMzg0YzM1LjI5NiwwLDY0LTI4LjcwNCw2NC02NFY2NA0KCUM1MTIsMjguNzA0LDQ4My4yOTYsMCw0NDgsMHoiLz4NCjxwYXRoIHN0eWxlPSJmaWxsOiNGQUZBRkE7IiBkPSJNNDMyLDI1NmgtODB2LTY0YzAtMTcuNjY0LDE0LjMzNi0xNiwzMi0xNmgzMlY5NmgtNjRsMCwwYy01My4wMjQsMC05Niw0Mi45NzYtOTYsOTZ2NjRoLTY0djgwaDY0DQoJdjE3Nmg5NlYzMzZoNDhMNDMyLDI1NnoiLz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K"/>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class='main_video_sub'>
                    <div class='main_video_sub_title'>
                        <span>Gaspar Manuel Zaldo</span>
                    </div>
                    <div class='main_video_sub_content'>
                        <span>
                            I am a photohrapher. I like a photograph people, happy people. Life stories. I
                            try to do it stylish and beautiful, felling and emotions.
                        </span>
                    </div>
                    <div class='main_video_sub_button'>
                        <a href='#'>Hire me</a>
                    </div>
                </div>

            </div>
        </div>
        <div class='portfolio item'>
            <div class='work_title'>
                <span>My works</span>
            </div>
            <div class='title'>
                <ul class="list-inline">
                    <li>
                        <a id="all" data-filter="*" class="port--list active">
                            <h5>All</h5>
                        </a>
                    </li>
                    <li>
                        <a data-filter=".Branding" class="port--list">
                            <h5>Branding</h5>
                        </a>
                    </li>
                    <li>
                        <a data-filter=".Design" class="port--list">
                            <h5>Design</h5>
                        </a>
                    </li>
                    <li>
                        <a data-filter=".Photography" class="port--list">
                            <h5>Photography</h5>
                        </a>
                    </li>
                    <li>
                        <a data-filter=".Videography" class="port--list">
                            <h5>Videography</h5>
                        </a>
                    </li>
                    <li>
                        <a data-filter=".Web" class="port--list">
                            <h5>Web</h5>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="menu">
                <div id="video-overlay" class="video-overlay">
                    <a class="video-overlay-close">&times;</a>
                </div>
                <div class='loding'>
                    <span class="back">
                        <span>L</span>
                        <span>o</span>
                        <span>a</span>
                        <span>d</span>
                        <span>i</span>
                        <span>n</span>
                        <span>g</span>
                    </span>
                </div>
                <div class="menu--wrapper">
                <?php
                //  Portfolio출력
                $sql = "select * from g5_write_portfolio";
                $result = sql_query($sql);
                for ($i=0; $row=sql_fetch_array($result); $i++) {
                    if($i < 10){
                        echo '<div class="menu--item center">
                        <figure class="'.$row['ca_name'].'">
                            <a class="video-play-button play-video" href="#">
                            <span></span>
                            </a>
                            <img data-filter="'.$row['wr_content'].'" src="http://img.youtube.com/vi/'.$row['wr_content'].'/maxresdefault.jpg" >
                        </figure></div>';
                    }else if($i < 20){
                        echo '<div class="menu--item center two">
                        <figure class="'.$row['ca_name'].'">
                            <a class="video-play-button play-video" href="#">
                            <span></span>
                            </a>
                            <img data-filter="'.$row['wr_content'].'" src="http://img.youtube.com/vi/'.$row['wr_content'].'/maxresdefault.jpg" >
                        </figure></div>';
                    }else{
                        echo '<div class="menu--item three">
                        <figure class="'.$row['ca_name'].'">
                            <a class="video-play-button play-video" href="#">
                            <span></span>
                            </a>
                            <img data-filter="'.$row['wr_content'].'" src="http://img.youtube.com/vi/'.$row['wr_content'].'/maxresdefault.jpg" >
                        </figure></div>';
                    }
                    
                }
                ?>
                </div>
            </div>

            <a class="version">HANG TEA HOUSE</a>
        </div>
        <div class='item'>
            <div class = "wrap">
                <h1>Contact us</h1>
                <div class = "postcard">

                <div class = "letter">
                    <form action="#" method="post" class="message_form">
                    <p class = "push">Dear </p><input type = "text" id = "recipient" name = "recipient_name" placeholder = "name of recipient" class = "push"><p> ,</p><br>
                    <label for = "message">Message</label><br>
                    <textarea id = "message" name = "message_to_recipient" placeholder = "Your eyes are like smoldering coals, merciless as they burn my soul in the most delightful way. Love you."></textarea><br>
                    <p>Yours Lovingly, </p><br>
                    <input type = "text" id = "sender_name" name = "sender" placeholder = "your name">
                    </form>
                </div>

                <div class = "address">
                    <img src = "http://i44.photobucket.com/albums/f9/dandee114/stamp_zpsvbuxiwih.png" class = "mail_stamp">
                    <form action="#" method="post" class="message_form">
                    <input type = "email" id = "recipient_email" name = "recipient_email" placeholder = "recipient's e-mail">
                    </form>
                    <p id = "address">Cherry Lane 1514,<br>
                    Lovely Heart,<br>
                    Hundred Acre Wood.
                    </p>
                </div>
                
                </div>
            </div>
        </div>

    </div>
</div>
<!-- } 상단 끝 -->

<hr>

<!-- 콘텐츠 시작 { -->