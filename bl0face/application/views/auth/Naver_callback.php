<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2017-01-14
 * Time: 오전 11:52
 */
?>
<!doctype html>
<html lang="ko">
<head>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.2.js" charset="utf-8"></script>
</head>
<body>
<script type="text/javascript">
    var naver_id_login = new naver_id_login("rhrZkfbYAZEnCF3dyZsw", "http://theline.kr/auth/login_naver_callback");
    // 네이버 사용자 프로필 조회
    naver_id_login.get_naver_userprofile("naverSignInCallback()");
    // 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
    function naverSignInCallback() {
        $.post("/auth/login_sns_process/nv", {name: naver_id_login.getProfileData('nickname'), email: naver_id_login.getProfileData('email'), id: naver_id_login.getProfileData('email')},
            function (postphpdata) {
                if (naver_id_login.oauthParams.access_token) {
                    window.opener.location.href='/index';
                    self.close();
                }
            });
    }
</script>
</body>
</html>
