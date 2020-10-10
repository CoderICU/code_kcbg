@extends('layouts.app')

@section('head-extension')
<script language="JavaScript" src="{{ URL::asset('/') }}qrcode/qrcode.min.js"></script>
<script src="https://unpkg.com/vue-qrcode-reader/dist/VueQrcodeReader.umd.min.js"></script>

<style scoped>
    .error {
        font-weight: bold;
        color: red;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

            </div>
            <div style="width: 100%; height: 10px;"></div>
            <button type="button" class="btn btn-primary btn-lg btn-block" >再生成一个</button>
        </div>
    </div>
</div>

<div>
    <p class="error">@{{ error }}</p><!--错误信息-->

    <p class="decode-result">扫描结果: <b>@{{ result }}</b></p><!--扫描结果-->

    <qrcode-stream @decode="onDecode" @init="onInit"></qrcode-stream>
</div>

@endsection

@section('body-tail')
<script>
    //引入

    new Vue({
        //注册
        // components: { QrcodeStream },
        el: '#app',
        data: {
            result: '',//扫码结果信息
            error: '1123',//错误信息
        },
        mounted() {
            this.test();
        },
        methods: {
            onDecode (result) {
                this.result = result
            },
            async onInit (promise) {
                alert("456789");
                console.log(123);
                try {
                    await promise
                } catch (error) {
                    if (error.name === 'NotAllowedError') {
                        this.error = "ERROR: you need to grant camera access permisson"
                    } else if (error.name === 'NotFoundError') {
                        this.error = "ERROR: no camera on this device"
                    } else if (error.name === 'NotSupportedError') {
                        this.error = "ERROR: secure context required (HTTPS, localhost)"
                    } else if (error.name === 'NotReadableError') {
                        this.error = "ERROR: is the camera already in use?"
                    } else if (error.name === 'OverconstrainedError') {
                        this.error = "ERROR: installed cameras are not suitable"
                    } else if (error.name === 'StreamApiNotSupportedError') {
                        this.error = "ERROR: Stream API is not supported in this browser"
                    }
                    // alert("456789");
                    console.log(this.error);
                }
            },
            test() {

                this.error = "456789"
            }

        }
    })
</script>
@endsection
