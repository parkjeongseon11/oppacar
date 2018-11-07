<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_PATH.'/head.php');
?>

	<div class="hd_sch_wr">
		<fieldset id="hd_sch" >
			<legend>사이트 내 전체검색</legend>
			<form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
			<input type="hidden" name="sfl" value="wr_subject||wr_content">
			<input type="hidden" name="sop" value="and">
			<label for="sch_stx" class="sound_only">검색어 필수</label>
			<input type="text" name="stx" id="sch_stx" maxlength="20" placeholder="원하시는 차종을 검색하세요." style=" background-image:url(../img/logo.svg); background-position:center left 12px; background-repeat:no-repeat; background-size:8% auto;";>
			<button type="submit" id="sch_submit" value="검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
			</form>

			<script>
			function fsearchbox_submit(f)
			{
				if (f.stx.value.length < 2) {
					alert("검색어는 두글자 이상 입력하십시오.");
					f.stx.select();
					f.stx.focus();
					return false;
				}

				// 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
				var cnt = 0;
				for (var i=0; i<f.stx.value.length; i++) {
					if (f.stx.value.charAt(i) == ' ')
						cnt++;
				}

				if (cnt > 1) {
					alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
					f.stx.select();
					f.stx.focus();
					return false;
				}

				return true;
			}
			</script>

		</fieldset>
		<p>‘아는오빠차’에서는 고객님의 소중한 차를 내 차만큼 신중하게 추천해 드립니다!</p>			
		<?php echo popular(); // 인기검색어, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?>
	</div>
	<div class="check ">
		<div class="main_people"><img src="<?php echo G5_IMG_URL ?>/main_people.png" alt="사람 이미지"></div>
		<div class="cnts">
			<ul>
				<li>
					<a href="<?php echo G5_URL ?>/page/korea_car.php">
						<img src="<?php echo G5_IMG_URL ?>/korea_car.png" alt="국산 자동차 검색">
					</a>
				</li>
				<li>
                    <a href="<?php echo G5_URL ?>/page/foreign_car.php">
                        <img src="<?php echo G5_IMG_URL ?>/imported_car.png" alt="수입 자동차 검색">
                    </a>
				</li>
                <li>
                    <a href="<?php echo G5_BBS_URL?>/board.php?bo_table=consulting">
                        <img src="<?php echo G5_IMG_URL ?>/car_financing.png" alt="자동차 할부">
                    </a>
                </li>
                <li>
                    <a href="https://www.carhistory.or.kr/main.car?realm=" target="_blank">
                        <img src="<?php echo G5_IMG_URL ?>/serch_link_service.png" alt="사고이력 조회">
                    </a>
                </li>
			</ul>
		</div>
	</div>
    <div class="sfkc">
        <div class="sf_title">
            <h2>우리나라차 검색</h2>
            <div class="more_btn">
                <a href="<?php echo G5_URL ?>/page/korea_car.php">
                  <strong>더보기</strong>
                  <img src="<?php echo G5_IMG_URL ?>/plus.png" alt="플러스">
                </a>
            </div>
        </div>
        <div class="kor_ctn">
            <a href="<?php echo G5_URL ?>/page/korea_car.php">
                <img src="<?php echo G5_IMG_URL ?>/kor_ctn.jpg" alt="우리나라차 리스트">
            </a>
        </div>
    </div>
    <div class="sfkc">
        <div class="sf_title">
            <h2>다른나라차 검색</h2>
            <div class="more_btn">
                <a href="<?php echo G5_URL ?>/page/foreign_car.php">
                    <strong>더보기</strong>
                   <img src="<?php echo G5_IMG_URL ?>/plus.png" alt="플러스">
                </a>
            </div>
        </div>
        <div class="kor_ctn">
            <a href="<?php echo G5_URL ?>/page/foreign_car.php">
                <img src="<?php echo G5_IMG_URL ?>/other_ctn.jpg" alt="다른나라차 리스트">
            </a>
        </div>
    </div>
    <div class="address" id="address">
        <div class="ads_txt">
            <img src="<?php echo G5_IMG_URL ?>/ads_txt.png" alt="경기도 수원시 상당구 용정동 697번지, 1685-1845, FAX. 0505. 6548.4868, Email. ceo@flugmedia.kr, 평일 : 10:00 ~ 18:00 / 점심 : 12:00 ~ 13:00">
            <div class="ads_sns">
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
        <div id="map" style="width: 50%; height: 380px; min-height:222px;"></div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPKvi9G5HDMbZlDvohO9gZ-yllTGF3_-w&callback=initMap"
                async defer>
        </script>
        <script type="text/javascript">
            var is_admin="<?php echo $is_admin; ?>";
            function initMap() {
                var latlng = new google.maps.LatLng(36.623186, 127.513083);
                var markLocation = new google.maps.LatLng(36.623186, 127.513083);
                var myOptions =
                    {
                        zoom: 17,
                        center: latlng,
                        mapTypeControl: false,
                        mapTypeControlOptions: {
                            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                            mapTypeIds: [
                                google.maps.MapTypeId.ROADMAP,
                                google.maps.MapTypeId.TERRAIN
                            ]
                        }
                    };

                var map = new google.maps.Map(document.getElementById("map"), myOptions);
                var myIcon = new google.maps.MarkerImage("../img/maps_marker.png");
                var myMarker = new google.maps.Marker(
                    {
                        position: latlng,
                        map: map,
                        icon: myIcon,
                        animation:google.maps.Animation.BOUNCE,
                        title: 'OPPACAR'
                    });
            }
        </script>
    </div>


<?php
include_once(G5_PATH.'/tail.php');
?>