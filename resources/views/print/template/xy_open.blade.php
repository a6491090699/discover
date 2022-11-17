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
            height: 35.25em;
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
            height: 3.525em;
        }
        .ie .stl_06 {
            height: 35.25em;
        }
        @font-face {
            font-family:"GVORHV+SimSun,Bold";
            src:url("1f24f75b-0000-0000-0000-000000000000.woff") format("woff");
        }
        .stl_07 {
            font-size: 1.33em;
            font-family: "GVORHV+SimSun,Bold", "Times New Roman";
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
            font-family: "GVORHV+SimSun,Bold", "Times New Roman";
            color: #000000;
        }
        @font-face {
            font-family:"WHMHVS+SimSun";
            src:url("a294590a-0000-0000-0000-000000000000.woff") format("woff");
        }
        .stl_11 {
            font-size: 1em;
            font-family: "WHMHVS+SimSun";
            color: #000000;
        }
        .stl_12 {
            font-size: 0.92em;
            font-family: "WHMHVS+SimSun";
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
            <object data="/static/approval/xy_open.svg" type="image/svg+xml" class="stl_04" style="position:absolute; width:47.9167em; height:35.25em;">
                <embed src="/static/approval/xy_open.svg" type="image/svg+xml" />
            </object>
        </div>
        <div class="stl_view">
            <div class="stl_05 stl_06">
                <div class="stl_01" style="left:16.0032em;top:3.2217em;"><span class="stl_07 stl_08 stl_09">福建漳龙外贸集团有限公司 &nbsp;</span></div>
                <div class="stl_01" style="left:18.6632em;top:4.9145em;"><span class="stl_07 stl_08 stl_09">信用证开证申请单 &nbsp;</span></div>
                <div class="stl_01" style="left:20.4833em;top:6.956em;"><span class="stl_10 stl_08 stl_09">{{$param['riqi']??'年  月  日'}} &nbsp;</span></div>
                <div class="stl_01" style="left:33.0972em;top:8.4543em;"><span class="stl_11 stl_08 stl_09">币别：人民币 &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:10.3665em;"><span class="stl_11 stl_08 stl_09">合同号：{{$param['sn']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:12.6234em;"><span class="stl_11 stl_08 stl_09">金额（大写）： &nbsp;</span></div>
                <div class="stl_01" style="left:22.272em;top:10.3665em;"><span class="stl_11 stl_08 stl_09">金额（小写）：{{$param['money']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:14.3643em;top:12.6234em;"><span class="stl_11 stl_08 stl_09">{{up_pinyin_money($param['money'])??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:8.5101em;top:14.5146em;"><span class="stl_11 stl_08 stl_09">
                    @for($i=0;$i<strlen($param['abstract']??'')/81;$i++)
                    {{substr($param['abstract'] , $i*81 , 81)}}<br>
                    @endfor &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:14.8804em;"><span class="stl_11 stl_08 stl_09">摘要： &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:19.3943em;"><span class="stl_11 stl_08 stl_09" style="word-spacing:0.5em;">最迟装船期： {{$param['ship_deadline']??'年  月  日'}} &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:21.6512em;"><span class="stl_11 stl_08 stl_09" style="word-spacing:0.5em;">付款期限： {{$param['pay_at']??' 即期/远期    天'}}</span></div>
                <div class="stl_01" style="left:22.272em;top:19.3943em;"><span class="stl_11 stl_08 stl_09">信用证有效期： {{$param['expired_at']??'年  月  日'}} &nbsp;</span></div>
                <div class="stl_01" style="left:22.272em;top:21.6512em;"><span class="stl_11 stl_08 stl_09">开证银行：{{$param['bank']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:23.5633em;"><span class="stl_11 stl_08 stl_09">董事长: &nbsp;</span></div>
                <div class="stl_01" style="left:7.1667em;top:25.8516em;"><span class="stl_11 stl_08 stl_09">{{$param['dsz']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:13.2893em;top:23.5633em;"><span class="stl_11 stl_08 stl_09">总会计师： &nbsp;</span></div>
                <div class="stl_01" style="left:16.1205em;top:25.8516em;"><span class="stl_11 stl_08 stl_09">{{$param['zkjs']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:13.2893em;top:28.1399em;"><span class="stl_11 stl_08 stl_09">部门经理: &nbsp;</span></div>
                <div class="stl_01" style="left:16.1205em;top:30.4282em;"><span class="stl_11 stl_08 stl_09">{{$param['bmjl']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:22.272em;top:23.5633em;"><span class="stl_11 stl_08 stl_09">财务经理: &nbsp;</span></div>
                <div class="stl_01" style="left:26.0245em;top:25.8516em;"><span class="stl_11 stl_08 stl_09">{{$param['cwjl']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:33.0972em;top:23.5633em;"><span class="stl_11 stl_08 stl_09">会计: &nbsp;</span></div>
                <div class="stl_01" style="left:36.8497em;top:25.8516em;"><span class="stl_11 stl_08 stl_09">{{$param['kj']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:36.8497em;top:30.4282em;"><span class="stl_11 stl_08 stl_09">{{$param['dzb']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:33.0972em;top:28.1886em;"><span class="stl_12 stl_08 stl_13">单证部: &nbsp;</span></div>
                <div class="stl_01" style="left:4.3643em;top:28.1399em;"><span class="stl_11 stl_08 stl_09">分管副总经理: &nbsp;</span></div>
                <div class="stl_01" style="left:7.1667em;top:30.4282em;"><span class="stl_11 stl_08 stl_09">{{$param['fgfzjl']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:22.272em;top:28.1399em;"><span class="stl_11 stl_08 stl_09">经办人: &nbsp;</span></div>
                <div class="stl_01" style="left:26.0245em;top:30.4282em;"><span class="stl_11 stl_08 stl_09">{{$param['jbr']??''}} &nbsp;</span></div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print()
</script>
</html>
