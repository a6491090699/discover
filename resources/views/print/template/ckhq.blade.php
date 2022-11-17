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

        a:link {
            text-decoration: none;
        }

        a:visited {
            text-decoration: none;
        }

        @media screen and (min-device-pixel-ratio:0),
        (-webkit-min-device-pixel-ratio:0),
        (min--moz-device-pixel-ratio: 0) {
            .stl_view {
                font-size: 10em;
                transform: scale(0.1);
                -moz-transform: scale(0.1);
                -webkit-transform: scale(0.1);
                -moz-transform-origin: top left;
                -webkit-transform-origin: top left;
            }
        }

        .layer {}

        .ie {
            font-size: 1pt;
        }

        .ie body {
            font-size: 12em;
        }

        @media print {
            .stl_view {
                font-size: 1em;
                transform: scale(1);
            }
        }

        .grlink {
            position: relative;
            width: 100%;
            height: 100%;
            z-index: 1000000;
        }

        .stl_01 {
            position: absolute;
            white-space: nowrap;
        }

        .stl_02 {
            font-size: 1em;
            line-height: 0.0em;
            width: 49.5em;
            height: 67.91666em;
            border-style: none;
            display: block;
            margin: 0em;
        }

        @supports(-ms-ime-align:auto) {
            .stl_02 {
                overflow: hidden;
            }
        }

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
            width: 49.5em;
        }

        .stl_06 {
            height: 6.791667em;
        }

        .ie .stl_06 {
            height: 67.91666em;
        }

        @font-face {
            font-family: "FHGFDG+SimSun,Bold";
            src: url("32866ec7-0000-0000-0000-000000000000.woff") format("woff");
        }

        .stl_07 {
            font-size: 1.41em;
            font-family: "FHGFDG+SimSun,Bold", "Times New Roman";
            color: #000000;
        }

        .stl_08 {
            line-height: 1em;
        }

        .stl_09 {
            letter-spacing: -0em;
        }

        .ie .stl_09 {
            letter-spacing: -0px;
        }

        @font-face {
            font-family: "QRCQPV+ArialMT";
            src: url("d7837021-0000-0000-0000-000000000000.woff") format("woff");
        }

        .stl_10 {
            font-size: 1.1em;
            font-family: "QRCQPV+ArialMT";
            color: #000000;
        }

        .stl_11 {
            line-height: 1.117187em;
        }

        .stl_12 {
            letter-spacing: -0.0002em;
        }

        .ie .stl_12 {
            letter-spacing: -0.0027px;
        }

        @font-face {
            font-family: "NROWJF+SimSun";
            src: url("13ee3cea-0000-0000-0000-000000000000.woff") format("woff");
        }

        .stl_13 {
            font-size: 1.1em;
            font-family: "NROWJF+SimSun", "Times New Roman";
            color: #000000;
        }

        .stl_14 {
            letter-spacing: 0em;
        }

        .ie .stl_14 {
            letter-spacing: 0px;
        }
    </style>
</head>

<body>
    <div class="stl_02">
        <div class="stl_03">
            <object data="/static/approval/ckhq.svg" type="image/svg+xml" class="stl_04"
                style="position:absolute; width:49.5em; height:67.9167em;">
                <embed src="/static/approval/ckhq.svg" type="image/svg+xml" />
            </object>
        </div>
        <div class="stl_view">
            <div class="stl_05 stl_06">
                <div class="stl_01" style="left:9.4477em;top:6.6311em;"><span class="stl_07 stl_08 stl_09">福建漳龙外贸集团有限公司出库或货权审批表 &nbsp;</span></div>
                <div class="stl_01" style="left:38.4532em;top:10.0414em;"><span class="stl_10 stl_11 stl_12">{{$param['ck_sn']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:29.8844em;top:10.122em;"><span class="stl_13 stl_08 stl_09">合同编号 &nbsp;</span></div>
                <div class="stl_01" style="left:8.2054em;top:10.2005em;"><span class="stl_13 stl_08 stl_14">出库单编号 &nbsp;</span></div>
                <div class="stl_01" style="left:19.9663em;top:10.2005em;"><span class="stl_13 stl_08 stl_09">{{$param['ht_sn']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:17.0323em;top:13.1681em;"><span class="stl_13 stl_08 stl_09">
                    @for($i=0;$i<strlen($param['ht_abstract']??'')/81;$i++)
                    {{substr($param['ht_abstract'] , $i*81 , 81)}}<br>
                    @endfor
                    &nbsp;</span></div>
                {{-- <div class="stl_01" style="left:17.0323em;top:13.1681em;"><span class="stl_13 stl_08 stl_09">划水大户浮点数水电费第三方都是对的多多多多多多多多多多 &nbsp;</span></div> --}}
                <div class="stl_01" style="left:8.7554em;top:16.9988em;"><span class="stl_13 stl_08 stl_14">合同摘要 &nbsp;</span></div>
                <div class="stl_01" style="left:17.0323em;top:22.6604em;"><span class="stl_13 stl_08 stl_09">
                    @for($i=0;$i<strlen($param['th_info']??'')/81;$i++)
                    {{substr($param['th_info'] , $i*81 , 81)}}<br>
                    @endfor &nbsp;</span></div>
                <div class="stl_01" style="left:6.0054em;top:28.6257em;"><span class="stl_13 stl_08 stl_14">提货单位及货物明细 &nbsp;</span></div>
                <div class="stl_01" style="left:8.2054em;top:38.4037em;"><span class="stl_13 stl_08 stl_14">经办业务员 &nbsp;</span></div>
                <div class="stl_01" style="left:8.2054em;top:44.7192em;"><span class="stl_13 stl_08 stl_14">财务部意见 &nbsp;</span></div>
                <div class="stl_01" style="left:27.7573em;top:38.4037em;"><span class="stl_13 stl_08 stl_09">{{$param['jb_man']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:29.4073em;top:44.7192em;"><span class="stl_13 stl_08 stl_09">{{$param['cw_tip']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:8.2054em;top:51.4813em;"><span class="stl_13 stl_08 stl_14">贸管部意见 &nbsp;</span></div>
                <div class="stl_01" style="left:29.4073em;top:51.4813em;"><span class="stl_13 stl_08 stl_09">{{$param['mg_tip']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:29.9573em;top:58.2051em;"><span class="stl_13 stl_08 stl_09">{{$param['main_check']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:7.6554em;top:58.2051em;"><span class="stl_13 stl_08 stl_14">分管副总审批 &nbsp;</span></div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print()
</script>

</html>
