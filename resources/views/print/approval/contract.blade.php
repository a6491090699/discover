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
            width: 46.58333em;
            height: 62.33333em;
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
            width: 46.58333em;
        }
        .stl_06 {
            height: 6.233334em;
        }
        .ie .stl_06 {
            height: 62.33333em;
        }
        @font-face {
            font-family:"CUFUDR+SimSun,Bold";
            src:url("03fd5a90-0000-0000-0000-000000000000.woff") format("woff");
        }
        .stl_07 {
            font-size: 1.5em;
            font-family: "CUFUDR+SimSun,Bold", "Times New Roman";
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
        @font-face {
            font-family:"AUONAC+SimSun";
            src:url("4780ffbd-0000-0000-0000-000000000000.woff") format("woff");
        }
        .stl_10 {
            font-size: 1em;
            font-family: "AUONAC+SimSun", "Times New Roman";
            color: #000000;
        }
        @font-face {
            font-family:"PQVBKP+ArialMT";
            src:url("3e6bb16c-0000-0000-0000-000000000000.woff") format("woff");
        }
        .stl_11 {
            font-size: 1em;
            font-family: "PQVBKP+ArialMT";
            color: #000000;
        }
        .stl_12 {
            line-height: 1.117188em;
        }
        .stl_13 {
            letter-spacing: -0.0001em;
        }

        .ie .stl_13 {
            letter-spacing: -0.0017px;
        }
        .stl_14 {
            font-size: 1.33em;
            font-family: "AUONAC+SimSun", "Times New Roman";
            color: #000000;
        }
        .stl_15 {
            letter-spacing: -0em;
        }

        .ie .stl_15 {
            letter-spacing: -0px;
        }

    </style>
</head>

<body>
    <div class="stl_02">
        <div class="stl_03">
            <object data="/static/approval/contract.svg" type="image/svg+xml" class="stl_04" style="position:absolute; width:46.5833em; height:62.3333em;">
                <embed src="/static/approval/contract.svg" type="image/svg+xml" />
            </object>
        </div>
        <div class="stl_view">
            <div class="stl_05 stl_06">
                <div class="stl_01" style="left:11.2937em;top:6.6522em;"><span class="stl_07 stl_08 stl_09">漳州商贸集团有限公司合同会签审批表 &nbsp;</span></div>
                <div class="stl_01" style="left:25.4511em;top:10.3878em;"><span class="stl_10 stl_08 stl_09">合同编号 &nbsp;</span></div>
                <div class="stl_01" style="left:32.5824em;top:10.3419em;"><span class="stl_11 stl_12 stl_13">{{$param['sn']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:5.2064em;top:10.427em;"><span class="stl_10 stl_08 stl_09">合同名称 &nbsp;</span></div>
                <div class="stl_01" style="left:14.8403em;top:10.3538em;"><span class="stl_14 stl_08 stl_09">{{$param['contract_name']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:14.4279em;top:13.3913em;"><span class="stl_10 stl_08 stl_09">
                    @for($i=0;$i<strlen($param['content']??'')/78;$i++)
                    {{substr($param['content'] , $i*78 , 78)}}<br>
                    @endfor 
                    &nbsp;</span></div>
                <div class="stl_01" style="left:5.2064em;top:16.3022em;"><span class="stl_10 stl_08 stl_09">合同内容及利润测算 &nbsp;</span></div>
                <div class="stl_01" style="left:14.4279em;top:20.7755em;"><span class="stl_10 stl_08 stl_09">{{$param['tip_jbywy']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:37.2101em;top:21.9885em;"><span class="stl_10 stl_08 stl_09">签字：{{$param['jbywy']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:5.2064em;top:22.5627em;"><span class="stl_10 stl_08 stl_09">经办业务员 &nbsp;</span></div>
                <div class="stl_01" style="left:5.2064em;top:27.6996em;"><span class="stl_10 stl_08 stl_09">贸易部意见 &nbsp;</span></div>
                <div class="stl_01" style="left:5.2064em;top:32.8364em;"><span class="stl_10 stl_08 stl_09">风控部意见 &nbsp;</span></div>
                <div class="stl_01" style="left:5.2064em;top:37.9733em;"><span class="stl_10 stl_08 stl_09">财务部意见 &nbsp;</span></div>
                <div class="stl_01" style="left:5.2064em;top:43.1101em;"><span class="stl_10 stl_08 stl_09">副总经理意见 &nbsp;</span></div>
                <div class="stl_01" style="left:5.2064em;top:48.247em;"><span class="stl_10 stl_08 stl_09">总经理审批 &nbsp;</span></div>
                <div class="stl_01" style="left:5.2064em;top:53.3838em;"><span class="stl_10 stl_08 stl_09">董事长审批 &nbsp;</span></div>
                <div class="stl_01" style="left:35.5431em;top:23.2268em;"><span class="stl_11 stl_12 stl_09">{{$param['day_jbywy']??'__年__月__日'}}</span></div>
                <div class="stl_01" style="left:14.4279em;top:25.9124em;"><span class="stl_10 stl_08 stl_09">{{$param['tip_myb']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:37.2101em;top:27.1253em;"><span class="stl_10 stl_08 stl_09">签字：{{$param['myb']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:35.8209em;top:28.3636em;"><span class="stl_11 stl_12 stl_09">{{$param['day_myb']??'__年__月__日'}}</span></div>
                <div class="stl_01" style="left:14.4279em;top:31.0492em;"><span class="stl_10 stl_08 stl_09">{{$param['tip_fkb']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:37.2101em;top:32.2622em;"><span class="stl_10 stl_08 stl_09">签字：{{$param['fkb']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:35.8209em;top:33.5005em;"><span class="stl_11 stl_12 stl_09">{{$param['day_fkb']??'__年__月__日'}}</span></div>
                <div class="stl_01" style="left:14.4279em;top:36.1861em;"><span class="stl_10 stl_08 stl_09">{{$param['tip_cwb']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:37.2101em;top:37.399em;"><span class="stl_10 stl_08 stl_09">签字：{{$param['cwb']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:35.8209em;top:38.6373em;"><span class="stl_11 stl_12 stl_09">{{$param['day_cwb']??'__年__月__日'}}</span></div>
                <div class="stl_01" style="left:14.4279em;top:41.3229em;"><span class="stl_10 stl_08 stl_09">{{$param['tip_fzjl']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:37.2101em;top:42.5358em;"><span class="stl_10 stl_08 stl_09">签字：{{$param['fzjl']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:35.8209em;top:43.7741em;"><span class="stl_11 stl_12 stl_09">{{$param['day_fzjl']??'__年__月__日'}}</span></div>
                <div class="stl_01" style="left:14.4279em;top:46.4598em;"><span class="stl_10 stl_08 stl_09">{{$param['tip_zjl']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:37.2101em;top:47.6727em;"><span class="stl_10 stl_08 stl_09">签字：{{$param['zjl']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:35.8209em;top:48.911em;"><span class="stl_11 stl_12 stl_09">{{$param['day_zjl']??'__年__月__日'}}</span></div>
                <div class="stl_01" style="left:14.4279em;top:51.5966em;"><span class="stl_10 stl_08 stl_09">{{$param['tip_dsz']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:37.2101em;top:52.8095em;"><span class="stl_10 stl_08 stl_09">签字：{{$param['dsz']??''}} &nbsp;</span></div>
                <div class="stl_01" style="left:35.8209em;top:54.0478em;"><span class="stl_11 stl_12 stl_09">{{$param['day_dsz']??'__年__月__日'}}</span></div>
            </div>
        </div>
    </div>
</body>
<script>
    window.print()
</script>
</html>
