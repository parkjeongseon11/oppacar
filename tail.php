<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/tail.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/tail.php');
    return;
}
?>

    </div>
    <div id="aside">
		<ul>
			<li>
				<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=consulting">상담<br>문의</a>
			</li>
			<li>
				<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=question">할부<br>문의</a>
			</li>
			<li>
				<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=review">이용<br>후기</a>
			</li>
			<li>
                <a href="<?php echo G5_URL ?>" class="this_item">
                    <img src="<?php echo G5_IMG_URL ?>/this_item.jpg" alt="">
                </a>
				<!--<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?> -->
			</li>
		</ul>
	</div>
</div>
<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->
<div id="ft">

    <div id="ft_wr">
        <!-- <div id="ft_link">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
            <a href="<?php echo get_device_change_url(); ?>">모바일버전</a>
        </div>
        <div id="ft_catch"><img src="<?php echo G5_IMG_URL; ?>/ft_logo.png" alt="<?php echo G5_VERSION ?>"></div> -->
		<div class="ft_txt">
			<span>CEO 곽영일</span>
			<span>사업자번호 301-23-54164</span>
			<span>경기도 수원시 상당구 용정동 697번지 3F</span>
			<span>T 1685-1845</span>
			<span>F 0505-6548-4868</span>
			<span>E ceo@flugmedia.kr</span>
		</div>
        <div id="ft_copy">Copyright &copy; <strong class="red">oppacar</strong>. All rights reserved.</div>
    </div>
    
    <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
        <script>
        
        $(function() {
            $("#top_btn").on("click", function() {
                $("html, body").animate({scrollTop:0}, '500');
                return false;
            });
        });
        </script>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>