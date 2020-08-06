<?php
/**
 * Created by PhpStorm.
 * User: theline
 * Date: 2017-05-03
 * Time: 오후 4:42
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function email_html_signin($name, $id, $password){
    $html = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<!-- If you delete this meta tag, Half Life 3 will never be released. -->
<meta name=\"viewport\" content=\"width=device-width\" />

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<title>ZURBemails</title>

</head>

<body bgcolor=\"#FFFFFF\" style=\"-webkit-font-smoothing:antialiased;
                               -webkit-text-size-adjust:none;
                               width: 100%!important;
                               height: 100%;\">

<!-- HEADER -->
<table style=\"width: 100%;
              margin: 0;
              padding: 0;
              border: 0;
              border-collapse: collapse;\" border=\"0\">
	<tr style=\"margin: 0;
               padding: 0;
               border: 0;\">
		<td></td>
		<td style=\"display:block!important;max-width:640px!important;margin:0 auto!important;clear:both!important;\">
            <img src=\"http://i.imgur.com/2ARR0uR.png\" style=\"max-width: 100%;margin-bottom:10px;\" />
        </td>
		<td></td>
	</tr><!-- logo top -->

    <tr style=\"margin: 0;
               padding: 0;
               border: 0;\">
        <td style=\"padding:0;\"></td>
        <td style=\"background-image:url(http://i.imgur.com/s5W0QXj.jpg);
                   background-repeat:no-repeat;
                   background-size:contain;
                   display:block!important;
                   width:640px!important;
                   height:140px!important;
                   margin:0 auto!important;
                   clear:both!important;
                   padding-top:0px;
                   padding-bottom:0;\">
            <div style=\"padding-top:30px;\">
                <h1 style=\"color:#fff;text-align:center;margin-top:0;font-weight:normal;font-size:40px;letter-spacing:-5px;\">회원가입을&nbsp;&nbsp;축하드립니다</h1>
                <p style=\"font-size:13px;color:#fff;text-align:center;font-family:Helvetica, sans-serif;letter-spacing: 28px;margin-top:-10px;\">CONGRATULATION</p>
            </div>
        </td>
        <td style=\"padding:0;\"></td>
    </tr><!-- top content -->

    <tr style=\"margin: 0;
               padding: 0;
               border: 0;\">
		<td></td>
		<td bgcolor=\"#e6e6e6\" style=\"display:block!important;
                                     max-width:640px!important;
                                     margin:0 auto!important;
                                     clear:both!important;
                                     padding-top:50px;
                                     padding-bottom:80px;\">


            <p style=\"text-align:center;color:#333;font-size:16px;\">
                안녕하세요. 더라인성형외과입니다.
                <br>
                회원가입을 축하드리며, 앞으로도 회원님을 생각하는 더라인이 되겠습니다.
                <br>
                <span style=\"color:#ec185f;\">".$name."</span> 회원님의 가입정보는 다음과 같습니다.
            </p>

            <table bgcolor=\"#ffffff\" style=\"width:70%;
                                            display:block;
                                            margin-left:auto;
                                            margin-right:auto;
                                            border-radius:20px;
                                            padding-top: 50px;
                                            padding-bottom: 50px;
                                            margin-top:30px;\">
                <tr>
                    <td></td>
                    <td>
                        <div style=\"width:100%;\">
                            <p style=\"font-size:24px;text-align:left;text-indent:100px;margin-bottom:0px;margin-top:0px;color:#666;\">아이디 : <a href=\"#\" style=\"color:#ec185f;text-decoration:none;font-family:Helvetica, sans-serif;\">".$id."</a></p>
                            <p style=\"font-size:24px;text-align:left;text-indent:100px;margin-bottom:0px;margin-top:0px;font-family:Helvetica, sans-serif;color:#666;\">비밀번호 : <a href=\"#\" style=\"color:#ec185f;text-decoration:none;\">".str_pad(substr($password, 0, 3), 10 , "*")."</a></p>
                        </div>
                    </td>
                    <td></td>
                </tr>
            </table>

		</td>
		<td></td>
	</tr><!-- middle content -->

    <tr>
        <td></td>
        <td bgcolor=\"#828282\" style=\"display:block!important;
                                     max-width:640px!important;
                                     margin:0 auto!important;
                                     clear:both!important;
                                     padding-top:30px;
                                     padding-bottom:30px;\">

            <p style=\"text-align:center;color:#fff;font-size:13px;font-family:sans-serif;\">
            본 메일은 정보통신망 이용촉진 및 정보보호 등에 관한 법률 시행 규칙에 의거
            <br>
            2017/04/02 기준 회원님의 광고 메일 수신동의로 발송되었습니다.
            <br>
            발신전용 메일로 회신이 되지 않습니다. 관련 문의사항은 <a href=\"#\">고객센터</a>를 이용하여 주시기 바랍니다.
            <br>
            메일 수신을 원하지 않으시면, 이메일 <a href=\"#\">수신거부</a>를 눌러주세요.
            <br>
            If you don’t want to receive this mail anymore, <a href=\"#\">click here</a>
            </p>


        </td>
        <td></td>
    </tr><!-- footer content -->

    <tr>
        <td></td>
        <td bgcolor=\"#ffffff\" style=\"display:block!important;
                                     max-width:640px!important;
                                     margin:0 auto!important;
                                     clear:both!important;
                                     padding-top:20px;
                                     padding-bottom:50px;\">

            <p style=\"text-align:center;color:#333;font-size:13px;font-family:sans-serif;\">
                서울 강남구 도산대로 157 신웅타워2 서울 강남구 신사동 561-31&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;이메일 : admin@theline-ps.com
            </p>
            <br>
            <hr style=\"color:#828282;\">
        </td>
        <td></td>
    </tr><!-- credit -->

</table><!-- /HEADER -->

</body>
</html>";

    return $html;
}

function email_html_search($name, $id, $password){
    $html = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<!-- If you delete this meta tag, Half Life 3 will never be released. -->
<meta name=\"viewport\" content=\"width=device-width\" />

<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<title>ZURBemails</title>

</head>

<body bgcolor=\"#FFFFFF\" style=\"-webkit-font-smoothing:antialiased;
                               -webkit-text-size-adjust:none;
                               width: 100%!important;
                               height: 100%;\">

<!-- HEADER -->
<table style=\"width: 100%;
              margin: 0;
              padding: 0;
              border: 0;
              border-collapse: collapse;\" border=\"0\">
	<tr style=\"margin: 0;
               padding: 0;
               border: 0;\">
		<td></td>
		<td style=\"display:block!important;max-width:640px!important;margin:0 auto!important;clear:both!important;\">
            <img src=\"http://i.imgur.com/2ARR0uR.png\" style=\"max-width: 100%;margin-bottom:10px;\" />
        </td>
		<td></td>
	</tr><!-- logo top -->

    <tr style=\"margin: 0;
               padding: 0;
               border: 0;\">
        <td style=\"padding:0;\"></td>
        <td style=\"background-image:url(http://i.imgur.com/s5W0QXj.jpg);
                   background-repeat:no-repeat;
                   background-size:contain;
                   display:block!important;
                   width:640px!important;
                   height:140px!important;
                   margin:0 auto!important;
                   clear:both!important;
                   padding-top:0px;
                   padding-bottom:0;\">
            <div style=\"padding-top:30px;\">
                <h1 style=\"color:#fff;text-align:center;margin-top:0;font-weight:normal;font-size:40px;letter-spacing:-5px;\">비밀번호가&nbsp;&nbsp;초기화되었습니다</h1>
                <p style=\"font-size:13px;color:#fff;text-align:center;font-family:Helvetica, sans-serif;letter-spacing: 28px;margin-top:-10px;\"></p>
            </div>
        </td>
        <td style=\"padding:0;\"></td>
    </tr><!-- top content -->

    <tr style=\"margin: 0;
               padding: 0;
               border: 0;\">
		<td></td>
		<td bgcolor=\"#e6e6e6\" style=\"display:block!important;
                                     max-width:640px!important;
                                     margin:0 auto!important;
                                     clear:both!important;
                                     padding-top:50px;
                                     padding-bottom:80px;\">


            <p style=\"text-align:center;color:#333;font-size:16px;\">
                안녕하세요. 더라인성형외과입니다.
                <br/>
                <span style=\"color:#ec185f;\">".$name."</span> 회원님의 초기화된 비밀번호는 다음과 같습니다.
            </p>

            <table bgcolor=\"#ffffff\" style=\"width:70%;
                                            display:block;
                                            margin-left:auto;
                                            margin-right:auto;
                                            border-radius:20px;
                                            padding-top: 50px;
                                            padding-bottom: 50px;
                                            margin-top:30px;\">
                <tr>
                    <td></td>
                    <td>
                        <div style=\"width:100%;\">
                            <p style=\"font-size:24px;text-align:left;text-indent:100px;margin-bottom:0px;margin-top:0px;color:#666;\">아이디 : <a href=\"#\" style=\"color:#ec185f;text-decoration:none;font-family:Helvetica, sans-serif;\">".$id."</a></p>
                            <p style=\"font-size:24px;text-align:left;text-indent:100px;margin-bottom:0px;margin-top:0px;font-family:Helvetica, sans-serif;color:#666;\">비밀번호 : <a href=\"#\" style=\"color:#ec185f;text-decoration:none;\">".$password."</a></p>
                        </div>
                    </td>
                    <td></td>
                </tr>
            </table>

		</td>
		<td></td>
	</tr><!-- middle content -->

    <tr>
        <td></td>
        <td bgcolor=\"#828282\" style=\"display:block!important;
                                     max-width:640px!important;
                                     margin:0 auto!important;
                                     clear:both!important;
                                     padding-top:30px;
                                     padding-bottom:30px;\">

            <p style=\"text-align:center;color:#fff;font-size:13px;font-family:sans-serif;\">
            본 메일은 정보통신망 이용촉진 및 정보보호 등에 관한 법률 시행 규칙에 의거
            <br>
            2017/04/02 기준 회원님의 광고 메일 수신동의로 발송되었습니다.
            <br>
            발신전용 메일로 회신이 되지 않습니다. 관련 문의사항은 <a href=\"#\">고객센터</a>를 이용하여 주시기 바랍니다.
            <br>
            메일 수신을 원하지 않으시면, 이메일 <a href=\"#\">수신거부</a>를 눌러주세요.
            <br>
            If you don’t want to receive this mail anymore, <a href=\"#\">click here</a>
            </p>


        </td>
        <td></td>
    </tr><!-- footer content -->

    <tr>
        <td></td>
        <td bgcolor=\"#ffffff\" style=\"display:block!important;
                                     max-width:640px!important;
                                     margin:0 auto!important;
                                     clear:both!important;
                                     padding-top:20px;
                                     padding-bottom:50px;\">

            <p style=\"text-align:center;color:#333;font-size:13px;font-family:sans-serif;\">
                서울 강남구 도산대로 157 신웅타워2 서울 강남구 신사동 561-31&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;이메일 : admin@theline-ps.com
            </p>
            <br>
            <hr style=\"color:#828282;\">
        </td>
        <td></td>
    </tr><!-- credit -->

</table><!-- /HEADER -->

</body>
</html>";

    return $html;
}