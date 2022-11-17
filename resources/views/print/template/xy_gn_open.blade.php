<!DOCTYPE html>
<!--[if IE]>  <html class="ie"> <![endif]-->
<html>

<head>
    <meta charset="utf-8" />
    <title>
    </title>
    <style>
        sup {
            vertical-align: baseline;
            position: relative;
            top: -0.4em;
        }
        sub {
            vertical-align: baseline;
            position: relative;
            top: 0.4em;
        }
        a:link {text-decoration:none;}
        a:visited {text-decoration:none;}
        @media screen and (min-device-pixel-ratio:0), (-webkit-min-device-pixel-ratio:0), (min--moz-device-pixel-ratio: 0) {.stl_view{ font-size:10em; transform:scale(0.1); -moz-transform:scale(0.1); -webkit-transform:scale(0.1); -moz-transform-origin:top left; -webkit-transform-origin:top left; } }
        .layer { }.ie { font-size: 1pt; }
        .ie body { font-size: 12em; }
        @media print{.stl_view {font-size:1em; transform:scale(1);}}
        .grlink { position:relative;width:100%;height:100%;z-index:1000000; }
        .stl_01 {
            position: absolute;
            white-space: nowrap;
        }
        .stl_02 {
            font-size: 1em;
            line-height: 0.0em;
            width: 47.91667em;
            height: 35.16667em;
            border-style: none;
            display: block;
            margin: 0em;
        }

        @supports(-ms-ime-align:auto) { .stl_02 {overflow: hidden;}}
        .stl_03 {
            position: relative;
        }
        .stl_04 {
            position: absolute;
            left: 0em;
            top: 0em;
        }
        .stl_05 {
            position: relative;
            width: 47.91667em;
        }
        .stl_06 {
            height: 3.516667em;
        }
        .ie .stl_06 {
            height: 35.16667em;
        }
        @font-face {
            font-family:"MUDVCJ+SimSun,Bold";
            src:url("24046419-0000-0000-0000-000000000000.woff") format("woff");
        }
        .stl_07 {
            font-size: 1.33em;
            font-family: "MUDVCJ+SimSun,Bold", "Times New Roman";
            color: #000000;
        }
        .stl_08 {
            line-height: 1em;
        }
        .stl_09 {
            letter-spacing: 0em;
        }

        .ie .stl_09 {
            letter-spacing: 0px;
        }
        .stl_10 {
            font-size: 1em;
            font-family: "MUDVCJ+SimSun,Bold", "Times New Roman";
            color: #000000;
        }
        @font-face {
            font-family:"QBEDNR+SimSun";
            src:url("4b1e31e7-0000-0000-0000-000000000000.woff") format("woff");
        }
        .stl_11 {
            font-size: 1em;
            font-family: "QBEDNR+SimSun";
            color: #000000;
        }
        .stl_12 {
            font-size: 0.92em;
            font-family: "QBEDNR+SimSun";
            color: #000000;
        }
        .stl_13 {
            letter-spacing: -0em;
        }

        .ie .stl_13 {
            letter-spacing: -0px;
        }

    </style>
</head>

