<?php
include_once("../common.php");

include_once(G5_PATH."/head2.php");

?>

<div class="contents">
    <div id="ctn_wrap">
        <div class="ctn_tit">
            <h2><span>회사</span>소개</h2>
            <p>ABOUT OPPACAR</p>
        </div>
        <div class="ctn_txt">
            <div class="txt_top">
                <img src="<?php echo G5_IMG_URL ?>/logo.svg" alt="<?php echo $config['cf_title']; ?>">
                <span><strong>저희 오빠카</strong> 는 고객님과의 신뢰를 중요하게 생각합니다.<br>원활한 매매를 위해 서류확인등을 통한 다양한 차량으로 보다 편리하게 이용하실 수 있습니다. </span>
            </div>
            <div class="txt_low">
                <ul>
                    <li>
                        <h4>편리성</h4>
                        <em>CONVENIENTLY</em>
                        <p>잘 정리되어 있는 카테고리로<br>원하는 차량을 쉽게 찾을 수<br>있습니다.</p>
                    </li>
                    <li>
                        <h4>고객만족</h4>
                        <em>CUSTOMER SATISFACTION</em>
                        <p>고객과의 신뢰를 중시하며<br>매물거래시 증명서류를<br>필수로 합니다.</p>
                    </li>
                    <li>
                        <h4>정직함</h4>
                        <em>HONESTY</em>
                        <p>100% 실매물만을 선별하여<br>정직한 가격으로 거래가<br>가능합니다.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>




<?php
include_once(G5_PATH."/tail.php");
?>