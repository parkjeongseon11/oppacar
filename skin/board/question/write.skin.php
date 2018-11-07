<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<div class="contents">
    <div id="ctn_wrap">
        <div class="ctn_tit online">
            <h2><span>궁금</span>합니다 글쓰기</h2>
            <p>CUSTOMER INQUIRY SERVICE WRITING</p>
        </div>



        <section id="bo_w">
            <h2 class="sound_only"><?php echo $g5['title'] ?></h2>

            <!-- 게시물 작성/수정 시작 { -->
            <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
                <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                <input type="hidden" name="w" value="<?php echo $w ?>">
                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                <input type="hidden" name="stx" value="<?php echo $stx ?>">
                <input type="hidden" name="spt" value="<?php echo $spt ?>">
                <input type="hidden" name="sst" value="<?php echo $sst ?>">
                <input type="hidden" name="sod" value="<?php echo $sod ?>">
                <input type="hidden" name="page" value="<?php echo $page ?>">
                <?php
                $option = '';
                $option_hidden = '';
                if ($is_notice || $is_html || $is_secret || $is_mail) {
                    $option = '';
                    if ($is_notice) {
                        $option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
                    }


                    if ($is_secret) {
                        if ($is_admin || $is_secret==1) {
                            $option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
                        } else {
                            $option_hidden .= '<input type="hidden" name="secret" value="secret">';
                        }
                    }

                    if ($is_mail) {
                        $option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
                    }
                }

                echo $option_hidden;
                ?>

                <?php if ($is_category) { ?>
                    <div class="bo_w_select write_div">
                        <label for="ca_name"  class="sound_only">분류<strong>필수</strong></label>
                        <select name="ca_name" id="ca_name" required>
                            <option value="">분류를 선택하세요</option>
                            <?php echo $category_option ?>
                        </select>
                    </div>
                <?php } ?>


                <?php if ($option) { ?>
                    <div class="write_div line_weite write_all">
                        <div class="title">옵션</div>
                        <div class="write_cts write_cts2">
                            <span class="sound_only">옵션</span>
                            <?php echo $option ?>
                        </div>
                    </div>
                <?php } ?>


                <div class="bo_w_info write_div write_all">
                    <div class="title">성명</div>
                    <?php if ($is_name) { ?>
                        <div class="write_cts">
                            <label for="wr_name" class="sound_only">성명<strong>필수</strong></label>
                            <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required">
                        </div>
                    <?php } ?>

                    <div class="title write_all">비밀번호</div>
                    <?php if ($is_password) { ?>
                        <div class="write_cts">
                            <label for="wr_password" class="sound_only">비밀번호<strong>필수</strong></label>
                            <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>">
                        </div>
                    <?php } ?>



                    <div class="bo_w_tit write_div write_all">
                        <div class="title">제목</div>
                        <label for="wr_subject" class="sound_only">제목<strong>필수</strong></label>

                        <div id="autosave_wrapper write_div">
                            <div class="write_cts">
                                <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input full_input required" size="50" maxlength="255">
                            </div>
                            <?php if ($is_member) { // 임시 저장된 글 기능 ?>
                                <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
                            <?php if($editor_content_js) echo $editor_content_js; ?>
                                <button type="button" id="btn_autosave" class="btn_frmline">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
                                <div id="autosave_pop">
                                    <strong>임시 저장된 글 목록</strong>
                                    <ul></ul>
                                    <div><button type="button" class="autosave_close">닫기</button></div>
                                </div>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="write_div write_all">
                        <div class="title title2">내용</div>
                        <div class="write_cts write_cts3">
                            <label for="wr_content" class="sound_only">내용<strong>필수</strong></label>
                            <div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
                                <?php if($write_min || $write_max) { ?>
                                    <!-- 최소/최대 글자 수 사용 시 -->
                                    <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                                <?php } ?>
                                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                                <?php if($write_min || $write_max) { ?>
                                    <!-- 최소/최대 글자 수 사용 시 -->
                                    <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>


                    <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
                        <div class="bo_w_flie write_div">
                            <div class="file_wr write_div ctn_flie">
                                <div class="title title3">첨부파일</div>
                                <label for="bf_file_<?php echo $i+1 ?>" class="lb_icon"><span class="sound_only"> 파일 #<?php echo $i+1 ?></span></label>
                                <input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능"  class="frm_file write_cts write_cts4">
                            </div>
                            <?php if ($is_file_content) { ?>
                                <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input" size="50" placeholder="파일 설명을 입력해주세요.">
                            <?php } ?>

                            <?php if($w == 'u' && $file[$i]['file']) { ?>
                                <span class="file_del">
                                  <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                                </span>
                            <?php } ?>

                        </div>
                    <?php } ?>


                    <div class="privacy">
                        <h3>개인정보 수집 및 이용동의</h3>
                        <div class="privacy_box">
                            <div class="privacy_txt">
                                <p>오빠카(이하 "회사")는 통신비밀 보호법, 전기통신사업법, 정보통신망 이용 촉진 및 정보보호 등에 관한 법률, 개인정보보호법 및 정부가 제정한 개인 정보보호 지침 등 정보통신서비스 제공자가 준수하여야 할 관련 법령상의 개인 정보보호 규정을 준수하며, 관련 법령에 의거한 개인정보취급방침을 정하여 이용자의 권익 보호에 최선을 다하고 있습니다.</p>
                                <strong>●  수집하는 개인 정보 항목</strong>
                                <em>1. 닉네임, 연락처</em>
                                <strong>●  수집/이용목적</strong>
                                <em>1. 닉네임, 연락처 : 상담글에 대한 답변 처리 및 직접 상담 시 활용
                                    <span>2. 암호 : 회원가입 없이 작성 글에 대한 수정 및 삭제 처리 시 필요</span></em>
                                <strong>●  수집하는 개인 정보의 보유기간</strong>
                                <em>1. 개인 정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다.</em>
                            </div>
                        </div>

                        <input type="checkbox" name="agree1" class="agree_checkbox"><label for="check1" class="check_label">개인정보 수집 및 이용 동의 <span>(필수)</span></label><br /><br />


                    </div>






                    <div class="btn_confirm write_div">
                        <a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_cancel btn">취소</a>
                        <input type="submit" value="작성완료" id="btn_submit" accesskey="s" class="btn_submit btn">
                    </div>
            </form>

            <script>
                <?php if($write_min || $write_max) { ?>
                // 글자수 제한
                var char_min = parseInt(<?php echo $write_min; ?>); // 최소
                var char_max = parseInt(<?php echo $write_max; ?>); // 최대
                check_byte("wr_content", "char_count");

                $(function() {
                    $("#wr_content").on("keyup", function() {
                        check_byte("wr_content", "char_count");
                    });
                });

                <?php } ?>
                function html_auto_br(obj)
                {
                    if (obj.checked) {
                        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
                        if (result)
                            obj.value = "html2";
                        else
                            obj.value = "html1";
                    }
                    else
                        obj.value = "";
                }

                function fwrite_submit(f)
                {
                    <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

                    var subject = "";
                    var content = "";
                    $.ajax({
                        url: g5_bbs_url+"/ajax.filter.php",
                        type: "POST",
                        data: {
                            "subject": f.wr_subject.value,
                            "content": f.wr_content.value
                        },
                        dataType: "json",
                        async: false,
                        cache: false,
                        success: function(data, textStatus) {
                            subject = data.subject;
                            content = data.content;
                        }
                    });

                    if (subject) {
                        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
                        f.wr_subject.focus();
                        return false;
                    }

                    if (content) {
                        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
                        if (typeof(ed_wr_content) != "undefined")
                            ed_wr_content.returnFalse();
                        else
                            f.wr_content.focus();
                        return false;
                    }

                    if (document.getElementById("char_count")) {
                        if (char_min > 0 || char_max > 0) {
                            var cnt = parseInt(check_byte("wr_content", "char_count"));
                            if (char_min > 0 && char_min > cnt) {
                                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                                return false;
                            }
                            else if (char_max > 0 && char_max < cnt) {
                                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                                return false;
                            }
                        }
                    }

                    function fwrite_submit(f)

                    <? if ($is_guest) { ?>
                    if (f.w.value == '') {
                        if (!f.agree1.checked) {
                            alert('개인정보 수집 및 이용에 대한 동의하지 않으면 등록하실 수 없습니다.');
                            f.agree1.focus();
                            return false;
                        }
                    }
                    <? } ?>

                    <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

                    document.getElementById("btn_submit").disabled = "disabled";

                    return true;
                }
            </script>
        </section>
        <!-- } 게시물 작성/수정 끝 -->


    </div>
</div>
