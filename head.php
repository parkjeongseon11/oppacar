<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/head.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<!-- 상단 시작 { -->
<div class="intro_popup">
	<div class="wrap">
		<div id="intro_logo">
			<a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo_w.svg" alt="<?php echo $config['cf_title']; ?>"></a>
		</div>
		<div class="intro_txt">
			<p class="mgb">I want my car</p>
			<strong class="mgb">OPPACAR</strong>
			<span class="mgb">나와 가족들이 함께타는 차!</span>
			<span class="intro_span mgb">‘아는오빠차’만의 ‘safety SYSTEM!’</span>
		</div>
		<aside>
			<ul>
				<li><a href="<?php echo G5_BBS_URL?>/board.php?bo_table=consulting"><img src="<?php echo G5_IMG_URL ?>/counselling_icon.png" alt="온라인 문의"></a></li>
				<li><a href="<?php echo G5_BBS_URL?>/board.php?bo_table=review"><img src="<?php echo G5_IMG_URL ?>/review_icon.png" alt="이용후기"></a></li>
				<li><a href="<?php echo G5_URL ?>/index.php?#address"><img src="<?php echo G5_IMG_URL ?>/location_icon.png" alt="찾아오시는 길"></a></li>
			</ul>
		</aside>
	</div>
</div>
	<div id="hd">
		<div id="hd_wrapper">
			<div id="logo">
				<a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.svg" alt="<?php echo $config['cf_title']; ?>"></a>
			</div>
			<nav id="gnb">
				<!--<h2>메인메뉴</h2>-->
				<div class="gnb_wrap">
					<ul id="gnb_1dul">
						<!--<li class="gnb_1dli gnb_mnal"><button type="button" class="gnb_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">전체메뉴열기</span></button></li>-->
						<?php
						$sql = " select *
									from {$g5['menu_table']}
									where me_use = '1'
									  and length(me_code) = '2'
									order by me_order, me_id ";
						$result = sql_query($sql, false);
						$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
						$menu_datas = array();

						for ($i=0; $row=sql_fetch_array($result); $i++) {
							$menu_datas[$i] = $row;

							$sql2 = " select *
										from {$g5['menu_table']}
										where me_use = '1'
										  and length(me_code) = '4'
										  and substring(me_code, 1, 2) = '{$row['me_code']}'
										order by me_order, me_id ";
							$result2 = sql_query($sql2);
							for ($k=0; $row2=sql_fetch_array($result2); $k++) {
								$menu_datas[$i]['sub'][$k] = $row2;
							}

						}

						$i = 0;
						foreach( $menu_datas as $row ){
							if( empty($row) ) continue; 
						?>
						<li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
							<a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
							<?php
							$k = 0;
							foreach( (array) $row['sub'] as $row2 ){

								if( empty($row2) ) continue; 

								if($k == 0)
									echo '<span class="bg">하위분류</span><ul class="gnb_2dul">'.PHP_EOL;
							?>
								<li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
							<?php
							$k++;
							}   //end foreach $row2

							if($k > 0)
								echo '</ul>'.PHP_EOL;
							?>
						</li>
						<?php
						$i++;
						}   //end foreach $row

						if ($i == 0) {  ?>
							<li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
						<?php } ?>
					</ul>
					<div id="gnb_all">
						<!--<h2>전체메뉴</h2>-->
						<ul class="gnb_al_ul">
							<?php
							
							$i = 0;
							foreach( $menu_datas as $row ){
							?>
							<li class="gnb_al_li">
								<a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_al_a"><?php echo $row['me_name'] ?></a>
								<?php
								$k = 0;
								foreach( (array) $row['sub'] as $row2 ){
									if($k == 0)
										echo '<ul>'.PHP_EOL;
								?>
									<li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $row2['me_name'] ?></a></li>
								<?php
								$k++;
								}   //end foreach $row2

								if($k > 0)
									echo '</ul>'.PHP_EOL;
								?>
							</li>
							<?php
							$i++;
							}   //end foreach $row

							if ($i == 0) {  ?>
								<li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
							<?php } ?>
						</ul>
						<button type="button" class="gnb_close_btn"><i class="fa fa-times" aria-hidden="true"></i></button>
					</div>
				</div>
			</nav>
			<div id="hd_sns">
				<ul>
					<li>
						<a href="<?php echo G5_URL ?>" class="icon facebook">
							<img src="<?php echo G5_IMG_URL ?>/facebook_icon.png" alt="">
						</a>
					</li>
					<li>
						<a href="<?php echo G5_URL ?>" class="icon instagram">
							<img src="<?php echo G5_IMG_URL ?>/instagram_icon.png" alt="">
						</a>
					</li>
					<li>
						<a href="<?php echo G5_URL ?>" class="icon twitter">
							<img src="<?php echo G5_IMG_URL ?>/twitter_icon.png" alt="">
						</a>
					</li>
					<li>
						<a href="<?php echo G5_URL ?>" class="icon youtube">
							<img src="<?php echo G5_IMG_URL ?>/youtube_icon.png" alt="">
						</a>
					</li>
				</ul>
			</div>
		 </div>

    <script>
    
    $(function(){
        $(".gnb_menu_btn").click(function(){
            $("#gnb_all").show();
        });
        $(".gnb_close_btn").click(function(){
            $("#gnb_all").hide();
        });
    });

    </script>
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <div id="container_wr">
   
    <div id="container">
        <?php if (!defined("_INDEX_")) { ?><h2 id="container_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2><?php } ?>