<body>
    <div class="stl_02">
        <div class="stl_03">
            <object data="/static/approval/xy_gn_open.svg" type="image/svg+xml" class="stl_04" style="position:absolute; width:47.9167em; height:35.1667em;">
                <embed src="/static/approval/xy_gn_open.svg" type="image/svg+xml" />
            </object>
        </div>
        <div class="stl_view">
            <div class="stl_05 stl_06">
                <div class="stl_01" style="left:16.0032em;top:3.2136em;"><span class="stl_07 stl_08 stl_09">福建漳龙外贸集团有限公司 &nbsp;</span></div>
                <div class="stl_01" style="left:17.3332em;top:4.9064em;"><span class="stl_07 stl_08 stl_09">国内信用证开证申请单 &nbsp;</span></div>
                <div class="stl_01" style="left:20.4833em;top:6.8977em;"><span class="stl_10 stl_08 stl_09">{{$param['riqi']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:33.0972em;top:8.371em;"><span class="stl_11 stl_08 stl_09">币别：人民币 &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:10.2831em;"><span class="stl_11 stl_08 stl_09">合同号：{{$param['sn']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:12.5401em;"><span class="stl_11 stl_08 stl_09">金额（大写）： &nbsp;</span></div>
                <div class="stl_01" style="left:22.272em;top:10.2831em;"><span class="stl_11 stl_08 stl_09">金额（小写）：{{$param['price']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:14.3643em;top:12.5401em;"><span class="stl_11 stl_08 stl_09">{{up_pinyin_money($param['price'])??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:8.5101em;top:14.4313em;"><span class="stl_11 stl_08 stl_09">
                    @for($i=0;$i<strlen($param['abstract']??'')/81;$i++)
                    {{substr($param['abstract'] , $i*81 , 81)}}<br>
                    @endfor &nbsp;</span></div>
                {{-- <div class="stl_01" style="left:8.5101em;top:15.6225em;"><span class="stl_11 stl_08 stl_09">所所锁 &nbsp;</span></div> --}}
                <div class="stl_01" style="left:4.3643em;top:14.797em;"><span class="stl_11 stl_08 stl_09">摘要： &nbsp;</span></div>
                <div class="stl_01" style="left:4.2875em;top:19.3109em;"><span class="stl_11 stl_08 stl_09">信用证有效期： {{$param['expired_at']??'年  月  日'}} &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:21.5679em;"><span class="stl_11 stl_08 stl_09">开证银行：{{$param['bank']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:23.48em;"><span class="stl_11 stl_08 stl_09">董事长: &nbsp;</span></div>
                <div class="stl_01" style="left:7.1667em;top:25.7683em;"><span class="stl_11 stl_08 stl_09">{{$param['dsz']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:13.2893em;top:23.48em;"><span class="stl_11 stl_08 stl_09">总会计师: &nbsp;</span></div>
                <div class="stl_01" style="left:16.1205em;top:25.7683em;"><span class="stl_11 stl_08 stl_09">{{$param['zkjs']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:13.2893em;top:28.0566em;"><span class="stl_11 stl_08 stl_09">部门经理: &nbsp;</span></div>
                <div class="stl_01" style="left:16.1205em;top:30.3449em;"><span class="stl_11 stl_08 stl_09">{{$param['bmjl']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:22.272em;top:23.48em;"><span class="stl_11 stl_08 stl_09">财务经理: &nbsp;</span></div>
                <div class="stl_01" style="left:26.0245em;top:25.7683em;"><span class="stl_11 stl_08 stl_09">{{$param['cwjl']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:33.0972em;top:23.48em;"><span class="stl_11 stl_08 stl_09">会计: &nbsp;</span></div>
                <div class="stl_01" style="left:36.8497em;top:25.7683em;"><span class="stl_11 stl_08 stl_09">{{$param['kj']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:36.8497em;top:30.3449em;"><span class="stl_11 stl_08 stl_09">{{$param['dzb']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:33.0972em;top:28.1052em;"><span class="stl_12 stl_08 stl_13">单证部: &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:28.0566em;"><span class="stl_11 stl_08 stl_09">分管副总经理: &nbsp;</span></div>
                <div class="stl_01" style="left:7.1667em;top:30.3449em;"><span class="stl_11 stl_08 stl_09">{{$param['fgfzjl']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:22.272em;top:28.0566em;"><span class="stl_11 stl_08 stl_09">经办人: &nbsp;</span></div>
                <div class="stl_01" style="left:26.0245em;top:30.3449em;"><span class="stl_11 stl_08 stl_09">{{$param['jbr']??''}} &nbsp;</span></div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print()
</script>
</html>
