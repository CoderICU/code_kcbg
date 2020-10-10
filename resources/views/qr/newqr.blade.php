@extends('layouts.app')

@section('head-extension')
<script language="JavaScript" src="{{ URL::asset('/') }}qrcode/qrcode.min.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div id="qrcode" style="margin: auto; width: 300px; margin-top: 20px;"></div>
                <p style="margin-top: 15px; font-size: 16px; text-align: center;">{{ $code->sn }}</p>
            </div>
            <div style="width: 100%; height: 10px;"></div>
            <button type="button" class="btn btn-primary btn-lg btn-block"  v-on:click="reNewQr">再生成一个</button>
        </div>
    </div>
</div>

@endsection

@section('body-tail')
<script>
    new Vue({
        el: '#app',
        data: {

        },
        mounted() {
            this.qrcode();
        },
        methods: {
            qrcode() {
                var qrcode = new QRCode(document.getElementById("qrcode"), {
                    text: "{{ $code->sn }}",
                    width: 300,
                    height: 300,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            },
            reNewQr() {
                document.location.reload();
            }
        }
    })
</script>
@endsection
