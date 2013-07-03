NSYSUAPI-selcrs-qrycrsfrm
=========================

A API for transform NSYSU class select system to JSON.


getDepartmentList.php

取得當學期選課系統可選的開課系所列表

getClassofDepartment.php

輸入開課系所回傳本學期可取得的課程

input:
<ul>
<li>D0 : 學年度</li>
<li>D1 : 開課系所</li>
</ul>


testLogin

輸入帳號密碼檢查是否合法

input:
<ul>
<li>SID : 帳號</li>
<li>PASSWD : 密碼</li>
</ul>

loginStudentCourse.php

登入選課系統並取得可用之Cookie(SESSION)

input:
<ul>
<li>SID : 帳號</li>
<li>PASSWD : 密碼</li>
</ul>


getStudentCourse.php

取得該SESSION之當學期選課紀錄

input:
<ul>
<li>cookie : cookie</li>
</ul>


